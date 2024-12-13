<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\PixelController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BootcampController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GiftClassController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\DaftarSiswaController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\HubungiKamiController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\CourseMasterController;
use App\Http\Controllers\KategoriBlogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProdukSettingController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\AksesPembelianController;
use App\Http\Controllers\InstrukturQuizController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\KelasTatapMukaController;
use App\Http\Controllers\NotifikasiUserController;
use App\Http\Controllers\BootcampsettingController;
use App\Http\Controllers\DashboardStudenController;
use App\Http\Controllers\AdminQuizSettingController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\InstrukturCoursesController;
use App\Http\Controllers\InstrukturSectionController;
use App\Http\Controllers\InstrukturSettingController;
use App\Http\Controllers\ProfileInstrukturController;
use App\Http\Controllers\HubungiKamiSettingController;
use App\Http\Controllers\InstrukturQuestionController;
use App\Http\Controllers\DashboardInstrukturController;
use App\Http\Controllers\InstrukturKurikulumController;
use App\Http\Controllers\OrderHistoryManagerController;
use App\Http\Controllers\SettingProfileInstrukturController;

//Authentikasi
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginstuden', [AuthController::class, 'loginstuden'])->name('loginstuden');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/regisInstruktur', [DashboardInstrukturController::class, 'register'])->name('regisInstruktur');
Route::get('/showregister', [DashboardInstrukturController::class, 'showregister'])->name('showregister');
Route::post('/regisStuden', [AuthController::class, 'register'])->name('regisStuden');
// Route::post('/guestregister/{id}', [AuthController::class, 'guestregister'])->name('guestregister');
Route::post('/guestregister', [AuthController::class, 'guestregister'])->name('guestregister');
Route::post('/bootcampregister', [AuthController::class, 'bootcampregister'])->name('bootcampregister');

