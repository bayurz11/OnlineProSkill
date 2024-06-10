<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="ProSkill Akademia - Lembaga kursus komputer terbaik untuk pengembangan kemampuan teknologi Anda. Temukan layanan kursus yang dipersonalisasi dan berorientasi pada kebutuhan Anda.">
    <meta name="keywords"
        content="Proskill, Proskill Akademia, teknologi komputer, kursus komputer, proskill akademia, proskill, kursus komputer tanjungpinang">
    <meta name="author" content="Lembaga kursus komputer | ProSkill Akademia">
    <meta property="og:type" content="website">
    <meta property="og:title" content="ProSkill Akademia - Lembaga kursus komputer terbaik">
    <meta property="og:description"
        content="ProSkill Akademia adalah lembaga kursus komputer terkemuka yang menyediakan layanan kursus terbaik dalam pengembangan keterampilan teknologi.">
    <meta property="og:image" content="assets/img/preview-banner.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://proskill.sch.id/">
    @include('layout.partials.admin.head_admin')
    <!-- Favicon -->
    <link rel="shortcut icon" href="public/assets_admin/images/favicon.png" />
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

    <!-- core:js -->
    <script src="{{ asset('public/assets_admin/vendors/core/core.js') }}"></script>
    <!-- inject:js -->
    <script src="{{ asset('public/assets_admin/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/assets_admin/js/template.js') }}"></script>
    <!-- endinject -->

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

        // Tampilkan pesan keberhasilan
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            showNotification(successMessage);
        }

        // Tampilkan pesan kesalahan
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            showNotification(errorMessage);
        }
    </script>
</head>

<body>
    <div class="main-wrapper">

        @include('layout.partials.admin.nav_admin')
        <div class="page-wrapper">
            @include('layout.partials.admin.header_admin')
            @yield('content')
            @include('layout.partials.admin.footer_admin-scripts')
        </div>
    </div>
</body>

</html>
