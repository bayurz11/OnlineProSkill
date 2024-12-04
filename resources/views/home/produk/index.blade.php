@section('title', 'ProSkill Akademia | Produk')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-two"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Produk</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Produk</span>
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

    <!-- shop-area -->
    <section class="shop-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-8 order-0 order-lg-2">
                    <div class="shop-top-wrap">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-sm-7">
                                <div class="shop-top-left">
                                    <p>
                                    <p>Menampilkan {{ $results->count() }} total hasil</p>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-5">
                                <div class="shop-top-right">
                                    <select name="orderby" class="orderby">
                                        <option value="latest" {{ request('orderby') == 'latest' ? 'selected' : '' }}>
                                            terbaru
                                        </option>
                                        <option value="oldest" {{ request('orderby') == 'oldest' ? 'selected' : '' }}>
                                            terlama
                                        </option>
                                        <option value="highest_price"
                                            {{ request('orderby') == 'highest_price' ? 'selected' : '' }}>
                                            harga tertinggi</option>
                                        <option value="lowest_price"
                                            {{ request('orderby') == 'lowest_price' ? 'selected' : '' }}>
                                            harga terendah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-item-wrap">
                        <div class="row">
                            @foreach ($results as $cours)
                                <div class="col-xl-4 col-sm-6">
                                    <div class="shop-item">
                                        <div class="shop-thumb">
                                            <a href="shop-details.html">
                                                <img src="{{ asset('public/uploads/' . $cours->gambar) }}" alt="img">
                                            </a>
                                            @if (!empty($cours->discount))
                                                <span class="flash-sale"
                                                    style="background-color: white; color: red;">{{ $cours->discount }}%</span>
                                            @endif

                                            <ul class="list-wrap shop-action">
                                                <li><a href="{{ route('produk-detail') }}"><i
                                                            class="fas fa-shopping-cart"></i></a></li>
                                                <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="shop-content">
                                            <h3 class="title"><a
                                                    href="{{ route('produk-detail') }}">{{ $cours->nama_kursus }}</a>
                                            </h3>
                                            <h4 class="price">
                                                @if (!empty($cours->discountedPrice) && $cours['discount'] != 0)
                                                    <del>Rp
                                                        {{ number_format($cours->price, 0, ',', '.') }}</del>
                                                    Rp
                                                    {{ number_format($cours->discountedPrice, 0, ',', '.') }}
                                                @else
                                                    Rp
                                                    {{ number_format($cours->price, 0, ',', '.') }}
                                                @endif
                                            </h4>
                                            <div class="courses__item-bottom">
                                                <div class="button">
                                                    <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}">
                                                        <span class="text">Detail</span>
                                                        <i class="flaticon-arrow-right"></i>
                                                    </a>
                                                </div>
                                                @php
                                                    $averageRating = $cours->reviews()->avg('rating');

                                                @endphp
                                                <div class="avg-rating">
                                                    <i class="fas fa-star"></i>
                                                    ({{ $averageRating ? number_format($averageRating, 1) : '0.0' }}
                                                    Reviews)
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <nav class="pagination__wrap mt-40">
                        {{ $results->links($paginationView) }}

                    </nav>
                </div>
                <div class="col-xl-3 col-lg-4">
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
                                    <a href="#">Show More +</a>
                                </div>
                            </div>
                        </div>

                        <div class="courses-widget">
                            <h4 class="widget-title">Harga</h4>
                            <div class="courses-cat-list">
                                <ul class="list-wrap">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="price[]"
                                                value="free" id="price_1"
                                                {{ in_array('free', request('price', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="price_1">All Price</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="price[]"
                                                value="free" id="price_2"
                                                {{ in_array('free', request('price', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="price_2">Free</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="price[]"
                                                value="paid" id="price_3"
                                                {{ in_array('paid', request('price', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="price_3">Paid</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-area-end -->
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
