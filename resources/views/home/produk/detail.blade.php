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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">
                                    <img src="{{ asset('public/assets/img/shop/shop_img01.jpg') }}" alt="img">
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab"
                                    aria-controls="profile-tab-pane" aria-selected="false">
                                    <img src="{{ asset('public/assets/img/shop/shop_img02.jpg') }}" alt="img">
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact-tab-pane" type="button" role="tab"
                                    aria-controls="contact-tab-pane" aria-selected="false">
                                    <img src="{{ asset('public/assets/img/shop/shop_img03.jpg') }}" alt="img">
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                                tabindex="0">
                                <a href="public/assets/img/shop/shop_img01.jpg" class="popup-image">
                                    <img src="public/assets/img/shop/shop_img01.jpg" alt="img">
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
                        <h2 class="title">Garden Adeline Life</h2>
                        <div class="product-review">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span>( Reviews 5.0 )</span>
                        </div>
                        <h3 class="price">$13.00</h3>
                        <p>Grursus mal suada faci lisis Lorem ipsum dolarorit more ametion consectetur Vesti at bulum nec
                            odio aea the dumm summ ipsum that dolocons rsus mal suada and fadolorit to the consectetur elit.
                        </p>
                        <div class="shop-details-qty">
                            <div class="cart-plus-minus">
                                <input type="text" value="1">
                            </div>
                            <a href="shop-details.html" class="cart-btn btn">Add To Cart</a>
                        </div>
                        <div class="shop-details-bottom">
                            <ul class="list-wrap">
                                <li class="sd-sku">
                                    <span class="title">SKU:</span>
                                    <span class="code">#CDP21</span>
                                </li>
                                <li class="sd-category">
                                    <span class="title">Categories:</span>
                                    <a href="shop-details.html">Business & Marketing</a>
                                </li>
                                <li class="sd-tag">
                                    <span class="title">Tags:</span>
                                    <a href="shop-details.html">Coaching,</a>
                                    <a href="shop-details.html">Education</a>
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
                                    aria-controls="description-tab-pane" aria-selected="true">Description</button>
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
                                <p>Grursus mal suada faci lisis Lorem ipsum dolarorit more ametion consectetur elit. Vesti
                                    at bulum nec odio aea the dumm summ ipsum that dolocons rsus mal suada and fadolorit to
                                    the consectetur elit. y to follow tutorials, Exercises, and solutions. This course does
                                    start from the beginning with very little knowledge and gives a great overview of common
                                    tools used for data science and progresses into more.</p>
                            </div>
                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                aria-labelledby="reviews-tab" tabindex="0">
                                <div class="product-desc-review">
                                    <div class="product-desc-review-title mb-15">
                                        <h5 class="title">Customer Reviews (0)</h5>
                                    </div>
                                    <div class="left-rc">
                                        <p>No reviews yet</p>
                                    </div>
                                    <div class="right-rc">
                                        <a href="#">Write a review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-product-area">
                <div class="section__title mb-40">
                    <h2 class="title">
                        Related
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
                        <div class="swiper-slide">
                            <div class="shop-item">
                                <div class="shop-thumb">
                                    <a href="shop-details.html">
                                        <img src="public/assets/img/shop/shop_img06.jpg" alt="img">
                                    </a>
                                    <ul class="list-wrap shop-action">
                                        <li><a href="shop-details.html"><i class="fas fa-shopping-cart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-heart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="shop-content">
                                    <h3 class="title"><a href="shop-details.html">The Fashion Edits</a></h3>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="avg">(5.00)</span>
                                    </div>
                                    <h4 class="price">$39.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="shop-item">
                                <div class="shop-thumb">
                                    <a href="shop-details.html">
                                        <img src="public/assets/img/shop/shop_img07.jpg" alt="img">
                                    </a>
                                    <span class="flash-sale">Sale</span>
                                    <ul class="list-wrap shop-action">
                                        <li><a href="shop-details.html"><i class="fas fa-shopping-cart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-heart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="shop-content">
                                    <h3 class="title"><a href="shop-details.html">The Business Women</a></h3>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="avg">(4.50)</span>
                                    </div>
                                    <h4 class="price">$19.00<del>$32.00</del></h4>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="shop-item">
                                <div class="shop-thumb">
                                    <a href="shop-details.html">
                                        <img src="public/assets/img/shop/shop_img08.jpg" alt="img">
                                    </a>
                                    <ul class="list-wrap shop-action">
                                        <li><a href="shop-details.html"><i class="fas fa-shopping-cart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-heart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="shop-content">
                                    <h3 class="title"><a href="shop-details.html">Online Makeup Tutorial</a></h3>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="avg">(5.00)</span>
                                    </div>
                                    <h4 class="price">$49.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="shop-item">
                                <div class="shop-thumb">
                                    <a href="shop-details.html">
                                        <img src="public/assets/img/shop/shop_img09.jpg" alt="img">
                                    </a>
                                    <span class="flash-sale">Sale</span>
                                    <ul class="list-wrap shop-action">
                                        <li><a href="shop-details.html"><i class="fas fa-shopping-cart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-heart"></i></a></li>
                                        <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="shop-content">
                                    <h3 class="title"><a href="shop-details.html">The Bad Feelings</a></h3>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="avg">(4.80)</span>
                                    </div>
                                    <h4 class="price">$49.00<del>$69.00</del></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details-area-end -->

@endsection