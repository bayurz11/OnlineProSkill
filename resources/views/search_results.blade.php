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

    <!-- all-courses -->
    <section class="all-courses-area section-py-120">
        <div class="container">
            @if ($results->isEmpty())
                <p style="text-align: center;">Tidak ada hasil yang ditemukan.</p>
            @else
                <div class="row">
                    <!-- Toggle button for mobile -->
                    <button class="sidebar-toggle d-lg-none" onclick="toggleSidebar()">Filter</button>

                    <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
                        <aside class="courses__sidebar">
                            <div class="courses-widget">
                                <h4 class="widget-title">Categories</h4>
                                <div class="courses-cat-list">
                                    <ul class="list-wrap">
                                        @foreach ($categori as $category)
                                            @if ($category->status == 1)
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input category-checkbox" type="checkbox"
                                                            value="{{ $category->id }}"
                                                            data-category-id="{{ $category->id }}"
                                                            id="cat_{{ $category->id }}"
                                                            {{ in_array($category->id, $category_ids) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="cat_{{ $category->id }}">
                                                            {{ $category->name_category }}
                                                            ({{ $categoryCounts[$category->id] ?? 0 }})
                                                        </label>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
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
                                                    <option value="latest">latest</option>
                                                </select>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs courses__nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="grid-tab" data-bs-toggle="tab"
                                                    data-bs-target="#grid" type="button" role="tab"
                                                    aria-controls="grid" aria-selected="true">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 1H2C1.44772 1 1 1.44772 1 2V6C1 6.55228 1.44772 7 2 7H6C6.55228 7 7 6.55228 7 6V2C7 1.44772 6.55228 1 6 1Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M16 1H12C11.4477 1 11 1.44772 11 2V6C11 6.55228 11.4477 7 12 7H16C16.5523 7 17 6.55228 17 6V2C17 1.44772 16.5523 1 16 1Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M16 11H12C11.4477 11 11 11.4477 11 12V16C11 16.5523 11.4477 17 12 17H16C16.5523 17 17 16.5523 17 16V12C17 11.4477 16.5523 11 16 11Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6 11H2C1.44772 11 1 11.4477 1 12V16C1 16.5523 1.44772 17 2 17H6C6.55228 17 7 16.5523 7 16V12C7 11.4477 6.55228 11 6 11Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="list-tab" data-bs-toggle="tab"
                                                    data-bs-target="#list" type="button" role="tab"
                                                    aria-controls="list" aria-selected="false">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 5H16M7 9H16M7 13H16M2 5H2.01M2 9H2.01M2 13H2.01"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
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
                                <div class="row">
                                    @foreach ($results as $result)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="course__item white-bg mb-30 fix">
                                                <div class="course__thumb w-img p-relative fix"
                                                    style="background-image: url('{{ asset($result->gambar) }}');">
                                                    <div class="course__tag">
                                                        <a href="#">Art & Design</a>
                                                    </div>
                                                </div>
                                                <div class="course__content">
                                                    <div
                                                        class="course__meta d-flex align-items-center justify-content-between">
                                                        <div class="course__lesson">
                                                            <span><i class="far fa-book-alt"></i> 13 Lesson</span>
                                                        </div>
                                                        <div class="course__rating">
                                                            <span><i class="icon_star"></i> 4.5 (44)</span>
                                                        </div>
                                                    </div>
                                                    <h3 class="course__title">
                                                        <a href="{{ route('classroomdetail', $result->id) }}">
                                                            {{ $result->nama }}
                                                        </a>
                                                    </h3>
                                                    <div class="course__teacher d-flex align-items-center">
                                                        <div class="course__teacher-thumb mr-15">
                                                            <img src="{{ asset('public/assets/img/course/teacher/teacher-1.jpg') }}"
                                                                alt="">
                                                        </div>
                                                        <h6><a href="#">{{ $result->teacher }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                                <div class="row">
                                    @foreach ($results as $result)
                                        <div class="col-12">
                                            <div class="course__item course__item-list white-bg mb-30 fix">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <div class="course__thumb w-img p-relative fix"
                                                            style="background-image: url('{{ asset($result->gambar) }}');">
                                                            <div class="course__tag">
                                                                <a href="#">Art & Design</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="course__content">
                                                            <div
                                                                class="course__meta d-flex align-items-center justify-content-between">
                                                                <div class="course__lesson">
                                                                    <span><i class="far fa-book-alt"></i> 13 Lesson</span>
                                                                </div>
                                                                <div class="course__rating">
                                                                    <span><i class="icon_star"></i> 4.5 (44)</span>
                                                                </div>
                                                            </div>
                                                            <h3 class="course__title">
                                                                <a href="{{ route('classroomdetail', $result->id) }}">
                                                                    {{ $result->nama }}
                                                                </a>
                                                            </h3>
                                                            <div class="course__teacher d-flex align-items-center">
                                                                <div class="course__teacher-thumb mr-15">
                                                                    <img src="{{ asset('public/assets/img/course/teacher/teacher-1.jpg') }}"
                                                                        alt="">
                                                                </div>
                                                                <h6><a href="#">{{ $result->teacher }}</a></h6>
                                                            </div>
                                                            <p>{{ Str::limit($result->deskripsi, 150, '...') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- <!-- Pagination -->
                        <div class="courses__pagination mt-30">
                            {{ $results->links() }}
                        </div> --}}
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- all-courses-end -->

@endsection

@section('scripts')
    <script>
        // Fungsi untuk toggle sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.courses__sidebar');
            sidebar.classList.toggle('active');
        }

        // Fungsi untuk handle checkbox change
        document.querySelectorAll('.category-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let selectedCategories = [];
                document.querySelectorAll('.category-checkbox:checked').forEach(checkedBox => {
                    selectedCategories.push(checkedBox.value);
                });

                let searchParams = new URLSearchParams(window.location.search);
                searchParams.set('category_ids', selectedCategories.join(','));
                window.location.search = searchParams.toString();
            });
        });
    </script>
@endsection

<style>
    .sidebar-toggle {
        display: none;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        position: fixed;
        top: 15px;
        right: 15px;
        z-index: 1000;
    }

    .courses__sidebar {
        transition: transform 0.3s ease;
    }

    .courses__sidebar.active {
        transform: translateX(0);
    }

    @media (max-width: 991.98px) {
        .sidebar-toggle {
            display: block;
        }

        .courses__sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: white;
            transform: translateX(-100%);
            z-index: 999;
        }

        .courses__sidebar.active {
            transform: translateX(0);
        }
    }
</style>
