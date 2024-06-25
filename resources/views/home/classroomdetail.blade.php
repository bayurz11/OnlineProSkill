@section('title', 'ProSkill Akademia | DetailKelas Tatap Muka')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-two"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('classroom') }}">Kelas Tatap Muka</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Resolving Conflicts Between Designers And
                                Engineers</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape01.svg') }}" alt="img" class="alltuchtopdown">
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

    <!-- courses-details-area -->
    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="courses__details-thumb">
                        <img src="public/assets/img/courses/courses_details.jpg" alt="img">
                    </div>
                    <div class="courses__details-content">

                        <h2 class="title">Resolving Conflicts Between Designers And Engineers</h2>
                        <div class="courses__details-meta">
                            <ul class="list-wrap">
                                <li class="author-two">
                                    <img src="public/assets/img/courses/course_author001.png" alt="img">
                                    By
                                    <a href="#">David Millar</a>
                                </li>
                                <li class="date"><i class="flaticon-calendar"></i>24/07/2024</li>
                                <li><i class="flaticon-mortarboard"></i>2,250 Students</li>
                            </ul>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview-tab-pane" type="button" role="tab"
                                    aria-controls="overview-tab-pane" aria-selected="true">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab"
                                    data-bs-target="#curriculum-tab-pane" type="button" role="tab"
                                    aria-controls="curriculum-tab-pane" aria-selected="false">Curriculum</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                aria-labelledby="overview-tab" tabindex="0">
                                <div class="courses__overview-wrap">
                                    <h3 class="title">Course Description</h3>
                                    <p>Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse ultrices gravida.
                                        Risus commodo viverra maecenas accumsan lacus vel facilisis.dolor sit amet,
                                        consectetur adipiscing elited do eiusmod tempor incididunt ut labore et dolore magna
                                        aliqua.</p>
                                    <h3 class="title">What you'll learn in this course?</h3>
                                    <p>Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse ultrices gravida.
                                        Risus commodo viverra maecenas accumsan.</p>
                                    <ul class="about__info-list list-wrap">
                                        <li class="about__info-list-item">
                                            <i class="flaticon-angle-right"></i>
                                            <p class="content">Work with color & Gradients & Grids</p>
                                        </li>
                                        <li class="about__info-list-item">
                                            <i class="flaticon-angle-right"></i>
                                            <p class="content">All the useful shortcuts</p>
                                        </li>
                                        <li class="about__info-list-item">
                                            <i class="flaticon-angle-right"></i>
                                            <p class="content">Be able to create Flyers, Brochures, Advertisements</p>
                                        </li>
                                        <li class="about__info-list-item">
                                            <i class="flaticon-angle-right"></i>
                                            <p class="content">How to work with Images & Text</p>
                                        </li>
                                    </ul>
                                    <p class="last-info">Morem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse
                                        ultrices gravida. Risus commodo viverra maecenas accumsan.Dorem ipsum dolor sit
                                        amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magn.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="curriculum-tab-pane" role="tabpanel"
                                aria-labelledby="curriculum-tab" tabindex="0">
                                <div class="courses__curriculum-wrap">
                                    <h3 class="title">Course Curriculum</h3>
                                    <p>Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse ultrices gravida.
                                        Risus commodo viverra maecenas accumsan.</p>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Introduction
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-wrap">
                                                        <li class="course-item open-item">
                                                            <a href="https://www.youtube.com/watch?v=b2Az7_lLh3g"
                                                                class="course-item-link popup-video">
                                                                <span class="item-name">Course Installation</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">03:03</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Create a Simple React App</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">React for the Rest of us</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">10:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Capacitance and Inductance
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-wrap">
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Course Installation</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Create a Simple React App</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">React for the Rest of us</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">10:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Final Audit
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-wrap">
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Course Installation</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">Create a Simple React App</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">07:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link">
                                                                <span class="item-name">React for the Rest of us</span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta duration">10:48</span>
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="public/assets/img/icons/lock.svg"
                                                                            alt="icon">
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="courses__details-sidebar">
                        <div class="courses__details-video">
                            <img src="public/assets/img/courses/course_thumb02.jpg" alt="img">
                            <a href="https://www.youtube.com/watch?v=YwrHGratByU" class="popup-video"><i
                                    class="fas fa-play"></i></a>
                        </div>
                        <div class="courses__cost-wrap">
                            <span>This Course Fee:</span>
                            <h2 class="title">$18.00 <del>$32.00</del></h2>
                        </div>
                        <div class="courses__information-wrap">
                            <h5 class="title">Course includes:</h5>
                            <ul class="list-wrap">
                                <li>
                                    <img src="public/assets/img/icons/course_icon01.svg" alt="img"
                                        class="injectable">
                                    Level
                                    <span>Expert</span>
                                </li>
                                <li>
                                    <img src="public/assets/img/icons/course_icon02.svg" alt="img"
                                        class="injectable">
                                    Duration
                                    <span>11h 20m</span>
                                </li>
                                <li>
                                    <img src="public/assets/img/icons/course_icon03.svg" alt="img"
                                        class="injectable">
                                    Lessons
                                    <span>12</span>
                                </li>
                                <li>
                                    <img src="public/assets/img/icons/course_icon04.svg" alt="img"
                                        class="injectable">
                                    Quizzes
                                    <span>145</span>
                                </li>
                                <li>
                                    <img src="public/assets/img/icons/course_icon05.svg" alt="img"
                                        class="injectable">
                                    Certifications
                                    <span>Yes</span>
                                </li>
                                <li>
                                    <img src="public/assets/img/icons/course_icon06.svg" alt="img"
                                        class="injectable">
                                    Graduation
                                    <span>25K</span>
                                </li>
                            </ul>
                        </div>
                        <div class="courses__payment">
                            <h5 class="title">Secure Payment:</h5>
                            <img src="public/assets/img/others/payment.png" alt="img">
                        </div>
                        <div class="courses__details-social">
                            <h5 class="title">Share this course:</h5>
                            <ul class="list-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                        <div class="courses__details-enroll">
                            <div class="tg-button-wrap">
                                <a href="{{ route('cart') }}" class="btn btn-two arrow-btn">
                                    Pesan Sekarang
                                    <img src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- courses-details-area-end -->

@endsection
