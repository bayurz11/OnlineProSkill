<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CourseMasterController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\KelasTatapMukaController;
use App\Http\Controllers\DashboardStudenController;
use App\Http\Controllers\DashboardInstrukturController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\OrderHistoryManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\SettingController;

//Authentikasi
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/regisInstruktur', [DashboardInstrukturController::class, 'register'])->name('regisInstruktur');
Route::post('/regisStuden', [AuthController::class, 'register'])->name('regisStuden');
Route::post('/guestregister/{id}', [AuthController::class, 'guestregister'])->name('guestregister');


Route::middleware('isAdmin')->group(function () {

    //******** Admin *********//
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
    Route::get('/Course/{id}/edit', [CourseMasterController::class, 'edit'])->name('Course.edit');
    Route::put('/Course/{id}', [CourseMasterController::class, 'update'])->name('Course.update');
    Route::delete('/Course_destroy/{id}', [CourseMasterController::class, 'destroy'])->name('Course.destroy');

    //Riwayat Pembelian Kursus
    Route::get('/OrderHistoryManager', [OrderHistoryManagerController::class, 'index'])->name('OrderHistoryManager');

    //*******ADMIN OFFLINE COURSE SETTING*******//

    //Kursus Tatap Muka
    Route::get('/classroomsetting', [KelasTatapMukaController::class, 'index'])->name('classroomsetting');
    Route::post('/storeclas', [KelasTatapMukaController::class, 'store'])->name('storeclas');
    Route::post('/update-class-status/{id}', [KelasTatapMukaController::class, 'updateclassstatus']);
    Route::get('/class/{id}/edit', [KelasTatapMukaController::class, 'edit'])->name('class.edit');
    Route::put('/class/{id}', [KelasTatapMukaController::class, 'update'])->name('class.update');
    Route::delete('/class_destroy/{id}', [KelasTatapMukaController::class, 'destroy'])->name('class.destroy');

    //kurikulum
    Route::get('/kurikulum/{id}', [KurikulumController::class, 'index'])->name('kurikulum');
    Route::post('/kurikulumstore', [KurikulumController::class, 'store'])->name('kurikulumstore');
});

//*********STUDEN*********//
Route::middleware('isStuden')->group(function () {

    //Profile Studen
    Route::get('/profil', [SettingController::class, 'index'])->name('profil');
    Route::post('/updateProfile/{id}', [SettingController::class, 'updateprofil'])->name('updateProfile');

    //Riwayat Transaksi
    Route::get('/history', [RiwayatTransaksiController::class, 'index'])->name('history');

    //payment
    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/success/{uuid}', [PaymentController::class, 'success'])->name('success');
});



//*********INSTRUKTUR*********//
// Auth Instruktur
Route::get('/dashboard_instruktur', [DashboardInstrukturController::class, 'index'])->name('dashboard_instruktur');



//*********FRONTEND*********//
Route::get('/', [HomeController::class, 'index'])->name('/');

//Classroom
Route::get('/classroom', [HomeController::class, 'classroom'])->name('classroom');
Route::get('/classroomdetail/{id}', [HomeController::class, 'classroomdetail'])->name('classroomdetail');

//checkout
Route::get('/checkout/{id}', [HomeController::class, 'checkout'])->name('checkout');

//Cart
Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::get('/addcart/{id}', [CartController::class, 'index'])->name('addcart');
