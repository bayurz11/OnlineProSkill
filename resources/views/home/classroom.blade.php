@section('title', 'ProSkill Akademia | Kelas Tatap Muka')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')
    <!-- main-area -->
    <main class="main-area fix">

        <!-- breadcrumb-area -->
        <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb__content">
                            <h3 class="title">Kelas Tatap Muka</h3>
                            <nav class="breadcrumb">
                                <span property="itemListElement" typeof="ListItem">
                                    <a href="{{ route('/') }}">Beranda</a>
                                </span>
                                <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                                <span property="itemListElement" typeof="ListItem">Kelas Tatap Muka</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
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
        </section>
        <!-- breadcrumb-area-end -->

        <!-- all-courses -->
        <section class="all-courses-area section-py-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="courses-top-wrap courses-top-wrap">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="courses-top-left">
                                        <p>Showing 250 total results</p>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div
                                        class="d-flex justify-content-center justify-content-md-end align-items-center flex-wrap">
                                        <div class="courses-top-right m-0 ms-md-auto">
                                            <span class="sort-by">Sort By:</span>
                                            <div class="courses-top-right-select">
                                                <select name="orderby" class="orderby">
                                                    <option value="Most Popular">Most Popular</option>
                                                    <option value="popularity">popularity</option>
                                                    <option value="average rating">average rating</option>
                                                    <option value="latest">latest</option>
                                                    <option value="latest">latest</option>
                                                </select>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs courses__nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="grid-tab" data-bs-toggle="tab"
                                                    data-bs-target="#grid" type="button" role="tab"
                                                    aria-controls="grid" aria-selected="true">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 1H2C1.44772 1 1 1.44772 1 2V6C1 6.55228 1.44772 7 2 7H6C6.55228 7 7 6.55228 7 6V2C7 1.44772 6.55228 1 6 1Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M16 1H12C11.4477 1 11 1.44772 11 2V6C11 6.55228 11.4477 7 12 7H16C16.5523 7 17 6.55228 17 6V2C17 1.44772 16.5523 1 16 1Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6 11H2C1.44772 11 1 11.4477 1 12V16C1 16.5523 1.44772 17 2 17H6C6.55228 17 7 16.5523 7 16V12C7 11.4477 6.55228 11 6 11Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M16 11H12C11.4477 11 11 11.4477 11 12V16C11 16.5523 11.4477 17 12 17H16C16.5523 17 17 16.5523 17 16V12C17 11.4477 16.5523 11 16 11Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="list-tab" data-bs-toggle="tab"
                                                    data-bs-target="#list" type="button" role="tab"
                                                    aria-controls="list" aria-selected="false">
                                                    <svg width="19" height="15" viewBox="0 0 19 15"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.5 6C0.67 6 0 6.67 0 7.5C0 8.33 0.67 9 1.5 9C2.33 9 3 8.33 3 7.5C3 6.67 2.33 6 1.5 6ZM1.5 0C0.67 0 0 0.67 0 1.5C0 2.33 0.67 3 1.5 3C2.33 3 3 2.33 3 1.5C3 0.67 2.33 0 1.5 0ZM1.5 12C0.67 12 0 12.68 0 13.5C0 14.32 0.68 15 1.5 15C2.32 15 3 14.32 3 13.5C3 12.68 2.33 12 1.5 12ZM5.5 14.5H17.5C18.05 14.5 18.5 14.05 18.5 13.5C18.5 12.95 18.05 12.5 17.5 12.5H5.5C4.95 12.5 4.5 12.95 4.5 13.5C4.5 14.05 4.95 14.5 5.5 14.5ZM5.5 8.5H17.5C18.05 8.5 18.5 8.05 18.5 7.5C18.5 6.95 18.05 6.5 17.5 6.5H5.5C4.95 6.5 4.5 6.95 4.5 7.5C4.5 8.05 4.95 8.5 5.5 8.5ZM4.5 1.5C4.5 2.05 4.95 2.5 5.5 2.5H17.5C18.05 2.5 18.5 2.05 18.5 1.5C18.5 0.95 18.05 0.5 17.5 0.5H5.5C4.95 0.5 4.5 0.95 4.5 1.5Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="grid" role="tabpanel"
                                aria-labelledby="grid-tab">
                                <div
                                    class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb01.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Development</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.8 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Learning JavaScript With
                                                        Imagination</a></h5>
                                                <p class="author">By <a href="#">David Millar</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$15.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb02.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Design</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.5 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">The Complete Graphic
                                                        Design for Beginners</a></h5>
                                                <p class="author">By <a href="#">Jenny Wilson</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$19.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb03.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Marketing</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.3 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Learning Digital
                                                        Marketing on Facebook</a></h5>
                                                <p class="author">By <a href="#">Wade Warren</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$24.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb04.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Business</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.8 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Financial Analyst
                                                        Training & Investing Course</a></h5>
                                                <p class="author">By <a href="#">Robert Fox</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$12.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb05.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Data Science</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.5 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Data Analysis &
                                                        Visualization Masterclass</a></h5>
                                                <p class="author">By <a href="#">Guy Hawkins</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$27.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb06.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Mathematic</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.7 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Master the Fundamentals
                                                        of Math</a></h5>
                                                <p class="author">By <a href="#">Sawpawlo Mark</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$10.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb07.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Business</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.8 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">How To Build A Localized
                                                        Website With Hugo And Strapi</a></h5>
                                                <p class="author">By <a href="#">David Millar</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$11.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb08.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Desing</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.5 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Designing Effective
                                                        Pricing Plans UX</a></h5>
                                                <p class="author">By <a href="#">Sawpawlo Mark</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$17.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb09.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Language</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.6 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Accelerating UX Maturity
                                                        With A Breakthrough Project</a></h5>
                                                <p class="author">By <a href="#">David Millar</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$22.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb10.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Creative</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.7 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Demystifying The New
                                                        Gatsby Framework</a></h5>
                                                <p class="author">By <a href="#">Jack & Jon</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$29.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb11.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Data</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.8 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Voice Control Usability
                                                        Considerations For Partially</a></h5>
                                                <p class="author">By <a href="#">Lily Rebeca</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$12.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb12.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Finance</a>
                                                    </li>
                                                    <li class="avg-rating"><i class="fas fa-star"></i> (4.5 Reviews)</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Things I Wish I’d Known
                                                        Earlier In My Career</a></h5>
                                                <p class="author">By <a href="#">Sawpawlo Mark</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    <h5 class="price">$9.00</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <nav class="pagination__wrap mt-30">
                                    <ul class="list-wrap">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="courses.html">2</a></li>
                                        <li><a href="courses.html">3</a></li>
                                        <li><a href="courses.html">4</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                                <div class="row courses__list-wrap row-cols-1">
                                    <div class="col">
                                        <div class="courses__item courses__item-three shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb01.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Development</a>
                                                        <div class="avg-rating">
                                                            <i class="fas fa-star"></i> (4.8 Reviews)
                                                        </div>
                                                    </li>
                                                    <li class="price"><del>$29.00</del>$15.00</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Resolving Conflicts
                                                        Between Designers And Engineers</a></h5>
                                                <p class="author">By <a href="#">David Millar</a></p>
                                                <p class="info">when an unknown printer took a galley of type and
                                                    scrambled type specimen book It has survived not only.</p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item courses__item-three shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb02.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Design</a>
                                                        <div class="avg-rating">
                                                            <i class="fas fa-star"></i> (4.5 Reviews)
                                                        </div>
                                                    </li>
                                                    <li class="price">$41.00</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Powerful Image
                                                        Optimization Tools for this year</a></h5>
                                                <p class="author">By <a href="#">Jenny Wilson</a></p>
                                                <p class="info">when an unknown printer took a galley of type and
                                                    scrambled type specimen book It has survived not only.</p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item courses__item-three shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb03.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Marketing</a>
                                                        <div class="avg-rating">
                                                            <i class="fas fa-star"></i> (4.6 Reviews)
                                                        </div>
                                                    </li>
                                                    <li class="price"><del>$24.00</del>$12.00</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Learning JavaScript With
                                                        Imagination</a></h5>
                                                <p class="author">By <a href="#">Wade Warren</a></p>
                                                <p class="info">when an unknown printer took a galley of type and
                                                    scrambled type specimen book It has survived not only.</p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item courses__item-three shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb04.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Finance</a>
                                                        <div class="avg-rating">
                                                            <i class="fas fa-star"></i> (4.9 Reviews)
                                                        </div>
                                                    </li>
                                                    <li class="price"><del>$32.00</del>$19.00</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">Resolving Conflicts
                                                        Between Designers And Engineers</a></h5>
                                                <p class="author">By <a href="#">Robert Fox</a></p>
                                                <p class="info">when an unknown printer took a galley of type and
                                                    scrambled type specimen book It has survived not only.</p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item courses__item-three shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb05.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Data Science</a>
                                                        <div class="avg-rating">
                                                            <i class="fas fa-star"></i> (4.7 Reviews)
                                                        </div>
                                                    </li>
                                                    <li class="price"><del>$50.00</del>$40.00</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">A Look At Remix And The
                                                        Differences With Next.js</a></h5>
                                                <p class="author">By <a href="#">Guy Hawkins</a></p>
                                                <p class="info">when an unknown printer took a galley of type and
                                                    scrambled type specimen book It has survived not only.</p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item courses__item-three shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb06.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Mathematic</a>
                                                        <div class="avg-rating">
                                                            <i class="fas fa-star"></i> (4.8 Reviews)
                                                        </div>
                                                    </li>
                                                    <li class="price"><del>$30.00</del>$19.00</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">An Accessibility-First
                                                        Approach To Chart Visual</a></h5>
                                                <p class="author">By <a href="#">Sawpawlo Mark</a></p>
                                                <p class="info">when an unknown printer took a galley of type and
                                                    scrambled type specimen book It has survived not only.</p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="courses__item courses__item-three shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="course-details.html" class="shine__animate-link">
                                                    <img src="public/assets/img/courses/course_thumb07.jpg"
                                                        alt="img">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="course.html">Development</a>
                                                        <div class="avg-rating">
                                                            <i class="fas fa-star"></i> (4.6 Reviews)
                                                        </div>
                                                    </li>
                                                    <li class="price">$11.00</li>
                                                </ul>
                                                <h5 class="title"><a href="course-details.html">How To Build A Localized
                                                        Website With Hugo And Strapi</a></h5>
                                                <p class="author">By <a href="#">Robert Fox</a></p>
                                                <p class="info">when an unknown printer took a galley of type and
                                                    scrambled type specimen book It has survived not only.</p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="course-details.html">
                                                            <span class="text">Enroll Now</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <nav class="pagination__wrap mt-30">
                                    <ul class="list-wrap">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="courses.html">2</a></li>
                                        <li><a href="courses.html">3</a></li>
                                        <li><a href="courses.html">4</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- all-courses-end -->

    </main>
    <!-- main-area-end -->
@endsection
