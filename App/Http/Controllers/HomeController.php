<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use Libraries\Request\Request;

class HomeController extends Controller
{

    public function index()
    {
        $movies = (new Movie)->orderByDesc('premiered_date')->limit(4)->get();

        return view('customer.index', [
            'movies' => $movies,
        ]);
    }

    public function nowShowing()
    {
        $movies = (new Movie)->raw('
            SELECT * FROM movies
            WHERE premiered_date <= CURDATE()
            ORDER BY premiered_date DESC
            LIMIT 20
        ');

        return view('customer.movie.index', [
            'movies' => $movies,
            'title' => 'NOW SHOWING MOVIE',
        ]);
    }

    public function comingSoon()
    {
        $movies = (new Movie)->raw('
            SELECT * FROM movies
            WHERE premiered_date > CURDATE()
            ORDER BY premiered_date DESC
            LIMIT 20
        ');

        return view('customer.movie.index', [
            'movies' => $movies,
            'title' => 'COMING SOON MOVIE',
        ]);
    }

    public function show(Request $request, $name)
    {
        $movie = (new Movie)->raw("
            SELECT * FROM movies
            WHERE REPLACE(REPLACE(LOWER(name), ' ', '-'), '.', '') = '$name'
        ")[0] ?? null;
        if (empty($movie)) {
            abort(404);
        }
        $schedules = (new Schedule)->raw("
            SELECT * FROM schedules
            WHERE movie_id = '$movie->id' AND started_at > CURDATE()
        ");
        $show_dates = [];
        foreach ($schedules as $schedule) {
            $started_at = $schedule->startedAt();
            $show_dates[$started_at->format('m-d')][$schedule->id] = $started_at->format('H:i');
        }
//dd($show_dates);
        return view('customer.movie.show', [
            'movie' => $movie,
            'show_dates' => $show_dates,
        ]);
    }
}