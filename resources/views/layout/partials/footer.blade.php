<!--<< Footer Section Start >>-->
<footer class="footer-section section-bg fix">

    <div class="frame-shape-3 float-bob-y">
        <img src="{{ asset('public/assets/img/frame-3.png') }}" alt="shape-img">
    </div>
    <div class="footer-widgets-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <a href="index.html">
                                <img src="{{ asset('public/assets/img/logo/logo.svg') }}" alt="logo-img">
                            </a>
                        </div>
                        <div class="footer-content style-two">
                            <p>
                                "ProSkill Akademia" BERKOMITMEN membantu memudahkan Anda menguasai TEKNOLOGI KOMPUTER
                                dengan CEPAT dan BIAYA TERJANGKAU.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Menu</h3>
                        </div>
                        <ul class="list-area">
                            <li>
                                <a href="{{ route('/') }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Beranda
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('Kelastatapmuka') }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Kelas Tatap Muka
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kelasOnline') }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Kelas Online
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('event') }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Event
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('artikel') }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Artikel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget style-margin">
                        <div class="widget-head">
                            <h3>Profile</h3>
                        </div>
                        <ul class="list-area">
                            <li>
                                <a href="{{ route('tentangkami') }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Tentang Kami
                                </a>
                            </li>
                            <li>
                                <a href="program-details.html">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Contoh Sertifikat
                                </a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/file/d/1FiVmF5_hau_8xRKfvoM8Wel1tUezCzA_/view"
                                    target="_blank">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Brosur
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('hubungikami') }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Hubungi Kami
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget style-margin">
                        <div class="widget-head">
                            <h3>Media Sosial</h3>
                        </div>
                        <div class="footer-content style-two">

                            <div class="social-icon d-flex align-items-center">
                                <a href="https://www.instagram.com/proskillakademia?igsh=MTJzdjNteGNrMGVpOA== "
                                    target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.linkedin.com/company/proskill-akademia/;" target="_blank"><i
                                        class="fa-brands fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/channel/UCNw50VFi4Rdmv1WpKlWGHUQ" target="_blank"><i
                                        class="fa-brands fa-youtube"></i></a>
                            </div>
                            {{-- <a href="https://wa.me/6281266187125?text=Halo,%20saya%20mau%20konsultasi"
                                data-animation="fadeInUp" data-delay="1.7s" class="theme-btn hover-white"
                                target="_blank">
                                Hubungi Admin
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="f-bottom-shape">
            <img src="{{ asset('public/assets/img/footer-bottom.png') }}" alt="shape-img">
        </div>
        <div class="container">
            <div class="footer-wrapper d-flex align-items-center justify-content-between">
                <p class="wow fadeInLeft color-2" data-wow-delay=".3s">
                    © All Copyright 2024 by <a href="{{ route('tentangkami') }}">Proskill Akademia</a>
                </p>
                <ul class="footer-menu wow fadeInRight" data-wow-delay=".5s">

                    <li>
                        <a href="contact.html">
                            Privacy Policy
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <a href="#" id="scrollUp" class="scroll-icon">
            <i class="far fa-arrow-up"></i>
        </a>
    </div>
</footer>
