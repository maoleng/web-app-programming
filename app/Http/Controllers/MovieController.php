<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\StoreRequest;
use App\Models\Movie;
use Libraries\Request\Request;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        $movies = (new Movie)->orderByDesc('created_at')->paginate(5);

        return view('admin.movie.index', [
            'movies' => $movies,
        ]);
    }

    public function create()
    {
        $categories = (new Movie)->getCategories();

        return view('admin.movie.create', [
            'categories' => $categories,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $movie = (new Movie)->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'directors' => $data['directors'],
            'actors' => $data['actors'],
            'category' => $data['category'],
            'premiered_date' => $data['premiered_date'],
            'banner' => '',
            'trailer' => $data['trailer'],
            'created_at' => now()->toDateTimeString(),
        ]);

        $extension = pathinfo(basename($data['banner']['name']),PATHINFO_EXTENSION);
        $path = "public/storage/movies/$movie->id.$extension";
        move_uploaded_file($data['banner']['tmp_name'], $path);
        $movie->update(['banner' => $path]);

        redirectWithSuccess('/admin/movie', 'Created movie successfully');
    }

}