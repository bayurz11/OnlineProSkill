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
                <div class="col-lg-7">
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
                                        <a href="{{ route('classroomdetail', $item['id']) }}"> <img
                                                src="{{ asset('public/uploads/' . $item['gambar']) }}" alt="img"></a>
                                    </td>
                                    <td class="product__name">
                                        <a href="{{ route('classroomdetail', $item['id']) }}">{{ $item['name'] }}</a>
                                    </td>
                                    <td class="product__price">Rp.{{ $item['price'] }}</td>
                                    <td class="product__quantity" style="text-align: left;">
                                        {{ $item['quantity'] }}
                                    </td>
                                    <td class="product__subtotal">Rp.{{ $item['price'] * $item['quantity'] }}</td>
                                    <td class="product__remove">
                                        <a href="{{ route('cart.remove', $item['id']) }}">×</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-5">
                    <div class="cart__collaterals-wrap">
                        <h2 class="title">Total Keranjang</h2>
                        <ul class="list-wrap">
                            @foreach ($cart as $item)
                                <li class="cart-item" style="display: flex; align-items: center; margin-bottom: 10px;">
                                    <a href="{{ route('cart.remove', $item['id']) }}"
                                        style="margin-right: 10px; color: red; text-decoration: none;">×</a>
                                    <a href="{{ route('classroomdetail', $item['id']) }}" style="margin-right: 10px;">
                                        <img src="{{ asset('public/uploads/' . $item['gambar']) }}" alt="img"
                                            style="width: 50px; height: 50px;">
                                    </a>
                                    <div class="cart-details" style="display: flex; flex-direction: column;">
                                        <a href="{{ route('classroomdetail', $item['id']) }}">{{ $item['name'] }}</a>
                                        <span class="cart-price">Rp.{{ number_format($item['price'], 0, ',', '.') }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="cart-summary" style="margin-top: 20px;">
                            <div class="subtotal"
                                style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>Subtotal</span>
                                <span>Rp.{{ number_format(array_sum(array_column($cart, 'price')), 0, ',', '.') }}</span>
                            </div>
                            <div class="total" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>Total</span>
                                <span
                                    class="amount">Rp.{{ number_format(array_sum(array_column($cart, 'price')), 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('checkout') }}" class="btn">Bayar & Gabung Kelas</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
