@section('title', 'ProSkill Akademia | Hasil Pencarian')
<?php $page = 'Search'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
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
    </section>
    <!-- breadcrumb-area-end -->

    @if ($results->isEmpty())
        <p>Tidak ada hasil yang ditemukan.</p>
    @else
        <!-- all-courses -->
        <section class="all-courses-area section-py-120">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
                        <aside class="courses__sidebar">
                            <div class="courses-widget">
                                <h4 class="widget-title">Categories</h4>
                                <div class="courses-cat-list">
                                    <ul class="list-wrap">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="cat_1">
                                                <label class="form-check-label" for="cat_1">Art & Design (8)</label>
                                            </div>
                                        </li>
                                        <!-- Add more categories as needed -->
                                    </ul>
                                    <div class="show-more">
                                        <a href="#">Show More +</a>
                                    </div>
                                </div>
                            </div>
                            <div class="courses-widget">
                                <h4 class="widget-title">Price</h4>
                                <div class="courses-cat-list">
                                    <ul class="list-wrap">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="price_1">
                                                <label class="form-check-label" for="price_1">All Price</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="price_2">
                                                <label class="form-check-label" for="price_2">Free</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="price_3">
                                                <label class="form-check-label" for="price_3">Paid</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="courses-widget">
                                <h4 class="widget-title">Skill level</h4>
                                <div class="courses-cat-list">
                                    <ul class="list-wrap">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="difficulty_1">
                                                <label class="form-check-label" for="difficulty_1">All Skills</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="difficulty_2">
                                                <label class="form-check-label" for="difficulty_2">Beginner (55)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="difficulty_3">
                                                <label class="form-check-label" for="difficulty_3">Intermediate
                                                    (22)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="difficulty_4">
                                                <label class="form-check-label" for="difficulty_4">High (42)</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <!-- Courses Grid -->
                    <div class="col-xl-9 col-lg-8">
                        <div class="courses-top-wrap">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="courses-top-left">
                                        <p>Showing {{ $results->count() }} total results</p>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div
                                        class="d-flex justify-content-center justify-content-md-end align-items-center flex-wrap">
                                        <div class="courses-top-right m-0 ms-md-auto">
                                            <span class="sort-by">Sort By:</span>
                                            <div class="courses-top-right-select">
                                                <select name="orderby" class="orderby">
                                                    <option value="Most Popular">Most Popular</option>
                                                    <option value="popularity">popularity</option>
                                                    <option value="average rating">average rating</option>
                                                    <option value="latest">latest</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                            @foreach ($results as $cours)
                                <div class="col">
                                    <div class="courses__item shine__animate-item">
                                        <div class="courses__item-thumb">
                                            <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}"
                                                class="shine__animate-link">
                                                <img src="{{ asset('public/uploads/' . $cours->gambar) }}" alt="Banner">
                                            </a>
                                        </div>
                                        <div class="courses__item-content">
                                            <ul class="courses__item-meta list-wrap">
                                                <li class="courses__item-tag">
                                                    <a
                                                        href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->kategori }}</a>
                                                </li>
                                                <li class="avg-rating"><i class="fas fa-star"></i> (4.8 Reviews)</li>
                                            </ul>
                                            <h5 class="title"><a
                                                    href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
                                            </h5>
                                            <p class="author">By <a href="#">{{ $cours->user->name }}</a></p>
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
                </div>
            </div>
        </section>
        <!-- all-courses-end -->
    @endif
@endsection
