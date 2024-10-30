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
                                    <li class="{{ Request::is('event') ? 'active' : '' }}">
                                        <a href="{{ route('event') }}">Event</a>
                                    </li>
                                    <li class="{{ Request::is('blog') ? 'active' : '' }}">
                                        <a href="{{ route('blog') }}">Artikel</a>
                                    </li>
                                    {{-- <li class="menu-item-has-children {{ Request::is('#') ? 'active' : '' }}">
                                        <a href="#">Profil</a>
                                        <ul class="sub-menu">
                                            <li class="{{ Request::is('about-us') ? 'active' : '' }}">
                                                <a href="about-us.html">Tantang Kami</a>
                                            </li>
                                            <li class="{{ Request::is('login') ? 'active' : '' }}">
                                                <a href="login.html">Contoh Sertifikat</a>
                                            </li>
                                            <li class="{{ Request::is('registration') ? 'active' : '' }}">
                                                <a href="registration.html">Brosur</a>
                                            </li>
                                            <li class="{{ Request::is('404') ? 'active' : '' }}">
                                                <a href="404.html">Hubungi kami</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>

                            <div class="tgmenu__search d-none d-md-block">
                                <form action="{{ route('search') }}" method="GET" class="tgmenu__search-form">
                                    {{-- <div class="select-grp">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.992 13.25C10.5778 13.25 10.242 13.5858 10.242 14C10.242 14.4142 10.5778 14.75 10.992 14.75V13.25ZM16.992 14.75C17.4062 14.75 17.742 14.4142 17.742 14C17.742 13.5858 17.4062 13.25 16.992 13.25V14.75ZM14.742 11C14.742 10.5858 14.4062 10.25 13.992 10.25C13.5778 10.25 13.242 10.5858 13.242 11H14.742ZM13.242 17C13.242 17.4142 13.5778 17.75 13.992 17.75C14.4062 17.75 14.742 17.4142 14.742 17H13.242ZM1 6.4H1.75H1ZM1 1.6H1.75H1ZM6.4 1V1.75V1ZM7 1.6H6.25H7ZM6.4 7V6.25V7ZM1 16.4H1.75H1ZM1 11.6H1.75H1ZM6.4 11V11.75V11ZM7 11.6H6.25H7ZM6.4 17V17.75V17ZM1.6 17V17.75V17ZM11 6.4H11.75H11ZM11 1.6H11.75H11ZM11.6 1V0.25V1ZM16.4 1V1.75V1ZM17 1.6H17.75H17ZM17 6.4H17.75H17ZM16.4 7V6.25V7ZM10.992 14.75H13.992V13.25H10.992V14.75ZM16.992 13.25H13.992V14.75H16.992V13.25ZM14.742 14V11H13.242V14H14.742ZM13.242 14V17H14.742V14H13.242ZM1.75 6.4V1.6H0.25V6.4H1.75ZM1.75 1.6C1.75 1.63978 1.7342 1.67794 1.70607 1.70607L0.645406 0.645406C0.392232 0.89858 0.25 1.24196 0.25 1.6H1.75ZM1.70607 1.70607C1.67794 1.7342 1.63978 1.75 1.6 1.75V0.25C1.24196 0.25 0.89858 0.392232 0.645406 0.645406L1.70607 1.70607ZM1.6 1.75H6.4V0.25H1.6V1.75ZM6.4 1.75C6.36022 1.75 6.32207 1.7342 6.29393 1.70607L7.35459 0.645406C7.10142 0.392231 6.75804 0.25 6.4 0.25V1.75ZM6.29393 1.70607C6.2658 1.67793 6.25 1.63978 6.25 1.6H7.75C7.75 1.24196 7.60777 0.898581 7.35459 0.645406L6.29393 1.70607ZM6.25 1.6V6.4H7.75V1.6H6.25ZM6.25 6.4C6.25 6.36022 6.2658 6.32207 6.29393 6.29393L7.35459 7.35459C7.60777 7.10142 7.75 6.75804 7.75 6.4H6.25ZM6.29393 6.29393C6.32207 6.2658 6.36022 6.25 6.4 6.25V7.75C6.75804 7.75 7.10142 7.60777 7.35459 7.35459L6.29393 6.29393ZM6.4 6.25H1.6V7.75H6.4V6.25ZM1.6 6.25C1.63978 6.25 1.67793 6.2658 1.70607 6.29393L0.645406 7.35459C0.898581 7.60777 1.24196 7.75 1.6 7.75V6.25ZM1.70607 6.29393C1.7342 6.32207 1.75 6.36022 1.75 6.4H0.25C0.25 6.75804 0.392231 7.10142 0.645406 7.35459L1.70607 6.29393ZM1.75 16.4V11.6H0.25V16.4H1.75ZM1.75 11.6C1.75 11.6398 1.7342 11.6779 1.70607 11.7061L0.645406 10.6454C0.392231 10.8986 0.25 11.242 0.25 11.6H1.75ZM1.70607 11.7061C1.67793 11.7342 1.63978 11.75 1.6 11.75V10.25C1.24196 10.25 0.898581 10.3922 0.645406 10.6454L1.70607 11.7061ZM1.6 11.75H6.4V10.25H1.6V11.75ZM6.4 11.75C6.36022 11.75 6.32207 11.7342 6.29393 11.7061L7.35459 10.6454C7.10142 10.3922 6.75804 10.25 6.4 10.25V11.75ZM6.29393 11.7061C6.2658 11.6779 6.25 11.6398 6.25 11.6H7.75C7.75 11.242 7.60777 10.8986 7.35459 10.6454L6.29393 11.7061ZM6.25 11.6V16.4H7.75V11.6H6.25ZM6.25 16.4C6.25 16.3602 6.2658 16.3221 6.29393 16.2939L7.35459 17.3546C7.60777 17.1014 7.75 16.758 7.75 16.4H6.25ZM6.29393 16.2939C6.32207 16.2658 6.36022 16.25 6.4 16.25V17.75C6.75804 17.75 7.10142 17.6078 7.35459 17.3546L6.29393 16.2939ZM6.4 16.25H1.6V17.75H6.4V16.25ZM1.6 16.25C1.63978 16.25 1.67793 16.2658 1.70607 16.2939L0.645406 17.3546C0.898581 17.6078 1.24196 17.75 1.6 17.75V16.25ZM1.70607 16.2939C1.7342 16.3221 1.75 16.3602 1.75 16.4H0.25C0.25 16.758 0.392231 17.1014 0.645406 17.3546L1.70607 16.2939ZM11.75 6.4V1.6H10.25V6.4H11.75ZM11.75 1.6C11.75 1.63978 11.7342 1.67793 11.7061 1.70607L10.6454 0.645406C10.3922 0.898581 10.25 1.24196 10.25 1.6H11.75ZM11.7061 1.70607C11.6779 1.7342 11.6398 1.75 11.6 1.75V0.25C11.242 0.25 10.8986 0.392231 10.6454 0.645406L11.7061 1.70607ZM11.6 1.75H16.4V0.25H11.6V1.75ZM16.4 1.75C16.3602 1.75 16.3221 1.7342 16.2939 1.70607L17.3546 0.645406C17.1014 0.392231 16.758 0.25 16.4 0.25V1.75ZM16.2939 1.70607C16.2658 1.67793 16.25 1.63978 16.25 1.6H17.75C17.75 1.24196 17.6078 0.898581 17.3546 0.645406L16.2939 1.70607ZM16.25 1.6V6.4H17.75V1.6H16.25ZM16.25 6.4C16.25 6.36022 16.2658 6.32207 16.2939 6.29393L17.3546 7.35459C17.6078 7.10142 17.75 6.75804 17.75 6.4H16.25ZM16.2939 6.29393C16.3221 6.2658 16.3602 6.25 16.4 6.25V7.75C16.758 7.75 17.1014 7.60777 17.3546 7.35459L16.2939 6.29393ZM16.4 6.25H11.6V7.75H16.4V6.25ZM11.6 6.25C11.6398 6.25 11.6779 6.2658 11.7061 6.29393L10.6454 7.35459C10.8986 7.60777 11.242 7.75 11.6 7.75V6.25ZM11.7061 6.29393C11.7342 6.32207 11.75 6.36022 11.75 6.4H10.25C10.25 6.75804 10.3922 7.10142 10.6454 7.35459L11.7061 6.29393Z"
                                                fill="currentcolor" />
                                        </svg>
                                        <select class="form-select" name="category_id" id="course-cat"
                                            aria-label="Default select example" style="width: 150px">
                                            <option value="">Kategori</option>
                                            @foreach ($categori as $category)
                                                @if ($category->status == 1)
                                                    <option value="{{ $category->id }}">{{ $category->name_category }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="input-grp">
                                        <input type="text" name="search_term" placeholder="Pencarian Kursus . . .">
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
                                        {{-- <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                            <ul class="navigation">
                                                <li class="menu-item-has-children">
                                                    <a href="#">
                                                        <img src="{{ $profile ? asset('public/uploads/' . $profile->gambar) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                            alt="img" width="50" height="50"
                                                            style="border-radius: 50%;">
                                                    </a>


                                                    <ul class="sub-menu">
                                                        <li>
                                                            <a class="dropdown-item">
                                                                <b>{{ $user->name }}</b>
                                                                <br>
                                                                <span
                                                                    style="font-size: 14px; color: #b2b2b2;">{{ $user->email }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="{{ Request::is('profil') ? 'active' : '' }}">
                                                            <a href="{{ route('profil') }}">Profil</a>
                                                        </li>
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
                                        </div> --}}

                                        <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                            <ul class="navigation">
                                                <li class="menu-item-has-children">
                                                    <a href="#">
                                                        <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                            alt="img" width="50" height="50"
                                                            style="border-radius: 50%; object-fit: cover;">
                                                    </a>
                                                    <ul class="sub-menu" style="left: 15; right: 20;">
                                                        {{-- <li>
                                                            <a class="dropdown-item">
                                                                <b>{{ Str::limit($user->name, 10) }}</b>
                                                                <br>
                                                                <span style="font-size: 14px; color: #b2b2b2;">{{ Str::limit($user->email, 10) }}</span>
                                                            </a>
                                                        </li> --}}
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
                                    <input type="text" placeholder="Pencarian Kursus...">
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
<!-- Model instruktur -->
@if (Auth::check() && Auth::user()->userRole->role_id == 2)
    @include('instruktur.modal.modalcreateCourse')
    @include('instruktur.modal.modalKurikulum')
    {{-- @include('instruktur.modal.modalKurikulumedit') --}}
    @include('instruktur.modal.materiModal')
@endif



<!-- header-area-end -->
