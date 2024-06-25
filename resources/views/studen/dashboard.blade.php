@section('title', 'ProSkill Akademia | Lembaga Kursus dan Pelatihan Komputer')
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
                <div class="dashboard__top-bg" data-background="public/assets/img/bg/student_bg.jpg"></div>
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="public/assets/img/courses/details_instructors02.jpg" alt="img">
                        </div>
                        <div class="content">
                            <h4 class="title">Emily Hannah</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="public/assets/img/icons/course_icon03.svg" alt="img" class="injectable">
                                    5 Courses Enrolled
                                </li>
                                <li>
                                    <img src="public/assets/img/icons/course_icon05.svg" alt="img" class="injectable">
                                    4 Certificate
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dashboard__instructor-info-right">
                        <a href="#" class="btn btn-two arrow-btn">Become an Instructor <img
                                src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard__sidebar-wrap">
                        <div class="dashboard__sidebar-title mb-20">
                            <h6 class="title">Welcome, Emily Hannah</h6>
                        </div>
                        <nav class="dashboard__sidebar-menu">
                            <ul class="list-wrap">
                                <li class="active">
                                    <a href="student-dashboard.html">
                                        <i class="fas fa-home"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="student-profile.html">
                                        <i class="skillgro-avatar"></i>
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="student-enrolled-courses.html">
                                        <i class="skillgro-book"></i>
                                        Enrolled Courses
                                    </a>
                                </li>
                                <li>
                                    <a href="student-wishlist.html">
                                        <i class="skillgro-label"></i>
                                        Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a href="student-review.html">
                                        <i class="skillgro-book-2"></i>
                                        Reviews
                                    </a>
                                </li>
                                <li>
                                    <a href="student-attempts.html">
                                        <i class="skillgro-question"></i>
                                        My Quiz Attempts
                                    </a>
                                </li>
                                <li>
                                    <a href="student-history.html">
                                        <i class="skillgro-satchel"></i>
                                        Order History
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="dashboard__sidebar-title mt-30 mb-20">
                            <h6 class="title">User</h6>
                        </div>
                        <nav class="dashboard__sidebar-menu">
                            <ul class="list-wrap">
                                <li>
                                    <a href="student-setting.html">
                                        <i class="skillgro-settings"></i>
                                        Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}">
                                        <i class="skillgro-logout"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </button> --}}
                <div class="col-lg-9">
                    <div class="dashboard__content-wrap dashboard__content-wrap-two">
                        <div class="dashboard__content-title">
                            <h4 class="title">Dashboard</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="dashboard__counter-item">
                                    <div class="icon">
                                        <i class="skillgro-book"></i>
                                    </div>
                                    <div class="content">
                                        <span class="count odometer" data-count="30"></span>
                                        <p>ENROLLED COURSES</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="dashboard__counter-item">
                                    <div class="icon">
                                        <i class="skillgro-tutorial"></i>
                                    </div>
                                    <div class="content">
                                        <span class="count odometer" data-count="10"></span>
                                        <p>ACTIVE COURSES</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="dashboard__counter-item">
                                    <div class="icon">
                                        <i class="skillgro-diploma-1"></i>
                                    </div>
                                    <div class="content">
                                        <span class="count odometer" data-count="7"></span>
                                        <p>COMPLETED COURSES</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->

@endsection
