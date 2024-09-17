@section('title', 'ProSkill Akademia | Tentang Kami')
<?php $page = 'Tentang_Kami'; ?>

@extends('layout.mainlayout')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg" loading="lazy">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Tentang Kami</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Tentang Kami</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
                data-aos-delay="400" loading="lazy">
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <!-- features-area -->
    <section class="features__area" style="background-color: #FE9900;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="section__title white-title text-center mb-50">
                        <span class="sub-title">Tentang Kami</span>
                        <h2 class="title">Proskill Akademia adalah lembaga kursus yang dikelola oleh</h2>
                        <p style="text-color:#fbfbfb">PT Bahagia Sukses Digimedia <br> Nomor Induk Berusaha PT. Bahagia
                            Sukses Digimedia: 1910220049534
                            <br>SK Depkumham: AHU-043447 .AH.01.30.Tahun 2022<br>Jl.DI Panjaitan Km 7 Komplek Taman Mekar
                            Sari 2 Blok C No.22, Melayu Kota Piring, Tanjung Pinang Timur, Tanjung Pinang, Kepulauan Riau,
                            29123
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="public/assets/img/icons/features_icon03.svg" class="injectable" alt="img">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Rekomendasi Disdik No</h4>
                            <p>B/412.35/3/5.3.02/2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="public/assets/img/icons/features_icon03.svg" class="injectable" alt="img">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Nomor Izin Operasional DPMPTSP No</h4>
                            <p>503/92/5.10.05.3/2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="public/assets/img/icons/features_icon03.svg" class="injectable" alt="img">
                        </div>
                        <div class="features__content">
                            <h4 class="title">NPSN Kemendikbud Ristek</h4>
                            <p>K9999032</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- features-area-end -->

@endsection
