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
                                <h4 class="widget-title">Level</h4>
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
                                            <div class="courses-top-right m-0 ms-md-auto">
                                                <div class="courses-top-right-select">
                                                    <form method="GET" action="{{ route('search') }}">
                                                        <select name="orderby" class="orderby"
                                                            onchange="this.form.submit()">
                                                            <option value="latest"
                                                                {{ request('orderby') == 'latest' ? 'selected' : '' }}>
                                                                terbaru</option>
                                                            <option value="oldest"
                                                                {{ request('orderby') == 'oldest' ? 'selected' : '' }}>
                                                                terlama</option>
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
                                                <img src="{{ asset('public/uploads/' . $cours->gambar) }}"
                                                    alt="Banner">
                                            </a>
                                        </div>
                                        <div class="courses__item-content">

                                            <h5 class="title"><a
                                                    href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->nama_kelas }}</a>
                                            </h5>
                                            <div class="courses__item-info">
                                                <ul class="list-wrap">
                                                    <li><span> <i class="fas fa-file"></i>
                                                            {{ $cours->Kategori->name_category }}</span></li>
                                                    <li><span> <i class="fas fa-tv"></i>
                                                            {{-- {{ $cours->Tipe->nama_tipe }}</span></li> --}}
                                                </ul>
                                            </div>
                                            <div class="courses__item-bottom">
                                                <ul class="list-wrap">
                                                    <li class="courses__item-price">
                                                        <span>IDR</span>{{ number_format($cours->harga, 0, ',', '.') }}
                                                    </li>
                                                    <li class="courses__item-rating">
                                                        <ul class="list-wrap">
                                                            <li><a href="#">4.7</a></li>
                                                            <li class="active"><i class="fas fa-star"></i></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $results->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- all-courses-end -->
@endsection

@push('scripts')
    <script>
        function toggleAllCategories(checkbox) {
            const checkboxes = document.querySelectorAll('.category-checkbox');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
            updateURL();
        }

        function updateURL() {
            const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                .map(cb => cb.getAttribute('data-category-id'));

            const url = new URL(window.location.href);
            if (selectedCategories.length > 0) {
                url.searchParams.set('category_ids', selectedCategories.join(','));
            } else {
                url.searchParams.delete('category_ids');
            }
            window.location.href = url.toString();
        }

        document.querySelectorAll('.category-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    document.getElementById('all_categories').checked = false;
                } else {
                    const allChecked = Array.from(document.querySelectorAll('.category-checkbox')).every(
                        cb => cb.checked);
                    document.getElementById('all_categories').checked = allChecked;
                }
                updateURL();
            });
        });

        document.getElementById('all_categories').addEventListener('change', function() {
            toggleAllCategories(this);
        });
    </script>
@endpush
