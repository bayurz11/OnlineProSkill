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
                        <div class="form-grp">
                            <input type="password" id="password" placeholder="Password" name="password"
                                class="password-field">
                            <button type="button" id="togglePassword" class="toggle-password">
                                <i class="fa fa-eye"></i> <!-- Icon mata -->
                            </button>
                        </div>
                        <div class="form-grp">
                            <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                                name="password_confirmation" class="password-field">
                            <button type="button" id="togglePasswordConfirmation" class="toggle-password">
                                <i class="fa fa-eye"></i> <!-- Icon mata -->
                            </button>
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
<style>
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
    }

    .password-field {
        position: relative;
        padding-right: 40px;
        /* Memberikan ruang untuk tombol toggle */
    }
</style>
<script>
    // Menangani toggle untuk password
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    togglePassword.addEventListener('click', function() {
        // Cek tipe input password
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        // Ganti ikon mata
        togglePassword.innerHTML = type === 'password' ? '<i class="fa fa-eye"></i>' :
            '<i class="fa fa-eye-slash"></i>';
    });

    // Menangani toggle untuk password_confirmation
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordConfirmationField = document.getElementById('password_confirmation');
    togglePasswordConfirmation.addEventListener('click', function() {
        // Cek tipe input password_confirmation
        const type = passwordConfirmationField.type === 'password' ? 'text' : 'password';
        passwordConfirmationField.type = type;
        // Ganti ikon mata
        togglePasswordConfirmation.innerHTML = type === 'password' ? '<i class="fa fa-eye"></i>' :
            '<i class="fa fa-eye-slash"></i>';
    });
</script>
