@extends('layout.mainlayoutbootcamp')

@section('title', 'ProSkill Akademia | Cart')
<?php $page = 'Cart'; ?>

@section('content')
    <div class="cart__area section-py-120">
        <div class="container">
            <div class="row">


                @if (count($cart) > 0)
                    <div class="col-lg-7">
                        <table class="table cart__table">
                            <thead>
                                <tr>
                                    <th class="product__thumb">&nbsp;</th>
                                    <th class="product__name">Kelas</th>
                                    <th class="product__price">Harga</th>
                                    <th class="product__remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td class="product__thumb">
                                            <a href="{{ route('classroomdetail', $item['id']) }}">
                                                <img src="{{ $item['gambar'] ? asset('public/uploads/' . $item['gambar']) : asset('public/assets/img/shop/shop_img01.jpg') }}"
                                                    alt="">
                                            </a>
                                        </td>
                                        <td class="product__name">
                                            <a href="{{ route('classroomdetail', $item['id']) }}">{{ $item['name'] }}</a>
                                        </td>
                                        <td class="product__price">Rp {{ number_format($item['price'], 0, ',', ',') }}</td>

                                        <td class="product__remove">
                                            <form action="{{ route('cart_bootcamp.remove', $item['id']) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn-remove"
                                                    style="background:none; border:none; color:rgb(20, 20, 20); cursor:pointer;">x</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="col-lg-7">
                        <p>Keranjang Anda kosong. <a href="{{ route('search') }}">Lihat kelas yang
                                tersedia.</a></p>
                    </div>
                @endif

                @if (count($cart) > 0)
                    <div class="col-lg-5">
                        <div class="cart__collaterals-wrap">
                            <h2 class="title">Total keranjang</h2>

                            @php
                                // Cek apakah user sudah pernah melakukan order
                                $biayaPendaftaran = 20000; // Biaya pendaftaran default
                                if (Auth::check()) {
                                    // Cari apakah user sudah pernah melakukan order
                                    $userOrders = \App\Models\Order::where('user_id', Auth::id())
                                        ->where('status', '!=', 'canceled')
                                        ->exists();

                                    // Jika user sudah pernah order, set biaya pendaftaran menjadi 0
                                    if ($userOrders) {
                                        $biayaPendaftaran = 0;
                                    }
                                }

                                $totalPrice = array_sum(array_column($cart, 'price')); // Total harga keranjang
                                $totalPriceWithPendaftaran = $totalPrice + $biayaPendaftaran; // Total dengan biaya pendaftaran
                            @endphp

                            <ul class="list-wrap">
                                <li>Jumlah Quantity <span>{{ array_sum(array_column($cart, 'quantity')) }}</span></li>
                                <li>Total Produk <span class="amount">Rp
                                        {{ number_format($totalPrice, 0, ',', ',') }}</span></li>
                                <li>Biaya Pendaftaran <span class="amount">Rp
                                        {{ number_format($biayaPendaftaran, 0, ',', ',') }}</span></li>
                                <li>Total <span class="amount">Rp
                                        {{ number_format($totalPriceWithPendaftaran, 0, ',', ',') }}</span></li>
                            </ul>

                            @auth
                                <form action="{{ route('payment') }}" class="customer__form-wrap" method="POST">
                                    @csrf
                                    @foreach ($cart as $item)
                                        <input type="hidden" name="cart_items[]" value="{{ $item['id'] }}">
                                    @endforeach

                                    <input type="hidden" name="biaya_pendaftaran" value="{{ $biayaPendaftaran }}">

                                    <div class="form-grp">
                                        <label for="name">Nama *</label>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label for="phone">Telepon *</label>
                                                <input type="number" id="phone" name="phone" min="0" required
                                                    value="{{ $profile->phone_number }}" maxlength="12"
                                                    placeholder="08**********">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label for="email">Alamat Email *</label>
                                                <input type="email" id="email" name="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn">Bayar</button>
                                </form>
                            @else
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#registerbootcampcart">
                                    Bayar
                                </button>
                            @endauth
                        </div>
                    </div>
                @else
                    <p></p>
                @endif


            </div>

        </div>
    </div>

    @include('home.modal.login')
    @include('home.modal.logincart')
    @include('home.modal.register')
    @include('home.modal.registerbootcampcart')
@endsection
