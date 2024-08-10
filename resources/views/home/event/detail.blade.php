@section('title', 'ProSkill Akademia | Event Detail')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Event Detail</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('event') }}">Event</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">{{ $event->name }}</span>
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
    <!-- event-details-area -->
    <section class="event__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="event__details-thumb">
                        <img src="{{ asset('public/uploads/events/' . $event->gambar) }}" alt="img">
                    </div>
                    <div class="event__details-content-wrap">
                        <div class="row">
                            <div class="col-70">
                                <div class="event__details-content">
                                    {{-- <div class="event__details-content-top">
                                        <a href="courses.html" class="tag">Development</a>
                                        <span class="avg-rating"><i class="fas fa-star"></i>(4.8 Reviews)</span>
                                    </div> --}}
                                    <h2 class="title">{{ $event->name }}</h2>
                                    <div class="event__meta">
                                        <ul class="list-wrap">
                                            <li class="author">
                                                <img src="{{ asset('public/assets/img/courses/course_author001.png') }}"
                                                    alt="img">
                                                By
                                                <a href="instructor-details.html">{{ $event->user->name }}</a>
                                            </li>
                                            <li class="location"><i class="flaticon-placeholder"></i>{{ $event->lokasi }}
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="event__details-overview">
                                        <h4 class="title-two">Event Overview</h4>
                                        <p>Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse ultrices
                                            gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.dolor sit
                                            amet, consectetur adipiscing elited do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua.</p>
                                    </div>

                                    <div class="event__widget">
                                        <div class="event__map">
                                            <h4 class="title">Map</h4>
                                            <div class="map">
                                                <iframe src="{{ $event->link_maps }}" width="600" height="450"
                                                    style="border:0;" allowfullscreen="" loading="lazy"
                                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="event__details-overview">
                                        <h4 class="title-two">Event Overview</h4>
                                        <p>Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse ultrices
                                            gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.dolor sit
                                            amet, consectetur adipiscing elited do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua.</p>
                                    </div>
                                    <h4 class="title-two">What you'll learn in this event?</h4>
                                    <p>Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse ultrices gravida.
                                        Risus commodo viverra maecenas accumsan.</p>
                                    <div class="event__details-inner">
                                        <div class="row">
                                            <div class="col-39">
                                                <img src="{{ asset('public/assets/img/events/event_details_img02.jpg') }}"
                                                    alt="img">
                                            </div>
                                            <div class="col-61">
                                                <div class="event__details-inner-content">
                                                    <h4 class="title">Four major elements that we offer <br> for this event
                                                    </h4>
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
                                                            <p class="content">Be able to create Flyers, Brochures,
                                                                Advertisements</p>
                                                        </li>
                                                        <li class="about__info-list-item">
                                                            <i class="flaticon-angle-right"></i>
                                                            <p class="content">How to work with Images & Text</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Morem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua Quis ipsum suspendisse ultrices gravida.
                                        Risus commodo viverra maecenas accumsan.Dorem ipsum dolor sit amet, consectetur
                                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magn.</p> --}}
                                </div>
                            </div>
                            <div class="col-30">
                                <aside class="event__sidebar">
                                    <div class="event__widget">
                                        <div class="courses__details-sidebar">
                                            {{-- <div class="courses__cost-wrap">
                                                <span>Event Fee</span>
                                                <h2 class="title">$19.00</h2>
                                            </div> --}}
                                            <div class="courses__information-wrap">
                                                <h5 class="title">Event Information:</h5>
                                                <ul class="list-wrap">
                                                    <li>
                                                        <img src="{{ asset('public/assets/img/icons/calendar.svg') }}"
                                                            alt="img" class="injectable">
                                                        Tanggal
                                                        <span>{{ Carbon::parse($event->tgl)->format('d - M - Y') }}</span>
                                                    </li>
                                                    <li>
                                                        <img src="{{ asset('public/assets/img/icons/course_icon02.svg') }}"
                                                            alt="img" class="injectable">
                                                        Start Time
                                                        <span>10.00am</span>
                                                    </li>
                                                    <li>
                                                        <img src="{{ asset('public/assets/img/icons/course_icon05.svg') }}"
                                                            alt="img" class="injectable">
                                                        Certifications
                                                        <span>Yes</span>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="courses__details-social">
                                                <h5 class="title">Share this course:</h5>
                                                <ul class="list-wrap">
                                                    <!-- Facebook Share -->
                                                    <li>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                            target="_blank">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <!-- Twitter Share -->
                                                    <li>
                                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($event->name) }}"
                                                            target="_blank">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <!-- WhatsApp Share -->
                                                    <li>
                                                        <a href="https://api.whatsapp.com/send?text={{ urlencode($event->name) }}%20{{ urlencode(url()->current()) }}"
                                                            target="_blank">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </a>
                                                    </li>
                                                    <!-- Instagram Profile (Instagram tidak mendukung direct share links) -->
                                                    <li>
                                                        <a href="https://www.instagram.com/yourprofile" target="_blank">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                    <!-- YouTube Share -->
                                                    <li>
                                                        <a href="https://www.youtube.com/share?url={{ urlencode(url()->current()) }}"
                                                            target="_blank">
                                                            <i class="fab fa-youtube"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="courses__details-enroll">
                                                <div class="tg-button-wrap">
                                                    <a href="contact.html" class="btn arrow-btn">Join This Event <img
                                                            src="{{ asset('public/assets/img/icons/right_arrow.svg') }}"
                                                            alt="img" class="injectable"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="event__widget">
                                        <div class="event__map">
                                            <h4 class="title">Map</h4>
                                            <div class="map">
                                                <iframe
                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48409.69813174607!2d-74.05163325136718!3d40.68264649999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae694479a3%3A0xb9949385da52e69e!2sBarclays%20Center!5e0!3m2!1sen!2sbd!4v1684309529719!5m2!1sen!2sbd"
                                                    style="border:0;" allowfullscreen="" loading="lazy"
                                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                        </div>
                                    </div> --}}
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- event-details-area-end -->
@endsection
