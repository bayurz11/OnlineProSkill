@section('title', 'ProSkill Akademia | DetailKelas Tatap Muka')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-two"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('classroom') }}">Kelas Tatap Muka</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">{{ $courses->nama_kursus }}</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- courses-details-area -->
    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="courses__details-thumb">
                        <img src="{{ asset('public/uploads/' . $courses->gambar) }}" alt="img">
                    </div>
                    <div class="courses__details-content">

                        <h2 class="title">{{ $courses->nama_kursus }}</h2>
                        <div class="courses__details-meta">
                            <ul class="list-wrap">
                                <li class="author-two">
                                    <img src="{{ asset('public/assets/img/courses/course_author001.png') }}"
                                        alt="img">
                                    <a href="#">{{ $courses->user->name }}</a>
                                </li>

                                <li><i class="flaticon-mortarboard"></i>2,250 Students</li>
                            </ul>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview-tab-pane" type="button" role="tab"
                                    aria-controls="overview-tab-pane" aria-selected="true">Ringkasan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab"
                                    data-bs-target="#curriculum-tab-pane" type="button" role="tab"
                                    aria-controls="curriculum-tab-pane" aria-selected="false">Kurikulum</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                aria-labelledby="overview-tab" tabindex="0">
                                <div class="courses__overview-wrap">
                                    <h3 class="title">Deskripsi Kelas</h3>
                                    <p> {!! $courses->content !!}</p>
                                    <h3 class="title">Pelajaran yang Didapat</h3>

                                    <ul class="about__info-list list-wrap">
                                        @foreach ($courseList as $course)
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">{{ $course }}</p>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="curriculum-tab-pane" role="tabpanel"
                                aria-labelledby="curriculum-tab" tabindex="0">
                                <div class="courses__curriculum-wrap">
                                    <h3 class="title">Kurikulum Kelas</h3>
                                    <p>Apa saja yang akan dipelajari di kelas ini</p>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Introduction
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-wrap">
                                                        <li class="course-item open-item">
                                                            <a href="https://www.youtube.com/watch?v=b2Az7_lLh3g"
                                                                class="course-item-link popup-video">
                                                                <span class="item-name">Course Installation</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">03:03</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Create a Simple React App</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">React for the Rest of us</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">10:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Capacitance and Inductance
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-wrap">
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Course Installation</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Create a Simple React App</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">React for the Rest of us</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">10:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Final Audit
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-wrap">
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Course Installation</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Create a Simple React App</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">React for the Rest of us</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">10:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
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
                <div class="col-xl-3 col-lg-4">
                    <div class="courses__details-sidebar">

                        <div class="courses__cost-wrap">
                            <span>Kursus Fee:</span>
                            <h2 class="title">Rp. {{ number_format($courses->price, 0, ',', '.') }}</h2>
                        </div>
                        <div class="courses__information-wrap">
                            <h5 class="title">Keterangan:</h5>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon01.svg') }}" alt="img"
                                        class="injectable">
                                    Tingkat
                                    <span>{{ $courses->tingkat }}</span>
                                </li>
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon02.svg') }}" alt="img"
                                        class="injectable">
                                    Durasi
                                    <span>{{ $courses->durasi }}</span>
                                </li>
                                {{-- <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    Pelajaran
                                    <span>12</span>
                                </li> --}}

                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon05.svg') }}" alt="img"
                                        class="injectable">
                                    Sertifikat
                                    <span>{{ $courses->sertifikat }}</span>
                                </li>
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon06.svg') }}" alt="img"
                                        class="injectable">
                                    Kelulusan
                                    <span>25K</span>
                                </li>
                            </ul>
                        </div>
                        <div class="courses__payment">
                            <h5 class="title">Pembayaran</h5>
                            <img src="{{ asset('public/assets/img/others/payment.png') }}" alt="img">
                        </div>
                        <div class="courses__details-social">
                            <h5 class="title">Share this course:</h5>
                            <ul class="list-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                        <div class="courses__details-enroll">
                            <div class="tg-button-wrap">
                                <a href="{{ route('checkout', ['id' => $courses->id]) }}" class="btn btn-two arrow-btn">
                                    Gabung Kelas
                                    <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                        class="injectable">
                                </a>
                            </div>
                            <br>
                            <div class="tg-button-wrap">
                                <a href="{{ route('cart.add', ['id' => $courses->id]) }}" class="btn btn-two arrow-btn">
                                    Masukkan keranjang
                                    <img src="{{ asset('public/assets/img/icons/cart.svg') }}" class="injectable"
                                        alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- courses-details-area-end -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var paragraphs = document.querySelectorAll('.content p');
            paragraphs.forEach(function(p) {
                var parent = p.parentNode;
                while (p.firstChild) {
                    parent.insertBefore(p.firstChild, p);
                }
                parent.removeChild(p);
            });
        });
    </script>
@endsection
