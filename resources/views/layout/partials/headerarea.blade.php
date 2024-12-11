<!-- header-area -->
<header>
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area tg-header__style-two">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tgmenu__wrap">
                        <nav class="tgmenu__nav">
                            <div class="logo">
                                <a href="{{ route('/') }}"><img src="{{ asset('public/assets/img/logo/logo.svg') }}"
                                        alt="Logo"></a>
                            </div>
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                <ul class="navigation">
                                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                                        <a href="{{ route('/') }}"> Beranda</a>
                                    </li>
                                    <li
                                        class="menu-item-has-children {{ Request::is('classroom', 'course', 'pbi') ? 'active' : '' }}">
                                        <a href="#">Program</a>
                                        <ul class="sub-menu">

                                            <li class="{{ Request::is('pbi') ? 'active' : '' }}">
                                                <a href="{{ route('pbi') }}">Bootcamp</a>
                                            </li>
                                            <li class="{{ Request::is('classroom') ? 'active' : '' }}">
                                                <a href="{{ route('classroom') }}">Kelas Tatap Muka</a>
                                            </li>
                                            <li class="{{ Request::is('course') ? 'active' : '' }}">
                                                <a href="{{ route('course') }}">Kelas Online</a>
                                            </li>
                                            <li class="{{ Request::is('konsultasi') ? 'active' : '' }}">
                                                <a href="{{ route('konsultasi') }}"> In-house Training</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="{{ Request::is('produk') ? 'active' : '' }}">
                                        <a href="{{ route('produk') }}">Produk</a>
                                    </li>
                                    <li class="{{ Request::is('blog') ? 'active' : '' }}">
                                        <a href="{{ route('blog') }}">Tutorial</a>
                                    </li>

                                </ul>
                            </div>

                            <div class="tgmenu__search d-none d-md-block">
                                <form action="{{ route('search') }}" method="GET" class="tgmenu__search-form">
                                    <div class="input-grp">
                                        <input type="text" name="search_term" placeholder="Cari Kelas, Produk ..."
                                            class="form-control w-90">
                                        <button type="submit"><i class="flaticon-search"></i></button>
                                    </div>
                                </form>
                            </div>


                            <div class="tgmenu__action tgmenu__action-two">
                                <ul class="list-wrap">
                                    <li class="mini-cart-icon">
                                        <a href="{{ route('cart.view') }}" class="cart-count">
                                            <img src="{{ asset('public/assets/img/icons/cart.svg') }}"
                                                class="injectable" alt="img">
                                            <span
                                                class="mini-cart-count">{{ array_sum(array_column($cart, 'quantity')) }}</span>
                                            {{-- <span class="mini-cart-count">0</span> --}}
                                        </a>
                                    </li>
                                    @auth

                                        @include('home.notifikasi.notif')
                                    @endauth
                                    @php
                                        use Illuminate\Support\Str;
                                    @endphp
                                    @auth


                                        <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                            <ul class="navigation">
                                                <li class="menu-item-has-children">
                                                    <a href="#">
                                                        <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                            alt="img" width="50" height="50"
                                                            style="border-radius: 50%; object-fit: cover;">
                                                    </a>
                                                    <ul class="sub-menu" style="left: 15; right: 20;">

                                                        @if (auth()->user() && auth()->user()->userRole->role_id == 3)
                                                            <li
                                                                class="{{ Request::is('akses_pembelian') ? 'active' : '' }}">
                                                                <a href="{{ route('akses_pembelian') }}">Akses
                                                                    Pembelian</a>
                                                            </li>
                                                            <li class="{{ Request::is('profil') ? 'active' : '' }}">
                                                                <a href="{{ route('profil') }}">Profil</a>
                                                            </li>
                                                        @endif
                                                        {{-- Tambahkan item menu jika role = 2 --}}
                                                        @if (auth()->user() && auth()->user()->userRole->role_id == 2)
                                                            <li
                                                                class="{{ Request::is('instruktur_profile') ? 'active' : '' }}">
                                                                <a href="{{ route('instruktur_profile') }}">My Profile</a>
                                                            </li>
                                                            <li
                                                                class="{{ Request::is('instruktur_courses') ? 'active' : '' }}">
                                                                <a href="{{ route('instruktur_courses') }}">Courses</a>
                                                            </li>
                                                        @endif

                                                        <li>
                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                            <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                Logout
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>


                                    @endauth
                                    @guest
                                        <li class="header-btn login-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="btn"
                                                style="background-color: white; color: black; border: 1px solid black;">Masuk</a>
                                        </li>
                                        <li class="header-btn login-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalDaftar"
                                                class="btn">Daftar</a>
                                        </li>
                                    @endguest
                                </ul>
                            </div>

                            <div class="mobile-chart">
                                <a href="{{ route('cart.view') }}" class="cart-count" role="button">
                                    <img src="{{ asset('public/assets/img/icons/cart.svg') }}" class="injectable"
                                        alt="img">
                                    <span
                                        class="mini-cart-count">{{ array_sum(array_column($cart, 'quantity')) }}</span>
                                </a>
                            </div>

                            @auth
                                <div class="mobile-menu-dropdown dropdown">
                                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                            alt="img"
                                            style="border-radius: 50%; width: 40px; height: 40px; object-fit: cover;">

                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if (auth()->user() && auth()->user()->userRole->role_id == 2)
                                            <li class="dropdown-item ">
                                                <a href="{{ route('instruktur_profile') }}">My Profile</a>
                                            </li>
                                            <li class="dropdown-item ">
                                                <a href="{{ route('instruktur_courses') }}">Courses</a>
                                            </li>
                                        @endif
                                        @if (auth()->user() && auth()->user()->userRole->role_id == 3)
                                            <li><a class="dropdown-item" href="{{ route('akses_pembelian') }}">Akses
                                                    Pembelian</a></li>
                                            <li><a class="dropdown-item" href="{{ route('profil') }}">Profil</a></li>
                                        @endif
                                        <li><a class="dropdown-item"
                                                href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endauth

                            <div class="mobile-nav-toggler">
                                <i class="tg-flaticon-menu-1"></i>
                            </div>

                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn">
                                <i class="tg-flaticon-close-1"></i>
                            </div>
                            <div class="nav-logo">
                                <a href="index.html">
                                    <img src="{{ asset('public/assets/img/logo/logo.svg') }}" alt="Logo">
                                </a>
                            </div>
                            <div class="tgmobile__search">
                                <form action="{{ route('search') }} " method="GET">
                                    <input type="text" placeholder="Pencarian Kursus dan Produk...">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div class="tgmobile__menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>

                            <div class="social-links">
                                <ul class="list-wrap">
                                    <li>
                                        <a href="https://www.instagram.com/proskillakademia/?igsh=MTJzdjNteGNrMGVpOA%3D%3D"
                                            target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/company/proskill-akademia/" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/channel/UCNw50VFi4Rdmv1WpKlWGHUQ"
                                            target="_blank">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @guest
                                <div class="auth-links" style="text-align: center; margin-top: 10px;">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="btn"
                                        style="background-color: white; color: black; border: 0px solid black;">Masuk</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalDaftar"
                                        class="btn btn-secondary">Daftar</a>
                                </div>
                            @endguest
                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
</header>
@include('home.modal.login')
@include('home.modal.logincart')
@include('home.modal.register')
@include('home.modal.registerinstruktur')
@include('home.modal.registercart')
@include('home.modal.forgotpassword')
<!-- Model instruktur -->
@if (Auth::check() && Auth::user()->userRole->role_id == 2)
    @include('instruktur.modal.modalcreateCourse')
    @include('instruktur.modal.modalKurikulum')
    {{-- @include('instruktur.modal.modalKurikulumedit') --}}
    @include('instruktur.modal.materiModal')
@endif



<!-- header-area-end -->
