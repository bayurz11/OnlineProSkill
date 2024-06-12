<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardInstrukturController;
use App\Http\Controllers\DashboardStudenController;
use Illuminate\Support\Facades\Route;

//Authentikasi
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//******** Admin *********//
Route::get('/login_admin', [AuthController::class, 'show'])->name('login_admin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Studen
Route::get('/dashboard_studen', [DashboardStudenController::class, 'index'])->name('dashboard_studen');
Route::get('/login_student', [AuthController::class, 'showinstuden'])->name('login_student');
Route::get('/registerStuden', [DashboardStudenController::class, 'showregister'])->name('registerStuden');
Route::post('/regisStuden', [DashboardStudenController::class, 'register'])->name('regisStuden');


// Instruktur
Route::get('/dashboard_instruktur', [DashboardInstrukturController::class, 'index'])->name('dashboard_instruktur');
Route::get('/login_instruktur', [AuthController::class, 'showinstruktur'])->name('login_instruktur');
Route::get('/registerInstruktur', [DashboardInstrukturController::class, 'showregister'])->name('registerInstruktur');
Route::post('/regisInstruktur', [DashboardInstrukturController::class, 'register'])->name('regisInstruktur');
