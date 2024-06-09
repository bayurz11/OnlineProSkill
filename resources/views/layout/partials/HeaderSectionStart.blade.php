<!-- Header Section Start -->
<header id="header-sticky" class="header-3">
    <div class="container">
        <div class="mega-menu-wrapper">
            <div class="header-main style-2">
                <div class="header-left">
                    <div class="logo">
                        <a href="{{ route('/') }}" class="header-logo">
                            <img src="{{ asset('public/assets/img/logo/logo.svg') }}" alt="logo-img">
                        </a>
                    </div>
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="{{ Request::is('/') ? 'active' : '' }}" style="margin-right: 50px;">
                                        <a href="{{ url('/') }}"> <span
                                                {{ Request::is('/') ? 'style=color:#028E83;' : '' }}>Beranda</span></a>
                                    </li>

                                    <li class="{{ Request::is('kelas*') ? 'active' : '' }}">
                                        <a href="#"
                                            style="{{ Request::is('Kelastatapmuka', 'kelasOnline') ? 'color:#028E83;' : '' }}">
                                            Kelas
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li class="{{ Request::is('Kelastatapmuka') ? 'active' : '' }}">
                                                <a href="{{ url('Kelastatapmuka') }}">Kelas Tatap Muka</a>
                                            </li>
                                            <li class="{{ Request::is('kelasOnline') ? 'active' : '' }}">
                                                <a href="{{ url('kelasOnline') }}">Kelas Online</a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="{{ Request::is('event*') ? 'active' : '' }}">
                                        <a href="{{ url('event') }}"><span
                                                {{ Request::is('event') ? 'style=color:#028E83;' : '' }}>Event</span></a>
                                    </li>

                                    <li class="{{ Request::is('artikel*') ? 'active' : '' }}">
                                        <a href="{{ url('artikel') }}"><span
                                                {{ Request::is('artikel') ? 'style=color:#028E83;' : '' }}>Artikel</span></a>
                                    </li>
                                    <li class="{{ Request::is('lainnya*') ? 'active' : '' }}">
                                        <a href="#"
                                            style="{{ Request::is('tentangkami', 'hubungikami') ? 'color:#028E83;' : '' }}">
                                            Profil
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('tentangkami') }}">Tentang Kami</a></li>
                                            <li><a href="{{ route('contohsertifikat') }}">Contoh sertifikat </a></li>
                                            <li><a href="https://drive.google.com/file/d/1FiVmF5_hau_8xRKfvoM8Wel1tUezCzA_/view"
                                                    target="_blank">Brosur</a></li>
                                            <li><a href="{{ route('hubungikami') }}">Hubungi Kami</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center">
                    <div class="author-icon">
                        <div class="icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>

                        <div class="content">
                            <span>Whatsapp Admin sekarang</span>
                            <h5>
                                <a href="tel:+6281266187125">+62 8126 6187 125</a>
                            </h5>
                        </div>
                    </div>
                    <div class="header-button">
                        <a href="https://wa.me/6281266187125?text=Halo,%20saya%20mau%20konsultasi" class="theme-btn"
                            style="background-color: #028E83; color: white; padding: 20px 30px; border-radius: 10px; text-decoration: none;">
                            <span>
                                Hubungi Admin
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </span>
                        </a>
                    </div>
                    <div class="header__hamburger d-xl-none my-auto">
                        <div class="sidebar__toggle">
                            <i class="fas fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
