<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\StoreRequest;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Ticket;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $movies = (new Movie)->orderByDesc('created_at')->get(['id', 'name']);

        return view('admin.schedule.index', [
            'groups' => $groups,
            'movies' => $movies,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $exist_schedules = (new Schedule)->raw("
            SELECT * FROM schedules
            WHERE 
              (started_at >= '{$data['started_at']}' AND started_at <= '{$data['ended_at']}')
                OR 
              (ended_at >= '{$data['started_at']}' AND ended_at <= '{$data['ended_at']}')
        ");
        if (! empty($exist_schedules)) {
            redirectBackWithError('Duplicate schedule');
        }

        $schedule = (new Schedule)->create($data);
        $data = [];
        for ($x = 1; $x <= 9; $x++) {
            for ($y = 1; $y <= 7; $y++) {
                for ($j = 1; $j <= 2; $j++) {
                    $seats = $x.','.$y;
                    $data[] = [
                        'type' => $j,
                        'price' => 50000 * $j,
                        'seats' => $seats,
                        'schedule_id' => $schedule->id,
                        'qr_code' => 'https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl='.url('admin/ticket/verify/').$schedule->id.'|'.$seats,
                        'is_used' => 0,
                    ];
                }
            }
        }
        (new Ticket)->insert($data);

        redirectBackWithSuccess('Create schedule successfully');
    }

    public function update(Request $request, $id): void
    {
        $data = $request->all();
        $data['started_at'] = "{$data['date']} {$data['started_at']}:00";
        $data['ended_at'] = "{$data['date']} {$data['ended_at']}:00";
        unset($data['date']);

        (new Schedule)->findOrFail($id)->update($data);

        redirectBackWithSuccess('Update schedule successfully');
    }

    public function destroy(Request $request, $id): void
    {
        (new Schedule)->findOrFail($id)->delete();

        session()->flash('success', 'Delete schedule successfully');
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