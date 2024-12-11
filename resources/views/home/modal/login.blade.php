<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="singUp-wrap">
                    <h2 class="title">Masuk Ke ProSkill</h2>
                    <p>Silahkan masukkan informasi akun kamu.</p>

                    <form action="{{ route('login') }}" class="account__form" method="POST" id="login">
                        @csrf
                        <div class="form-grp">
                            <input id="email_or_phone" type="text" placeholder="Email atau Nomor Telepon"
                                name="email_or_phone" autofocus>
                        </div>
                        <div class="form-grp position-relative">
                            <input id="password" type="password" placeholder="Password" name="password">
                            <i class="toggle-password bi bi-eye-slash position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                onclick="togglePasswordVisibility()"></i>
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
                            data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}" data-callback="onSubmitLogin"
                            data-action='submit'>Masuk
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
                    <div class="account__switch">
                        <p>Belum punya akun?<a href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModalDaftar">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
