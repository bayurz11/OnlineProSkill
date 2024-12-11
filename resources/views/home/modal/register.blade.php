<div class="modal fade" id="exampleModalDaftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="singUp-wrap">
                    <h2 class="title">Buat Akun ProSkill</h2>
                    <p>Silahkan isi form berikut untuk melanjutkan.</p>

                    <form action="{{ route('regisStuden') }}" class="account__form" method="POST" id="regisStuden">
                        @csrf
                        <div class="form-grp">
                            <input type="text" id="name" name="name"
                                placeholder="Masukkan Nama Lengkap Anda">
                        </div>
                        <div class="form-grp">
                            <input type="email" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="form-grp">
                            <input type="phone" id="phone_number" placeholder="08**********" name="phone_number"
                                maxlength="12">
                        </div>
                        <div class="form-grp position-relative">
                            <input id="password" type="password" placeholder="Password" name="password">
                            <i class="toggle-password1 bi bi-eye-slash position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                onclick="togglePasswordVisibility1('password', this)"></i>
                        </div>

                        <div class="form-grp position-relative">
                            <input id="password_confirmation" type="password" placeholder="Konfirmasi Password"
                                name="password_confirmation">
                            <i class="toggle-password2 bi bi-eye-slash position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
                                onclick="togglePasswordVisibility2('password_confirmation', this)"></i>
                        </div>

                        <span>Password minimal 8 karakter terdiri simbol,
                            huruf, dan angka</span>
                        <button class="g-recaptcha btn btn-two arrow-btn"
                            data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                            data-callback="onSubmitRegisStuden" data-action='submit'>Daftar
                            <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                class="injectable">
                        </button>
                    </form><br>

                    <div class="account__switch">
                        <p>Apakah Punya Akun?<a href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility3(inputId, iconElement) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            iconElement.classList.remove("bi-eye-slash");
            iconElement.classList.add("bi-eye");
        } else {
            input.type = "password";
            iconElement.classList.remove("bi-eye");
            iconElement.classList.add("bi-eye-slash");
        }
    }

    function togglePasswordVisibility4(inputId, iconElement) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            iconElement.classList.remove("bi-eye-slash");
            iconElement.classList.add("bi-eye");
        } else {
            input.type = "password";
            iconElement.classList.remove("bi-eye");
            iconElement.classList.add("bi-eye-slash");
        }
    }

    // Fungsi untuk memanggil togglePasswordVisibility untuk password
    function togglePasswordVisibility1(inputId, iconElement) {
        togglePasswordVisibility4(inputId, iconElement);
    }

    // Fungsi untuk memanggil togglePasswordVisibility untuk konfirmasi password
    function togglePasswordVisibility2(inputId, iconElement) {
        togglePasswordVisibility3(inputId, iconElement);
    }
</script>
