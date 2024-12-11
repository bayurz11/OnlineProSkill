<div class="modal fade" id="exampleModallupaPassword" tabindex="-1" aria-labelledby="exampleModallupaPasswordLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModallupaPasswordLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="singUp-wrap">
                    <h2 class="title">Lupa Password ProSkill</h2>
                    <p>Silahkan isi form berikut untuk melanjutkan.</p>

                    <form action="{{ route('forgotPassword.update') }}" method="POST" enctype="multipart/form-data"
                        class="instructor__profile-form" id="forgotpassword">
                        @csrf

                        <div class="form-grp">
                            <input type="email" id="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-grp position-relative">
                            <input type="password" id="password" placeholder="Password" name="password">
                            <i class="toggle-password bi bi-eye position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                onclick="togglePasswordVisibility('password', this)"></i>
                        </div>
                        <div class="form-grp position-relative">
                            <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                                name="password_confirmation">
                            <i class="toggle-password bi bi-eye position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                onclick="togglePasswordVisibility('password_confirmation', this)"></i>
                        </div>
                        <span>Password minimal 8 karakter terdiri simbol, huruf, dan angka</span>
                        <button class="g-recaptcha btn btn-two arrow-btn"
                            data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                            data-callback="onSubmitForgotPassword" data-action='submit'>Reset Password
                            <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                class="injectable">
                        </button>
                    </form>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    function togglePasswordVisibilityforgot(inputId, iconElement) {
        const passwordField = document.getElementById(inputId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            iconElement.classList.remove('bi-eye');
            iconElement.classList.add('bi-eye-slash');
        } else {
            passwordField.type = 'password';
            iconElement.classList.remove('bi-eye-slash');
            iconElement.classList.add('bi-eye');
        }
    }
</script> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
