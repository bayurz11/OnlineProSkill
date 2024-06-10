<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... (other meta and link tags) ... -->

    <title>Proskill Akademia | Login</title>

    <!-- ... (other styles and scripts) ... -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets_admin/vendors/core/core.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('public/assets_admin/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets_admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('public/assets_admin/css/demo1/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('public/assets_admin/images/favicon.png') }}" />
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
                                            <a href="{{ route('login') }}"
                                                class="noble-ui-logo d-block mb-2">ProSkill<span>Akademia</span></a>
                                            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.
                                            </h5>
                                        </div>
                                        <form class="forms-sample" method="POST" action="api/login">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email" autofocus>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    autocomplete="current-password" placeholder="Password"
                                                    name="password">
                                            </div>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="authCheck">
                                                <label class="form-check-label" for="authCheck">Remember me</label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-primary me-2 mb-3 mb-md-0 text-white"
                                                    id="login-button">Login</button>
                                            </div>
                                            <script>
                                                function adjustButtonWidth() {
                                                    const button = document.getElementById('login-button');
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
                                                <a href="{{ route('registrasi') }}" class="d-block mt-3 text-muted">Not
                                                    a user? Sign up</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Optionally, you can add an image or any other content in this column
                                <div class="col-md-4 d-none d-md-block">
                                    <img src="path/to/your/image.jpg" alt="Login image" class="img-fluid">
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</body>

</html>
