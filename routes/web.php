<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'Showlogin'])->name('login');
Route::get('/registrasi', [AuthController::class, 'showregistrasi'])->name('registrasi');
Route::get('/dashboard', [AuthController::class, 'showdashboard'])->name('dashboard');
