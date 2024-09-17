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
    <section class="features__area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="section__title white-title text-center mb-50">
                        <span class="sub-title">How We Start Journey</span>
                        <h2 class="title">Start your Learning Journey Today!</h2>
                        <p>Groove’s intuitive shared inbox makesteam members together <br> organize, prioritize and.In this
                            episode.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icons/features_icon01.svg" class="injectable" alt="img">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Learn with Experts</h4>
                            <p>Curate anding area share Pluralsight content to reach your</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icons/features_icon02.svg" class="injectable" alt="img">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Learn Anything</h4>
                            <p>Curate anding area share Pluralsight content to reach your</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icons/features_icon03.svg" class="injectable" alt="img">
                        </div>
                        <div class="features__content">
                            <h4 class="title">Get Online Certificate</h4>
                            <p>Curate anding area share Pluralsight content to reach your</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features__item">
                        <div class="features__icon">
                            <img src="assets/img/icons/features_icon04.svg" class="injectable" alt="img">
                        </div>
                        <div class="features__content">
                            <h4 class="title">E-mail Marketing</h4>
                            <p>Curate anding area share Pluralsight content to reach your</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features-area-end -->

@endsection
