<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description"
        content="ProSkill Akademia BERKOMITMEN membantu memudahkan Anda menguasai TEKNOLOGI KOMPUTER dengan CEPAT dan BIAYA TERJANGKAU. Pembelajaran dengan metode PRAKTEK dan dibimbing langsung oleh INSTRUKTUR yang KOMPETEN.">
    <meta name="keywords"
        content="Proskill, Proskill Akademia, teknologi komputer, kursus komputer, proskill akademia, proskill, kursus komputer tanjungpinang">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="public/assets/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/flaticon-skillgro.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/flaticon-skillgro-new.css ') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/default-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/tg-cursor.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">
    @if (session('success'))
        <div id="success-message" class="notify alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="notify alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <style>
        .notify {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none;
            opacity: 0;
            transition: opacity 0.3s, top 0.3s;
        }

        .notify.show {
            display: block;
            opacity: 1;
            top: 50px;
        }

        .notify.alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .notify.alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
    </style>

    <script>
        // Fungsi untuk menampilkan notifikasi
        function showNotification(element) {
            if (element) {
                element.classList.add('show');
                // Tunggu 3 detik kemudian hilangkan pesan
                setTimeout(function() {
                    element.classList.remove('show');
                }, 3000);
            }
        }

        // Ambil elemen pesan keberhasilan
        var successMessage = document.getElementById('success-message');
        // Ambil elemen pesan kesalahan
        var errorMessage = document.getElementById('error-message');

        // Tampilkan pesan keberhasilan
        showNotification(successMessage);

        // Tampilkan pesan kesalahan
        showNotification(errorMessage);
    </script>
</head>

<body>

    <!--Preloader-->
    @include('layout.partials.Preloader')
    <!--Preloader-end -->

    <!-- Whatsapp popup -->
    @include('layout.partials.whatsapp')

    <!-- header-area -->
    @include('layout.partials.headerarea')
    <!-- header-area-end -->

    <!-- main-area -->
    <main class="main-area fix">

        @yield('content')

    </main>
    <!-- main-area-end -->



    <!-- footer-area -->
    @include('layout.partials.footerarea')
    <!-- footer-area-end -->




    <!-- JS here -->
    <script src="{{ asset('public/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.odometer.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('public/assets/js/tween-max.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/tg-cursor.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/vivus.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('public/assets/js/svg-inject.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.circleType.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/plyr.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/aos.js') }}"></script>
    <script src="{{ asset('public/assets/js/main.js') }}"></script>

    <script>
        SVGInject(document.querySelectorAll("img.injectable"));
    </script>
</body>

</html>
