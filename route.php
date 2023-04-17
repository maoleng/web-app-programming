<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Middlewares\IfAlreadyLogin;
use Libraries\Redirect\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->middleware(IfAlreadyLogin::class);
Route::get('/register', [AuthController::class, 'register'])->middleware(IfAlreadyLogin::class);
Route::post('/process_login', [AuthController::class, 'processLogin']);
Route::post('/process_register', [AuthController::class, 'processRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/admin', [DashboardController::class, 'index']);

Route::get('/admin/movie', [MovieController::class, 'index']);
Route::get('/admin/movie/create', [MovieController::class, 'create']);
Route::post('/admin/movie/store', [MovieController::class, 'store']);
Route::get('/admin/movie/edit/{id}', [MovieController::class, 'edit']);
