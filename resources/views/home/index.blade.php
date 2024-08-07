@section('title', 'ProSkill Akademia | Lembaga Kursus dan Pelatihan Komputer')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')


    @guest
        <!-- banner-area -->
        <section class="banner-area-two banner-bg-two tg-motion-effects"
            data-background="{{ asset('public/assets/img/banner/banner_bg02.png') }}">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="banner__content-two">
                            <h3 class="title" data-aos="fade-right" data-aos-delay="400">
                                Learning is
                                <span class="position-relative">
                                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                            fill="currentcolor" />
                                    </svg>
                                    What You
                                </span>
                                Make of it. Make it Yours at SkillGro.
                            </h3>
                            <div class="banner__btn-two" data-aos="fade-right" data-aos-delay="600">
                                <a href="contact.html" class="btn arrow-btn">Start Free Trial <img
                                        src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                        class="injectable"></a>
                                <a href="https://www.youtube.com/watch?v=b2Az7_lLh3g" class="play-btn popup-video"><i
                                        class="fas fa-play"></i> Watch Our <br> Class Demo</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-8">
                        <div class="banner__images-two tg-svg">
                            <img src="{{ asset('public/assets/img/banner/h2_banner_img.png') }}" alt="img"
                                class="main-img">
                            <div class="shape big-shape" data-aos="fade-up" data-aos-delay="600">
                                <img src="{{ asset('public/assets/img/banner/h2_banner_shape01.svg') }}" alt="shape"
                                    class="injectable tg-motion-effects1">
                            </div>
                            <span class="svg-icon" id="banner-svg"
                                data-svg-icon="{{ asset('public/assets/img/banner/h2_banner_shape02.svg') }}"></span>
                            <div class="about__enrolled" data-aos="fade-right" data-aos-delay="200">
                                <p class="title"><span>36K+</span> Enrolled Students</p>
                                <img src="{{ asset('public/assets/img/others/student_grp.png') }}" alt="img">
                            </div>
                            <div class="banner__student" data-aos="fade-left" data-aos-delay="200">
                                <div class="icon">
                                    <img src="{{ asset('public/assets/img/banner/h2_banner_icon.svg') }}" alt="img"
                                        class="injectable">
                                </div>
                                <div class="content">
                                    <span>Total Students</span>
                                    <h4 class="title">15K</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('public/assets/img/banner/h2_banner_shape03.svg') }}" alt="shape" class="line-shape-two"
                data-aos="fade-right" data-aos-delay="1600">
        </section>
        <!-- banner-area-end -->

        <!-- brand-area -->
        <div class="brand-area brand-area-two">
            <div class="container-fluid">
                <div class="marquee_mode">
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand01.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand02.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand03.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand04.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand05.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand06.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand07.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand04.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="assets/img/brand/brand03.png" alt="brand"></a>
                        <img src="assets/img/icons/brand_star.svg" alt="star">
                    </div>
                </div>
            </div>
        </div>
        <!-- brand-area-end -->

        <!-- features-area -->
        <section class="features__area-two section-pt-120 section-pb-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section__title text-center mb-40">
                            <span class="sub-title">Our Top Features</span>
                            <h2 class="title">Raih Tujuan Anda Bersama ProSkill Akademia</h2>
                            <p>when an unknown printer took a galley of type and scrambled make <br> specimen book has
                                survived not only five centuries</p>
                        </div>
                    </div>
                </div>
                <div class="features__item-wrap">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="features__item-two">
                                <div class="features__content-two">
                                    <div class="content-top">
                                        <div class="features__icon-two">
                                            <img src="public/assets/img/icons/h2_features_icon01.svg" alt="img"
                                                class="injectable">
                                        </div>
                                        <h2 class="title">Expert Tutors</h2>
                                    </div>
                                    <p>when an unknown printer took a galley offe type and scrambled makes.</p>
                                </div>
                                <div class="features__item-shape">
                                    <img src="public/assets/img/others/features_item_shape.svg" alt="img"
                                        class="injectable">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="features__item-two">
                                <div class="features__content-two">
                                    <div class="content-top">
                                        <div class="features__icon-two">
                                            <img src="public/assets/img/icons/h2_features_icon02.svg" alt="img"
                                                class="injectable">
                                        </div>
                                        <h2 class="title">Effective Courses</h2>
                                    </div>
                                    <p>when an unknown printer took a galley offe type and scrambled makes.</p>
                                </div>
                                <div class="features__item-shape">
                                    <img src="public/assets/img/others/features_item_shape.svg" alt="img"
                                        class="injectable">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="features__item-two">
                                <div class="features__content-two">
                                    <div class="content-top">
                                        <div class="features__icon-two">
                                            <img src="public/assets/img/icons/h2_features_icon03.svg" alt="img"
                                                class="injectable">
                                        </div>
                                        <h2 class="title">Earn Certificate</h2>
                                    </div>
                                    <p>when an unknown printer took a galley offe type and scrambled makes.</p>
                                </div>
                                <div class="features__item-shape">
                                    <img src="public/assets/img/others/features_item_shape.svg" alt="img"
                                        class="injectable">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- features-area-end -->
    @endguest
    <!-- course-area -->
    <section class="courses-area section-py-120" data-background="public/assets/img/bg/courses_bg.jpg">
        <div class="container">
            <div class="section__title-wrap">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section__title text-center mb-40">
                            <span class="sub-title">Kelas ProSkill Akademia</span>
                            <h2 class="title">Kelas Online dan Offline Kami</h2>
                            <p class="desc">Saatnya Meningkatkan Keterampilan dan Skill Anda</p>
                        </div>
                        <div class="courses__nav">
                            <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                        data-bs-target="#all-tab-pane" type="button" role="tab"
                                        aria-controls="all-tab-pane" aria-selected="true">
                                        Semua Kelas
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="courseTabContent">
                <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab"
                    tabindex="0">
                    <div class="swiper courses-swiper-active">
                        <div class="swiper-wrapper">
                            @foreach ($KelasTatapMuka as $kelas)
                                <div class="swiper-slide">
                                    <div
                                        class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
                                        <div class="courses__item-thumb courses__item-thumb-two">
                                            <a href="{{ route('classroomdetail', ['id' => $kelas->id]) }}"
                                                class="shine__animate-link">
                                                <img src="{{ asset('public/uploads/' . $kelas->gambar) }}" alt="img"
                                                    class="img-fluid">
                                            </a>
                                        </div>
                                        <div
                                            class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1">
                                            <ul class="courses__item-meta list-wrap">
                                                <li class="courses__item-tag">
                                                    @if ($kelas->course_type == 'online')
                                                        <span class="badge bg-primary">Online</span>
                                                    @else
                                                        <span class="badge bg-secondary">Offline</span>
                                                    @endif
                                                </li>
                                                <li class="price">Rp {{ number_format($kelas->price, 0, '.', '.') }}</li>
                                            </ul>
                                            <h5 class="title course-title flex-grow-1">
                                                <a
                                                    href="{{ route('classroomdetail', ['id' => $kelas->id]) }}">{{ $kelas->nama_kursus }}</a>
                                            </h5>
                                            <div class="courses__item-content-bottom mt-auto">
                                                <div class="author-two">
                                                    <a href="instructor-details.html">
                                                        <img src="public/assets/img/courses/course_author001.png"
                                                            alt="img">{{ $kelas->user->name }}
                                                    </a>
                                                </div>
                                                <div class="avg-rating">
                                                    <i class="fas fa-star"></i> (4.8 Reviews)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            <div class="all-courses-btn mt-30">
                <div class="tg-button-wrap justify-content-center">
                    <a href="{{ route('search') }}" class="btn arrow-btn">Lihat Semua Kursus <img
                            src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                </div>
            </div>
        </div>
    </section>
    <!-- course-area-end -->
    <!-- about-area -->
    <section class="about-area-two tg-motion-effects section-pb-120">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="faq__img-wrap tg-svg">
                        <div class="faq__round-text">
                            <div class="curved-circle">
                                * Education * System * can * Make * Change *
                            </div>
                        </div>
                        <div class="faq__img faq__img-two">
                            <img src="public/assets/img/others/faq_img.png" alt="img">
                            <div class="shape-one">
                                <img src="public/assets/img/others/faq_shape01.svg" class="injectable tg-motion-effects4"
                                    alt="img">
                            </div>
                            <div class="shape-two">
                                <span class="svg-icon" id="faq-two-svg"
                                    data-svg-icon="public/assets/img/others/faq_shape02.svg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__content">
                        <div class="section__title">
                            <span class="sub-title">Get More About Us</span>
                            <h2 class="title">
                                Thousand Of Top
                                <span class="position-relative">
                                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                            fill="currentcolor" />
                                    </svg>
                                    Courses
                                </span>
                                Now in One Place
                            </h2>
                        </div>
                        <p class="desc">Groove’s intuitive shared inbox makes it easy for team members to
                            organize, prioritize and.In this episode of the Smashing Pod we’re talking about Web
                            Platform Baseline.</p>
                        <ul class="about__info-list list-wrap">
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">The Most World Class Instructors</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Access Your Class anywhere</p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">Flexible Course Plan</p>
                            </li>
                        </ul>
                        <div class="tg-button-wrap">
                            <a href="about-us.html" class="btn arrow-btn">Start Free Trial <img
                                    src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->

    <!-- event-area -->
    <section class="event__area section-pt-120 section-pb-90">
        <div class="container">
            <div class="event__inner-wrap">
                <div class="row">
                    <div class="col-30">
                        <div class="event__content">
                            <div class="section__title mb-20">
                                <span class="sub-title">Upcoming Events</span>
                                <h2 class="title">Join Our Community And Make it Bigger</h2>
                            </div>
                            <p>Edhen an unknown printer took a galley acrambled make a type specimen bookas
                                centuries.Edhen anderely unknown printer took a galley.</p>
                            <div class="tg-button-wrap">
                                <a href="events.html" class="btn arrow-btn">See All Events <img
                                        src="public/assets/img/icons/right_arrow.svg" alt="img"
                                        class="injectable"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-70">
                        <div class="event__item-wrap">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="event__item shine__animate-item">
                                        <div class="event__item-thumb">
                                            <a href="events-details.html" class="shine__animate-link"><img
                                                    src="public/assets/img/events/event_thumb01.jpg" alt="img"></a>
                                        </div>
                                        <div class="event__item-content">
                                            <span class="date">25 June, 2024</span>
                                            <h2 class="title"><a href="events-details.html">The Accessible
                                                    Target Sizes Cheatsheet</a></h2>
                                            <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                                    class="flaticon-map"></i>United Kingdom</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="event__item shine__animate-item">
                                        <div class="event__item-thumb">
                                            <a href="events-details.html" class="shine__animate-link"><img
                                                    src="public/assets/img/events/event_thumb02.jpg" alt="img"></a>
                                        </div>
                                        <div class="event__item-content">
                                            <span class="date">25 June, 2024</span>
                                            <h2 class="title"><a href="events-details.html">Exactly How
                                                    Technology Can Make Reading</a></h2>
                                            <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                                    class="flaticon-map"></i>Tokyo Japan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="event__item shine__animate-item">
                                        <div class="event__item-thumb">
                                            <a href="events-details.html" class="shine__animate-link"><img
                                                    src="public/assets/img/events/event_thumb03.jpg" alt="img"></a>
                                        </div>
                                        <div class="event__item-content">
                                            <span class="date">25 June, 2024</span>
                                            <h2 class="title"><a href="events-details.html">Aewe Creating
                                                    Futures Through Technology</a></h2>
                                            <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                                    class="flaticon-map"></i>New Work</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="event__shape">
            <img src="public/assets/img/events/event_shape.png" alt="img" class="alltuchtopdown">
        </div>
    </section>
    <!-- event-area-end -->

    <!-- blog-area -->
    <section class="blog__post-area blog__post-area-two">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section__title text-center mb-40">
                        <span class="sub-title">News & Blogs</span>
                        <h2 class="title">Our Latest News Feed</h2>
                        <p>when known printer took a galley of type scrambl edmake</p>
                    </div>
                </div>
            </div>
            <div class="row gutter-20">
                <div class="col-xl-3 col-md-6">
                    <div class="blog__post-item shine__animate-item">
                        <div class="blog__post-thumb">
                            <a href="blog-details.html" class="shine__animate-link"><img
                                    src="public/assets/img/blog/blog_post01.jpg" alt="img"></a>
                            <a href="blog.html" class="post-tag">Marketing</a>
                        </div>
                        <div class="blog__post-content">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>20 July, 2024</li>
                                    <li><i class="flaticon-user-1"></i>by <a href="blog-details.html">Admin</a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="title"><a href="blog-details.html">How To Become idiculously Self-Aware
                                    In 20 Minutes</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="blog__post-item shine__animate-item">
                        <div class="blog__post-thumb">
                            <a href="blog-details.html" class="shine__animate-link"><img
                                    src="public/assets/img/blog/blog_post02.jpg" alt="img"></a>
                            <a href="blog.html" class="post-tag">Students</a>
                        </div>
                        <div class="blog__post-content">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>20 July, 2024</li>
                                    <li><i class="flaticon-user-1"></i>by <a href="blog-details.html">Admin</a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="title"><a href="blog-details.html">Get Started With UI Design With Tips
                                    To Speed</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="blog__post-item shine__animate-item">
                        <div class="blog__post-thumb">
                            <a href="blog-details.html" class="shine__animate-link"><img
                                    src="public/assets/img/blog/blog_post03.jpg" alt="img"></a>
                            <a href="blog.html" class="post-tag">Science</a>
                        </div>
                        <div class="blog__post-content">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>20 July, 2024</li>
                                    <li><i class="flaticon-user-1"></i>by <a href="blog-details.html">Admin</a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="title"><a href="blog-details.html">Make Your Own Expanding Contracting
                                    Content</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="blog__post-item shine__animate-item">
                        <div class="blog__post-thumb">
                            <a href="blog-details.html" class="shine__animate-link"><img
                                    src="public/assets/img/blog/blog_post04.jpg" alt="img"></a>
                            <a href="blog.html" class="post-tag">Agency</a>
                        </div>
                        <div class="blog__post-content">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>20 July, 2024</li>
                                    <li><i class="flaticon-user-1"></i>by <a href="blog-details.html">Admin</a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="title"><a href="blog-details.html">What we are capable to usually
                                    discovered</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-area-end -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var courseTitles = document.querySelectorAll('.course-title');
            var maxHeight = 0;

            // Temukan tinggi maksimum
            courseTitles.forEach(function(title) {
                if (title.offsetHeight > maxHeight) {
                    maxHeight = title.offsetHeight;
                }
            });

            // Tetapkan tinggi maksimum ke semua elemen course-title
            courseTitles.forEach(function(title) {
                title.style.height = maxHeight + 'px';
            });
        });
    </script>

@endsection
