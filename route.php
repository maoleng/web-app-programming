<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middlewares\IfAlreadyLogin;
use Libraries\Redirect\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->middleware(IfAlreadyLogin::class);
Route::post('/process_login', [AuthController::class, 'processLogin']);
Route::post('/process_register', [AuthController::class, 'processRegister']);
