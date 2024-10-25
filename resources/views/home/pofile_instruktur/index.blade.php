@section('title', 'ProSkill Akademia | Profile Instruktur')
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

                            <span property="itemListElement" typeof="ListItem">Profile Instruktur</span>
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

    <!-- dashboard-area -->
    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
                    <div class="dashboard__sidebar-wrap"
                        style="background-color: #f9fafb; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); display: flex; align-items: center;">
                        <div style="margin-right: 15px;">
                            <img src="{{ $instructorProfile && $instructorProfile->gambar ? (strpos($instructorProfile->gambar, 'googleusercontent') !== false ? $instructorProfile->gambar : asset('public/uploads/' . $instructorProfile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                alt="Profile Image" style="border-radius: 50%; width: 60px; height: 60px;">
                        </div>
                        <div>
                            <ul class="list-wrap" style="list-style-type: none; padding: 0; margin: 0;">
                                <li>
                                    <span
                                        style="font-size: 18px; color: #333; font-weight: bold;">{{ $instructorProfile->user->name }}</span>
                                </li>
                                <li>
                                    <span style="font-size: 14px; color: #666;">Mentor sejak
                                        {{ \Carbon\Carbon::parse($instructorProfile->created_at)->format('d M Y') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content" id="myTabContent">
                        {{-- <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">Kelas Yang dibuat</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tab-pane fade show active" id="grid" role="tabpanel"
                                    aria-labelledby="grid-tab">
                                    <div class="courses__grid-wrap row row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1"
                                        style="gap: 15px;">
                                        @if ($kelas->isNotEmpty())
                                            @foreach ($kelas as $item)
                                                @if ($item->status == 1)
                                                    <div class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100"
                                                        style="margin-bottom: 20px;">
                                                        <div class="courses__item-thumb courses__item-thumb-two"
                                                            style="margin-bottom: 15px;">
                                                            <a href="{{ route('classroomdetail', ['id' => $item['id']]) }}"
                                                                class="shine__animate-link">
                                                                <img src="{{ asset('public/uploads/' . $item['gambar']) }}"
                                                                    alt="img" class="img-fluid" loading="lazy"
                                                                    style="max-width: 100%; height: auto;">
                                                            </a>
                                                        </div>
                                                        <div class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1"
                                                            style="gap: 10px;">
                                                            <ul class="courses__item-meta list-wrap"
                                                                style="margin-bottom: 10px;">
                                                                <li class="courses__item-tag">
                                                                    @if ($item['course_type'] == 'online')
                                                                        <span class="badge bg-primary">Online</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">Cours Tatap
                                                                            Muka</span>
                                                                    @endif
                                                                </li>

                                                                <li class="price">
                                                                    @if (!empty($item['discountedPrice']))
                                                                        <del>Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}</del>
                                                                        Rp
                                                                        {{ number_format($item['discountedPrice'], 0, ',', '.') }}
                                                                    @else
                                                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                            <h5 class="title course-title flex-grow-1">
                                                                <a
                                                                    href="{{ route('classroomdetail', ['id' => $item['id']]) }}">{{ $item['nama_kursus'] }}</a>
                                                            </h5>
                                                            <div class="courses__item-bottom" style="margin-top: auto;">
                                                                <div class="button">
                                                                    <a
                                                                        href="{{ route('classroomdetail', ['id' => $item['id']]) }}">
                                                                        <span class="text">Detail cours</span>
                                                                        <i class="flaticon-arrow-right"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p>Tidak ada kelas yang ditemukan untuk instruktur ini.</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                        <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                            <div
                                class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                @if ($kelas->isNotEmpty())
                                    @foreach ($kelas as $item)
                                        @if ($item->status == 1)
                                            <div class="col mb-4">
                                                <div
                                                    class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
                                                    <div class="courses__item-thumb courses__item-thumb-two">
                                                        <a href="{{ route('classroomdetail', ['id' => $item['id']]) }}"
                                                            class="shine__animate-link">
                                                            <img src="{{ asset('public/uploads/' . $item['gambar']) }}"
                                                                alt="img" class="img-fluid" loading="lazy">
                                                        </a>
                                                    </div>
                                                    <div
                                                        class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1">
                                                        <ul class="courses__item-meta list-wrap">
                                                            <li class="courses__item-tag">
                                                                @if ($item['course_type'] == 'online')
                                                                    <span class="badge bg-primary">Online</span>
                                                                @else
                                                                    <span class="badge bg-secondary">cours Tatap
                                                                        Muka</span>
                                                                @endif
                                                            </li>

                                                            <li class="price">
                                                                @if (!empty($item['discountedPrice']))
                                                                    <del>Rp
                                                                        {{ number_format($item['price'], 0, ',', '.') }}</del>
                                                                    Rp
                                                                    {{ number_format($item['discountedPrice'], 0, ',', '.') }}
                                                                @else
                                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                                @endif
                                                            </li>
                                                            @if (in_array($item->id, $joinedCourses))
                                                                <span class="badge bg-success">Joined</span>
                                                            @endif
                                                        </ul>
                                                        <h5 class="title course-title flex-grow-1">
                                                            <a
                                                                href="{{ route('classroomdetail', ['id' => $item['id']]) }}">{{ $item['nama_kursus'] }}</a>
                                                        </h5>
                                                        <div class="courses__item-bottom">
                                                            <div class="button">
                                                                <a
                                                                    href="{{ route('classroomdetail', ['id' => $item['id']]) }}">
                                                                    <span class="text">Detail cours</span>
                                                                    <i class="flaticon-arrow-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p>Tidak ada kelas yang ditemukan untuk instruktur ini.</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
    </section>
    <!-- dashboard-area-end -->

@endsection
