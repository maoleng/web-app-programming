<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Libraries\Request\Request;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
        $date = $request->get('date');
        $date = in_array($date, [null, ''], true) ? now()->format('Y-m-d') : $date;
        $schedules = (new Schedule)->raw("
            SELECT schedules.*, movies.name, movies.description, movies.banner
            FROM schedules
            LEFT JOIN movies ON schedules.movie_id = movies.id
            WHERE YEARWEEK(`started_at`, 1) = YEARWEEK('$date', 1)
            ORDER BY started_at
        ");

        $groups = $this->getWeekArrayKey($date);
        foreach ($schedules as $schedule) {
            $started_at = $schedule->startedAt();
            $schedule->date = $started_at->format('Y-m-d');
            $schedule->started_time = $started_at->format('H:i');
            $schedule->ended_time = $schedule->endedAt()->format('H:i');
            $groups[$started_at->englishDayOfWeek."<br>{$started_at->format('d-m')}"][] = $schedule;
        }

        return view('admin.schedule.index', [
            'groups' => $groups,
        ]);
    }

    public function update(Request $request, $id): void
    {
        $data = $request->all();
        $data['started_at'] = "{$data['date']} {$data['started_at']}:00";
        $data['ended_at'] = "{$data['date']} {$data['ended_at']}:00";
        unset($data['date']);

        (new Schedule)->where('id', $id)->update($data);

        redirectBackWithSuccess('Update schedule successfully');
    }

    private function getWeekArrayKey($base_date): array
    {
        $groups = [];
        $start = Carbon::make($base_date)->startOfWeek();
        $end = Carbon::make($base_date)->endOfWeek();
        foreach (CarbonPeriod::create($start, $end) as $date) {
            $groups[$date->englishDayOfWeek."<br>{$date->format('d-m')}"] = [];
        }

        return $groups;
    }
}