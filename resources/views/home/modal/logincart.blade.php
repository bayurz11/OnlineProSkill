<div class="modal fade" id="exampleModalchart" tabindex="-1" aria-labelledby="exampleModalchartLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalchartLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="singUp-wrap">
                    <h2 class="title">Masuk Ke ProSkill</h2>
                    <p>Silahkan masukkan informasi akun kamu.</p>

                    <form action="{{ route('loginstuden') }}" class="account__form" method="POST" id="loginstuden">
                        @csrf
                        <div class="form-grp">
                            <input id="email_or_phone" type="text" placeholder="Email atau Nomor Telepon"
                                name="email_or_phone" autofocus>
                        </div>
                        <div class="form-grp position-relative">
                            <input id="password1" type="password" placeholder="Password" name="password">
                            <i class="toggle-password bi bi-eye position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                onclick="toggle()"></i>
                        </div>
                        <div class="account__check">
                            <div class="account__check-remember">
                                <input type="checkbox" class="form-check-input" value="" id="terms-check">
                                <label for="terms-check" class="form-check-label">Ingat saya</label>
                            </div>
                            <div class="account__check-forgot">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModallupaPassword">Lupa
                                    Password?</a>
                            </div>
                        </div>
                        <button class="g-recaptcha btn btn-two arrow-btn"
                            data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                            data-callback="onSubmitloginstuden" data-action='submit'>Masuk
                            <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                class="injectable">
                        </button>
                    </form><br>
                    <div class="account__social">
                        <a href="{{ route('oauth.google') }}" class="account__social-btn">
                            <img src="{{ asset('public/assets/img/icons/google.svg') }}" alt="img">
                            Masuk Dengan Google
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggle() {
        const passwordField = document.getElementById('password1');
        const toggleIcon = document.querySelector('.toggle-password');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>
