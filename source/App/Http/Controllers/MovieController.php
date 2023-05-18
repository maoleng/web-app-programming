<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\MovieRequest;
use App\Models\Movie;
use Libraries\Request\Request;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        $q = $request->get('q');
        $builder = 'SELECT * FROM movies ';
        if (isset($q)) {
            $builder .= "WHERE
                name LIKE '%$q%' OR
                description LIKE '%$q%' OR
                duration LIKE '%$q%' OR
                directors LIKE '%$q%' OR
                actors LIKE '%$q%' OR
                premiered_date LIKE '%$q%' OR
                banner LIKE '%$q%' OR
                trailer LIKE '%$q%'
            ";
        }
        $movies = (new Movie)->rawPaginate("$builder ORDER BY created_at DESC", 15);

        return view('admin.movie.index', [
            'movies' => $movies,
        ]);
    }

    public function show(Request $request, $id): void
    {
        response()->json((array) (new Movie)->findOrFail($id));
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
            if (! str_starts_with($movie->banner, 'http')) {
                unlink($movie->banner);
            }
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

        try {
            $movie->delete();
        } catch (\Exception) {
            redirectBackWithError('Can not delete movie because it is scheduled');
        }
        if (! str_starts_with($movie->banner, 'http')) {
            unlink($movie->banner);
        }

        redirectWithSuccess('/admin/movie', 'Removed movie successfully');
    }

}