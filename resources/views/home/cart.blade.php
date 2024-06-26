a@section('title', 'ProSkill Akademia | Cart')
<?php $page = 'Cart'; ?>

@extends('layout.mainlayout')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Cart</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Cart</span>
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

    <!-- cart-area -->
    <div class="cart__area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <table class="table cart__table">
                        <thead>
                            <tr>
                                <th class="product__thumb">&nbsp;</th>
                                <th class="product__name">Produk</th>
                                <th class="product__price">Harga</th>
                                {{-- <th class="product__quantity">Quantity</th> --}}
                                <th class="product__subtotal">Subtotal</th>
                                <th class="product__remove">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="product__thumb">
                                    <a href="shop-details.html"><img src="{{ asset('public/uploads/' . $courses->gambar) }}"
                                            alt=""></a>
                                </td>
                                <td class="product__name">
                                    <a href="shop-details.html">{{ $courses->nama_kursus }}</a>
                                </td>
                                <td class="product__price">Rp. {{ number_format($courses->price, 0, ',', '.') }}</td>
                                {{-- <td class="product__quantity">
                                    <div class="cart-plus-minus">
                                        <input type="text" value="1">
                                    </div>
                                </td> --}}
                                <td class="product__subtotal">Rp. {{ number_format($courses->price, 0, ',', '.') }}</td>
                                <td class="product__remove">
                                    <a href="#">×</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product__thumb">
                                    <a href="shop-details.html"><img
                                            src="{{ asset('public/assets/img/shop/shop_img02.jpg') }}" alt=""></a>
                                </td>
                                <td class="product__name">
                                    <a href="shop-details.html">Time to Explore</a>
                                </td>
                                <td class="product__price">$19.00</td>
                                <td class="product__quantity">
                                    <div class="cart-plus-minus">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="product__subtotal">$19.00</td>
                                <td class="product__remove">
                                    <a href="#">×</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="cart__actions">
                                    <form action="#" class="cart__actions-form">
                                        <input type="text" placeholder="Coupon code">
                                        <button type="submit" class="btn">Apply coupon</button>
                                    </form>
                                    <div class="update__cart-btn text-end f-right">
                                        <button type="submit" class="btn">Update cart</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="cart__collaterals-wrap">
                        <h2 class="title">Cart totals</h2>
                        <ul class="list-wrap">
                            <li>Subtotal <span>$32.00</span></li>
                            <li>Total <span class="amount">$32.00</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="btn">Bayar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area-end -->
@endsection
