@extends('layout.mainlayout')

@section('title', 'ProSkill Akademia | Cart')
<?php $page = 'Cart'; ?>

@section('content')
    <section class="breadcrumb__area breadcrumb__bg" data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <!-- Breadcrumb section content -->
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
                                    <td class="product__quantity">{{ $item['quantity'] }}</td>
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
                        <h2 class="title">Total keranjang</h2>
                        <ul class="list-wrap">
                            <li>Subtotal <span>Rp.{{ array_sum(array_column($cart, 'price')) }}</span></li>
                            <li>Total <span class="amount">Rp.{{ array_sum(array_column($cart, 'price')) }}</span></li>
                            <li>Jumlah Quantity <span>{{ array_sum(array_column($cart, 'quantity')) }}</span></li>
                        </ul>
                        <a href="" class="btn">Bayar & Gabung kelas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
