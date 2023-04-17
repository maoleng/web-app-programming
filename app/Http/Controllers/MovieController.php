<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\MovieRequest;
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

    public function edit(Request $request, $id)
    {
        $movie = (new Movie)->findOrFail($id);
        $categories = $movie->getCategories();

        return view('admin.movie.edit', [
            'movie' => $movie,
            'categories' => $categories,
        ]);
    }

    public function store(MovieRequest $request): void
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

    public function update(MovieRequest $request, $id): void
    {
        $movie = (new Movie)->findOrFail($id);

        $data = $request->validated();
        $update_data = [
            'name' => $data['name'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'directors' => $data['directors'],
            'actors' => $data['actors'],
            'category' => $data['category'],
            'premiered_date' => $data['premiered_date'],
            'trailer' => $data['trailer'],
        ];

        if ($data['banner'] !== null) {
            unlink($movie->banner);
            $extension = pathinfo(basename($data['banner']['name']),PATHINFO_EXTENSION);
            $path = "public/storage/movies/$movie->id.$extension";
            move_uploaded_file($data['banner']['tmp_name'], $path);
            $update_data['banner'] = $path;
        }
        $movie->update($update_data);

        redirectWithSuccess('/admin/movie', 'Updated movie successfully');
    }

    public function destroy(Request $request, $id): void
    {
        $movie = (new Movie)->findOrFail($id);

        $movie->delete();
        unlink($movie->banner);

        redirectWithSuccess('/admin/movie', 'Removed movie successfully');
    }

}