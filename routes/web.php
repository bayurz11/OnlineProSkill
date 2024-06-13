<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardInstrukturController;
use App\Http\Controllers\DashboardStudenController;
use App\Http\Controllers\SubcategoriesController;
use Illuminate\Support\Facades\Route;

//Authentikasi
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//******** Admin *********//
Route::get('/login_admin', [AuthController::class, 'show'])->name('login_admin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//*******ADMIN ONLINE COURSE SETTING*******//
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::post('/storecategories', [CategoriesController::class, 'store'])->name('storecategories');
Route::post('/update-category-status/{id}', [CategoriesController::class, 'updateStatus']);
Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories_destroy/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');


Route::get('/subcategories', [SubcategoriesController::class, 'index'])->name('subcategories');
Route::post('/storesubcategories', [SubcategoriesController::class, 'store'])->name('storesubcategories');
Route::post('/update-subcategory-status/{id}', [SubcategoriesController::class, 'updateSubstatus']);
Route::delete('/subcategories_destroy/{id}', [SubcategoriesController::class, 'destroy'])->name('subcategories.destroy');
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
