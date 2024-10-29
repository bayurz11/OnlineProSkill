@section('title', 'ProSkill Akademia | Hasil Pencarian')
<?php $page = 'Search'; ?>

@extends('layout.mainlayout')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-two"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
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
    </div>
    <!-- breadcrumb-area-end -->
    <!-- all-courses -->
    <section class="all-courses-area section-py-120">
        <div class="container">

            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
                    <aside class="courses__sidebar">
                        <div class="courses-widget">
                            <h4 class="widget-title">Kategori</h4>
                            <div class="courses-cat-list">
                                <ul class="list-wrap">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="all_categories" onclick="toggleAllCategories(this)"
                                                {{ empty($category_ids) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="all_categories">Semua Kategori</label>
                                        </div>
                                    </li>
                                    @foreach ($categori as $index => $category)
                                        @if ($category->status == 1 && ($categoryCounts[$category->id] ?? 0) > 0)
                                            <li class="category-item {{ $index >= 4 ? 'hidden' : '' }}">
                                                <div class="form-check">
                                                    <input class="form-check-input category-checkbox" type="checkbox"
                                                        value="{{ $category->id }}" data-category-id="{{ $category->id }}"
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
                                    <a href="#" id="toggleButton" onclick="showMoreCategories(event)">Tampilkan Lebih
                                        Banyak +</a>
                                </div>
                            </div>
                        </div>


                        <div class="courses-widget">
                            <h4 class="widget-title">Level</h4>
                            <div class="courses-cat-list">
                                <ul class="list-wrap">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input tingkat-checkbox" type="checkbox" value=""
                                                id="difficulty_all" onclick="resetAllLevels(this)">
                                            <label class="form-check-label" for="difficulty_all">All Levels</label>
                                        </div>
                                    </li>
                                    @foreach ($tingkatLevels as $tingkat)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input tingkat-checkbox" type="checkbox"
                                                    value="{{ $tingkat }}" id="level_{{ $loop->index }}"
                                                    {{ in_array($tingkat, (array) request()->input('tingkat', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="level_{{ $loop->index }}">
                                                    {{ $tingkat }} ({{ $tingkatCounts[$tingkat] ?? 0 }})
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
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
                                    @foreach ($results as $cours)
                                        @if ($cours->status == 1)
                                            <div class="col mb-4">
                                                <div
                                                    class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
                                                    <div class="courses__item-thumb courses__item-thumb-two">
                                                        <a href="{{ route('classroomdetail', ['id' => $cours['id']]) }}"
                                                            class="shine__animate-link">
                                                            <img src="{{ asset('public/uploads/' . $cours['gambar']) }}"
                                                                alt="img" class="img-fluid" loading="lazy">
                                                        </a>
                                                    </div>
                                                    <div
                                                        class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1">
                                                        <ul class="courses__item-meta list-wrap">
                                                            <li class="courses__item-tag">
                                                                @if ($cours['course_type'] == 'online')
                                                                    <span class="badge bg-primary">Online</span>
                                                                @else
                                                                    <span class="badge bg-secondary">Kelas Tatap
                                                                        Muka</span>
                                                                @endif
                                                            </li>
                                                            @if (in_array($cours->id, $joinedCourses))
                                                                <i class="fas fa-check-circle fa-lg" style="color: green;"
                                                                    title="Anda sudah bergabung"></i>
                                                            @endif
                                                            <li class="price">
                                                                @if (!empty($cours['discountedPrice']) && $cours['discount'] != 0)
                                                                    <del>Rp
                                                                        {{ number_format($cours['price'], 0, ',', '.') }}</del>
                                                                    Rp
                                                                    {{ number_format($cours['discountedPrice'], 0, ',', '.') }}
                                                                @else
                                                                    Rp {{ number_format($cours['price'], 0, ',', '.') }}
                                                                @endif
                                                            </li>
                                                        </ul>
                                                        <h5 class="title course-title flex-grow-1">
                                                            <a
                                                                href="{{ route('classroomdetail', ['id' => $cours['id']]) }}">{{ $cours['nama_kursus'] }}</a>
                                                        </h5>
                                                        <div class="courses__item-bottom">
                                                            <div class="button">
                                                                <a
                                                                    href="{{ route('classroomdetail', ['id' => $cours['id']]) }}">
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
                                    @foreach ($results as $cours)
                                        <div class="col">
                                            <div class="courses__item courses__item-three shine__animate-item">
                                                <div class="courses__item-thumb">
                                                    <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}"
                                                        class="shine__animate-link">
                                                        <img src="{{ asset('public/uploads/' . $cours->gambar) }}"
                                                            alt="Banner" class="wd-100 wd-sm-150 me-3">
                                                    </a>
                                                </div>
                                                <div class="courses__item-content">
                                                    <ul class="courses__item-meta list-wrap">
                                                        <li class="price">
                                                            @if (in_array($cours->id, $joinedCourses))
                                                                <i class="fas fa-check-circle fa-lg" style="color: green;"
                                                                    title="Anda sudah bergabung"></i>
                                                            @endif
                                                            @if (!empty($cours->discountedPrice) && $cours['discount'] != 0)
                                                                <del>Rp
                                                                    {{ number_format($cours->price, 0, ',', '.') }}</del>
                                                                Rp
                                                                {{ number_format($cours->discountedPrice, 0, ',', '.') }}
                                                            @else
                                                                Rp
                                                                {{ number_format($cours->price, 0, ',', '.') }}
                                                            @endif
                                                        </li>

                                                        @if ($cours->course_type == 'online')
                                                            <span class="badge bg-primary">Online</span>
                                                        @else
                                                            <span class="badge bg-secondary">Kelas Tatap Muka</span>
                                                        @endif
                                                    </ul>

                                                    <h5 class="title">
                                                        <a
                                                            href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
                                                    </h5>


                                                    <p class="info">{!! $cours->content !!}</p>
                                                    <div class="courses__item-bottom">
                                                        <div class="button">
                                                            <a
                                                                href="{{ route('classroomdetail', ['id' => $cours->id]) }}">
                                                                <span class="text">Detail</span>
                                                                <i class="flaticon-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                        {{-- <div class="button">
                                                        <a href="{{ route('cart.add', ['id' => $cours->id]) }}"
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
    <!-- all-courses-end -->
    @endif



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi elemen-elemen yang digunakan
            const checkboxes = document.querySelectorAll('.category-checkbox');
            const allCategoriesCheckbox = document.getElementById('all_categories');
            const sortBySelect = document.querySelector('select[name="orderby"]');
            const tingkatCheckboxes = document.querySelectorAll('.tingkat-checkbox');
            const difficultyAllCheckbox = document.getElementById('difficulty_all');
            const showMoreButton = document.getElementById('toggleButton');

            function updateUrl(selectedCategories, orderby, selectedTingkat) {
                const url = new URL(window.location.href);
                url.searchParams.set('categories', selectedCategories.join(','));
                url.searchParams.set('orderby', orderby);
                url.searchParams.set('tingkat', selectedTingkat.join(','));
                window.location.href = url.toString();
            }

            // Fungsi untuk memperbarui kategori
            function updateCategories() {
                const selectedCategories = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
                updateUrl(selectedCategories, sortBySelect?.value || '', Array.from(tingkatCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value));
            }

            // Fungsi untuk memperbarui tingkat
            function updateLevels() {
                const selectedTingkat = Array.from(tingkatCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
                updateUrl(Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value), sortBySelect?.value || '', selectedTingkat);
            }

            function toggleAllCategories(source) {
                if (source.checked) {
                    checkboxes.forEach(checkbox => checkbox.checked = false);
                    updateCategories();
                }
            }

            function toggleAllLevels(source) {
                if (source.checked) {
                    tingkatCheckboxes.forEach(checkbox => checkbox.checked = false);
                    updateLevels();
                }
            }

            // Event listener untuk setiap checkbox kategori
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        allCategoriesCheckbox.checked = false;
                    }
                    updateCategories();
                });
            });

            // Event listener untuk checkbox "Semua Kategori"
            if (allCategoriesCheckbox) {
                allCategoriesCheckbox.addEventListener('change', function() {
                    toggleAllCategories(this);
                });
            }

            // Event listener untuk pengurutan (sort by)
            if (sortBySelect) {
                sortBySelect.addEventListener('change', function() {
                    updateCategories();
                });
            }

            // Event listener untuk checkbox tingkat
            tingkatCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Jika "Semua Level" dicentang, hapus centang dari semua checkbox tingkat lainnya
                    if (this.checked && this === difficultyAllCheckbox) {
                        tingkatCheckboxes.forEach(cb => {
                            if (cb !== this) cb.checked = false; // Uncheck others
                        });
                    }

                    // Update URL berdasarkan tingkat yang dipilih
                    updateLevels();
                });
            });

            // Event listener untuk checkbox "All Levels"
            if (difficultyAllCheckbox) {
                difficultyAllCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        tingkatCheckboxes.forEach(checkbox => checkbox.checked = false);
                        updateLevels();
                    }
                });
            }

            // Fungsi untuk menampilkan atau menyembunyikan lebih banyak kategori
            if (showMoreButton) {
                const categoryItems = document.querySelectorAll('.list-wrap .category-item');
                const showMoreCategoriesStatus = localStorage.getItem('showMoreCategories') === 'true';

                if (categoryItems.length <= 4) {
                    showMoreButton.style.display = 'none';
                } else {
                    for (let i = 4; i < categoryItems.length; i++) {
                        categoryItems[i].classList.toggle('hidden', !showMoreCategoriesStatus);
                    }
                    showMoreButton.innerText = showMoreCategoriesStatus ? 'Tampilkan Lebih Sedikit -' :
                        'Tampilkan Lebih Banyak +';
                }

                showMoreButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    const hiddenCategories = document.querySelectorAll('.category-item.hidden');

                    if (hiddenCategories.length > 0) {
                        hiddenCategories.forEach(category => category.classList.remove('hidden'));
                        showMoreButton.innerText = 'Tampilkan Lebih Sedikit -';
                        localStorage.setItem('showMoreCategories', 'true');
                    } else {
                        categoryItems.forEach((category, index) => {
                            if (index >= 4) {
                                category.classList.add('hidden');
                            }
                        });
                        showMoreButton.innerText = 'Tampilkan Lebih Banyak +';
                        localStorage.setItem('showMoreCategories', 'false');
                    }
                });
            }

            // Hapus elemen kategori bootcamp dari tampilan jika ada
            const bootcampCategories = document.querySelectorAll('.category-item[data-type="bootcamp"]');
            bootcampCategories.forEach(category => category.style.display = 'none');

            // Aktifkan semua tooltip di halaman
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Cek dan centang checkbox berdasarkan parameter URL
            const urlParams = new URLSearchParams(window.location.search);

            // Centang checkbox kategori
            if (urlParams.has('categories')) {
                const categories = urlParams.get('categories').split(',');
                checkboxes.forEach(checkbox => {
                    if (categories.includes(checkbox.value)) {
                        checkbox.checked = true;
                    }
                });
            }

            // Centang checkbox tingkat
            if (urlParams.has('tingkat')) {
                const tingkat = urlParams.get('tingkat').split(',');
                tingkatCheckboxes.forEach(checkbox => {
                    if (tingkat.includes(checkbox.value)) {
                        checkbox.checked = true;
                    }
                });
            }

            // Centang dropdown sort by
            if (urlParams.has('orderby')) {
                sortBySelect.value = urlParams.get('orderby');
            }
        });
    </script>





@endsection
