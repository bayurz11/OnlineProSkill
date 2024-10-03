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
                        <h3 class="title tg-svg" data-aos="fade-right" data-aos-delay="400"
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
                        </h3> <br>
                        <p data-aos="fade-right" data-aos-delay="600" style="font-size: 1rem; margin-bottom: 15px;">
                            📊 Jadilah ahli dalam <b>visualisasi data</b> dan ambil langkah pertama menuju karier yang lebih
                            cerah! <b>Daftar sekarang</b>, dan wujudkan impianmu <b>menjadi data-driven professional!.</b>
                        </p>
                        <p data-aos="fade-right" data-aos-delay="700" style="font-size: 1rem;">
                            📝 Temukan lebih banyak informasi dan daftar di <b>Proskill Akademia!.</b>
                        </p>
                        <div class="banner__btn-wrap" data-aos="fade-right" data-aos-delay="800" style="margin-top: 20px;">
                            <a href="{{ route('cart_bootcamp.checkout', ['id' => 17]) }}" class="btn arrow-btn"
                                style="font-size: 1rem; padding: 15px 25px;">Daftar
                                Sekarang
                                <img src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"
                                    style="margin-left: 10px;">
                            </a>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; " data-aos="fade-top"
                        data-aos-delay="800">
                        <div style="display: flex; align-items: center;">
                            <div>
                                <p style="margin: 0; font-size: 0.9rem;">Available <b>Online</b>,</p>
                                <p style="margin: 0; font-size: 0.9rem;"><b>5 Weeks</b></p>
                            </div>
                        </div>

                        <div style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>
                        <div style="display: flex; align-items: center;">
                            <img src="public/assets/img/icons/clock.svg" alt="Clock Icon"
                                style="width: 28px; height: 28px; vertical-align: middle; margin-right: 10px;">
                            <div>
                                <p style="margin: 0; font-size: 0.9rem;">Per Week</p>
                                <p style="margin: 0; font-weight: bold; font-size: 0.9rem;">2 - 4 hrs</p>
                            </div>
                        </div>
                        <div style="border-left: 2px solid #007368; height: 50px; margin: 0 20px;"></div>
                        <div style="display: flex; align-items: center;">
                            <img src="public/assets/img/icons/path-to-live-icon.svg" alt="Format Icon"
                                style="width: 42px; height: 42px; vertical-align: middle; margin-right: 10px;">
                            <div>
                                <p style="margin: 0; font-size: 0.9rem;">Format</p>
                                <p style="margin: 0; font-weight: bold; font-size: 0.9rem;">Flexible</p>
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

    <!-- about-area -->
    <section class="about-area tg-motion-effects section-py-120">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-9" data-aos="fade-right" data-aos-delay="600">
                    <div class="about__images">
                        <img src="public/assets/img/others/Bootcamp.png" alt="img" class="main-img">
                        <img src="public/assets/img/others/about_shape.svg" alt="img" class="shape alltuchtopdown">
                        <a href="https://www.youtube.com/watch?v=hxpItadargI" class="play-btn popup-video">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28"
                                fill="none">
                                <path
                                    d="M0.19043 26.3132V1.69421C0.190288 1.40603 0.245303 1.12259 0.350273 0.870694C0.455242 0.6188 0.606687 0.406797 0.79027 0.254768C0.973854 0.10274 1.1835 0.0157243 1.39936 0.00193865C1.61521 -0.011847 1.83014 0.0480663 2.02378 0.176003L20.4856 12.3292C20.6973 12.4694 20.8754 12.6856 20.9999 12.9535C21.1245 13.2214 21.1904 13.5304 21.1904 13.8456C21.1904 14.1608 21.1245 14.4697 20.9999 14.7376C20.8754 15.0055 20.6973 15.2217 20.4856 15.3619L2.02378 27.824C1.83056 27.9517 1.61615 28.0116 1.40076 27.9981C1.18536 27.9847 0.97607 27.8983 0.792638 27.7472C0.609205 27.596 0.457661 27.385 0.352299 27.1342C0.246938 26.8833 0.191236 26.6008 0.19043 26.3132Z"
                                    fill="currentcolor" />
                            </svg>
                        </a>

                        {{-- <div class="about__enrolled" data-aos="fade-right" data-aos-delay="200">
                            <p class="title"><span>36K+</span> Enrolled Students</p>
                            <img src="public/assets/img/others/student_grp.png" alt="img">
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__content">
                        <div class="section__title">
                            <span class="sub-title" data-aos="fade-top" data-aos-delay="600">Detail</span>
                            <h2 class="title" data-aos="fade-top" data-aos-delay="600">
                                Apa Yang Akan
                                <span class="position-relative">
                                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                            fill="currentcolor" />
                                    </svg>
                                    Anda
                                </span>
                                Pelajari
                            </h2>
                        </div>

                        <ul class="about__info-list list-wrap" data-aos="fade-top" data-aos-delay="800">
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Mengumpulkan Data</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Menelaah Data</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Memvalidasi Data</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Menentukan Objek Data</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Menkonstruksi Data</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Membuat Business Intelligence</p>
                            </li>
                        </ul>
                        {{-- <div class="tg-button-wrap">
                            <a href="about-us.html" class="btn arrow-btn">Start Free Trial <img
                                    src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->

    <!-- fact-area -->
    <section class="fact__area">
        <div class="container">
            <div class="fact__inner-wrap" data-aos="fade-top" data-aos-delay="800">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon01.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">Instruktur Berpengalaman</h4>
                                <p>Dibimbing Langsung oleh Instruktur Berpengalaman di Bidangnya</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon02.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">Materi Video</h4>
                                <p>Disediakan Juga Materi Video untuk Peserta Bootccamp</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon03.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">Sertifikat Penyelesaian</h4>
                                <p>Mendaptakan Sertifikat Setelah Menyelesaikan Bootcamp</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="public/assets/img/icons/features_icon04.svg" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">E-mail Profesional</h4>
                                <p>Disediakan Email Profesional untuk Peserta Bootcamp</p>
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
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="600">
                    <div class="banner__images">
                        <img src="public/assets/img/banner/man.png" alt="img" class="main-img" data-aos="fade-left"
                            data-aos-delay="800">
                        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme"
                            data-aos="fade-left" data-aos-delay="600">

                    </div>
                    <div
                        style=" position: absolute; bottom: 0; left: 0; right: 0; height: 90px; 
                        background: linear-gradient(to bottom, transparent, #f5f4f9);
                        z-index: 1;">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="800">
                    <div class="faq__content">
                        <div class="section__title pb-10">
                            <span class="sub-title">Tanya Proskill Akademia</span>
                            <h2 class="title">Frequently Asked <br> Questions 😊</h2>
                        </div>
                        <br>
                        <div class="faq__wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Apakah Pemula Bisa Mengikuti Bootcamp ini?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
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
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            apa Persyaratan Untuk Mengikuti Bootcamp ini?
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
                                            Berapa Lama Waktu Bootcamp ini?
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
                                            Apakah Tersedia Komunitas Belajar?
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-area-end -->

    <script>
        $(document).ready(function() {
            $('.popup-video').magnificPopup({
                type: 'iframe',
                iframe: {
                    patterns: {
                        youtube: {
                            index: 'youtube.com/',
                            id: 'v=',
                            src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                        }
                    }
                }
            });
        });
    </script>
@endsection
