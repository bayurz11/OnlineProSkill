<!DOCTYPE html>
<html lang="en">
<!--<< Header Area >>-->

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="ProSkill Akademia BERKOMITMEN membantu memudahkan Anda menguasai TEKNOLOGI KOMPUTER dengan CEPAT dan BIAYA TERJANGKAU. Pembelajaran dengan metode PRAKTEK dan dibimbing langsung oleh INSTRUKTUR yang KOMPETEN.">
    <meta name="keywords"
        content="Proskill, Proskill Akademia, teknologi komputer, kursus komputer, proskill akademia, proskill, kursus komputer tanjungpinang">
    <meta name="author" content="ProSkill Akademia">
    <meta property="og:url" content="https://proskill.sch.id/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="ProSkill Akademia">
    <meta property="og:description"
        content="ProSkill Akademia BERKOMITMEN membantu memudahkan Anda menguasai TEKNOLOGI KOMPUTER dengan CEPAT dan BIAYA TERJANGKAU. Pembelajaran dengan metode PRAKTEK dan dibimbing langsung oleh INSTRUKTUR yang KOMPETEN.">
    <meta property="og:image" content="public/assets/img/favicon.png">
    <meta name="google-site-verification" content="hCMbf-C99zBHv278k_biSK9VKVvC8tMprI1k7Dl7NkQ" />
    <!-- ======== Page title ============ -->
    <title>@yield('title')</title>
    @include('layout.partials.head')

</head>

<body>

    <!-- Preloader Start -->
    @include('layout.partials.PreloaderStart')

    <!-- Offcanvas Area Start -->
    @include('layout.partials.OffcanvasAreaStart')
    <div class="offcanvas__overlay"></div>

    <!-- Header Top Section Start -->
    @include('layout.partials.HeaderTopSectionStart')

    <!-- Header Section Start -->
    @include('layout.partials.HeaderSectionStart')

    @yield('content')
    <!--<< Footer Section Start >>-->
    @include('layout.partials.footer')

    @include('layout.partials.footer-scripts')

</body>

</html>
