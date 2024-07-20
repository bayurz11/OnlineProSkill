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
    <section class="all-courses-area section-py-120">
        <div class="container">
            <div class="row">
                <!-- Sidebar untuk Filter -->
                <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
                    <aside class="courses__sidebar">
                        <!-- Kategori -->
                        <div class="courses-widget">
                            <h4 class="widget-title">Categories</h4>
                            <div class="courses-cat-list">
                                <ul class="list-wrap">
                                    @foreach ($categori as $category)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                                    id="cat_{{ $category->id }}">
                                                <label class="form-check-label"
                                                    for="cat_{{ $category->id }}">{{ $category->name }}
                                                    ({{ $category->course_count }})
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="show-more">
                                    <a href="#">Show More +</a>
                                </div>
                            </div>
                        </div>
                        <!-- Harga -->
                        <div class="courses-widget">
                            <h4 class="widget-title">Price</h4>
                            <div class="courses-cat-list">
                                <ul class="list-wrap">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="price_all">
                                            <label class="form-check-label" for="price_all">All Price</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="price_free">
                                            <label class="form-check-label" for="price_free">Free</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="price_paid">
                                            <label class="form-check-label" for="price_paid">Paid</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Level Keterampilan -->
                        <div class="courses-widget">
                            <h4 class="widget-title">Skill level</h4>
                            <div class="courses-cat-list">
                                <ul class="list-wrap">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="level_all">
                                            <label class="form-check-label" for="level_all">All Skills</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="level_beginner">
                                            <label class="form-check-label" for="level_beginner">Beginner</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="level_intermediate">
                                            <label class="form-check-label" for="level_intermediate">Intermediate</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="level_advanced">
                                            <label class="form-check-label" for="level_advanced">Advanced</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>

                <!-- Konten Kursus -->
                <div class="col-xl-9 col-lg-8">
                    <div class="courses-top-wrap">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="courses-top-left">
                                    {{-- <p>Showing {{ $results->total() }} total results</p> --}}
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
                                    <ul class="nav nav-tabs courses__nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#grid" type="button" role="tab"
                                                aria-controls="grid" aria-selected="true">
                                                <!-- Icon Grid -->
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
                                                <!-- Icon List -->
                                                <svg width="19" height="15" viewBox="0 0 19 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.5 6C0.67 6 0 6.67 0 7.5C0 8.33 0.67 9 1.5 9C2.33 9 3 8.33 3 7.5C3 6.67 2.33 6 1.5 6ZM1.5 0C0.67 0 0 0.67 0 1.5C0 2.33 0.67 3 1.5 3C2.33 3 3 2.33 3 1.5C3 0.67 2.33 0 1.5 0ZM1.5 12C0.67 12 0 12.67 0 13.5C0 14.33 0.67 15 1.5 15C2.33 15 3 14.33 3 13.5C3 12.67 2.33 12 1.5 12ZM18 6C17.17 6 16.5 6.67 16.5 7.5C16.5 8.33 17.17 9 18 9C18.83 9 19.5 8.33 19.5 7.5C19.5 6.67 18.83 6 18 6ZM18 0C17.17 0 16.5 0.67 16.5 1.5C16.5 2.33 17.17 3 18 3C18.83 3 19.5 2.33 19.5 1.5C19.5 0.67 18.83 0 18 0ZM18 12C17.17 12 16.5 12.67 16.5 13.5C16.5 14.33 17.17 15 18 15C18.83 15 19.5 14.33 19.5 13.5C19.5 12.67 18.83 12 18 12Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Kursus -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="grid" role="tabpanel"
                            aria-labelledby="grid-tab">
                            <div class="row">
                                @foreach ($results as $course)
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <div class="course-card">
                                            <div class="course-card__image">
                                                <a href="{{ route('course.details', $course->id) }}">
                                                    <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
                                                </a>
                                            </div>
                                            <div class="course-card__content">
                                                <h3 class="course-card__title">{{ $course->title }}</h3>
                                                <p class="course-card__price">${{ $course->price }}</p>
                                                <a href="{{ route('course.details', $course->id) }}"
                                                    class="btn btn-primary">View Course</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                            <div class="list-view">
                                @foreach ($results as $course)
                                    <div class="list-view__item">
                                        <div class="list-view__image">
                                            <a href="{{ route('course.details', $course->id) }}">
                                                <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
                                            </a>
                                        </div>
                                        <div class="list-view__content">
                                            <h3 class="list-view__title">{{ $course->title }}</h3>
                                            <p class="list-view__price">${{ $course->price }}</p>
                                            <a href="{{ route('course.details', $course->id) }}"
                                                class="btn btn-primary">View Course</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrap">
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
