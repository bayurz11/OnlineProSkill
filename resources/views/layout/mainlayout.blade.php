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
</head>

<body>

    <!--Preloader-->
    @include('layout.partials.Preloader')
    <!--Preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="tg-flaticon-arrowhead-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('layout.partials.headerarea')
    <!-- header-area-end -->

    <!-- main-area -->
    <main class="main-area fix">

        @yield('content')

    </main>
    <!-- main-area-end -->


    <!-- Whatsapp popup -->
    <div id="whatsapp-popup"
        style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 9999; cursor: move;"
        ontouchstart="handleTouchStart(event)" ontouchmove="handleTouchMove(event)">
        <a href="https://wa.me/6281266187125?" target="_blank">
            <img src="public/assets/img/whatsapp.png" alt="WhatsApp Icon" style="width: 50px; height: auto;"
                loading="lazy">
        </a>
        <div id="popup-message"
            style="display: none; position: absolute; top: -50px; left: -160px; background-color: #fff; padding: 10px; border: 1px solid #ccc;">
            hubungi Whatsapp kami
        </div>
    </div>

    <script>
        var initialX, initialY;
        var popup = document.getElementById('whatsapp-popup');
        var messagePopup = document.getElementById('popup-message');
        var isDragging = false;

        function showMessage() {
            messagePopup.style.display = 'block';
            setTimeout(function() {
                messagePopup.style.display = 'none';
            }, 2000);
        }

        function handleTouchStart(event) {
            isDragging = false;
            var touch = event.targetTouches[0];
            initialX = touch.clientX - parseInt(window.getComputedStyle(popup).getPropertyValue('left'));
            initialY = touch.clientY - parseInt(window.getComputedStyle(popup).getPropertyValue('top'));
        }

        function handleTouchMove(event) {
            if (!isDragging) return;
            var touch = event.targetTouches[0];
            var newX = touch.clientX - initialX;
            var newY = touch.clientY - initialY;
            popup.style.left = newX + 'px';
            popup.style.top = newY + 'px';
        }

        document.addEventListener('touchend', function() {
            isDragging = false;
        });

        setTimeout(function() {
            popup.style.display = 'block';
            showMessage();
        }, 300);
    </script>
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
