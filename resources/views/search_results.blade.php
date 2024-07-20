@section('title', 'ProSkill Akademia | Hasil Pencarian')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')


    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Hasil Pencarian</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Hasil Pencarian</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
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
    </section>
    <!-- breadcrumb-area-end -->

    @if ($results->isEmpty())
        <p>Tidak ada hasil yang ditemukan.</p>
    @else
        <section class="all-courses-area section-py-120">
            <div class="container">
                <div class="row">
                    @foreach ($results as $cours)
                        <div class="col">
                            <div class="courses__item shine__animate-item">
                                <div class="courses__item-thumb">
                                    <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}"
                                        class="shine__animate-link">
                                        <img src="{{ asset('public/uploads/' . $cours->gambar) }}" alt="Banner"
                                            class="wd-100 wd-sm-150 me-3">
                                    </a>
                                </div>
                                <div class="courses__item-content">
                                    <h5 class="title">
                                        <a
                                            href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
                                    </h5>
                                    <p class="author">By <a href="#">{{ $cours->user->name }}</a>&nbsp;&nbsp;
                                        <img src="{{ asset('public/assets/img/icons/course_icon06.svg') }}" alt="img"
                                            class="injectable">
                                        Kuota Kelas <span>{{ $cours->jumlah_pendaftaran }}/{{ $cours->kuota }}</span>

                                        @if (in_array($cours->id, $joinedCourses))
                                            <span
                                                style="color: green; font-weight: bold; padding: 2px 6px; border: 1px solid green; border-radius: 10rem; background-color: #e0f7e9;">
                                                Joined
                                            </span>
                                        @endif
                                    </p>
                                    <div class="courses__item-bottom">
                                        <div class="button">
                                            <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}">
                                                <span class="text">Detail</span>
                                                <i class="flaticon-arrow-right"></i>
                                            </a>
                                        </div>
                                        <h5 class="price">Rp {{ number_format($cours->price, 0, ',', ',') }}</h5>
                                        @if ($cours->course_type == 'online')
                                            <span class="badge bg-primary">Online</span>
                                        @else
                                            <span class="badge bg-secondary">Offline</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
