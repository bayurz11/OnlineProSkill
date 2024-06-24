<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CourseMasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardInstrukturController;
use App\Http\Controllers\DashboardStudenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderHistoryManagerController;
use App\Http\Controllers\SubcategoriesController;
use Illuminate\Support\Facades\Route;

//Authentikasi
// Route::get('/login_instruktur', [AuthController::class, 'showinstruktur'])->name('login_instruktur');
// Route::get('/login_student', [AuthController::class, 'showinstuden'])->name('login_student');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/stdregister', [AuthController::class, 'stdregister'])->name('stdregister');

//******** Admin *********//
Route::get('/login_admin', [AuthController::class, 'show'])->name('login_admin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//*******ADMIN ONLINE COURSE SETTING*******//
//Kategori
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::post('/storecategories', [CategoriesController::class, 'store'])->name('storecategories');
Route::post('/update-category-status/{id}', [CategoriesController::class, 'updateStatus']);
Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories_destroy/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

//Subkategori
Route::get('/subcategories', [SubcategoriesController::class, 'index'])->name('subcategories');
Route::post('/storesubcategories', [SubcategoriesController::class, 'store'])->name('storesubcategories');
Route::post('/update-subcategory-status/{id}', [SubcategoriesController::class, 'updateSubstatus']);
Route::get('/subcategories/{id}/edit', [SubcategoriesController::class, 'edit'])->name('subcategories.edit');
Route::put('/subcategories/{id}', [SubcategoriesController::class, 'update'])->name('subcategories.update');
Route::delete('/subcategories_destroy/{id}', [SubcategoriesController::class, 'destroy'])->name('subcategories.destroy');
Route::get('/get-subcategories/{categoryId}', [SubcategoriesController::class, 'getSubcategories']);

//kelola Kursus
Route::get('/CourseMaster', [CourseMasterController::class, 'index'])->name('CourseMaster');
Route::post('/storeCourse', [CourseMasterController::class, 'store'])->name('storeCourse');
Route::post('/update-Course-status/{id}', [CourseMasterController::class, 'updateCoursestatus']);
//Riwayat Pembelian Kursus
Route::get('/OrderHistoryManager', [OrderHistoryManagerController::class, 'index'])->name('OrderHistoryManager');

//*********STUDEN*********//
//Auth Studen
Route::get('/dashboard_studen', [DashboardStudenController::class, 'index'])->name('dashboard_studen');
Route::get('/registerStuden', [DashboardStudenController::class, 'showregister'])->name('registerStuden');
Route::post('/regisStuden', [DashboardStudenController::class, 'register'])->name('regisStuden');

//*********INSTRUKTUR*********//
// Auth Instruktur
Route::get('/dashboard_instruktur', [DashboardInstrukturController::class, 'index'])->name('dashboard_instruktur');
Route::get('/registerInstruktur', [DashboardInstrukturController::class, 'showregister'])->name('registerInstruktur');
Route::post('/regisInstruktur', [DashboardInstrukturController::class, 'register'])->name('regisInstruktur');



//*********FRONTEND*********//
Route::get('/', [HomeController::class, 'index'])->name('/');
