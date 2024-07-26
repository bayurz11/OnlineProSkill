@section('title', 'ProSkill Akademia | Event')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')


    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Event</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Event</span>
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

    <!-- event-area -->
    <section class="event__area-two section-py-120">
        <div class="container">
            <div class="event__inner-wrap">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb01.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">The Accessible Target Sizes Cheatsheet</a>
                                </h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>United Kingdom</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb02.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">Aewe Creating Futures Through
                                        Technology</a></h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>Tokyo Japan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb03.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">Exactly How Technology Can Make Reading</a>
                                </h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>Colorado</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb04.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">Learning JavaScript With Imagination</a>
                                </h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>Alexander City</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb05.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">Make Your Magnificent May 2023
                                        Edition</a></h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>Alaska</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb06.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">Accessible Target Sizes Cheatsheet</a>
                                </h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>Estes Park</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb07.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">Color mechanics that he came up with
                                        during</a></h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>Walsenburg</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="event__item shine__animate-item">
                            <div class="event__item-thumb">
                                <a href="events-details.html" class="shine__animate-link"><img
                                        src="assets/img/events/event_thumb08.jpg" alt="img"></a>
                            </div>
                            <div class="event__item-content">
                                <span class="date">25 June, 2024</span>
                                <h2 class="title"><a href="events-details.html">How To Design Effective User
                                        Onboarding</a></h2>
                                <a href="https://maps.google.com/maps" class="location" target="_blank"><i
                                        class="flaticon-map"></i>New Work</a>
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
    </section>
    <!-- event-area-end -->

@endsection
