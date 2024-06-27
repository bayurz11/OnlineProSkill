@section('title', 'ProSkill Akademia | Checkout')
<?php $page = 'Checkout'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Checkout</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Checkout</span>
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

    <!-- checkout-area -->
    <div class="checkout__area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon__code-wrap">
                        <div class="coupon__code-info">
                            <span><i class="far fa-bookmark"></i> Punya kupon?</span>
                            <a href="#" id="coupon-element">Klik di sini untuk memasukkan kode Anda</a>
                        </div>
                        <form action="#" class="coupon__code-form">
                            <p>Jika Anda memiliki kode kupon, silakan gunakan di bawah ini.</p>
                            <input type="text" placeholder="Coupon code">
                            <button type="submit" class="btn">Terapkan kupon</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="#" class="customer__form-wrap">
                        <span class="title">RINCIAN PENAGIHAN</span>

                        <div class="form-grp">
                            <label for="company-name">Nama *</label>
                            <input type="text" id="company-name">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-grp">
                                    <label for="phone">Phone *</label>
                                    <input type="number" id="phone" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-grp">
                                    <label for="email">Email address *</label>
                                    <input type="email" id="email">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="order__info-wrap">
                        <h2 class="title">PESANAN ANDA</h2>
                        <ul class="list-wrap">
                            <li class="title">Kelas <span>Subtotal</span></li>
                            <li>{{ $courses->nama_kursus }}<span>Rp.
                                    {{ number_format($courses->price, 0, ',', '.') }}</span></li>
                            <li>Subtotal <span>Rp. {{ number_format($courses->price, 0, ',', '.') }}</span></li>
                            <li>Total <span>Rp. {{ number_format($courses->price, 0, ',', '.') }}</span></li>
                        </ul>
                        {{-- <p>Sorry, it seems that there are no available payment methods for your state. Please contact us if
                            you require assistance or wish to make alternate arrangements.</p>
                        <p>Your personal data will be used to process your order, support your experience throughout this
                            website, and for other purposes described in our <a href="#">privacy policy.</a></p> --}}
                        <button class="btn">Bayar & gabung kelas</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area-end -->


@endsection
