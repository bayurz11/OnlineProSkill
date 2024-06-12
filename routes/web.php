<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'show'])->name('/');
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/regisProses', [AuthController::class, 'register'])->name('regisProses');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
