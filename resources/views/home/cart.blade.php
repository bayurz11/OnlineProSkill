@extends('layout.mainlayout')

@section('title', 'ProSkill Akademia | Cart')
<?php $page = 'Cart'; ?>

@section('content')
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

    <div class="cart__area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <table class="table cart__table">
                        <thead>
                            <tr>
                                <th class="product__thumb">&nbsp;</th>
                                <th class="product__name">Kursus</th>
                                <th class="product__price">Harga</th>
                                <th class="product__quantity">Quantity</th>
                                <th class="product__subtotal">Subtotal</th>
                                <th class="product__remove">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <td class="product__thumb">
                                        <a href="shop-details.html"> <img
                                                src="{{ asset('public/uploads/' . $item['gambar']) }}"alt="img"></a>
                                    </td>
                                    <td class="product__name">
                                        <a href="shop-details.html">{{ $item['name'] }}</a>
                                    </td>
                                    <td class="product__price">Rp.{{ $item['price'] }}</td>
                                    <td class="product__quantity">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="{{ $item['quantity'] }}">
                                        </div>
                                    </td>
                                    <td class="product__subtotal">Rp.{{ $item['price'] * $item['quantity'] }}</td>
                                    <td class="product__remove">
                                        <a href="#">×</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="cart__collaterals-wrap">
                        <h2 class="title">Total keranjang</h2>
                        <ul class="list-wrap">
                            <li>Subtotal <span>Rp.{{ array_sum(array_column($cart, 'price')) }}</span></li>
                            <li>Total <span class="amount">Rp.{{ array_sum(array_column($cart, 'price')) }}</span></li>
                        </ul>
                        <a href="check-out.html" class="btn">Bayar & Gabung kelas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
