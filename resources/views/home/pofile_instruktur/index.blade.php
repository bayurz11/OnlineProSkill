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
    <section class="all-courses-area section-py-120">
        <div class="container">

            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
                    <aside class="courses__sidebar">
                        <div class="courses-widget">
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


                    </aside>
                </div>
                <!-- Courses Grid -->
                <div class="col-xl-9 col-lg-8">
                    @if ($results->isEmpty())
                        <p style="text-align: center;">Tidak ada hasil yang ditemukan.</p>
                    @else
                        <div class="courses-top-wrap">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="courses-top-left">
                                        <p>Menampilkan {{ $results->count() }} total hasil</p>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div
                                        class="d-flex justify-content-center justify-content-md-end align-items-center flex-wrap">
                                        <div class="courses-top-right m-0 ms-md-auto">
                                            <span class="sort-by">Urutkan Berdasarkan:</span>
                                            <div class="courses-top-right-select">
                                                <form id="sortForm" method="GET" action="{{ route('search') }}">
                                                    <select name="orderby" class="orderby">
                                                        <option value="latest"
                                                            {{ request('orderby') == 'latest' ? 'selected' : '' }}>terbaru
                                                        </option>
                                                        <option value="oldest"
                                                            {{ request('orderby') == 'oldest' ? 'selected' : '' }}>terlama
                                                        </option>
                                                        <option value="highest_price"
                                                            {{ request('orderby') == 'highest_price' ? 'selected' : '' }}>
                                                            harga tertinggi</option>
                                                        <option value="lowest_price"
                                                            {{ request('orderby') == 'lowest_price' ? 'selected' : '' }}>
                                                            harga terendah</option>
                                                    </select>
                                                </form>
                                            </div>

                                        </div>

                                        <ul class="nav nav-tabs courses__nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="grid-tab" data-bs-toggle="tab"
                                                    data-bs-target="#grid" type="button" role="tab"
                                                    aria-controls="grid" aria-selected="true">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 1H2C1.44772 1 1 1.44772 1 2V6C1 6.55228 1.44772 7 2 7H6C6.55228 7 7 6.55228 7 6V2C7 1.44772 6.55228 1 6 1Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M16 1H12C11.4477 1 11 1.44772 11 2V6C11 6.55228 11.4477 7 12 7H16C16.5523 7 17 6.55228 17 6V2C17 1.44772 16.5523 1 16 1Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6 11H2C1.44772 11 1 11.4477 1 12V16C1 16.5523 1.44772 17 2 17H6C6.55228 17 7 16.5523 7 16V12C7 11.4477 6.55228 11 6 11Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M16 11H12C11.4477 11 11 11.4477 11 12V16C11 16.5523 11.4477 17 12 17H16C16.5523 17 17 16.5523 17 16V12C17 11.4477 16.5523 11 16 11Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>

                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="list-tab" data-bs-toggle="tab"
                                                    data-bs-target="#list" type="button" role="tab"
                                                    aria-controls="list" aria-selected="false">
                                                    <svg width="19" height="15" viewBox="0 0 19 15"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.5 6C0.67 6 0 6.67 0 7.5C0 8.33 0.67 9 1.5 9C2.33 9 3 8.33 3 7.5C3 6.67 2.33 6 1.5 6ZM1.5 0C0.67 0 0 0.67 0 1.5C0 2.33 0.67 3 1.5 3C2.33 3 3 2.33 3 1.5C3 0.67 2.33 0 1.5 0ZM1.5 12C0.67 12 0 12.68 0 13.5C0 14.32 0.68 15 1.5 15C2.32 15 3 14.32 3 13.5C3 12.68 2.33 12 1.5 12ZM5.5 14.5H17.5C18.05 14.5 18.5 14.05 18.5 13.5C18.5 12.95 18.05 12.5 17.5 12.5H5.5C4.95 12.5 4.5 12.95 4.5 13.5C4.5 14.05 4.95 14.5 5.5 14.5ZM5.5 8.5H17.5C18.05 8.5 18.5 8.05 18.5 7.5C18.5 6.95 18.05 6.5 17.5 6.5H5.5C4.95 6.5 4.5 6.95 4.5 7.5C4.5 8.05 4.95 8.5 5.5 8.5ZM4.5 1.5C4.5 2.05 4.95 2.5 5.5 2.5H17.5C18.05 2.5 18.5 2.05 18.5 1.5C18.5 0.95 18.05 0.5 17.5 0.5H5.5C4.95 0.5 4.5 0.95 4.5 1.5Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">


                            <div class="tab-pane fade show active" id="grid" role="tabpanel"
                                aria-labelledby="grid-tab">
                                <div
                                    class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                    @foreach ($results as $item)
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
                                </div>

                            </div>

                            <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                                <div class="row courses__list-wrap row-cols-1">
                                    @foreach ($results as $item)
                                        <div class="col">
                                            <div class="courses__item courses__item-three shine__animate-item">
                                                <div class="courses__item-thumb">
                                                    <a href="{{ route('classroomdetail', ['id' => $item->id]) }}"
                                                        class="shine__animate-link">
                                                        <img src="{{ asset('public/uploads/' . $item->gambar) }}"
                                                            alt="Banner" class="wd-100 wd-sm-150 me-3">
                                                    </a>
                                                </div>
                                                <div class="courses__item-content">
                                                    <ul class="courses__item-meta list-wrap">
                                                        <li class="price">
                                                            @if (!empty($item->discountedPrice))
                                                                <del>Rp
                                                                    {{ number_format($item->price, 0, ',', '.') }}</del>
                                                                Rp
                                                                {{ number_format($item->discountedPrice, 0, ',', '.') }}
                                                            @else
                                                                Rp
                                                                {{ number_format($item->price, 0, ',', '.') }}
                                                            @endif
                                                        </li>
                                                        @if ($item->course_type == 'online')
                                                            <span class="badge bg-primary">Online</span>
                                                        @else
                                                            <span class="badge bg-secondary">cours Tatap Muka</span>
                                                        @endif
                                                    </ul>
                                                    <h5 class="title">
                                                        <a
                                                            href="{{ route('classroomdetail', ['id' => $item->id]) }}">{{ $item->nama_kursus }}</a>
                                                    </h5>

                                                    <p class="author">By <a
                                                            href="#">{{ $item->user->name }}</a>&nbsp;&nbsp;
                                                        @if (in_array($item->id, $joinedCourses))
                                                            <span class="badge bg-success" data-bs-toggle="tooltip"
                                                                title="Anda sudah bergabung dengan cours ini">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                        @endif
                                                    </p>
                                                    <p class="info">{!! $item->content !!}</p>
                                                    <div class="courses__item-bottom">
                                                        <div class="button">
                                                            <a href="{{ route('classroomdetail', ['id' => $item->id]) }}">
                                                                <span class="text">Detail</span>
                                                                <i class="flaticon-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                        {{-- <div class="button">
                                                        <a href="{{ route('cart.add', ['id' => $item->id]) }}"
                                                            class="cart-count"
                                                            style="color: #ffffff; background-color: #007F73;">Keranjang
                                                            <img src="{{ asset('public/assets/img/icons/cart.svg') }}"
                                                                class="injectable" alt="img">
                                                        </a>
                                                    </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <nav class="pagination__wrap mt-30">
                                {{ $results->links($paginationView) }}
                            </nav>
                        </div>
                </div>
    </section>
    <!-- dashboard-area -->
    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
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




                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
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
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- dashboard-area-end -->

@endsection
