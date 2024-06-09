<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Proskill Akademia | Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->


    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('public/assets_admin_admin/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('public/assets_admin/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets_admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('public/assets_admin/css/demo1/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('public/assets_admin/images/favicon.png') }}" />

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
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-4 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="auth-form-wrapper px-5 py-5">
                                        <div class="text-center">
                                            <a href="#"
                                                class="noble-ui-logo d-block mb-2">ProSkill<span>Akademia</span></a>
                                            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.
                                            </h5>
                                        </div>
                                        <form class="forms-sample" method="POST" action="/register">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    required autofocus placeholder="Masukkan nama anda">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Masukkan Email anda" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Masukkan password anda" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm
                                                    Password</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Konfirmasi Password Anda"
                                                    required>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-primary me-2 mb-3 mb-md-0 text-white"
                                                    id="register-button">Register</button>
                                            </div>

                                            <script>
                                                function adjustButtonWidth() {
                                                    const button = document.getElementById('register-button');
                                                    const screenWidth = window.innerWidth;

                                                    if (screenWidth <= 576) {
                                                        button.style.width = '100%';
                                                    } else if (screenWidth <= 768) {
                                                        button.style.width = '250px';
                                                    } else {
                                                        button.style.width = '375px';
                                                    }
                                                }
                                                window.onload = adjustButtonWidth;
                                                window.onresize = adjustButtonWidth;
                                            </script>

                                            <div class="text-center">
                                                <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Already
                                                    have an
                                                    account? Log in</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Optionally, you can add an image or any other content in this column
                                <div class="col-md-4 d-none d-md-block">
                                    <img src="path/to/your/image.jpg" alt="Register image" class="img-fluid">
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('public/assets_admin/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('public/assets_admin/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/assets_admin/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

</body>

</html>
