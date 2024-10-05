@section('title', 'Bootcamp Power BI')
<?php $page = 'index'; ?>

@extends('layout.mainlayoutbootcamp')

@section('content')

    <!-- banner-area -->
    <section class="banner-area banner-bg tg-motion-effects"
        style="min-height: 100vh; width: 100%; display: flex; align-items: center; justify-content: center;">
        <div class="container" style="width: 90%; max-width: 1200px; padding-left: 5%; padding-right: 5%; height: auto;">
            <div class="row justify-content-between align-items-start" style="display: flex; flex-wrap: wrap;">
                <div class="col-xl-12 col-lg-12 col-md-12" style="flex: 1; padding-left: 0;">
                    <img src="{{ asset('public/assets/img/logo/logo.svg') }}" alt="Logo" data-aos-delay="800"
                        data-aos="fade-top" style="display: block; margin-bottom: 20px;">
                    <div class="banner__content" style="padding: 0;">
                        {{-- <h3 class="title tg-svg" data-aos="fade-right" data-aos-delay="400"
                            style="font-size: 2.5rem; line-height: 1.2; margin-left: 0;">
                            <b style="color: #007368">Bootcamp</b>
                            <span class="position-relative" style="display: inline-block;">
                                <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: auto;">
                                    <path
                                        d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                        fill="currentcolor" />
                                </svg>
                                Power BI.
                            </span>
                            <br>
                            untuk data analyst pemula
                        </h3> <br> --}}

                        <h3 class="title tg-svg" data-aos="fade-right" data-aos-delay="400">
                            <b style="color: #007368"><b>Bootcamp</b></b>
                            <span class="position-relative">
                                <span class="svg-icon" id="banner-svg"
                                    data-svg-icon="assets/img/objects/title_shape.svg"></span>
                                <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                        fill="currentcolor" />
                                </svg>
                                Power BI
                            </span>
                            <br> <b style="color: #007368">Untuk <b>Data Analyst</b> Pemula </b>
                        </h3> <br>
                        <p data-aos="fade-right" data-aos-delay="600" style="font-size: 1rem; margin-bottom: 18px;">
                            📊 Siap Mengembangkan Skill Sebagai <b>Data Analyst? </b> Gabung Sekarang di <b>Bootcamp Power
                                BI </b>Untuk Pemula! Kuasai keterampilan <b>Analisis Data </b>Dari nol dengan Panduan
                            Langsung dari <b>Mentor Berpengalaman.</b> Jangan Lewatkan Kesempatan ini Untuk <b>Mengasah
                                Kemampuanmu!</b>
                        </p>
                        <p data-aos="fade-right" data-aos-delay="700" style="font-size: 1rem;">
                            📝 Pelajari Program <b>Bootcamp Power Bi</b> dari <b>Proskill Akademia!.</b>
                        </p>
                        {{-- <div class="banner__btn-wrap" data-aos="fade-right" data-aos-delay="800" style="margin-top: 20px;">
                            <a href="{{ route('cart_bootcamp.checkout', ['id' => 17]) }}" class="btn arrow-btn"
                                style="font-size: 1rem; padding: 15px 25px;">Daftar
                                Sekarang
                                <img src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"
                                    style="margin-left: 10px;">
                            </a>
                        </div> --}}
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; " data-aos="fade-top"
                        data-aos-delay="600">
                        <div style="display: flex; align-items: center;">
                            <div>
                                <p style="margin: 0; font-size: 0.9rem;">5X <b><img src="public/assets/img/icons/zoom.svg"
                                            alt="zoom"
                                            style="width: 36px; height: 30px; vertical-align: middle; margin-right: 5px;"></b>
                                    Online</p>
                                <p style="margin: 0; font-size: 0.9rem;"><b>Setiap Sabtu</b></p>
                            </div>
                        </div>

                        <div style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>
                        <div style="display: flex; align-items: center;">
                            <img src="public/assets/img/icons/Video.svg" alt="Clock Icon"
                                style="width: 28px; height: 28px; vertical-align: middle; margin-right: 10px;">
                            <div>
                                <p style="margin: 0; font-size: 0.9rem;">25 Video</p>
                                <p style="margin: 0; font-weight: bold; font-size: 0.9rem;"><b>on demand</b></p>
                            </div>
                        </div>
                        <div style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>
                        <div style="display: flex; align-items: center;">
                            <img src="public/assets/img/icons/calender.svg" alt="Format Icon"
                                style="width: 28px; height: 28px; vertical-align: middle; margin-right: 10px;">
                            <div>
                                <p style="margin: 0; font-size: 0.9rem;">Start:</p>
                                <p style="margin: 0; font-weight: bold; font-size: 0.9rem;">30 Nov</p>
                            </div>
                        </div>
                        <div style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>
                        <div style="display: flex; align-items: center;">
                            <div>
                                <p style="margin: 0; font-size: 0.9rem;">In demand</p>
                                <p style="margin: 0; font-weight: bold; font-size: 0.9rem;">Tools & Skills</p>
                            </div>
                            <img src="public/assets/img/icons/power-bi.png" alt="Tools Icon"
                                style="width: 28px; height: 32px; vertical-align: middle; margin-left: 10px;">
                        </div>

                    </div>

                </div>

                <div class="col-lg-5" style="position: relative;">
                    <div class="banner__images">
                        <img src="public/assets/img/banner/man.png" alt="img" class="main-img" data-aos="fade-left"
                            data-aos-delay="800">

                        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme"
                            data-aos="fade-left" data-aos-delay="600">

                    </div>
                    <div
                        style="
                        position: absolute; 
                        bottom: 0; 
                        left: 0; 
                        right: 0; 
                        height: 90px; 
                        background: linear-gradient(to bottom, transparent, white); /* Sesuaikan dengan warna background */
                        z-index: 1;">
                    </div>
                </div>
            </div>
        </div>
        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="line-shape" data-aos="fade-right"
            data-aos-delay="1000" style="max-width: 20%; height: auto; position: absolute; z-index: -1;">

    </section>
    <!-- banner-area-end -->

    <!-- fact-area -->
    <section class="fact__area">
        <div class="section__title text-center">

            <h2 class="title" data-aos="fade-top" data-aos-delay="600">
                <b style="color: #007368"><b>Kenapa Harus Ikut</b></b>
                <span class="position-relative">
                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                            fill="currentcolor" />
                    </svg>
                    Bootcamp
                </span>
                <b style="color: #007368"><b>Ini</b></b>
            </h2>
        </div> <br>
        <div class="container">
            <div class="fact__inner-wrap" data-aos="fade-top" data-aos-delay="800"
                style="background-color: #f5f3f9; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="row" style="display: flex; flex-wrap: wrap;">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon06.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">3 Portofolio</h4>
                                <p>Mendapatkan 3 Portofolio Projek</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon02.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">Materi & Rekaman Pertemuan</h4>
                                <p>Disediakan Materi Video untuk Peserta Bootccamp</p>
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
                                <img src="public/assets/img/icons/features_icon05.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title" style="color: #007368">Custom Domain Email</h4>
                                <p>Disediakan Custom Domain Email untuk Peserta Bootcamp</p>
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
                                <p>Disediakan Group Alumni untuk Peserta Bootcamp</p>
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
                </div>
            </div>
        </div>

    </section>
    <!-- fact-area-end -->

    <!-- faq-area -->
    <section class="faq__area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <!-- Konten Kiri: Target dan Sasaran -->
                <div class="col-lg-6">
                    <div class="about__content">
                        <div class="section__title">
                            <span class="sub-title" data-aos="fade-top" data-aos-delay="600">Detail</span>
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
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Paham Dasar Data Analyst</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Mengetahui Tools Data Analyst</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Bisa Membuat Dashboard Data</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Memiliki Portfolio Data Analyst</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Konten Kanan: Gambar dan Card -->
                <div class="col-lg-6 col-md-9" data-aos="fade-left" data-aos-delay="600">
                    <div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 85vh;">
                        <div class="align-items-center">
                            <!-- Gambar bagian atas card -->
                            <img src="public/assets/img/banner/instruktur2.png" class="card-img-top" alt="User Photo"
                                style="height: 25rem; width:20rem; object-fit: cover;">

                            <!-- Card Body yang diangkat sedikit ke atas -->
                            <div class="card text-center" style="width: 20rem; overflow: hidden; margin-top: -30px;">
                                <div class="card-body">
                                    <h5 class="card-title">Power BI Expertise</h5>

                                    <!-- Ganti teks dengan gambar logo -->
                                    <img src="public/assets/img/banner/johnson-and-johnson-1.png"
                                        alt="Johnson & Johnson Logo" style="height: 50px; margin-bottom: 10px;">

                                    <!-- Nama menjadi link dengan ikon LinkedIn -->
                                    <a href="https://www.linkedin.com/in/beni-oktopiansah" class="card-text"
                                        style="text-decoration: none;">
                                        <i class="fab fa-linkedin" style="color: #0077b5; margin-right: 9px;"></i>Beni
                                        Oktopiansah
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- faq-area-end -->


    <!-- faq-area -->
    <section class="faq__area" style="padding-top: 10;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="600" style="margin-top: -50px;">
                    <div class="banner__images">
                        <img src="public/assets/img/banner/man2.png" alt="img" class="main-img"
                            data-aos="fade-right" data-aos-delay="800">
                        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme"
                            data-aos="fade-right" data-aos-delay="600">
                    </div>
                    <div
                        style="position: absolute; bottom: 0; left: 0; right: 0; height: 90px; 
                            background: linear-gradient(to bottom, transparent, #f5f3f9); z-index: 1;">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="800" style="margin-top: -50px;">
                    <div class="faq__content">
                        <div class="section__title pb-10">
                            <span class="sub-title">Materi</span>
                            <h2 class="title" style="color: #FE9900">Daftar Materi <b style="color: #007368">Kelas</b>
                            </h2>
                        </div>
                        <br>
                        <div class="faq__wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Fundamental Data Analyst
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Mengenal Data dan Data Analyst </p><br>
                                            <p>Statistik sederhana untuk Data Analyst </p><br>
                                            <p>Data Analyst Process </p> <br>
                                            <p>Landscape dunia Data Analyst</p><br>
                                            <p>Membangun Portfolio Data Analyst yang baik</p><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Pengenalan Spreadsheet
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Spreadsheet untuk Data Analis
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Pengenalan SQL dan Big Query untuk Analisis Data
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour2"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Membangun Dashboard dengan Looker Studio
                                        </button>
                                    </h2>
                                    <div id="collapseFour2" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour3"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Membangun Dashboard dengan Tableau
                                        </button>
                                    </h2>
                                    <div id="collapseFour3" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
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

    {{-- <!-- faq-area -->
    <section class="faq__area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="600">
                    <div class="banner__images">
                        <img src="public/assets/img/banner/man2.png" alt="img" class="main-img"
                            data-aos="fade-right" data-aos-delay="800">
                        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme"
                            data-aos="fade-right" data-aos-delay="600">

                    </div>
                    <div
                        style=" position: absolute; bottom: 0; left: 0; right: 0; height: 90px; 
                        background: linear-gradient(to bottom, transparent, #f5f3f9);
                        z-index: 1;">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="800">
                    <div class="faq__content">
                        <div class="section__title pb-10">
                            <span class="sub-title">Materi</span>
                            <h2 class="title" style="color: #FE9900">Daftar Materi <b style="color: #007368">Kelas</b>
                            </h2>
                        </div>
                        <br>
                        <div class="faq__wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Fundamental Data Analyst
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Mengenal Data dan Data Analyst </p><br>
                                            <p>Statistik sederhana untuk Data Analyst </p><br>
                                            <p>Data Analyst Process </p> <br>
                                            <p>Landscape dunia Data Analyst</p><br>
                                            <p>Membangun Portfolio Data Analyst yang baik</p><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Pengenalan Spreadsheet
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Spreadsheet untuk Data Analis
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Pengenalan SQL dan Big Query untuk Analisis Data
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour2"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Membangun Dashboard dengan Looker Studio
                                        </button>
                                    </h2>
                                    <div id="collapseFour2" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour3"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Membangun Dashboard dengan Tableau
                                        </button>
                                    </h2>
                                    <div id="collapseFour3" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Groove’s intuitive shared inbox makes it easy for team members organize
                                                prioritize and.In this episode.urvived not only five centuries.Edhen an
                                                unknown printer took a galley of type and scrambl
                                            </p>
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
    <!-- faq-area-end --> --}}







@endsection
