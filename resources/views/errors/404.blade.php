@section('title', 'ProSkill Akademia | Halaman Tidak Ditemukan')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- error-area -->
    <section class="error-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="error-wrap text-center">
                        <div class="error-img">
                            <img src="public/assets/img/others/error_img.svg" alt="img" class="injectable">
                        </div>
                        <div class="error-content">
                            <h2 class="title">ERROR PAGE! <span>Sorry! This Page is Not Available!</span></h2>
                            <div class="tg-button-wrap">
                                <a href="{{ route('/') }}" class="btn arrow-btn">Go To Home Page <img
                                        src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- error-area-end -->


@endsection
