@section('title', 'ProSkill Akademia | Lembaga Kursus dan Pelatihan Komputer')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    @guest
        <!-- banner-area -->
        <section class="banner-area-two banner-bg-two tg-motion-effects"
            data-background="{{ asset('public/assets/img/banner/banner_bg02.png') }}">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="banner__content-two">
                            <h3 class="title" data-aos="fade-right" data-aos-delay="400">
                                Tingkatkan Keahlian Komputer
                                <span class="position-relative">
                                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                            fill="currentcolor" />
                                    </svg>
                                    Anda
                                </span>
                                Bergabung Bersama Kami di Proskill!
                            </h3>

                            <div class="banner__btn-two" data-aos="fade-right" data-aos-delay="600">
                                <a href="{{ route('search') }}" class="btn arrow-btn">Bergabung Sekarang<img
                                        src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                        class="injectable"></a>
                                <a href="https://www.youtube.com/watch?v=NwCzzvlDOmo" class="play-btn popup-video"><i
                                        class="fas fa-play"></i> Sekilas Tentang<br> ProSkill Akademia</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-8">
                        <div class="banner__images-two tg-svg">
                            <img src="{{ asset('public/assets/img/banner/1.png') }}" alt="img" class="main-img"
                                loading="lazy">
                            <div class="shape big-shape" data-aos="fade-up" data-aos-delay="600">
                                <img src="{{ asset('public/assets/img/banner/h2_banner_shape01.svg') }}" alt="shape"
                                    class="injectable tg-motion-effects1">
                            </div>
                            <span class="svg-icon" id="banner-svg"
                                data-svg-icon="{{ asset('public/assets/img/banner/h2_banner_shape02.svg') }}"></span>
                            <div class="about__enrolled" data-aos="fade-right" data-aos-delay="200">
                                <p class="title"><span>{{ $sertifikat->count() }}</span> Siswa Terdaftar</p>
                                <img src="{{ asset('public/assets/img/others/1.png') }}" alt="img">
                            </div>
                            <div class="banner__student" data-aos="fade-left" data-aos-delay="200">
                                <div class="icon">
                                    <img src="{{ asset('public/assets/img/banner/h2_banner_icon.svg') }}" alt="img"
                                        class="injectable">
                                </div>
                                <div class="content">
                                    <span>Jumlah Siswa</span>
                                    <h4 class="title">{{ $daftar_siswa->count() }} Siswa</h4>
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
        <div class="brand-area brand-area-two" style="background-color: rgb(255, 255, 255)">
            <div class="container-fluid">
                <div class="marquee_mode">
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand01.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand02.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand03.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand04.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand05.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand06.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand07.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand04.png" alt="brand" loading="lazy">
                    </div>
                    <div class="brand__item">
                        <a href="#"><img src="public/assets/img/brand/brand03.png" alt="brand" loading="lazy">
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
                            <span class="sub-title">Mengapa Memilih ProSkill</span>
                            <h2 class="title">Raih Tujuan Anda Bersama ProSkill Akademia</h2>

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
                                                class="injectable" loading="lazy">
                                        </div>
                                        <h2 class="title">Tutor Ahli</h2>
                                    </div>
                                    <p>Belajar Langsung Dari Tutor Yang Ahli di Bidangnya.</p>
                                </div>
                                <div class="features__item-shape">
                                    <img src="public/assets/img/others/features_item_shape.svg" alt="img"
                                        class="injectable" loading="lazy">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="features__item-two">
                                <div class="features__content-two">
                                    <div class="content-top">
                                        <div class="features__icon-two">
                                            <img src="public/assets/img/icons/h2_features_icon02.svg" alt="img"
                                                class="injectable" loading="lazy">
                                        </div>
                                        <h2 class="title">Kursus yang Efektif</h2>
                                    </div>
                                    <p>Kurikulum Kelas yang Sesuai Dengan Standar Industri.</p>
                                </div>
                                <div class="features__item-shape">
                                    <img src="public/assets/img/others/features_item_shape.svg" alt="img"
                                        class="injectable" loading="lazy">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="features__item-two">
                                <div class="features__content-two">
                                    <div class="content-top">
                                        <div class="features__icon-two">
                                            <img src="public/assets/img/icons/h2_features_icon03.svg" alt="img"
                                                class="injectable" loading="lazy">
                                        </div>
                                        <h2 class="title">Sertifikat Penyelesaian</h2>
                                    </div>
                                    <p>Mendapatkan Sertifikat Setelah Menyelesaikan Kelas.</p>
                                </div>
                                <div class="features__item-shape">
                                    <img src="public/assets/img/others/features_item_shape.svg" alt="img"
                                        class="injectable" loading="lazy">
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
    <section class="courses-area section-py-120" data-background="public/assets/img/bg/courses_bg.jpg" loading="lazy">
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
                                                    class="img-fluid" loading="lazy">
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
                                                <li class="price">Rp {{ number_format($kelas->price, 0, '.', '.') }}
                                                </li>
                                            </ul>
                                            <h5 class="title course-title flex-grow-1">
                                                <a
                                                    href="{{ route('classroomdetail', ['id' => $kelas->id]) }}">{{ $kelas->nama_kursus }}</a>
                                            </h5>
                                            <div class="courses__item-content-bottom mt-auto">
                                                <div class="author-two">
                                                    <a href="">
                                                        <img src="public/assets/img/courses/course_author001.png"
                                                            alt="img" loading="lazy">{{ $kelas->user->name }}
                                                    </a>
                                                </div>
                                                {{-- <div class="avg-rating">
                                                    <i class="fas fa-star"></i> (4.8 Reviews)
                                                </div> --}}
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
                    <a href="{{ route('search') }}" class="btn arrow-btn">Lihat Semua Kelas <img
                            src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                </div>
            </div>
        </div>
    </section>
    <!-- course-area-end -->
    {{-- <!-- about-area -->
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
    <!-- about-area-end --> --}}

    <!-- event-area -->
    @if ($event->count() > 0)
        <section class="event__area section-pt-120 section-pb-90">
            <div class="container">
                <div class="event__inner-wrap">
                    <div class="row">
                        <div class="col-30">
                            <div class="event__content">
                                <div class="section__title mb-20">
                                    <span class="sub-title">Acara Mendatang</span>
                                    <h2 class="title">Bergabunglah dengan Komunitas Kami dan Jadikan Lebih Besar</h2>
                                </div>

                                <div class="tg-button-wrap">
                                    <a href="{{ route('event') }}" class="btn arrow-btn">Lihat Semua Acara <img
                                            src="public/assets/img/icons/right_arrow.svg" alt="img"
                                            class="injectable"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-70">
                            <div class="event__item-wrap">
                                <div class="row justify-content-center">
                                    @foreach ($event as $event)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="event__item shine__animate-item">
                                                <div class="event__item-thumb">
                                                    <a href="{{ route('event_detail', ['id' => $event->id]) }}"
                                                        class="shine__animate-link">
                                                        <img src="{{ asset('public/uploads/events/' . $event->gambar) }}"
                                                            alt="img" loading="lazy">
                                                    </a>
                                                </div>
                                                <div class="event__item-content">
                                                    <span
                                                        class="date">{{ Carbon::parse($event->tgl)->format('d - F - Y') }}</span>
                                                    <h2 class="title event-name">
                                                        <a
                                                            href="{{ route('event_detail', ['id' => $event->id]) }}">{{ $event->name }}</a>
                                                    </h2>
                                                    <a href="{{ $event->link_maps }}" class="location" target="_blank">
                                                        <i class="flaticon-map"></i>{{ $event->lokasi }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="event__shape">
                <img src="public/assets/img/events/event_shape.png" alt="img" class="alltuchtopdown"
                    loading="lazy">
            </div>
        </section>
        <!-- event-area-end -->
    @endif

    <!-- testimonial-area -->
    <section class="testimonial__area-six section-py-140 testimonial__bg-three"
        data-background="public/assets/img/bg/h8_testimonial_bg.jpg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 col-md-8">
                    <div class="section__title mb-50">
                        <span class="sub-title">Testimonial Kami</span>
                        <h2 class="title">Apa yang Siswa Pikirkan dan Katakan Tentang ProSkill</h2>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-4">
                    <div class="testimonial__nav-two">
                        <button class="testimonial-button-prev"><i class="skillgro-right-arrow"></i></button>
                        <button class="testimonial-button-next"><i class="skillgro-right-arrow"></i></button>
                    </div>
                </div>
            </div>
            <div class="swiper-container testimonial-active-five">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial__item-two testimonial__item-five">
                            <div class="testimonial__author testimonial__author-two">
                                <div class="testimonial__author-thumb testimonial__author-thumb-two">
                                    <img src="public/assets/img/others/user1.png" alt="img">
                                </div>
                                <div class="testimonial__author-content testimonial__author-content-two">
                                    <h2 class="title">Jeff Chua</h2>
                                    <span>Siswa SD</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ Sangat Bermanfaat ”</p>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__item-two testimonial__item-five">
                            <div class="testimonial__author testimonial__author-two">
                                <div class="testimonial__author-thumb testimonial__author-thumb-two">
                                    <img src="public/assets/img/others/user3.png" alt="img">
                                </div>
                                <div class="testimonial__author-content testimonial__author-content-two">
                                    <h2 class="title">ANZELTHA NAJLA AUDIA</h2>
                                    <span>Siswa SMP</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ Sangat Bermanfaat dan Menambah Pengetahuan Basic computer ”</p>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__item-two testimonial__item-five">
                            <div class="testimonial__author testimonial__author-two">
                                <div class="testimonial__author-thumb testimonial__author-thumb-two">
                                    <img src="public/assets/img/others/user2.png" alt="img">
                                </div>
                                <div class="testimonial__author-content testimonial__author-content-two">
                                    <h2 class="title">LINA</h2>
                                    <span>Ibu Rumah Tangga</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ Semoga lebih Banyak Program Baru ”</p>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__item-two testimonial__item-five">
                            <div class="testimonial__author testimonial__author-two">
                                <div class="testimonial__author-thumb testimonial__author-thumb-two">
                                    <img src="public/assets/img/others/user5.png" alt="img">
                                </div>
                                <div class="testimonial__author-content testimonial__author-content-two">
                                    <h2 class="title">ABDUL AZIZ</h2>
                                    <span>Siswa SMA</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ Kurusu ini Sangat Bermanfaat Teruutama Bagi Orang Awam tentang Soal Komputer dan AI ”
                                </p>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="swiper-slide">
                        <div class="testimonial__item-two testimonial__item-five">
                            <div class="testimonial__author testimonial__author-two">
                                <div class="testimonial__author-thumb testimonial__author-thumb-two">
                                    <img src="public/assets/img/others/user4.png" alt="img">
                                </div>
                                <div class="testimonial__author-content testimonial__author-content-two">
                                    <h2 class="title">BAYHAQI MUFTI</h2>
                                    <span>Siswa SMP</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ Hal yang Menarik Selama Saya mengikuti Kursus ini Adalah Saya Bisa Menggunakan Aplikasi
                                    Microseof Word, Excel, dan Powerpoint, Saya Juga Bisa Menggunakan Teknologi AI ”
                                </p>
                            </div>

                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="testimonial__shape-wrap-two">
            <img src="public/assets/img/events/event_shape.png" alt="shape" class="alltuchtopdown" loading="lazy"
                data-aos="fade-down-left" data-aos-delay="400">
            <img src="public/assets/img/events/event_shape.png" alt="shape" data-aos="fade-up-right"
                class="alltuchtopdown" loading="lazy" data-aos-delay="400">
        </div>
    </section>
    <!-- testimonial-area-end -->

    <!-- blog-area -->
    <section class="blog__post-area blog__post-area-two">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section__title text-center mb-40">
                        <span class="sub-title">Artikel</span>
                        <h2 class="title">Berita Terbaru dan Tips Singkat tentang Komputer</h2>
                        {{-- <p>when known printer took a galley of type scrambl edmake</p> --}}
                    </div>
                </div>
            </div>
            <div class="row gutter-20">
                @foreach ($blog as $blog)
                    <div class="col-xl-3 col-md-6">
                        <div class="blog__post-item shine__animate-item">
                            <div class="blog__post-thumb">
                                <a href="{{ route('blog_detail', ['id' => $blog->id]) }}"
                                    class="shine__animate-link"><img src="{{ asset('public/uploads/' . $blog->gambar) }}"
                                        alt="img" loading="lazy"></a>
                                <a href="{{ route('blog_detail', ['id' => $blog->id]) }}"
                                    class="post-tag">{{ json_decode($blog->tag, true)[0]['value'] }}</a>
                            </div>
                            <div class="blog__post-content">
                                <div class="blog__post-meta">
                                    <ul class="list-wrap">
                                        <li><i
                                                class="flaticon-calendar"></i>{{ Carbon::parse($blog->date)->format('d M, Y') }}
                                        </li>
                                        <li><i class="flaticon-user-1"></i>by <a
                                                href="{{ route('blog_detail', ['id' => $blog->id]) }}">{{ $blog->user->name }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <h4 class="title blog-name"><a
                                        href="{{ route('blog_detail', ['id' => $blog->id]) }}">{{ $blog->title }}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- blog-area-end -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengatur tinggi untuk elemen course-title
            var courseTitles = document.querySelectorAll('.course-title');
            var maxCourseTitleHeight = 0;

            // Temukan tinggi maksimum untuk course-title
            courseTitles.forEach(function(title) {
                if (title.offsetHeight > maxCourseTitleHeight) {
                    maxCourseTitleHeight = title.offsetHeight;
                }
            });

            // Tetapkan tinggi maksimum ke semua elemen course-title
            courseTitles.forEach(function(title) {
                title.style.height = maxCourseTitleHeight + 'px';
            });

            // Mengatur tinggi untuk elemen event-name
            var eventNames = document.querySelectorAll('.event-name');
            var maxEventNameHeight = 0;

            // Temukan tinggi maksimum untuk event-name
            eventNames.forEach(function(eventName) {
                var height = eventName.offsetHeight;
                if (height > maxEventNameHeight) {
                    maxEventNameHeight = height;
                }
            });

            // Mengatur tinggi untuk elemen .blog-name
            var blogNames = document.querySelectorAll('.blog-name');
            var maxBlogNamesHeight = 0;

            // Temukan tinggi maksimum untuk .blog-name
            blogNames.forEach(function(blogName) {
                var height = blogName.offsetHeight;
                if (height > maxBlogNamesHeight) {
                    maxBlogNamesHeight = height;
                }
            });

            // Tetapkan tinggi maksimum ke semua elemen .blog-name
            blogNames.forEach(function(blogName) {
                blogName.style.height = maxBlogNamesHeight + 'px';
            });

            // Select all testimonial items
            var testimonialItems = document.querySelectorAll('.testimonial__item-two');
            var maxTestimonialHeight = 0;

            // Find the maximum height among all testimonial items
            testimonialItems.forEach(function(testimonialItem) {
                var height = testimonialItem.offsetHeight;
                if (height > maxTestimonialHeight) {
                    maxTestimonialHeight = height;
                }
            });

            // Set the maximum height to all testimonial items
            testimonialItems.forEach(function(testimonialItem) {
                testimonialItem.style.height = maxTestimonialHeight + 'px';
            });


        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".testimonial-active-five", {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 1000, // Set delay to 2000ms (2 seconds)
                    disableOnInteraction: false,
                },
                speed: 2000, // Adjust the speed to control how fast the marquee scrolls
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
                navigation: {
                    nextEl: ".testimonial-button-next",
                    prevEl: ".testimonial-button-prev",
                },
            });
        });
    </script>


@endsection
