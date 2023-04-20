<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookTicketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ScheduleController;
use App\Http\Middlewares\IfAlreadyLogin;
use Libraries\Redirect\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/{name}', [HomeController::class, 'show']);
Route::get('/now_showing_movie', [HomeController::class, 'nowShowing']);
Route::get('/coming_soon_movie', [HomeController::class, 'comingSoon']);

Route::post('/order/choose_schedule', [BookTicketController::class, 'chooseSchedule']);
Route::get('/order/choose_seat', [BookTicketController::class, 'chooseSeat']);
Route::get('/order/choose_seat/{id}', [BookTicketController::class, 'processChooseSeat']);
Route::get('/order/choose_combo', [BookTicketController::class, 'chooseCombo']);
Route::post('/order/choose_combo', [BookTicketController::class, 'processChooseCombo']);

Route::get('/login', [AuthController::class, 'login'])->middleware(IfAlreadyLogin::class);
Route::get('/register', [AuthController::class, 'register'])->middleware(IfAlreadyLogin::class);
Route::post('/process_login', [AuthController::class, 'processLogin']);
Route::post('/process_register', [AuthController::class, 'processRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/admin', [DashboardController::class, 'index']);

Route::get('/admin/order', [OrderController::class, 'index']);
Route::get('/admin/order/{id}', [OrderController::class, 'show']);
Route::get('/admin/order/update_payment', [OrderController::class, 'updatePayment']);
Route::get('/admin/order/update_status', [OrderController::class, 'updateStatus']);

Route::get('/admin/schedule', [ScheduleController::class, 'index']);
Route::post('/admin/schedule', [ScheduleController::class, 'store']);
Route::post('/admin/schedule/{id}', [ScheduleController::class, 'update']);
Route::post('/admin/schedule/destroy/{id}', [ScheduleController::class, 'destroy']);

Route::get('/admin/movie', [MovieController::class, 'index']);
Route::get('/admin/movie/{id}', [MovieController::class, 'show']);
Route::get('/admin/movie/create', [MovieController::class, 'create']);
Route::post('/admin/movie/store', [MovieController::class, 'store']);
Route::get('/admin/movie/edit/{id}', [MovieController::class, 'edit']);
Route::post('/admin/movie/update/{id}', [MovieController::class, 'update']);
Route::post('/admin/movie/destroy/{id}', [MovieController::class, 'destroy']);

Route::get('/admin/customer', [CustomerController::class, 'index']);
