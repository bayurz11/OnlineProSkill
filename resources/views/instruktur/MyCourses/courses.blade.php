@section('title', 'ProSkill Akademia | My Courses')
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
            @include('instruktur.nav.profile')

            <div class="row">
                @include('instruktur.nav.navbar')
                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">My Courses</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="dashboard__nav-wrap">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="itemOne-tab" data-bs-toggle="tab"
                                                data-bs-target="#itemOne-tab-pane" type="button" role="tab"
                                                aria-controls="itemOne-tab-pane" aria-selected="true">Publish</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="itemThree-tab" data-bs-toggle="tab"
                                                data-bs-target="#itemThree-tab-pane" type="button" role="tab"
                                                aria-controls="itemThree-tab-pane" aria-selected="false">Draft</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="itemOne-tab-pane" role="tabpanel"
                                        aria-labelledby="itemOne-tab" tabindex="0">
                                        <div class="row">
                                            <div class="alert alert-warning" role="alert">
                                                Anda Belum Menambahkan kelas Apapun
                                            </div>
                                            @foreach ($KelasTatapMuka->where('status', 1)->take(3) as $kelas)
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="courses__item courses__item-two shine__animate-item">
                                                        <div class="courses__item-thumb courses__item-thumb-two">
                                                            <a href="course-details.html" class="shine__animate-link">
                                                                <img src="public/assets/img/courses/course_thumb02.jpg"
                                                                    alt="img">
                                                            </a>
                                                        </div>
                                                        <div class="courses__item-content courses__item-content-two">
                                                            <ul class="courses__item-meta list-wrap">
                                                                <li class="courses__item-tag">
                                                                    <a href="course.html">Design</a>
                                                                </li>
                                                                <li class="price"><del>$20.00</del>$10.00</li>
                                                            </ul>
                                                            <h5 class="title"><a href="course-details.html">The Complete
                                                                    Graphic Design for Beginners</a></h5>
                                                            <div class="courses__item-content-bottom">
                                                                <div class="author-two">
                                                                    <a href="instructor-details.html"><img
                                                                            src="assets/img/courses/course_author002.png"
                                                                            alt="img">Wilson</a>
                                                                </div>
                                                                <div class="avg-rating">
                                                                    <i class="fas fa-star"></i> (4.5 Reviews)
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="courses__item-bottom-two">
                                                            <ul class="list-wrap">
                                                                <li><i class="flaticon-book"></i>60</li>
                                                                <li><i class="flaticon-clock"></i>70h 45m</li>
                                                                <li><i class="flaticon-mortarboard"></i>202</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="itemThree-tab-pane" role="tabpanel"
                                        aria-labelledby="itemThree-tab" tabindex="0">
                                        <div class="row">
                                            @if ($KelasTatapMuka->isEmpty())
                                                <div class="alert alert-warning" role="alert">
                                                    Anda Belum Menambahkan kelas Apapun
                                                </div>
                                            @else
                                                @foreach ($KelasTatapMuka->where('status', 1)->take(3) as $kelas)
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="courses__item courses__item-two shine__animate-item">
                                                            <div class="courses__item-thumb courses__item-thumb-two">
                                                                <a href="{{ route('instruktur.kurikulum', ['id' => $kelas->id]) }}"
                                                                    data-id="{{ $kelas->id }}"
                                                                    class="shine__animate-link">

                                                                    <img src="{{ asset('public/uploads/' . $kelas->gambar) }}"
                                                                        alt="img" class="img-fluid"
                                                                        style="width: 100%; height: auto; object-fit: cover;">
                                                                </a>
                                                            </div>
                                                            <div class="courses__item-content courses__item-content-two">
                                                                <ul class="courses__item-meta list-wrap">
                                                                    <li class="courses__item-tag">
                                                                        <a href="course.html">{{ $kelas->tag }}</a>
                                                                    </li>
                                                                    <li class="price">
                                                                        @if (!empty($kelas->discountedPrice))
                                                                            <del>Rp
                                                                                {{ number_format($kelas->price, 0, ',', '.') }}</del>
                                                                            Rp
                                                                            {{ number_format($kelas->discountedPrice, 0, ',', '.') }}
                                                                        @else
                                                                            Rp
                                                                            {{ number_format($kelas->price, 0, ',', '.') }}
                                                                        @endif
                                                                    </li>

                                                                </ul>
                                                                <h5 class="title"><a
                                                                        href="{{ route('instruktur.kurikulum', ['id' => $kelas->id]) }}">{{ $kelas->nama_kursus }}</a>
                                                                </h5>
                                                                <div class="courses__item-content-bottom">
                                                                    <div class="author-two">
                                                                        <a href="#"><img
                                                                                src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"style="object-fit: cover;"
                                                                                alt="img">{{ $kelas->user->name }}</a>
                                                                    </div>
                                                                    <div class="avg-rating">
                                                                        <i class="fas fa-star"></i> (4.5 Reviews)
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="courses__item-bottom-two">
                                                                <ul class="list-wrap">
                                                                    <li><i
                                                                            class="flaticon-book"></i>{{ $kelas->lesson_count }}
                                                                    </li>
                                                                    <li><i class="flaticon-clock"></i>{{ $kelas->durasi }}
                                                                    </li>
                                                                    <li><i
                                                                            class="flaticon-mortarboard"></i>{{ $jumlahPendaftaran->get($kelas->id, 0) }}
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
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

@endsection
