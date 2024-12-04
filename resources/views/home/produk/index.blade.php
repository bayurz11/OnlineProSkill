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
                                            <a href="{{ route('produk-detail', ['id' => $cours->id]) }}">
                                                <img src="{{ asset('public/uploads/' . $cours->gambar) }}" alt="img">
                                            </a>
                                            @if (!empty($cours->discount))
                                                <span class="flash-sale"
                                                    style="background-color: white; color: red;">{{ $cours->discount }}%</span>
                                            @endif

                                            <ul class="list-wrap shop-action">
                                                <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                <li><a href="{{ route('produk-detail', ['id' => $cours->id]) }}"><i
                                                            class="far fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="shop-content">
                                            <h3 class="title"><a
                                                    href="{{ route('produk-detail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
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
                                                    <a href="{{ route('produk-detail', ['id' => $cours->id]) }}">
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
                                    <!-- Checkbox untuk All Price -->
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="price[]"
                                                value="free" id="price_1"
                                                {{ !in_array('free', is_array(request('price')) ? request('price') : (array) request('price', [])) &&
                                                !in_array('paid', is_array(request('price')) ? request('price') : (array) request('price', []))
                                                    ? 'checked'
                                                    : '' }}>
                                            <label class="form-check-label" for="price_1">All Price</label>
                                        </div>
                                    </li>

                                    <!-- Checkbox untuk Free -->
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="price[]"
                                                value="free" id="price_2"
                                                {{ in_array('free', is_array(request('price')) ? request('price') : (array) request('price', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="price_2">Free</label>
                                        </div>
                                    </li>

                                    <!-- Checkbox untuk Paid -->
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="price[]"
                                                value="paid" id="price_3"
                                                {{ in_array('paid', is_array(request('price')) ? request('price') : (array) request('price', [])) ? 'checked' : '' }}>
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
            const checkboxes = document.querySelectorAll('.category-checkbox');
            const allCategoriesCheckbox = document.getElementById('all_categories');
            const sortBySelect = document.querySelector('select[name="orderby"]');
            const showMoreButton = document.getElementById('toggleButton');
            const priceCheckboxes = document.querySelectorAll('.form-check-input[name="price[]"]');
            const freeCheckbox = document.querySelector('.form-check-input[value="free"]');
            const paidCheckbox = document.querySelector('.form-check-input[value="paid"]');

            // Fungsi untuk memperbarui URL berdasarkan kategori
            function updateCategoryUrl() {
                const selectedCategories = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                const url = new URL(window.location.href);
                url.searchParams.set('categories', selectedCategories.join(','));
                window.history.pushState({}, '', url.toString());
            }

            // Fungsi untuk memperbarui URL berdasarkan harga
            function updatePriceUrl() {
                const selectedPrices = Array.from(priceCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                const url = new URL(window.location.href);
                if (selectedPrices.length > 0) {
                    url.searchParams.set('price', selectedPrices);
                } else {
                    url.searchParams.delete('price');
                }
                window.history.pushState({}, '', url.toString());
            }

            // Event listener untuk checkbox kategori
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        allCategoriesCheckbox.checked =
                        false; // Hilangkan centang pada "Semua Kategori"
                    }
                    updateCategoryUrl();
                });
            });

            // Event listener untuk checkbox "Semua Kategori"
            if (allCategoriesCheckbox) {
                allCategoriesCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => (checkbox.checked = this.checked));
                    updateCategoryUrl();
                });
            }

            // Event listener untuk checkbox harga (saling meniadakan)
            freeCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    paidCheckbox.checked = false; // Hilangkan centang pada "Paid"
                }
                updatePriceUrl();
            });

            paidCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    freeCheckbox.checked = false; // Hilangkan centang pada "Free"
                }
                updatePriceUrl();
            });

            // Event listener untuk pengurutan (sort by)
            if (sortBySelect) {
                sortBySelect.addEventListener('change', function() {
                    const url = new URL(window.location.href);
                    url.searchParams.set('orderby', this.value);
                    window.history.pushState({}, '', url.toString());
                });
            }
        });
    </script>


@endsection
