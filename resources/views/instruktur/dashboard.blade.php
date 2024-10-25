@section('title', 'ProSkill Akademia | Dashboard Instruktur')
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

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            @include('instruktur.nav.profile')

            <div class="row">
                @include('instruktur.nav.navbar')
                <div class="col-lg-9">
                    <div class="dashboard__content-wrap dashboard__content-wrap-two mb-60">
                        <div class="dashboard__content-title">
                            <h4 class="title">Dashboard</h4>
                        </div>
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-8">
                                <div class="dashboard__counter-item">
                                    <div class="icon">
                                        <i class="skillgro-group"></i>
                                    </div>
                                    <div class="content">
                                        <span class="count odometer" data-count="160"></span>
                                        <p>TOTAL STUDENTS</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-8">
                                <div class="dashboard__counter-item">
                                    <div class="icon">
                                        <i class="skillgro-notepad"></i>
                                    </div>
                                    <div class="content">
                                        <span class="count odometer" data-count="{{ $kelastatapmukaCount }}"></span>
                                        <p>TOTAL COURSES</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="dashboard__counter-item">
                                    <div class="icon">
                                        <i class="skillgro-dollar-currency-symbol"></i>
                                    </div>
                                    <div class="content">
                                        <span class="count odometer" data-count="29000"></span>
                                        <p>TOTAL EARNINGS</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">My Courses</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="dashboard__review-table">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Course Name</th>
                                                <th>Enrolled</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="course-details.html">Accounting</a>
                                                </td>
                                                <td>
                                                    <p class="color-black">50</p>
                                                </td>
                                                <td>
                                                    <div class="review__wrap">
                                                        <div class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="course-details.html">Marketing</a>
                                                </td>
                                                <td>
                                                    <p class="color-black">43</p>
                                                </td>
                                                <td>
                                                    <div class="review__wrap">
                                                        <div class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="course-details.html">Web Design</a>
                                                </td>
                                                <td>
                                                    <p class="color-black">36</p>
                                                </td>
                                                <td>
                                                    <div class="review__wrap">
                                                        <div class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="course-details.html">Graphic</a>
                                                </td>
                                                <td>
                                                    <p class="color-black">22</p>
                                                </td>
                                                <td>
                                                    <div class="review__wrap">
                                                        <div class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="load-more-btn text-center mt-20">
                            <a href="#" class="link-btn">Browse All Course <img src="assets/img/icons/right_arrow.svg"
                                    alt="" class="injectable"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- dashboard-area-end -->

@endsection
