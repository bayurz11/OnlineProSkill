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
                                alt="img" width="120" height="120" style="object-fit: cover;">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ $user->name }}</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    {{ $orders->count() }} Kelas
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

                                        {{-- <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="business-tab" data-bs-toggle="tab"
                                                data-bs-target="#business-tab-pane" type="button" role="tab"
                                                aria-controls="business-tab-pane" aria-selected="false">
                                                Kursus Selesai
                                            </button>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel"
                                        aria-labelledby="all-tab" tabindex="0">

                                        @if ($orders->isEmpty())
                                            <div class="col mb-4">
                                                <div class="alert alert-warning" role="alert">
                                                    Anda Belum Mengikuti kelas
                                                </div>
                                                <div class="row">
                                                    @foreach ($KelasTatapMuka->where('status', 1)->take(3) as $kelas)
                                                        <div class="col mb-4">
                                                            <div
                                                                class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
                                                                <div class="courses__item-thumb courses__item-thumb-two">
                                                                    <a href="{{ route('classroomdetail', ['id' => $kelas->id]) }}"
                                                                        class="shine__animate-link">
                                                                        <img src="{{ asset('public/uploads/' . $kelas->gambar) }}"
                                                                            alt="img" class="img-fluid"
                                                                            style="width: 100%; height: auto; object-fit: cover;">
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1">
                                                                    <ul class="courses__item-meta list-wrap">
                                                                        <li class="courses__item-tag">
                                                                            @if ($kelas->course_type == 'online')
                                                                                <span class="badge bg-primary">Online</span>
                                                                            @else
                                                                                <span class="badge bg-secondary">Kelas Tatap
                                                                                    Muka</span>
                                                                            @endif
                                                                        </li>
                                                                        <li class="price">Rp
                                                                            {{ number_format($kelas->price, 0, '.', '.') }}
                                                                        </li>
                                                                    </ul>
                                                                    <h5 class="title course-title flex-grow-1">
                                                                        <a
                                                                            href="{{ route('classroomdetail', ['id' => $kelas->id]) }}">{{ $kelas->nama_kursus }}</a>
                                                                    </h5>
                                                                    <div class="courses__item-bottom">
                                                                        <div class="button">
                                                                            <a
                                                                                href="{{ route('classroomdetail', ['id' => $kelas->id]) }}">
                                                                                <span class="text">Detail Kelas</span>
                                                                                <i class="flaticon-arrow-right"></i>
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="all-courses-btn mt-30">
                                                    <div class="tg-button-wrap justify-content-center">
                                                        <a href="{{ route('search') }}" class="btn arrow-btn">Lihat Semua
                                                            Kelas <img src="public/assets/img/icons/right_arrow.svg"
                                                                alt="img" class="injectable"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div
                                                class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                                @foreach ($orders as $order)
                                                    <div class="col mb-4">


                                                        <div
                                                            class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
                                                            <!-- Thumbnail Gambar -->
                                                            <div class="courses__item-thumb courses__item-thumb-two">
                                                                <a href="{{ route('lesson', ['id' => $order->product_id]) }}"
                                                                    class="shine__animate-link">
                                                                    <img src="{{ $order->KelasTatapMuka->gambar ? asset('public/uploads/' . $order->KelasTatapMuka->gambar) : asset('public/assets/img/courses/course_thumb01.jpg') }}"
                                                                        alt="img" class="img-fluid w-100"
                                                                        style="height: 200px; object-fit: cover;">
                                                                </a>
                                                            </div>
                                                            <!-- Konten Kartu -->
                                                            <div
                                                                class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1">
                                                                <h5 class="title flex-grow-1">
                                                                    <a
                                                                        href="{{ route('lesson', ['id' => $order->product_id]) }}">{{ $order->KelasTatapMuka->nama_kursus ?? 'Nama kelas tidak tersedia' }}</a>
                                                                </h5>
                                                                <div>
                                                                    <span
                                                                        class="badge {{ $order->KelasTatapMuka->course_type == 'online' ? 'bg-primary' : 'bg-secondary' }} ms-auto">
                                                                        {{ ucfirst($order->KelasTatapMuka->course_type) }}
                                                                    </span>
                                                                </div>
                                                                <div class="courses__item-content-bottom mt-auto">

                                                                    <div class="author-two d-flex align-items-center">
                                                                        <a href="#">
                                                                            <img src="{{ asset('public/assets/img/courses/course_author001.png') }}"
                                                                                alt="img" class="rounded-circle"
                                                                                style="width: 30px; height: 30px;">
                                                                            {{ $order->KelasTatapMuka->user->name }}
                                                                        </a>
                                                                        <img src="{{ $order->$KelasTatapMuka->user->userprofile && $order->$KelasTatapMuka->user->userprofile->gambar ? (strpos($order->$KelasTatapMuka->user->userprofile->gambar, 'googleusercontent') !== false ? $order->$KelasTatapMuka->user->userprofile->gambar : asset('public/uploads/' . $order->$KelasTatapMuka->user->userprofile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                                            alt="Profile Image" class="rounded-circle"
                                                                            style="border-radius: 50%; width: 30px; height: 30px; object-fit: cover;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="business-tab-pane" role="tabpanel"
                                    aria-labelledby="business-tab" tabindex="0">
                                    <div
                                        class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                        @foreach ($orders as $order)
                                            @if ($order->completion == 100)
                                                <div class="col">
                                                    <div
                                                        class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
                                                        <div class="courses__item-thumb courses__item-thumb-two">
                                                            <a href="{{ route('lesson', ['id' => $order->product_id]) }}"
                                                                class="shine__animate-link">
                                                                <img src="{{ $order->KelasTatapMuka->gambar ? asset('public/uploads/' . $order->KelasTatapMuka->gambar) : asset('public/assets/img/courses/course_thumb01.jpg') }}"
                                                                    alt="img" class="img-fluid"
                                                                    style="width: 100%; height: auto; object-fit: cover;">
                                                            </a>
                                                        </div>
                                                        <div class="courses__item-content courses__item-content-two">
                                                            <h5 class="title">
                                                                <a
                                                                    href="{{ route('lesson', ['id' => $order->product_id]) }}">{{ $order->KelasTatapMuka->nama_kursus ?? 'Nama kelas tidak tersedia' }}</a>
                                                            </h5>
                                                            <div class="progress-item progress-item-two">
                                                                <h6 class="title">Selesai <span>100%</span></h6>
                                                                <div class="progress" role="progressbar"
                                                                    aria-label="Example with label" aria-valuenow="100"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar" style="width: 100%">
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
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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
