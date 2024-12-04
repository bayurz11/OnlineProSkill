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
                            <div class="col-xl-4 col-sm-6">
                                <div class="shop-item">
                                    <div class="shop-thumb">
                                        <a href="shop-details.html">
                                            <img src="{{ asset('public/assets/img/shop/shop_img01.jpg') }}" alt="img">
                                        </a>
                                        <span class="flash-sale">Sale</span>
                                        <ul class="list-wrap shop-action">
                                            <li><a href="{{ route('produk-detail') }}"><i
                                                        class="fas fa-shopping-cart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="shop-content">
                                        <h3 class="title"><a href="{{ route('produk-detail') }}">Garden Adeline Life</a>
                                        </h3>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="avg">(5.00)</span>
                                        </div>
                                        <h4 class="price">Rp 13.000<del>Rp 19.000</del></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav class="pagination__wrap mt-40">
                        <ul class="list-wrap">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="shop.html">2</a></li>
                            <li><a href="shop.html">3</a></li>
                            <li><a href="shop.html">4</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <aside class="courses__sidebar">
                        <div class="courses-widget">
                            <h4 class="widget-title">Categories</h4>
                            <div class="courses-cat-list">
                                <ul class="list-wrap">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cat_1">
                                            <label class="form-check-label" for="cat_1">Art & Design (8)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cat_2">
                                            <label class="form-check-label" for="cat_2">Business (12)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="cat_3">
                                            <label class="form-check-label" for="cat_3">Data Science (7)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="cat_4">
                                            <label class="form-check-label" for="cat_4">Development (10)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="cat_5">
                                            <label class="form-check-label" for="cat_5">Finance (8)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="cat_6">
                                            <label class="form-check-label" for="cat_6">Health & Fitness (8)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="cat_7">
                                            <label class="form-check-label" for="cat_7">Lifestyle (9)</label>
                                        </div>
                                    </li>
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

                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-area-end -->

@endsection
