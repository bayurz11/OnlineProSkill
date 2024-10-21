@section('title', 'ProSkill Akademia | Profil Saya')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </div>

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            <div class="dashboard__top-wrap">
                <div class="dashboard__top-bg" data-background="{{ asset('public/assets/img/bg/student_bg.jpg') }}">
                </div>
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                alt="img" width="120" height="120" style="object-fit: cover;">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ $user->name }}</h4>
                            <div class="review__wrap review__wrap-two">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span>(15 Reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard__instructor-info-right">
                        <a href="#" class="btn btn-two arrow-btn">Create a New Course <img
                                src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('instruktur.nav.navbar')

                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">My Profile</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="profile__content-wrap">
                                    <ul class="list-wrap">
                                        <li><span>Registration Date</span> February 28, 2026 8:01 am</li>
                                        <li><span>Username</span> {{ $user->name }}</li>
                                        <li><span>Email</span> {{ $user->email }}</li>
                                        <li><span>Phone Number</span> {{ $user->phone }}</li>
                                        <li><span>Skill/Occupation</span> Application Developer</li>
                                        <li><span>Biography</span> I'm the Front-End Developer for #ThemeGenix in New York,
                                            OR. I have a serious passion for UI effects, animations, and
                                            creating intuitive, dynamic user experiences.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- dashboard-area-end -->

@endsection
