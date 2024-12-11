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
                        <div class="form-grp">
                            <input type="password" id="password" placeholder="Password Baru" name="password" required>
                        </div>
                        <div class="form-grp">
                            <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                                name="password_confirmation" required>
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
