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
                            <div class="about__enrolled" data-aos="fade-right" data-aos-delay="200"
                                style="margin-left: -40px; margin-top: -60px;">
                                <p class="title"><span>{{ $sertifikat->count() }}</span> Sertifikat</p>
                                <img src="{{ asset('public/assets/img/others/1.png') }}" alt="img">
                            </div>
                            <div class="banner__student hide-on-small" data-aos="fade-left" data-aos-delay="200"
                                style="margin-top: -80px;">
                                <div class="icon">
                                    <img src="{{ asset('public/assets/img/banner/h2_banner_icon.svg') }}" alt="img"
                                        class="injectable">
                                </div>
                                <div class="content">
                                    <span>Total Siswa</span>
                                    <h4 class="title">{{ $daftar_siswa->count() }} Siswa</h4>
                                </div>
                            </div>
                            <style>
                                @media (max-width: 1200px) {
                                    .hide-on-small {
                                        display: none;
                                    }
                                }
                            </style>

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



    @endguest
    <!-- course-area -->
    {{-- <section class="courses-area section-py-120" data-background="public/assets/img/bg/courses_bg.jpg" loading="lazy">
        <div class="container">
            <div class="section__title-wrap">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section__title text-center mb-40">
                            <span class="sub-title">Program ProSkill Akademia</span>
                            <h2 class="title">Jelajahi Program Unggulan Kami</h2>
                            <p class="desc">Inilah saat yang tepat untuk melangkah maju! Program ProSkill Akademia siap
                                membantu Anda meningkatkan keterampilan dengan pelatihan terbaik yang sesuai dengan
                                kebutuhan Anda.</p>
                        </div>
                        <div class="courses__nav">
                            <ul class="nav nav-tabs" id="courseTab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                        data-bs-target="#all-tab-pane" type="button" role="tab"
                                        aria-controls="all-tab-pane" aria-selected="true">Semua Program</button>
                                </li>

                                @foreach ($courseTypes as $index => $type)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $index === 0 ? '' : '' }}"
                                            id="{{ strtolower($type) }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#{{ strtolower($type) }}-tab-pane" type="button"
                                            role="tab" aria-controls="{{ strtolower($type) }}-tab-pane"
                                            aria-selected="false">{{ $type }}</button>
                                    </li>
                                @endforeach
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
                            @foreach ($KelasTatapMuka->where('status', 1) as $kelas)
                                @include('partials.course-item', ['kelas' => $kelas])
                            @endforeach
                        </div>
                    </div>
                </div>

                @foreach ($courseTypes as $type)
                    <div class="tab-pane fade" id="{{ strtolower($type) }}-tab-pane" role="tabpanel"
                        aria-labelledby="{{ strtolower($type) }}-tab" tabindex="0">
                        <div class="swiper courses-swiper-active">
                            <div class="swiper-wrapper">
                                @foreach ($KelasTatapMuka->where('course_type', $type)->where('status', 1) as $kelas)
                                    @include('partials.course-item', [
                                        'kelas' => $kelas,
                                    ])
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="all-courses-btn mt-30">
                <div class="tg-button-wrap justify-content-center">
                    <a href="{{ route('search') }}" class="btn arrow-btn">Lihat Semua Kelas <img
                            src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="courses-area section-py-120" data-background="public/assets/img/bg/courses_bg.jpg" loading="lazy">
        <div class="container">
            <div class="section__title-wrap">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section__title text-center mb-40">
                            <span class="sub-title">Program ProSkill Akademia</span>
                            <h2 class="title">Jelajahi Program Unggulan Kami</h2>
                            <p class="desc">Inilah saat yang tepat untuk melangkah maju! Program ProSkill Akademia siap
                                membantu Anda meningkatkan keterampilan dengan pelatihan terbaik yang sesuai dengan
                                kebutuhan Anda.</p>
                        </div>
                        <div class="courses__nav">
                            <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                        data-bs-target="#all-tab-pane" type="button" role="tab"
                                        aria-controls="all-tab-pane" aria-selected="true">
                                        Semua Program
                                    </button>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bootcamp" data-bs-toggle="tab"
                                        data-bs-target="#bootcamp" type="button" role="tab"
                                        aria-controls="bootcamp" aria-selected="false">
                                        Bootcamp
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="offline" data-bs-toggle="tab"
                                        data-bs-target="#offline" type="button" role="tab" aria-controls="offline"
                                        aria-selected="false">
                                        Kelas Tatap Muka
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="online" data-bs-toggle="tab"
                                        data-bs-target="#online" type="button" role="tab" aria-controls="online"
                                        aria-selected="false">
                                        Kelas Online
                                    </button>
                                </li> --}}
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
                            @foreach ($KelasTatapMuka->where('status', 1) as $kelas)
                                @php
                                    $kurikulumExists = \App\Models\Kurikulum::where('course_id', $kelas->id)->exists();
                                    $averageRating = $kelas->reviews()->avg('rating');
                                @endphp

                                @if ($kurikulumExists)
                                    <div class="swiper-slide">
                                        <div
                                            class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
                                            <div class="courses__item-thumb courses__item-thumb-two">
                                                <a href="{{ route('classroomdetail', ['id' => $kelas->id]) }}"
                                                    class="shine__animate-link">
                                                    <img src="{{ asset('public/uploads/' . $kelas->gambar) }}"
                                                        alt="img" class="img-fluid" loading="lazy">
                                                </a>
                                            </div>
                                            <div
                                                class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <span
                                                            class="badge {{ $kelas->course_type == 'online' ? 'bg-primary' : 'bg-secondary' }}">
                                                            {{ $kelas->course_type == 'online' ? 'Online' : 'Kelas Tatap Muka' }}
                                                        </span>
                                                    </li>
                                                    <li class="price">
                                                        @if (!empty($kelas->discountedPrice) && $kelas->discount != 0)
                                                            <del>Rp {{ number_format($kelas->price, 0, ',', '.') }}</del>
                                                            Rp {{ number_format($kelas->discountedPrice, 0, ',', '.') }}
                                                        @else
                                                            Rp {{ number_format($kelas->price, 0, ',', '.') }}
                                                        @endif
                                                    </li>
                                                    @if (in_array($kelas->id, $joinedCourses))
                                                        <i class="fas fa-check-circle fa-lg" style="color: green;"></i>
                                                    @endif
                                                </ul>
                                                <h5 class="title course-title flex-grow-1">
                                                    <a
                                                        href="{{ route('classroomdetail', ['id' => $kelas->id]) }}">{{ $kelas->nama_kursus }}</a>
                                                </h5>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="{{ route('classroomdetail', ['id' => $kelas->id]) }}">
                                                            <span class="text">Detail Kelas</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="avg-rating">
                                                        <i class="fas fa-star"></i>
                                                        ({{ $averageRating ? number_format($averageRating, 1) : '0.0' }}
                                                        Reviews)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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

    <!-- about-area -->
    <section class="about-area tg-motion-effects section-py-120">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="col-lg-5" style="position: relative;">
                    <div class="banner__images"
                        style="position: relative; display: flex; justify-content: center; align-items: center;">
                        <!-- Background Image -->
                        <img src="public/assets/img/banner/banner1.png" alt="img" class="main-img"
                            data-aos="fade-right" data-aos-delay="800">

                        <!-- Decorative Background Dots -->
                        <img src="public/assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme"
                            data-aos="fade-right" data-aos-delay="600">
                        <!-- Background Gradient -->
                        <div
                            style="  position: absolute; top: 0;  left: -80px; right: 0; bottom: 0; width: 100%; height: 100%;
                                     background: linear-gradient(to bottom, transparent, white); z-index: 1; pointer-events: none;">
                        </div>
                        <!-- Wrapper untuk konten tengah (ikon & teks) -->
                        <div
                            style="position: absolute; display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 102;">
                            <!-- Teks di atas tautan video -->
                            <span style="font-size: 18px; color: #000; font-weight: bold; margin-bottom: 8px;"
                                data-aos="fade-right" data-aos-delay="800">Lihat</span>

                            <!-- Tautan untuk membuka video di modal popup -->
                            <a href="https://www.youtube.com/watch?v=1umLD1G-Ljo" class="popup-video"
                                data-aos="fade-right" data-aos-delay="800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                    viewBox="0 0 22 28" fill="none">
                                    <path
                                        d="M0.19043 26.3132V1.69421C0.190288 1.40603 0.245303 1.12259 0.350273 0.870694C0.455242 0.6188 0.606687 0.406797 0.79027 0.254768C0.973854 0.10274 1.1835 0.0157243 1.39936 0.00193865C1.61521 -0.011847 1.83014 0.0480663 2.02378 0.176003L20.4856 12.3292C20.6973 12.4694 20.8754 12.6856 20.9999 12.9535C21.1245 13.2214 21.1904 13.5304 21.1904 13.8456C21.1904 14.1608 21.1245 14.4697 20.9999 14.7376C20.8754 15.0055 20.6973 15.2217 20.4856 15.3619L2.02378 27.824C1.83056 27.9517 1.61615 28.0116 1.40076 27.9981C1.18536 27.9847 0.97607 27.8983 0.792638 27.7472C0.609205 27.596 0.457661 27.385 0.352299 27.1342C0.246938 26.8833 0.191236 26.6008 0.19043 26.3132Z"
                                        fill="red" />
                                </svg>
                            </a>

                            <!-- Teks di bawah tautan video -->
                            <span style="font-size: 18px; color: #000; font-weight: bold; margin-top: 8px;"
                                data-aos="fade-right" data-aos-delay="800">Sesi Bootcamp
                                Sebelumnya</span>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="600">
                    <div class="about__content">
                        <div class="section__title">
                            <span class="sub-title">Acara Mendatang</span>
                            <h2 class="title">
                                Bootcamp
                                <span class="position-relative">
                                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                            fill="currentcolor" />
                                    </svg>
                                    Power BI
                                </span><br>
                                untuk data analyst pemula
                            </h2>
                        </div>
                        <p class="desc">
                            📊 Siap Mengembangkan Skill Sebagai <b>Data Analyst? </b> Gabung Sekarang di <b>Bootcamp Power
                                BI </b>Untuk Pemula! Kuasai keterampilan <b>Analisis Data </b>Dari nol dengan Panduan
                            Langsung dari <b>Mentor Berpengalaman.</b> Jangan Lewatkan Kesempatan ini Untuk <b>Mengasah
                                Kemampuanmu!</b>
                            <br>
                            <br>
                            📝 Pelajari Program <b>Bootcamp Power Bi</b> dari <b>Proskill Akademia!.</b>

                        </p>
                        <div class="d-flex justify-content-between align-items-center flex-wrap" data-aos="fade-top"
                            data-aos-delay="600">
                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                <div>
                                    <p class="mb-0" style="font-size: 0.6rem;"><b>5X</b> <b><img
                                                src="public/assets/img/icons/zoom.svg" alt="zoom"
                                                style="width: 30px; height: 26px; vertical-align: middle; margin-right: 3px;"></b>
                                        Online</p>
                                    <p class="mb-0" style="font-size: 0.6rem;"><b>Setiap Sabtu</b></p>
                                </div>
                            </div>

                            <div class="d-none d-md-block border-left"
                                style="border-left: 2px solid #007368; height: 35px; margin: 0 8px;"></div>

                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                <img src="public/assets/img/icons/Video.svg" alt="Clock Icon"
                                    style="width: 20px; height: 20px; vertical-align: middle; margin-right: 8px;">
                                <div>
                                    <p class="mb-0" style="font-size: 0.6rem;">50+ Video</p>
                                    <p class="mb-0 font-weight-bold" style="font-size: 0.6rem;"><b>on demand</b></p>
                                </div>
                            </div>

                            <div class="d-none d-md-block border-left"
                                style="border-left: 2px solid #007368; height: 35px; margin: 0 8px;"></div>

                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                <img src="public/assets/img/icons/calender.svg" alt="Format Icon"
                                    style="width: 20px; height: 20px; vertical-align: middle; margin-right: 8px;">
                                <div>
                                    <p class="mb-0" style="font-size: 0.6rem;">Start:</p>
                                    <p class="mb-0 font-weight-bold" style="font-size: 0.6rem;"><b>30 Nov</b></p>
                                </div>
                            </div>

                            <div class="d-none d-md-block border-left"
                                style="border-left: 2px solid #007368; height: 35px; margin: 0 8px;"></div>

                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                <div>
                                    <p class="mb-0" style="font-size: 0.6rem;">In demand</p>
                                    <p class="mb-0 font-weight-bold" style="font-size: 0.6rem;"><b>Tools & Skills</b></p>
                                </div>
                                <img src="public/assets/img/icons/power-bi.png" alt="Tools Icon"
                                    style="width: 20px; height: 24px; vertical-align: middle; margin-left: 8px;">
                            </div>
                        </div>
                        <div class="tg-button-wrap">
                            <a href="{{ route('pbi') }}" class="btn arrow-btn">Detail Bootcamp<img
                                    src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->

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
                                    <h2 class="title">Lonando Decaprio</h2>
                                    <span>Mahasiswa</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ Harga Terjangkau, Tempatnya Bersih dan Nyaman yang Pastinya, Mr nya Juga Sabar,
                                    Instruktur Menyampaikan Materi Mudah
                                    Dimengerti ”</p>
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
                                    <h2 class="title">Fransisca Angelina</h2>
                                    <span>Mahasiswa</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ kesan saya selama saya mengikuti kursus ini sangat lah baik dari segi lingkungan dan
                                    staff, dan juga fasilitas yang sangat memadai. terimakasih juga kepada Mr. beni ya....
                                    beliau sangat bersabar dalam mengajar siswa-siswi nya. ”</p>
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
                    <div class="swiper-slide">
                        <div class="testimonial__item-two testimonial__item-five">
                            <div class="testimonial__author testimonial__author-two">
                                <div class="testimonial__author-thumb testimonial__author-thumb-two">
                                    <img src="public/assets/img/others/user6.png" alt="img">
                                </div>
                                <div class="testimonial__author-content testimonial__author-content-two">
                                    <h2 class="title">Nabila Putri Aulia</h2>
                                    <span>Freelance</span>
                                </div>
                            </div> <br>
                            <div class="testimonial__content-two">

                                <p>“ saya ingin menambah pengetahuan Microsoft Office agar saya lebih mudah mengerjakan
                                    pekerjaan di dunia pekerjaan yang sudah serba digital. ”
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

    <!-- instructor-area-two -->
    <section class="instructor__area-four">
        <div class="container">
            <div class="instructor__item-wrap-two">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="instructor__item-two tg-svg">
                            <div class="instructor__thumb-two">
                                <img src="public/assets/img/instructor/instructor_two01.png" alt="img">
                                <div class="shape-one">
                                    <img src="public/assets/img/instructor/instructor_shape01.svg" alt="img"
                                        class="injectable">
                                </div>
                                <div class="shape-two">
                                    <span class="svg-icon" id="instructor-svg"
                                        data-svg-icon="public/assets/img/instructor/instructor_shape02.svg"></span>
                                </div>
                            </div>
                            <div class="instructor__content-two">
                                <h3 class="title"><a href="contact.html">Become a Instructor</a></h3>
                                <p>To take a trivial example, which of us undertakes physical exercise yes is this happen
                                    here.</p>
                                <div class="tg-button-wrap">
                                    <a href="#"data-bs-toggle="modal" data-bs-target="#ModalDaftar"
                                        class="btn arrow-btn">Apply Now <img src="public/assets/img/icons/right_arrow.svg"
                                            alt="img" class="injectable"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- instructor-area-two-end -->
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
        var swiper = new Swiper('.courses-swiper-active', {
            slidesPerView: 1.5, // Default
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                // Atur untuk ukuran layar lebih kecil
                768: {
                    slidesPerView: 1.5, // Misal untuk tablet
                },
                1200: {
                    slidesPerView: 2, // Misal untuk ukuran di bawah 1200px
                },
                1600: {
                    slidesPerView: 2.5, // Misal untuk ukuran layar besar
                }
            }
        });
    </script>

    @include('home.modal.registerinstruktur')
@endsection
