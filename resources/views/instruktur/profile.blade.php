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

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            @include('instruktur.nav.profile')

            <div class="row">
                @include('instruktur.nav.navbar')

                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">My Profile</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="profile__content-wrap">
                                    <ul class="list-wrap">
                                        <li><span>Registration Date</span>
                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y h:i a') }}</li>

                                        <li><span>Username</span> {{ $user->name }}</li>
                                        <li><span>Email</span> {{ $user->email }}</li>
                                        <li><span>Phone Number</span> {{ $profile->phone_number }}</li>
                                        {{-- <li><span>Skill/Occupation</span> Application Developer</li>
                                        <li><span>Biography</span> I'm the Front-End Developer for #ThemeGenix in New York,
                                            OR. I have a serious passion for UI effects, animations, and
                                            creating intuitive, dynamic user experiences.</li> --}}
                                    </ul>
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
