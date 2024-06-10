<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags, title, and other head contents -->
    <title>Proskill Akademia | Login</title>
    <link rel="stylesheet" href="{{ asset('public/assets_admin/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets_admin/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets_admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets_admin/css/demo1/style.css') }}">
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
                                        <form class="forms-sample" id="login-form">
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
                                                <button type="button"
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

                                        <div id="success-message" class="notify alert alert-success" role="alert"
                                            style="display: none;"></div>
                                        <div id="error-message" class="notify alert alert-danger" role="alert"
                                            style="display: none;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        function showNotification(element, message) {
            if (element) {
                element.textContent = message;
                element.classList.add('show');
                // Tunggu 3 detik kemudian hilangkan pesan
                setTimeout(function() {
                    element.classList.remove('show');
                }, 3000);
            }
        }

        document.getElementById('login-button').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showNotification(document.getElementById('success-message'), data.message);
                        setTimeout(function() {
                            window.location.href = data.redirect;
                        }, 3000);
                    } else {
                        showNotification(document.getElementById('error-message'), data.message ||
                            'Login gagal');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification(document.getElementById('error-message'), 'Terjadi kesalahan');
                });
        });
    </script>

    <!-- core:js -->
    <script src="{{ asset('public/assets_admin/vendors/core/core.js') }}"></script>
    <script src="{{ asset('public/assets_admin/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/assets_admin/js/template.js') }}"></script>
</body>

</html>
