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

    <!-- instructor-details-area -->
    <section class="instructor__details-area section-pt-120 section-pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="instructor__details-wrap">
                        <div class="instructor__details-info">
                            <div class="instructor__details-thumb">
                                <img src="{{ $instructorProfile && $instructorProfile->gambar ? (strpos($instructorProfile->gambar, 'googleusercontent') !== false ? $instructorProfile->gambar : asset('public/uploads/' . $instructorProfile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                    alt="img" style="object-fit: cover;">
                            </div>
                            <div class="instructor__details-content">
                                <h2 class="title">Robert Fox</h2>
                                <span class="designation">Expert Laravel Pro</span>
                                <ul class="list-wrap">
                                    <li class="avg-rating"><i class="fas fa-star"></i>(4.8 Reviews)</li>
                                    <li><i class="far fa-envelope"></i><a href="mailto:info@gmail.com">info@gmail.com</a>
                                    </li>
                                    <li><i class="fas fa-phone-alt"></i><a href="tel:0123456789">+123 9500 600</a></li>
                                </ul>
                                <p>Grursus mal suada faci lisis Lorem ipsum dolarorit more ametion consectetur Vesity bulum
                                    a nec odio aea the dumm ipsumm ipsum that dolocons sus suada and farit consectetur elit.
                                </p>
                                <div class="instructor__details-social">
                                    <ul class="list-wrap">
                                        <li>
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="instructor__details-courses">
                            <div class="row align-items-center mb-30">
                                <div class="col-md-8">
                                    <h2 class="main-title">My Courses</h2>
                                    <p>when known printer took a galley of type scrambl edmake</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="instructor__details-nav">
                                        <button class="courses-button-prev"><i class="flaticon-arrow-right"></i></button>
                                        <button class="courses-button-next"><i class="flaticon-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper courses-swiper-active-two">
                                <div class="swiper-wrapper">
                                    @if ($kelas->isNotEmpty())
                                        @foreach ($kelas as $item)
                                            @if ($item->status == 1)
                                                <div class="swiper-slide">
                                                    <div class="courses__item shine__animate-item">
                                                        <div class="courses__item-thumb">
                                                            <a href="{{ route('classroomdetail', ['id' => $item['id']]) }}"
                                                                class="shine__animate-link">
                                                                <img src="{{ asset('public/uploads/' . $item['gambar']) }}"
                                                                    alt="img" class="img-fluid" loading="lazy">
                                                            </a>
                                                        </div>
                                                        <div class="courses__item-content">
                                                            <ul class="courses__item-meta list-wrap">
                                                                <li class="courses__item-tag">
                                                                    @if ($item['course_type'] == 'online')
                                                                        <span class="badge bg-primary">Online</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">Kelas Tatap
                                                                            Muka</span>
                                                                    @endif
                                                                </li>
                                                                <li class="avg-rating"><i class="fas fa-star"></i> (4.3
                                                                    Reviews)</li>
                                                                <li class="price">
                                                                    @if (!empty($item['discountedPrice']))
                                                                        <del style="color: red; margin-right: 8px;">Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}
                                                                        </del>
                                                                        <span
                                                                            style="color: #007F73; font-weight: bold; font-size: 1.2em;">Rp
                                                                            {{ number_format($item['discountedPrice'], 0, ',', '.') }}
                                                                        </span>
                                                                    @else
                                                                        <span style="color: red;">Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}
                                                                        </span>
                                                                    @endif
                                                                </li>

                                                                @if (in_array($item->id, $joinedCourses))
                                                                    <i class="fas fa-check-circle fa-lg"
                                                                        style="color: #007F73;"></i>
                                                                @endif
                                                            </ul>
                                                            <h5 class="title"><a
                                                                    href="{{ route('classroomdetail', ['id' => $item['id']]) }}">{{ $item['nama_kursus'] }}
                                                            </h5>
                                                            <p class="author">By <a
                                                                    href="{{ route('profile_instruktur', ['id' => $instructorProfile->user->id]) }}">{{ $instructorProfile->user->name }}</a>
                                                            </p>

                                                            <div class="courses__item-bottom">
                                                                <div class="button">
                                                                    <a
                                                                        href="{{ route('classroomdetail', ['id' => $item['id']]) }}">
                                                                        <span class="text">Detail Kelas</span>
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

                <div class="col-xl-3">
                    <div class="instructor__sidebar">
                        <h4 class="title">Quick Contact</h4>
                        <p>Feel free to contact us through Twitter or Facebook if you prefer!</p>
                        <form action="#">
                            <div class="form-grp">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="form-grp">
                                <input type="email" placeholder="E-mail">
                            </div>
                            <div class="form-grp">
                                <input type="text" placeholder="Topic">
                            </div>
                            <div class="form-grp">
                                <input type="number" placeholder="Phone">
                            </div>
                            <div class="form-grp">
                                <textarea name="message" placeholder="Type Message"></textarea>
                            </div>
                            <button type="submit" class="btn arrow-btn">Send Message <img
                                    src="assets/img/icons/right_arrow.svg" alt="img" class="injectable"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- instructor-details-area-end -->
    <!-- dashboard-area -->
    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
                    <div class="dashboard__sidebar-wrap"
                        style="background-color: #f9fafb; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); display: flex; align-items: center;">
                        <div style="margin-right: 15px;">
                            <img src="{{ $instructorProfile && $instructorProfile->gambar ? (strpos($instructorProfile->gambar, 'googleusercontent') !== false ? $instructorProfile->gambar : asset('public/uploads/' . $instructorProfile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                alt="Profile Image"
                                style="border-radius: 50%; width: 80px; height: 80px; object-fit: cover;">
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

                        <div class="tab-pane fade show active" id="grid" role="tabpanel"
                            aria-labelledby="grid-tab">
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
                                                                    <span class="badge bg-secondary">Kelas Tatap
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
                                                                <i class="fas fa-check-circle fa-lg"
                                                                    style="color: green;"></i>
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
