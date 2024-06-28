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


                @auth
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
                @endauth
                @auth
                    <div class="col-lg-7">
                        <form action="{{ route('payment') }}" class="customer__form-wrap" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $courses->id }}">
                            <span class="title">RINCIAN PENAGIHAN</span>

                            <div class="form-grp">
                                <label for="name">Nama *</label>
                                <input type="text" id="name" name="name">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <label for="phone">Telepon *</label>
                                        <input type="number" id="phone" name="phone" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <label for="email">Alamat Email *</label>
                                        <input type="email" id="email" name="email">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn">Bayar & gabung kelas</button>
                        </form>
                    </div>
                @endauth
                @guest
                    <div class="col-12">
                        <div class="coupon__code-wrap">
                            <div class="coupon__code-info">
                                <span></i> Sudah memiliki akun?</span>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Klik di sini untuk
                                    Masuk</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="singUp-wrap">
                            <h2 class="title">Buat Akun ProSkill</h2>
                            <p>Silahkan isi form berikut untuk melanjutkan.</p>

                            <form action="{{ route('guestregister', ['id' => $courses->id]) }}" class="account__form"
                                method="POST">
                                @csrf
                                <div class="form-grp">
                                    <input type="text" id="name" name="name"
                                        placeholder="Masukkan Nama Lengkap Anda">
                                </div>
                                <div class="form-grp">
                                    <input type="email" id="email" placeholder="Email" name="email">
                                </div>
                                <div class="form-grp">
                                    <input type="password" id="password" placeholder="Password" name="password">
                                </div>
                                <div class="form-grp">
                                    <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                                        name="password_confirmation">
                                </div>
                                <button type="submit" class="btn btn-two arrow-btn">Daftar<img
                                        src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                        class="injectable"></button>
                            </form><br>
                            <div class="account__social">
                                <a href="#" class="account__social-btn">
                                    <img src="{{ asset('public/assets/img/icons/google.svg') }}" alt="img">
                                    Daftar Dengan Google
                                </a>
                            </div>

                        </div>
                    </div>
                @endguest


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
                                        <span
                                            class="cart-price">Rp.{{ number_format($item['price'], 0, ',', '.') }}</span>
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
                            <div class="total"
                                style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>Total</span>
                                <span
                                    class="amount">Rp.{{ number_format(array_sum(array_column($cart, 'price')), 0, ',', '.') }}</span>
                            </div>
                            <a href="" class="btn">Bayar & Gabung Kelas</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
