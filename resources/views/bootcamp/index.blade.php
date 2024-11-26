@section('title', 'Bootcamp Power BI')
<?php $page = 'index'; ?>

@extends('layout.mainlayoutbootcamp')

@section('content')

    <!-- banner-area -->
    <section class="banner-area banner-bg tg-motion-effects"
        style=" width: 100%; display: flex; align-items: center; justify-content: center;">
        <div class="container" style="width: 85%; max-width: 1200px; padding-left: 5%; padding-right: 5%; height: auto;">
            <div class="row justify-content-between align-items-start" style="display: flex; flex-wrap: wrap;">
                <div class="col-xl-12 col-lg-12 col-md-12" style="flex: 1; padding-left: 0;">
                    {{-- <img src="{{ asset('public/assets/img/logo/logo.svg') }}" alt="Logo" data-aos-delay="800"
                        data-aos="fade-top" style="display: block; margin-bottom: 20px;"> --}}
                    <div class="banner__content" style="padding: 0;">
                        <h3 class="title tg-svg" data-aos="fade-right" data-aos-delay="400"
                            style="font-size: 2.5rem; line-height: 1.5; padding-top: 20px; margin-left: 0;">
                            <b style="color: #007368"><b>Bootcamp</b></b>
                            <span class="position-relative" style="display: inline-block; margin-top: 12px;">
                                <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: auto;">
                                    <path
                                        d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                        fill="currentcolor" />
                                </svg>
                                Power BI.
                            </span>
                            <br>
                            <b style="color: #007368">untuk <b>data analyst </b>pemula</b>
                        </h3>
                        <p data-aos="fade-right" data-aos-delay="600" style="font-size: 1rem; margin-bottom: 18px;">
                            📊 Siap Mengembangkan Skill Sebagai <b>Data Analyst? </b> Gabung Sekarang di <b>Bootcamp Power
                                BI </b>Untuk Pemula! Kuasai keterampilan <b>Analisis Data </b>Dari nol dengan Panduan
                            Langsung dari <b>Mentor Berpengalaman.</b> Jangan Lewatkan Kesempatan ini Untuk <b>Mengasah
                                Kemampuanmu!</b>
                        </p>
                        <p data-aos="fade-right" data-aos-delay="700" style="font-size: 1rem;">
                            📝 Pelajari Program <b>Bootcamp Power Bi</b> dari <b>Proskill Akademia!.</b>
                        </p>

                    </div>
                    <div class="d-flex justify-content-between align-items-center flex-wrap" data-aos="fade-top"
                        data-aos-delay="600">
                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <div>
                                <p class="mb-0" style="font-size: 0.9rem;"><b>5X</b> <b><img
                                            src="public/assets/img/icons/zoom.svg" alt="zoom"
                                            style="width: 36px; height: 30px; vertical-align: middle; margin-right: 5px;"></b>
                                    Online</p>
                                <p class="mb-0" style="font-size: 0.9rem;"><b>Setiap Sabtu</b></p>
                            </div>
                        </div>

                        <div class="d-none d-md-block border-left"
                            style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>

                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <img src="public/assets/img/icons/Video.svg" alt="Clock Icon"
                                style="width: 28px; height: 28px; vertical-align: middle; margin-right: 10px;">
                            <div>
                                <p class="mb-0" style="font-size: 0.9rem;">50+ Video</p>
                                <p class="mb-0 font-weight-bold" style="font-size: 0.9rem;"><b>on demand</b></p>
                            </div>
                        </div>

                        <div class="d-none d-md-block border-left"
                            style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>

                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <img src="public/assets/img/icons/25.png" alt="Format Icon"
                                style="width: 28px; height: 28px; vertical-align: middle; margin-right: 10px;">
                            <div>
                                <p class="mb-0" style="font-size: 0.9rem;">Start:</p>
                                <p class="mb-0 font-weight-bold" style="font-size: 0.9rem;"><b>25 Jan</b></p>
                            </div>
                        </div>

                        <div class="d-none d-md-block border-left"
                            style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>

                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <div>
                                <p class="mb-0" style="font-size: 0.9rem;">In demand</p>
                                <p class="mb-0 font-weight-bold" style="font-size: 0.9rem;"><b>Tools & Skills</b></p>
                            </div>
                            <img src="public/assets/img/icons/power-bi.png" alt="Tools Icon"
                                style="width: 28px; height: 32px; vertical-align: middle; margin-left: 10px;">
                        </div>
                    </div>


                </div>

                <div class="col-lg-5" style="position: relative;">
                    <div class="banner__images"
                        style="position: relative; display: flex; justify-content: center; align-items: center; margin-top: 160px; margin-left: 50px;">
                        <!-- Background Image -->
                        <img src="public/assets/img/banner/banner2.jpg" alt="img" class="main-img" data-aos="fade-left"
                            data-aos-delay="800" style="width: 150%; height: auto; border-radius: 10px;">

                        <!-- Decorative Background Dots -->
                        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme"
                            data-aos="fade-left" data-aos-delay="600">

                        <!-- Background Gradient -->
                        <div
                            style="position: absolute; top: 0; left: -80px; right: 0; bottom: 0; width: 150%; height: 100%; background: linear-gradient(to bottom, transparent, white); z-index: 1; pointer-events: none;">
                        </div>

                        <!-- Wrapper untuk konten tengah (ikon & teks) -->
                        <div
                            style="position: absolute; display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 102;">
                            <!-- Teks di atas tautan video -->
                            <span class="h6 text-dark font-weight-bold mb-2" data-aos="fade-left"
                                data-aos-delay="800">Lihat</span>

                            <!-- Tautan untuk membuka video di modal popup -->
                            <a href="https://www.youtube.com/watch?v=1umLD1G-Ljo" class="popup-video" data-aos="fade-left"
                                data-aos-delay="800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 22 28"
                                    fill="none">
                                    <path
                                        d="M0.19043 26.3132V1.69421C0.190288 1.40603 0.245303 1.12259 0.350273 0.870694C0.455242 0.6188 0.606687 0.406797 0.79027 0.254768C0.973854 0.10274 1.1835 0.0157243 1.39936 0.00193865C1.61521 -0.011847 1.83014 0.0480663 2.02378 0.176003L20.4856 12.3292C20.6973 12.4694 20.8754 12.6856 20.9999 12.9535C21.1245 13.2214 21.1904 13.5304 21.1904 13.8456C21.1904 14.1608 21.1245 14.4697 20.9999 14.7376C20.8754 15.0055 20.6973 15.2217 20.4856 15.3619L2.02378 27.824C1.83056 27.9517 1.61615 28.0116 1.40076 27.9981C1.18536 27.9847 0.97607 27.8983 0.792638 27.7472C0.609205 27.596 0.457661 27.385 0.352299 27.1342C0.246938 26.8833 0.191236 26.6008 0.19043 26.3132Z"
                                        fill="red" />
                                </svg>
                            </a>

                            <!-- Teks di bawah tautan video -->
                            <span class="h6 text-dark font-weight-bold mt-2" data-aos="fade-left"
                                data-aos-delay="800">Sesi Bootcamp Sebelumnya</span>
                        </div>

                    </div>

                    <!-- Menggunakan kelas Bootstrap untuk responsif -->
                    <div class="banner__student mt-7 mt-md-6" data-aos="fade-left" data-aos-delay="200"
                        style="z-index: 100;">
                        <div class="icon">
                            <img src="{{ asset('public/assets/img/banner/h2_banner_icon.svg') }}" alt="img"
                                class="injectable">
                        </div>
                        <div class="content">
                            <span>Peserta Bootcamp</span>
                            <h4 class="title">{{ $bootcamp->count() }}</h4>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="line-shape" data-aos="fade-right"
            data-aos-delay="1000" style="max-width: 20%; height: auto; position: absolute; z-index: -1;">

    </section>
    <!-- banner-area-end -->

    <!-- fact-area -->
    <section class="fact__area pt-5">
        <div class="section__title text-center ">

            <h2 class="title" data-aos="fade-top" data-aos-delay="600">
                <b style="color: #007368"><b>Temukan 1 dari 6 Alasan Kenapa
                    </b></b><br>
                <span class="position-relative">
                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                            fill="currentcolor" />
                    </svg>
                    Bootcamp Power BI ProSkill
                </span><br>
                <b style="color: #007368"><b>Berbeda ?
                    </b></b>
            </h2>
        </div> <br><br>
        <div class="container">
            <div class="fact__inner-wrap" data-aos="fade-top" data-aos-delay="800"
                style="background-color: #f5f3f9; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="row" style="display: flex; flex-wrap: wrap;">

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon02.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">Materi & Rekaman Pertemuan</h4>
                                <p>Dapatkan akses ke pembelajaran praktis yang bisa Anda ikuti kapan saja, di mana saja</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon03.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">Sertifikat Penyelesaian</h4>
                                <p>Mendapatkan Sertifikat Setelah Menyelesaikan Bootcamp</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon01.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">Group Alumni</h4>
                                <p>Bangun jaringan, temukan peluang baru, dan Jadikan komunitas ini
                                    sebagai wadah inspirasi dan kolaborasi.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon07.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">Lifetime access</h4>
                                <p>Tidak Ada Batasan Waktu untuk Mengakses Materi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon05.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">Custom Domain Email</h4>
                                <p>Disediakan Custom Domain Email untuk Peserta </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon06.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">3 Portofolio</h4>
                                <p>Mendapatkan 3 Portofolio Projek </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- fact-area-end -->

    <!-- faq-area -->
    <section class="faq__area pt-5">
        <div class="container  ">
            <div class="row align-items-center justify-content-center ">
                <!-- Konten Kiri: Target dan Sasaran -->
                <div class="col-lg-7">
                    <div class="about__content">
                        <div class="section__title">

                            <h2 class="title" data-aos="fade-top" data-aos-delay="600">
                                <b style="color: #007368">Target dan Sasaran</b>
                                <span class="position-relative">
                                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                            fill="currentcolor" />
                                    </svg>
                                    Bootcamp
                                </span>
                            </h2>
                        </div>
                        <p class="desc" data-aos="fade-top" data-aos-delay="600">Harapannya, Setelah selesai mengikuti
                            bootcamp ini, peserta akan:</p>
                        <ul class="about__info-list list-wrap" data-aos="fade-top" data-aos-delay="800">
                            <li class="about__info-list-item mt-4">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Paham Flow Cara Menganalisis Data Dengan Power Bi
                                </p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Mengetahui Cara Membuat Visualisasi Data Interaktif</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Memahami Cara Mempublish Laporan Analisis Data
                                </p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Membuat Portofolio Dashboard Dengan Power Bi Untuk Karir Sebagai Data
                                    Analyst</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5 col-md-9 mt-4 mt-md-0" data-aos="fade-left" data-aos-delay="600">
                    <div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 85vh;">
                        <div class="banner__images">
                            <img src="public/assets/img/banner/banner1.png" alt="img" class="main-img"
                                data-aos="fade-left" data-aos-delay="800">

                            <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme"
                                data-aos="fade-left" data-aos-delay="600">

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- faq-area-end -->


    <!-- faq-area -->
    <section class="faq__area" style="padding-top: 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5" data-aos="fade-right" data-aos-delay="600" style="margin-top: -50px;">
                    <div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 85vh;">
                        <div class="align-items-center">
                            <!-- Gambar bagian atas card -->
                            <img src="public/assets/img/banner/instruktur2.png" class="card-img-top" alt="User Photo"
                                style="height: 20rem; width:15rem; object-fit: cover;">

                            <!-- Card Body yang diangkat sedikit ke atas -->
                            <div class="card text-center" style="width: 15rem; overflow: hidden; margin-top: -50px;">
                                <div class="card-body">
                                    <h5 class="card-title">Power BI Expertise</h5>

                                    <!-- Ganti teks dengan gambar logo -->
                                    <img src="public/assets/img/banner/johnson-and-johnson-1.png"
                                        alt="Johnson & Johnson Logo" style="height: 20px; margin-bottom: 10px;">
                                    <br>
                                    <!-- Nama menjadi link dengan ikon LinkedIn -->
                                    <a href="https://www.linkedin.com/in/beni-oktopiansah" class="card-text"
                                        style="text-decoration: none; font-size: 18px;">
                                        <i class="fab fa-linkedin"
                                            style="color: #0077b5; margin-right: 16px; font-size: 28px;"></i>Beni
                                        Oktopiansah
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mb-3" data-aos="fade-left" data-aos-delay="800" style="margin-top: -50px;">
                    <div class="faq__content">
                        <div class="section__title pb-10">
                            <span class="sub-title">
                                <h2 style="color: #007368">Materi</h2>
                            </span>
                            <h2 class="title" style="color: #FE9900">Daftar Materi <b
                                    style="color: #007368">Bootcamp</b>
                            </h2>
                        </div>
                        <br>
                        <div class="faq__wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            Memulai Analisis Data dengan Power BI
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Kenapa Anda harus menguasai analisis data</p><br>
                                            <p>Contoh Analisis Data dalam Bisnis</p><br>
                                            <p>Proses pengolahan Data untuk Dasar Keputusan Strategis</p><br>
                                            <p>Peran Data Analyst dalam Pengambilan Keputusan</p><br>
                                            <p>Tantangan dalam Mengelola Data Besar (Big Data)</p><br>
                                            <p>Siklus Hidup Data: Dari Pengumpulan hingga Visualisasi</p><br>
                                            <p>Tools dan Software yang Digunakan oleh Data Analysts</p><br>
                                            <p>Power BI vs. Alat BI Lain: Kelebihan dan Kekurangan</p><br>
                                            <p>Apa itu Power BI? Sejarah dan Tujuan Pengembangan</p><br>
                                            <p>Mengapa menggunakan Power BI Penting bagi Analis Data?</p><br>
                                            <p>Produk Power BI: Desktop, Service, Mobile</p><br>
                                            <p>Instalasi Power BI Desktop: Persiapan dan Langkah Awal</p><br>
                                            <p>Antarmuka Power BI Desktop: Navigasi dan Fungsi Utama</p><br>
                                            <p>Cara Menghubungkan ke Sumber Data (Excel, Database, CSV)</p><br>
                                            <p>Latihan Praktis: Mengimpor Data dari Excel dan CSV</p><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Power Query untuk ETL & Data Modelling
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Memahami Pentingnya Pembersihan Data</p><br>
                                            <p>Menggunakan Power Query untuk Membersihkan & Transformasi Data</p><br>
                                            <p>Teknik Pembersihan Data: Duplikat, Null, dan Kesalahan </p><br>
                                            <p>Teknik Transformasi Data</p><br>
                                            <p>Latihan Praktis: Membersihkan dan Mengubah Data</p><br>
                                            <p>Pengantar Pemodelan Data: Konsep dan Pentingnya </p><br>
                                            <p>Membuat Hubungan Antara Tabel: One-to-Many, Many-to-Many</p><br>
                                            <p>Mengelola Relasi Tabel di Power BI</p><br>
                                            <p>Latihan Praktis: Membuat Model Data yang Terhubung </p><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Data Analysis Expressions (DAX) & Measurement
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Apa Itu DAX? Fungsi dan Kegunaannya</p><br>
                                            <p>Sintaks dan Struktur DAX di Power BI</p><br>
                                            <p>Fungsi DAX Dasar: SUM, AVERAGE, COUNT </p><br>
                                            <p>Latihan Praktis: Menggunakan Fungsi DAX untuk Pengukuran Dasar</p><br>
                                            <p>Fungsi DAX Lanjutan: CALCULATE, FILTER, ALL </p><br>
                                            <p>Menghitung Nilai MAX, MIN dengan DAX </p><br>
                                            <p>Menggunakan DAX untuk Analisis Waktu (Time Intelligence) </p><br>
                                            <p>Latihan Praktis: Menerapkan Fungsi DAX Lanjutan </p><br>
                                            <p>Menulis Formula DAX yang Efisien </p><br>
                                            <p>Teknik Optimasi Kueri DAX untuk Dataset Besar </p><br>
                                            <p>Debugging dan Memperbaiki Kesalahan DAX </p><br>
                                            <p>Latihan Praktis: Meningkatkan Performa Kueri DAX </p><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Membuat Dashboard untuk Visualisasi Data Interaktif
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Peran Visualisasi dalam Komunikasi Data</p><br>
                                            <p>Jenis-Jenis Visual di Power BI: Tabel, Grafik, Peta, dll.</p><br>
                                            <p>Kapan Menggunakan Visual yang Tepat?</p><br>
                                            <p>Latihan Praktis: Membuat Visualisasi Dasar dengan Data Penjualan</p><br>
                                            <p>Mengubah Tampilan Visual: Warna, Font, Gaya</p><br>
                                            <p>Menambahkan Label, Judul, dan Tooltip pada Visual</p><br>
                                            <p>Membuat Visual Interaktif dengan Fitur Drilldown</p><br>
                                            <p>Latihan Praktis: Kustomisasi Visualisasi Penjualan</p><br>
                                            <p>Pengenalan Dashboard: Konsep dan Tujuan</p><br>
                                            <p>Menambahkan Elemen Dashboard: Visual, Filter, dan Slicer</p><br>
                                            <p>Mengelola Dashboard dan Memperbarui Data</p><br>
                                            <p>Latihan Praktis: Membangun Dashboard Data Penjualan</p><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour2"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Publikasi & Portofolio Dashboard
                                        </button>
                                    </h2>
                                    <div id="collapseFour2" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Membuat akun di Power BI Service dengan email custom domain</p><br>
                                            <p>Membuat dan mengelola Workspace</p><br>
                                            <p>Mempublikasikan Laporan ke Power BI Service</p><br>
                                            <p>Pengaturan Hak Akses dan Berbagi Laporan dengan Tim</p><br>
                                            <p>Latihan Praktis: Mempublikasikan Dashboard ke Website</p><br>
                                            <p>Panduan Visualisasi Data: Warna, Simbol, dan Layout</p><br>
                                            <p>Membuat Portfolio Untuk Dashboard Power BI</p><br>
                                            <p>Dukungan Komunitas Power BI Developer</p><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour3"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Rekaman Zoom Meeting
                                        </button>
                                    </h2>
                                    <div id="collapseFour3" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Rekaman Pertemuan Pertama </p><br>
                                            <p>Rekaman Pertemuan Ke-2 </p><br>
                                            <p>Rekaman Pertemuan Ke-3</p><br>
                                            <p>Rekaman Pertemuan Ke-4 </p><br>
                                            <p>Rekaman Pertemuan Ke-5</p><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-area-end -->


    <!-- course-area -->
    <section class="faq__area" style="padding-top: 100px;">
        <div class="section__title text-center">

            <h2 class="title" data-aos="fade-top" data-aos-delay="600">
                <b style="color: #007368"><b>Contoh</b></b>
                <span class="position-relative">
                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                            fill="currentcolor" />
                    </svg>
                    Dashboard
                </span><br>
                <b style="color: #007368"><b>hasil Bootcamp sebelumnya</b></b>
            </h2>
        </div> <br><br>
        <div class="container">
            <div style="display: flex; justify-content: center; width: 100%; height: auto;">
                <iframe class="mx-1" width="100%" height="100%"
                    src="https://app.powerbi.com/view?r=eyJrIjoiNGJhOTI5OWMtOTgzOC00YWY2LWJkZjgtMWFhNWRlMzk3NTIxIiwidCI6Ijc1MzY1ODcyLWU5Y2QtNDk4My04YTdlLWZiZDc2MzU0N2I1MCIsImMiOjEwfQ%3D%3D&pageName=ReportSection85228c1842b89f43dae5"
                    frameborder="0" allowFullScreen="true"
                    style="border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); aspect-ratio: 16 / 9; margin: 0 100px;">
                </iframe>
            </div>

            <br><br><br>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="600">
                @php

                    $kelas = $KelasTatapMuka->firstWhere('id', 17);
                @endphp
                @if ($kelas && $kelas->status == 1)
                    <div class="features__item-wrap align-items-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6">
                                <div class="features__item-two">
                                    <div class="features__content-two">
                                        <div class="text-center">
                                            <p style="font-size: 1.8rem; margin-top: 18px; font-weight: bold;">Investasi
                                            </p>
                                        </div>
                                        <div class="text-center">
                                            <del style="font-size: 1.2rem;">Rp 599.000</del>
                                        </div>
                                        <div
                                            class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1 justify-content-center align-items-center">
                                            <ul class="courses__item-meta list-unstyled text-center">
                                                <li class="price h4" style="font-size: 2rem;">Rp
                                                    {{ number_format($kelas->price, 0, '.', '.') }}</li>
                                            </ul>
                                        </div>
                                        <!-- Membungkus tombol dengan div berkelas text-center -->
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('cart_bootcamp.checkout', ['id' => $kelas->id]) }}"
                                                class="btn arrow-btn"
                                                style="font-size: 1rem; padding: 15px 25px; display: flex; justify-content: center; align-items: center; width: 200px; margin-top: 20px;">
                                                Daftar Sekarang
                                                <img src="public/assets/img/icons/right_arrow.svg" alt="img"
                                                    class="injectable" style="margin-left: 10px;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="features__item-shape">
                                        <img src="public/assets/img/others/features_item_shape.svg" alt="img"
                                            class="injectable" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- course-area-end -->


    <script>
        $(document).ready(function() {
            $('.popup-video').magnificPopup({
                type: 'iframe',
                iframe: {
                    patterns: {
                        youtube: {
                            index: 'youtube.com/',
                            id: 'v=',
                            src: 'https://www.youtube.com/embed/%id%?autoplay=1' // Autoplay parameter
                        }
                    },
                    srcAction: 'iframe_src',
                }
            });
        });
    </script>



@endsection
