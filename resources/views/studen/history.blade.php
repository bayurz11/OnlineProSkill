@section('title', 'ProSkill Akademia | Profil Saya')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            <div class="dashboard__top-wrap">
                <div class="dashboard__top-bg" data-background="{{ asset('public/assets/img/bg/student_bg.jpg') }}"></div>
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="{{ $profile->gambar ? asset('public/uploads/' . $profile->gambar) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                alt="img" width="120" height="120">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ $user->name }}</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    5 Courses Enrolled
                                </li>
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon05.svg') }}" alt="img"
                                        class="injectable">
                                    4 Certificate
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">

                @include('studen.nav.nav')

                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">Riwayat Transaksi</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="dashboard__review-table">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Nama Kelas</th>
                                                <th>Tanggal</th>
                                                <th>Harga</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p>#5478</p>
                                                </td>
                                                <td>
                                                    <p>App Development</p>
                                                </td>
                                                <td>
                                                    <p>January 31, 2024</p>
                                                </td>
                                                <td>
                                                    <p>$99.99</p>
                                                </td>
                                                <td>
                                                    <span class="dashboard__quiz-result">Success</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>#4585</p>
                                                </td>
                                                <td>
                                                    <p>Graphic</p>
                                                </td>
                                                <td>
                                                    <p>February 03, 2024</p>
                                                </td>
                                                <td>
                                                    <p>$199.99</p>
                                                </td>
                                                <td>
                                                    <span class="dashboard__quiz-result processing">Processing</span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->

    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('profileImage');
                    img.src = e.target.result;
                    img.onload = function() {
                        // Set width and height attributes to 120x120
                        img.style.width = '120px';
                        img.style.height = '120px';
                        img.style.objectFit = 'cover'; // Optional: ensure the image covers the area
                    };
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
