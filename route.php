<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middlewares\Authenticate;
use App\Http\Requests\StoreRequest;
use App\Models\Post;
use Libraries\Redirect\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/process_login', [AuthController::class, 'processLogin']);
Route::post('/process_register', [AuthController::class, 'processRegister']);

Route::get('/post/{id}', [HomeController::class, 'test'])->middleware(Authenticate::class);
Route::post('/post', static function (StoreRequest $request) {
    $data = $request->validated();
    (new Post)->create($data);

    redirect()->back();
});