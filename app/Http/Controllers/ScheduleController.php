<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{

    public function index()
    {
        $schedules = (new Schedule)->raw('
            SELECT schedules.*, movies.name, movies.description, movies.banner
            FROM schedules
            LEFT JOIN movies ON schedules.movie_id = movies.id
            WHERE YEARWEEK(`started_at`, 1) = YEARWEEK(CURDATE(), 1)
            ORDER BY started_at
        ');
        $groups = [];
        foreach ($schedules as $schedule) {
            $started_at = $schedule->startedAt();
            $schedule->started_time = $started_at->format('H:i');
            $schedule->ended_time = $schedule->endedAt()->format('H:i');
            $groups[$started_at->englishDayOfWeek."<br>{$started_at->format('d-m')}"][] = $schedule;
        }

        return view('admin.schedule.index', [
            'groups' => $groups,
        ]);
    }

}