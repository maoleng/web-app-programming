<?php

use App\Http\Controllers\HomeController;
use App\Http\Middlewares\Authenticate;
use App\Http\Requests\StoreRequest;
use App\Models\Post;
use Libraries\Redirect\Route;

Route::get('/abc', [HomeController::class, 'index']);
Route::get('/post/{id}', [HomeController::class, 'test'])->middleware(Authenticate::class);
Route::post('/post', static function (StoreRequest $request) {
    $data = $request->validated();
    (new Post)->create($data);

    redirect()->back();
});