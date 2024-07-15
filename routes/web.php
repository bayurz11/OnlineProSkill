<?php

use App\Http\Controllers\AksesPembelianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CourseMasterController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\KelasTatapMukaController;
use App\Http\Controllers\NotifikasiUserController;
use App\Http\Controllers\DashboardStudenController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\DashboardInstrukturController;
use App\Http\Controllers\OrderHistoryManagerController;
use App\Http\Controllers\SectionController;

//Authentikasi
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginstuden', [AuthController::class, 'loginstuden'])->name('loginstuden');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/regisInstruktur', [DashboardInstrukturController::class, 'register'])->name('regisInstruktur');
Route::post('/regisStuden', [AuthController::class, 'register'])->name('regisStuden');
// Route::post('/guestregister/{id}', [AuthController::class, 'guestregister'])->name('guestregister');
Route::post('/guestregister', [AuthController::class, 'guestregister'])->name('guestregister');

Route::get('oauth/google', [OauthController::class, 'redirectToProvider'])->name('oauth.google');
Route::get('oauth/google/callback', [OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');


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
    // Route::post('/update-Course-status/{id}', [CourseMasterController::class, 'updateCoursestatus']);
    Route::get('/Course/{id}/edit', [CourseMasterController::class, 'edit'])->name('Course.edit');
    Route::put('/Course/{id}', [CourseMasterController::class, 'update'])->name('Course.update');
    // Route::delete('/Course_destroy/{id}', [CourseMasterController::class, 'destroy'])->name('Course.destroy');

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
    Route::post('/kurikulum/store', [KurikulumController::class, 'store'])->name('kurikulumstore');
    Route::get('/kurikulum/{id}/edit', [KurikulumController::class, 'edit'])->name('kurikulum.edit');
    Route::put('/kurikulumupdate/{id}', [KurikulumController::class, 'update'])->name('kurikulum.update');
    Route::delete('/kurikulum_destroy/{id}', [KurikulumController::class, 'destroy'])->name('class.destroy');

    //Section Kurikulum
    Route::get('/section-content/{id}', [SectionController::class, 'getContent']);
    Route::post('/section/store', [SectionController::class, 'store'])->name('section.store');
    Route::get('/section/{id}/edit', [SectionController::class, 'edit'])->name('section.edit');
    Route::put('/sectionupdate/{id}', [SectionController::class, 'update'])->name('section.update');
    Route::delete('/section_destroy/{id}', [SectionController::class, 'destroy'])->name('class.destroy');
});

//*********STUDEN*********//
Route::middleware('isStuden')->group(function () {

    //Profile Studen
    Route::get('/profil', [SettingController::class, 'index'])->name('profil');
    Route::post('/updateProfile/{id}', [SettingController::class, 'updateprofil'])->name('updateProfile');

    //Riwayat Transaksi
    Route::get('/history', [RiwayatTransaksiController::class, 'index'])->name('history');
    //invoic
    Route::get('/cetak/{id}', [RiwayatTransaksiController::class, 'cetak'])->name('cetak');

    //payment
    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/success/{uuid}', [PaymentController::class, 'success'])->name('success');

    //Akses Pembelian
    Route::get('/akses_pembelian', [AksesPembelianController::class, 'index'])->name('akses_pembelian');

    //lesson
    Route::get('/lesson/{id}', [AksesPembelianController::class, 'lesson'])->name('lesson');
});



//*********INSTRUKTUR*********//
// Auth Instruktur
Route::get('/dashboard_instruktur', [DashboardInstrukturController::class, 'index'])->name('dashboard_instruktur');



//*********FRONTEND*********//
Route::get('/', [HomeController::class, 'index'])->name('/');

//Classroom
Route::get('/classroom', [HomeController::class, 'classroom'])->name('classroom');
Route::get('/classroomdetail/{id}', [HomeController::class, 'classroomdetail'])->name('classroomdetail');
// Route::get('classroomdetail/{id}/{slug}', [HomeController::class, 'classroomdetail'])->name('classroomdetail');

//online Course
Route::get('/course', [HomeController::class, 'classroom'])->name('course');
Route::get('/classroomdetail/{id}', [HomeController::class, 'classroomdetail'])->name('classroomdetail');



//checkout
Route::get('/checkout/{id}', [HomeController::class, 'checkout'])->name('checkout');

//Cart
Route::get('/cart', [CartController::class, 'show'])->name('cart.view');
Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/adddetail/{id}', [CartController::class, 'addToCartdetail'])->name('cart.adddetail');
Route::get('/cart/checkout/{id}', [CartController::class, 'addToCartceckout'])->name('cart.checkout');
Route::post('cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

//notifikasi
Route::get('/notifikasi', [NotifikasiUserController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi/baca-semua', [NotifikasiUserController::class, 'bacaSemua'])->name('notifikasi.bacaSemua');
