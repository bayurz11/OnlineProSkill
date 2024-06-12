<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardInstrukturController;
use App\Http\Controllers\DashboardStudenController;
use Illuminate\Support\Facades\Route;

Route::get('/login_admin', [AuthController::class, 'show'])->name('login_admin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Studen
Route::get('/dashboard_studen', [DashboardStudenController::class, 'index'])->name('dashboard_studen');
Route::get('/registerStuden', [DashboardStudenController::class, 'showregister'])->name('registerStuden');
Route::post('/regisStuden', [DashboardStudenController::class, 'register'])->name('regisStuden');
// Instruktur
Route::get('/dashboard_instruktur', [DashboardInstrukturController::class, 'index'])->name('dashboard_instruktur');
Route::get('/register', [DashboardInstrukturController::class, 'showregister'])->name('register');
Route::post('/regisProses', [DashboardInstrukturController::class, 'register'])->name('regisProses');
