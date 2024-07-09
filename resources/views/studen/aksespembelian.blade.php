@section('title', 'ProSkill Akademia | Akses Pembelian')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape01.svg') }}" alt="img" class="alltuchtopdown">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape02.svg') }}" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape03.svg') }}" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape04.svg') }}" alt="img"
                data-aos="fade-down-left" data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape05.svg') }}" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            <div class="dashboard__top-wrap">
                <div class="dashboard__top-bg" data-background="{{ asset('public/assets/img/bg/student_bg.jpg') }}"></div>
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                alt="img" width="120" height="120">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ $user->name }}</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    5 Courses Enrolled
                                </li>
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon05.svg') }}" alt="img"
                                        class="injectable">
                                    4 Certificate
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @include('studen.nav.nav')

                <div class="col-lg-9">
                    <div class="dashboard__content-wrap dashboard__content-wrap-two">
                        <div class="dashboard__content-title">
                            <h4 class="title">Kursus Terdaftar</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="dashboard__nav-wrap">
                                    <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                                data-bs-target="#all-tab-pane" type="button" role="tab"
                                                aria-controls="all-tab-pane" aria-selected="true">
                                                Kursus Terdaftar
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="business-tab" data-bs-toggle="tab"
                                                data-bs-target="#business-tab-pane" type="button" role="tab"
                                                aria-controls="business-tab-pane" aria-selected="false">
                                                Kursus Selesai
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel"
                                        aria-labelledby="all-tab" tabindex="0">

                                        <div class="swiper dashboard-courses-active">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="courses__item courses__item-two shine__animate-item">
                                                        @foreach ($orders as $order)
                                                            <div class="courses__item-thumb courses__item-thumb-two">
                                                                <a href="{{ route('lesson', ['id' => $order->id]) }}"
                                                                    class="shine__animate-link">
                                                                    <img src="{{ $order->KelasTatapMuka->gambar ? asset('public/uploads/' . $order->KelasTatapMuka->gambar) : asset('public/assets/img/courses/course_thumb01.jpg') }}"
                                                                        alt="img" class="wd-100 wd-sm-150">
                                                                </a>
                                                            </div>
                                                            <div class="courses__item-content courses__item-content-two">
                                                                <h5 class="title">
                                                                    <a
                                                                        href="{{ route('lesson', ['id' => $order->id]) }}">{{ $order->KelasTatapMuka->nama_kursus ?? 'Nama kelas tidak tersedia' }}</a>
                                                                </h5>
                                                                <div class="courses__item-content-bottom">
                                                                    <div class="author-two">
                                                                        <a href="instructor-details.html">
                                                                            <img src="{{ asset('public/assets/img/courses/course_author001.png') }}"
                                                                                alt="img">
                                                                            {{ $order->KelasTatapMuka->user->name }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="progress-item progress-item-two">
                                                                    <h6 class="title">Selesai <span>12.5%</span></h6>
                                                                    <div class="progress" role="progressbar"
                                                                        aria-label="Example with label" aria-valuenow="25"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar" style="width: 12.5%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="courses__item-bottom-two">
                                                                <ul class="list-wrap">
                                                                    <li><i class="flaticon-book"></i>05</li>
                                                                    <li><i class="flaticon-clock"></i>11h 20m</li>
                                                                    <li><i class="flaticon-mortarboard"></i>22</li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane fade" id="business-tab-pane" role="tabpanel"
                                        aria-labelledby="business-tab" tabindex="0">
                                        <div class="swiper dashboard-courses-active">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="courses__item courses__item-two shine__animate-item">
                                                        <div class="courses__item-thumb courses__item-thumb-two">
                                                            <a href="course-details.html" class="shine__animate-link">
                                                                <img src="{{ asset('public/assets/img/courses/course_thumb01.jpg') }}"
                                                                    alt="img">
                                                            </a>
                                                        </div>
                                                        <div class="courses__item-content courses__item-content-two">
                                                            <ul class="courses__item-meta list-wrap">
                                                                <li class="courses__item-tag">
                                                                    <a href="course.html">Development</a>
                                                                </li>
                                                            </ul>
                                                            <h5 class="title"><a href="course-details.html">Learning
                                                                    JavaScript With Imagination</a></h5>
                                                            <div class="courses__item-content-bottom">
                                                                <div class="author-two">
                                                                    <a href="instructor-details.html"><img
                                                                            src="{{ asset('public/assets/img/courses/course_author001.png') }}"
                                                                            alt="img">David Millar</a>
                                                                </div>
                                                                <div class="avg-rating">
                                                                    <i class="fas fa-star"></i> (4.8 Reviews)
                                                                </div>
                                                            </div>
                                                            <div class="progress-item progress-item-two">
                                                                <h6 class="title">COMPLETE <span>100%</span></h6>
                                                                <div class="progress" role="progressbar"
                                                                    aria-label="Example with label" aria-valuenow="25"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar" style="width: 100%"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="courses__item-bottom-two">
                                                            <ul class="list-wrap">
                                                                <li><i class="flaticon-book"></i>05</li>
                                                                <li><i class="flaticon-clock"></i>11h 20m</li>
                                                                <li><i class="flaticon-mortarboard"></i>22</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
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
    <!-- dashboard-area-end -->

    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('profileImage');
                    img.src = e.target.result;
                    img.onload = function() {
                        img.style.width = '120px';
                        img.style.height = '120px';
                        img.style.objectFit = 'cover';
                    };
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
