@section('title', 'ProSkill Akademia | Materi Pelajaran')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
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
                            <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
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
                test

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
                        img.style.width = '120px';
                        img.style.height = '120px';
                        img.style.objectFit = 'cover';
                    };
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
