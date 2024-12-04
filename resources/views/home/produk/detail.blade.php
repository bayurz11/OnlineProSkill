@section('title', 'ProSkill Akademia | Detai Produk')
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
                        <h3 class="title">Detail Produk</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Detail Produk</span>
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

    <!-- shop-details-area -->
    <section class="shop-details-area section-pt-120 section-pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="shop-details-images-wrap d-flex gap-3">

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                                tabindex="0">
                                <a href="{{ asset('public/uploads/' . $courses->gambar) }}" class="popup-image">
                                    <img src="{{ asset('public/uploads/' . $courses->gambar) }}" alt="img">
                                </a>
                            </div>
                            <div class="tab-pane" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                                tabindex="0">
                                <a href="public/assets/img/shop/shop_img02.jpg" class="popup-image">
                                    <img src="public/assets/img/shop/shop_img02.jpg" alt="img">
                                </a>
                            </div>
                            <div class="tab-pane" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                                tabindex="0">
                                <a href="public/assets/img/shop/shop_img03.jpg" class="popup-image">
                                    <img src="public/assets/img/shop/shop_img03.jpg" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="shop-details-content">
                        <h2 class="title">{{ $courses->nama_kursus }}</h2>
                        <div class="product-review">
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $reviews->avg('rating'))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span>({{ $reviews->count() }} Reviews)</span>
                        </div>

                        <h3 class="price">
                            @if (!empty($courses->discountedPrice) && $courses['discount'] != 0)
                                <del style="color: gray; font-size: 14px;">Rp
                                    {{ number_format($courses->price, 0, ',', '.') }}</del>
                                Rp
                                {{ number_format($courses->discountedPrice, 0, ',', '.') }}
                            @else
                                Rp
                                {{ number_format($courses->price, 0, ',', '.') }}
                            @endif
                        </h3>

                        <p> {!! $courses->content !!} </p>
                        <div class="shop-details-qty">

                            <div class="tg-button-wrap">
                                <a href="{{ route('cart.checkout', ['id' => $courses->id]) }}"
                                    class="btn btn-two arrow-btn">
                                    Checkout
                                    <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                        class="injectable">
                                </a>
                            </div>
                            <br>
                            <div class="tg-button-wrap">
                                <a href="{{ route('cart.adddetail', ['id' => $courses->id]) }}" class="btn">Masukkan
                                    keranjang
                                    <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                        class="injectable">
                                </a>
                            </div>
                        </div>
                        <div class="shop-details-bottom">
                            <ul class="list-wrap">

                                <li class="sd-category">
                                    <span class="title">Kategori:</span>
                                    <a href="">{{ $courses->kategori_id }}</a>
                                </li>
                                <li class="sd-tag">
                                    <span class="title">Tags:</span>
                                    <span>{{ json_decode($courses->tag)[0]->value }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-desc-wrap">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description-tab-pane" type="button" role="tab"
                                    aria-controls="description-tab-pane" aria-selected="true">Deskripsi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                    aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                                aria-labelledby="description-tab" tabindex="0">
                                <p>{!! $courses->content !!}</p>
                            </div>
                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                aria-labelledby="reviews-tab" tabindex="0">
                                <div class="courses__rating-wrap">
                                    <h2 class="title">Reviews</h2>
                                    <div class="course-rate">
                                        <div class="course-rate__summary">
                                            <div class="course-rate__summary-value">

                                                {{ number_format($reviews->avg('rating'), 1) }}
                                            </div>
                                            <div class="course-rate__summary-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $reviews->avg('rating'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="course-rate__summary-text">
                                                {{ $reviews->count() }} Ratings
                                            </div>
                                        </div>

                                        <div class="course-rate__details">
                                            @for ($rating = 5; $rating >= 1; $rating--)
                                                <div class="course-rate__details-row">
                                                    <div class="course-rate__details-row-star">
                                                        {{ $rating }}
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="course-rate__details-row-value">
                                                        <div class="rating-gray"></div>
                                                        <div class="rating"
                                                            style="width:{{ ($reviews->where('rating', $rating)->count() / max(1, $reviews->count())) * 100 }}%;"
                                                            title="{{ ($reviews->where('rating', $rating)->count() / max(1, $reviews->count())) * 100 }}%">
                                                        </div>
                                                        <span
                                                            class="rating-count">{{ $reviews->where('rating', $rating)->count() }}</span>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <div id="review-container">
                                        @foreach ($reviews as $index => $review)
                                            <div class="course-review-head review"
                                                style="display: {{ $index < 3 ? 'block' : 'none' }};">
                                                <div class="review-author-thumb">
                                                    <img src="{{ $review->user->userprofile && $review->user->userprofile->gambar ? (strpos($review->user->userprofile->gambar, 'googleusercontent') !== false ? $review->user->userprofile->gambar : asset('public/uploads/' . $review->user->userprofile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                        alt="img"
                                                        style="border-radius: 50%; width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="review-author-content">
                                                    <div class="author-name">
                                                        <h5 class="name">{{ $review->user->name }}
                                                            <span>{{ $review->created_at->diffForHumans() }}</span>
                                                        </h5>
                                                        <div class="author-rating">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <i class="fas fa-star"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <h4 class="title">{{ $review->kelasTatapMuka->nama_kursus }}</h4>
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                    @if (count($reviews) > 3)
                                        <button id="load-more"
                                            style="background-color: #e9ecef; color: #495057; border: none; border-radius: 50px; padding: 10px 20px; font-size: 16px; cursor: pointer; display: block; margin: 0 auto;">
                                            Tampilkan Lebih Banyak
                                        </button>
                                    @endif

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const reviews = document.querySelectorAll('.review');
                                            const loadMoreButton = document.getElementById('load-more');
                                            let displayed = 3; // Awalnya hanya menampilkan 3 ulasan

                                            // Hanya jalankan event listener jika ada tombol
                                            if (loadMoreButton) {
                                                loadMoreButton.addEventListener('click', function() {
                                                    for (let i = displayed; i < displayed + 3 && i < reviews.length; i++) {
                                                        reviews[i].style.display = 'block';
                                                    }
                                                    displayed += 3;

                                                    // Jika semua ulasan telah ditampilkan, sembunyikan tombol
                                                    if (displayed >= reviews.length) {
                                                        loadMoreButton.style.display = 'none';
                                                    }
                                                });
                                            }
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-product-area">
                <div class="section__title mb-40">
                    <h2 class="title">
                        <span class="position-relative">
                            <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                    fill="currentcolor" />
                            </svg>
                            products
                        </span>
                    </h2>
                </div>
                <div class="swiper-container shop-active">
                    <div class="swiper-wrapper">
                        @foreach ($results as $cours)
                            <div class="swiper-slide">
                                <div class="shop-item">
                                    <div class="shop-thumb">
                                        <a href="{{ route('produk-detail', ['id' => $cours->id]) }}">
                                            <!-- Ganti dengan URL yang sesuai -->
                                            <img src="{{ asset('public/uploads/' . $cours->gambar) }}" alt="img">
                                            <!-- Ganti dengan nama kolom yang menyimpan gambar -->
                                        </a>
                                        <ul class="list-wrap shop-action">
                                            <li><a href="{{ route('produk-detail', ['id' => $cours->id]) }}"><i
                                                        class="fas fa-shopping-cart"></i></a></li>
                                            <li><a href="javascript:void(0);"><i class="far fa-heart"></i></a></li>
                                            <li><a href="{{ route('produk-detail', ['id' => $cours->id]) }}"><i
                                                        class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="shop-content">
                                        <h3 class="title"><a
                                                href="{{ route('produk-detail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
                                        </h3> <!-- Ganti dengan kolom yang menyimpan nama kursus -->
                                        <div class="rating">
                                            <!-- Menampilkan rating jika tersedia -->
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fas fa-star {{ $cours->rating > $i ? 'filled' : '' }}"></i>
                                            @endfor
                                            @php
                                                $averageRating = $cours->reviews()->avg('rating');

                                            @endphp
                                            <span
                                                class="avg">({{ $averageRating ? number_format($averageRating, 1) : '0.0' }}
                                                Reviews)</span>
                                            <!-- Ganti dengan kolom rating -->
                                        </div>
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
                                        </h4> <!-- Ganti dengan kolom harga -->
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details-area-end -->

@endsection
