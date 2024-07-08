@extends('layout.mainlayout')

@section('title', 'ProSkill Akademia | Cart')
<?php $page = 'Cart'; ?>

@section('content')
    {{-- <section class="breadcrumb__area breadcrumb__bg" data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <!-- Breadcrumb section content -->
    </section> --}}

    <div class="cart__area section-py-120">
        <div class="container">
            <div class="row">
                @auth
                    @if (count($cart) > 0)
                        <div class="col-12">
                            <div class="coupon__code-wrap">
                                <div class="coupon__code-info">
                                    <span><i class="far fa-bookmark"></i> Punya kupon?</span>
                                    <a href="#" id="coupon-element">Klik di sini untuk memasukkan kode Anda</a>
                                </div>
                                <form action="#" class="coupon__code-form">
                                    <p>Jika Anda memiliki kode kupon, silakan gunakan di bawah ini.</p>
                                    <input type="text" placeholder="Kode kupon">
                                    <button type="submit" class="btn">Terapkan kupon</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                @endauth
                @auth
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
                                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
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
                        <tr>
                            <td colspan="5">
                                <p>Keranjang Anda kosong. <a href="{{ route('classroom') }}">Lihat kelas yang
                                        tersedia.</a></p>
                            </td>
                        </tr>
                    @endif
                @endauth

                @guest
                    <div class="col-12">
                        <div class="coupon__code-wrap">
                            <div class="coupon__code-info">
                                <span>Sudah memiliki akun?</span>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalchart">Klik di sini untuk
                                    Masuk</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="singUp-wrap">
                            <h2 class="title">Buat Akun ProSkill</h2>
                            <p>Silahkan isi form berikut untuk melanjutkan.</p>

                            <form action="{{ route('guestregister') }}" class="account__form" method="POST" id="guestregister">
                                @csrf
                                <div class="form-grp">
                                    <input type="text" id="name" name="name"
                                        placeholder="Masukkan Nama Lengkap Anda">
                                </div>
                                <div class="form-grp">
                                    <input type="email" id="email" placeholder="Email" name="email">
                                </div>
                                <div class="form-grp">
                                    <input type="phone" id="phone_number" placeholder="08**********" name="phone_number"
                                        maxlength="12">
                                </div>
                                <div class="form-grp">
                                    <input type="password" id="password" placeholder="Password" name="password">
                                </div>
                                <div class="form-grp">
                                    <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                                        name="password_confirmation">
                                </div>
                                <button class="g-recaptcha btn btn-two arrow-btn"
                                    data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                                    data-callback="onSubmitguestregister" data-action='submit'>
                                    Daftar
                                    <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                        class="injectable">
                                </button>
                            </form><br>
                            <div class="account__social">
                                <a href="{{ route('oauth.google') }}" class="account__social-btn">
                                    <img src="{{ asset('public/assets/img/icons/google.svg') }}" alt="img">
                                    Daftar Dengan Google
                                </a>
                            </div>

                        </div>
                    </div>
                @endguest

                <div class="col-lg-5">
                    <div class="cart__collaterals-wrap">
                        <h2 class="title">Total keranjang</h2>
                        @if (count($cart) > 0)
                            <ul class="list-wrap">

                                {{-- <li>Jumlah Quantity <span>{{ array_sum(array_column($cart, 'quantity')) }}</span></li> --}}
                                <li>Subtotal
                                    <span>Rp
                                        {{ number_format(array_sum(array_column($cart, 'price')), 0, ',', ',') }}</span>
                                </li>
                                <li>Total <span class="amount">Rp
                                        {{ number_format(array_sum(array_column($cart, 'price')), 0, ',', ',') }}</span>
                                </li>
                            </ul>
                            <form action="{{ route('payment') }}" class="customer__form-wrap" method="POST">
                                @csrf
                                @foreach ($cart as $item)
                                    <input type="hidden" name="cart_items[]" value="{{ $item['id'] }}">
                                @endforeach

                                <div class="form-grp" hidden>
                                    <label for="name">Nama *</label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-grp" hidden>
                                            <label for="phone">Telepon *</label>
                                            <input type="number" id="phone" name="phone" min="0" required
                                                value="{{ $profile->phone_number }}" maxlength="12"
                                                placeholder="08**********">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-grp" hidden>
                                            <label for="email">Alamat Email *</label>
                                            <input type="email" id="email" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn">Bayar & gabung kelas</button>
                            </form>
                        @else
                            <p>
                            </p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
