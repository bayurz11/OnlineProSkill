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