Route::get('oauth/google', [OauthController::class, 'redirectToProvider'])->name('oauth.google');
Route::get('oauth/google/callback', [OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');


Route::middleware('isAdmin')->group(function () {

    //******** Admin *********//
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/adminProfile', [DashboardController::class, 'profile'])->name('adminProfile');
    // Route untuk update profil
    Route::post('/admin/profile/update', [DashboardController::class, 'updateProfil'])->name('admin.profile.update');

    // Route untuk update password
    Route::post('/admin/profile/password/{id}', [DashboardController::class, 'updatePassword'])->name('admin.password.update');
    Route::get('/get-notifications', [NotificationController::class, 'getNotifications']);
    Route::post('/mark-notifications-read', [NotificationController::class, 'markNotificationsRead']);

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

    //Bootcamp
    Route::get('/bootcampsetting', [BootcampsettingController::class, 'index'])->name('bootcampsetting');
    Route::get('/HistoryOrder', [BootcampsettingController::class, 'history'])->name('HistoryOrder');
    Route::get('/prin/{id}', [BootcampsettingController::class, 'cetak'])->name('prin');

    //Kelola Event
    Route::get('/kelola_event', [AdminEventController::class, 'index'])->name('kelola_event');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/event/{id}/edit', [AdminEventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{id}/update', [AdminEventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}/destroy', [AdminEventController::class, 'destroy'])->name('event.destroy');

    //kategori Blog
    Route::get('/kategori_blog', [KategoriBlogController::class, 'index'])->name('kategori_blog');
    Route::post('/storekategori', [KategoriBlogController::class, 'store'])->name('kategori.store');
    Route::post('/update-kategori-status/{id}', [KategoriBlogController::class, 'updateStatuskategor']);
    Route::get('/kategori/{id}/edit', [KategoriBlogController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriBlogController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori_destroy/{id}', [KategoriBlogController::class, 'destroy'])->name('kategori.destroy');

    //kelola Blog
    Route::get('/kelola_blog', [AdminBlogController::class, 'index'])->name('kelola_blog');
    Route::post('/storeblog', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog_destroy/{id}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');


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

    //Gift Class
    // Route::get('/giftClass', [GiftClassController::class, 'giftClass'])->name('giftClass');
    //*******pixel Setting*******//

    Route::get('/settings/pixel', [PixelController::class, 'index'])->name('pixel.settings');
    Route::post('/settings/pixel', [PixelController::class, 'store'])->name('pixel.store');
    // Route::get('/settings/pixel', [PixelController::class, 'edit'])->name('pixel.edit');

    //*******PEMBAYARAN DAN TRANSAKSI*******//

    //Riwayat Pembelian Kursus
    Route::get('/OrderHistoryManager', [OrderHistoryManagerController::class, 'index'])->name('OrderHistoryManager');
    Route::get('/prin/{id}', [OrderHistoryManagerController::class, 'cetak'])->name('prin');

    //*******KESISWAAN*******//
    Route::get('/daftar_siswa', [DaftarSiswaController::class, 'index'])->name('daftar_siswa');
    Route::post('/update-daftar_siswa/{id}', [DaftarSiswaController::class, 'updateStatus']);
    Route::get('/siswa/{id}/edit', [DaftarSiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [DaftarSiswaController::class, 'update'])->name('siswa.update');

    //*******PENGATURAN UMUM*******//
    Route::get('/herosection', [HeroSectionController::class, 'index'])->name('herosection');

    //sertifikat
    Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat');
    Route::post('/sertifikat/store', [SertifikatController::class, 'store'])->name('sertifikat.store');
    Route::get('/sertifikat/{id}/edit', [SertifikatController::class, 'edit'])->name('sertifikat.edit');
    Route::put('/sertifikat/{id}/update', [SertifikatController::class, 'update'])->name('sertifikat.update');
    Route::delete('/sertifikat/{id}/destroy', [SertifikatController::class, 'destroy'])->name('sertifikat.destroy');


    //Hubungi Kami
    Route::get('/settingcontactus', [HubungiKamiSettingController::class, 'index'])->name('settingcontactus');
    Route::post('/contactus/store', [HubungiKamiSettingController::class, 'store'])->name('contactus.store');
    Route::get('/contact/{id}/edit', [HubungiKamiSettingController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update', [HubungiKamiSettingController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{id}/destroy', [HubungiKamiSettingController::class, 'destroy'])->name('contact.destroy');

    //Instruktur Setting
    Route::get('/instruktursetting', [InstrukturSettingController::class, 'index'])->name('instruktursetting');
    Route::post('/instruktur/store', [InstrukturSettingController::class, 'storeInstruktur'])->name('instruktur.store');


    //*******PRODUK*******//
    // //ketegori produk
    // Route::get('/kategoriproduk', [KategoriProdukController::class, 'index'])->name('kategoriproduk');
    // Route::post('/kategori/store', [KategoriProdukController::class, 'store'])->name('kategori.store');
    // Route::post('/status-update/{id}', [KategoriProdukController::class, 'statusUpdate']);
    // Route::get('/kategori/{id}/edit', [KategoriProdukController::class, 'edit'])->name('kategori.edit');
    // Route::put('/kategori/produk/{id}', [KategoriProdukController::class, 'update'])->name('kategori.update');
    // Route::delete('/kategori/destroy/{id}', [KategoriProdukController::class, 'destroy'])->name('kategori.destroy');

    //prosuk setting
    Route::get('/produksetting', [ProdukSettingController::class, 'index'])->name('produksetting');
    Route::post('/prosuk/store', [ProdukSettingController::class, 'store'])->name('produk.store');
    Route::post('/update-produk-status/{id}', [ProdukSettingController::class, 'updateprodukstatus']);
    Route::get('/produk/{id}/edit', [ProdukSettingController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukSettingController::class, 'update'])->name('produk.update');
    Route::delete('/produk_destroy/{id}', [ProdukSettingController::class, 'destroy'])->name('produk.destroy');


    //Quiz
    Route::get('/admin_quiz', [AdminQuizSettingController::class, 'index'])->name('admin.quiz');
    Route::delete('/admin_quiz/{id_tugas}', [AdminQuizSettingController::class, 'destroy'])->name('adminquiz.destroy');

    //Pertanyaan
    Route::get('/admin_question_pg', [AdminQuizSettingController::class, 'pg'])->name('admin_question_pg');
    Route::get('/admin_view_pg/{id_tugas}', [AdminQuizSettingController::class, 'viewpg'])->name('admin_view_pg');
    Route::get('/tugas/{id_tugas}/question/{questionNumber}', [AdminQuizSettingController::class, 'fetchQuestion'])
        ->name('fetch_question');
    Route::post('/admin_pertanyaan_pg/store', [AdminQuizSettingController::class, 'storepg'])->name('admin_pertanyaan_pg.store');
    Route::get('/admin_question_essay/{id_tugas}', [AdminQuizSettingController::class, 'esai'])->name('admin_question_essay');
});

//*********STUDEN*********//
Route::middleware('isStuden')->group(function () {

    //Profile Studen
    Route::get('/profil', [SettingController::class, 'index'])->name('profil');
    Route::post('/updateProfile/{id}', [SettingController::class, 'updateprofil'])->name('updateProfile');
    Route::post('/updatePassword/{id}', [SettingController::class, 'updatePassword'])->name('updatePassword');

    //Riwayat Transaksi
    Route::get('/history', [RiwayatTransaksiController::class, 'index'])->name('history');
    //invoic
    Route::get('/cetak/{id}', [RiwayatTransaksiController::class, 'cetak'])->name('cetak');

    //payment
    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');

    //Akses Pembelian
    Route::get('/akses_pembelian', [AksesPembelianController::class, 'index'])->name('akses_pembelian');

    //review
    Route::get('/review', [ReviewController::class, 'index'])->name('review');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

    //lesson
    Route::get('/lesson/{id}', [AksesPembelianController::class, 'lesson'])->name('lesson');
    Route::put('/sectionupdatestatus/{id}', [AksesPembelianController::class, 'updatestatus'])->name('sectionstatus');
    Route::post('/print_certificate/{id}', [AksesPembelianController::class, 'printCertificate'])->name('print_certificate');
    Route::get('/certificate/preview', [AksesPembelianController::class, 'previewCertificate'])->name('certificate.preview');
    Route::get('/course-content/{id}', [AksesPembelianController::class, 'getKurikulum'])->name('course-content');

    //Quiz
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::get('/view_pg/{id_tugas}', [QuizController::class, 'viewpg'])->name('view_pg');
    Route::post('/tugas/{id_tugas}/jawaban', [QuizController::class, 'storeJawaban'])->name('jawaban.store');
    Route::get('/tugas/{id_tugas}/question/{questionNumber}', [QuizController::class, 'getQuestion']);

    Route::post('/tugas/{id_tugas}/finish', [QuizController::class, 'finishQuiz']);



    // Route::get('/kurikulum-content/{$kurikulum_id}', [AksesPembelianController::class, 'fetchContent'])->name('kurikulum.content');
});


Route::match(['get', 'post'], '/webhook/xendit', [PaymentController::class, 'handleXenditWebhook']);
Route::get('/success/{uuid}', [PaymentController::class, 'success'])->name('success');


//*********INSTRUKTUR*********//
Route::middleware('isInstruktur')->group(function () {
    // Auth Instruktur
    Route::get('/dashboard_instruktur', [DashboardInstrukturController::class, 'index'])->name('dashboard_instruktur');
    Route::get('/instruktur_profile', [DashboardInstrukturController::class, 'profile'])->name('instruktur_profile');

    Route::get('/instruktur_setting', [SettingProfileInstrukturController::class, 'profilesetting'])->name('instruktur_setting');
    Route::post('/updateProfileinstruktur/{id}', [SettingProfileInstrukturController::class, 'updateprofil'])->name('updateProfileinstruktur');
    Route::post('/updatePasswordInstruktur/{id}', [SettingProfileInstrukturController::class, 'updatePassword'])->name('updatePasswordInstruktur');

    //Courses
    Route::get('/instruktur_courses', [InstrukturCoursesController::class, 'index'])->name('instruktur_courses');
    Route::post('/courses/store', [InstrukturCoursesController::class, 'store'])->name('courses.store');

    //kurikulum
    Route::get('/instruktur_kurikulum/{id}', [InstrukturKurikulumController::class, 'index'])->name('instruktur.kurikulum');
    Route::post('/instruktur_kurikulum/store', [InstrukturKurikulumController::class, 'store'])->name('instruktur_kurikulum.store');
    Route::get('/instruktur_kurikulum/{id}/edit', [InstrukturKurikulumController::class, 'edit'])->name('instruktur_kurikulum.edit');
    Route::put('/instruktur_kurikulum/{id}', [InstrukturKurikulumController::class, 'update'])->name('instruktur_kurikulum.update');
    Route::delete('/instruktur_kurikulum_destroy/{id}', [InstrukturKurikulumController::class, 'destroy'])->name('class.destroy');

    Route::get('/section-content/{id}', [InstrukturSectionController::class, 'getContent']);
    Route::post('/instruktur_section/store', [InstrukturSectionController::class, 'store'])->name('instruktur_section.store');
    Route::get('/instruktur_section/{id}/edit', [InstrukturSectionController::class, 'edit'])->name('instruktur_section.edit');
    Route::put('/instruktur_section/{id}', [InstrukturSectionController::class, 'update'])->name('instruktur_section.update');
    Route::delete('/instruktur_section_destroy/{id}', [InstrukturSectionController::class, 'destroy'])->name('section.destroy');

    //Quiz
    Route::get('/instruktur_quiz', [InstrukturQuizController::class, 'index'])->name('instruktur.quiz');
    Route::delete('/instruktur_quiz/{id_tugas}', [InstrukturQuizController::class, 'destroy'])->name('quiz.destroy');

    //Pertanyaan
    Route::get('/instruktur_question_pg', [InstrukturQuestionController::class, 'pg'])->name('instruktur_question_pg');
    Route::get('/instruktur_view_pg/{id_tugas}', [InstrukturQuestionController::class, 'viewpg'])->name('instruktur_view_pg');
    Route::get('/tugas/{id_tugas}/question/{questionNumber}', [InstrukturQuestionController::class, 'fetchQuestion'])
        ->name('fetch_question');
    Route::post('/instruktur_pertanyaan_pg/store', [InstrukturQuestionController::class, 'storepg'])->name('instruktur_pertanyaan_pg.store');
    Route::get('/instruktur_question_essay/{id_tugas}', [InstrukturQuestionController::class, 'esai'])->name('instruktur_question_essay');
});


//*********FRONTEND*********//
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::post('/forgotPassword', [HomeController::class, 'update'])->name('forgotPassword.update');


//Classroom
Route::get('/classroom', [HomeController::class, 'classroom'])->name('classroom');
Route::get('/classroomdetail/{id}', [HomeController::class, 'classroomdetail'])->name('classroomdetail');
// Route::get('classroomdetail/{id}/{slug}', [HomeController::class, 'classroomdetail'])->name('classroomdetail');

//online Course
Route::get('/course', [HomeController::class, 'course'])->name('course');
Route::get('/coursedetail/{id}', [HomeController::class, 'coursedetail'])->name('coursedetail');

//checkout
Route::get('/checkout/{id}', [HomeController::class, 'checkout'])->name('checkout');

//Cart
Route::get('/cart', [CartController::class, 'show'])->name('cart.view');
Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/adddetail/{id}', [CartController::class, 'addToCartdetail'])->name('cart.adddetail');
Route::get('/cart/adddetailproduk/{id}', [CartController::class, 'addToCartProduk'])->name('cart.adddetailproduk');
Route::get('/cart/checkout/{id}', [CartController::class, 'addToCartceckout'])->name('cart.checkout');
Route::post('cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

//notifikasi
Route::get('/notifikasi', [NotifikasiUserController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi/baca-semua', [NotifikasiUserController::class, 'bacaSemua'])->name('notifikasi.bacaSemua');

//search
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/kelasdanproduk', [SearchController::class, 'kelasdanproduk'])->name('kelasdanproduk');

//Event 
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/event_detail/{id}', [EventController::class, 'detailEvent'])->name('event_detail');

//Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog_detail/{id}', [BlogController::class, 'blogDetail'])->name('blog_detail');

//Hubungi Kami
Route::get('/hubungikami', [HubungiKamiController::class, 'index'])->name('hubungikami');

//Tentang Kami
Route::get('/tentangkami', [TentangKamiController::class, 'index'])->name('tentangkami');

//konsultasi
Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');

//Profile Instruktur
Route::get('/profile_instruktur/{id}', [ProfileInstrukturController::class, 'index'])->name('profile_instruktur');

//sertifikat
Route::get('/cetak_sertifikat/{id}', [SertifikatController::class, 'cetakSertifikat'])->name('cetak_sertifikat');
Route::get('/print/{id}', [SertifikatController::class, 'printCertificate'])->name('print');

// reviews
Route::post('/classes/{class}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

//produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk-detail/{id}', [ProdukController::class, 'detail'])->name('produk-detail');

//*********Bootcamp*********//
//PowerBI
Route::get('/pbi', [BootcampController::class, 'index'])->name('pbi');
Route::get('/cart_bootcamp/checkout/{id}', [BootcampController::class, 'addToCartceckout'])->name('cart_bootcamp.checkout');
Route::get('/cart_bootcamp', [BootcampController::class, 'show'])->name('cart_bootcamp.view');
Route::post('cart_bootcamp/remove/{id}', [BootcampController::class, 'removeFromCart'])->name('cart_bootcamp.remove');

//EXCEL
Route::get('/excel', [BootcampController::class, 'indexexcel'])->name('excel');
Route::get('/cart_bootcamp/checkout/{id}', [BootcampController::class, 'addToCartceckout'])->name('cart_bootcamp.checkout');
Route::get('/cart_bootcamp', [BootcampController::class, 'show'])->name('cart_bootcamp.view');
Route::post('cart_bootcamp/remove/{id}', [BootcampController::class, 'removeFromCart'])->name('cart_bootcamp.remove');

// Route::get('forgot-password', function () {
//     return view('auth.forgot-password'); // Sesuaikan nama view
// })->middleware('guest')->name('password.request');

Route::post('forgot-password', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Email reset password berhasil dikirim.')
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('reset-password/{token}', function ($token) {
    return view('reset-password', ['token' => $token]); // Sesuaikan nama view
})->middleware('guest')->name('password.reset');

Route::post('reset-password', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ], [

        'email.required' => 'Alamat email wajib diisi.',
        'email.email' => 'Alamat email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password harus memiliki minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
            ])->save();

            $user->setRememberToken(\Illuminate\Support\Str::random(60));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('/')->with('success', 'Password berhasil diperbarui. Silakan login.')
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
