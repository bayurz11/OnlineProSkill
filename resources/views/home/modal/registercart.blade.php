<div class="modal fade" id="exampleModalDaftarcart" tabindex="-1" aria-labelledby="exampleModalDaftarcartLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalDaftarcartLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="singUp-wrap">
                    <h2 class="title">Buat Akun ProSkill</h2>
                    <p>Silahkan isi form berikut untuk melanjutkan.</p>

                    <form action="{{ route('guestregister') }}" class="account__form" method="POST" id="guestregister">
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
                            <input id="password2" type="password" placeholder="Password" name="password"
                                class="form-control">
                            <i id="togglePassword1" class="toggle-password bi bi-eye position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <div class="form-grp position-relative">
                            <input id="password_confirmation1" type="password" placeholder="Konfirmasi Password"
                                name="password_confirmation" class="form-control">
                            <i id="togglePassword1Confirmation" class="toggle-password bi bi-eye position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <span>Password minimal 8 karakter terdiri simbol,
                            huruf, dan angka</span>
                        <button class="g-recaptcha btn btn-two arrow-btn"
                            data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                            data-callback="onSubmitguestregister" data-action='submit'>
                            Daftar
                            <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                class="injectable">
                        </button>
                    </form><br>

                    <div class="account__switch">
                        <p>Apakah Punya Akun?<a href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModalchart">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword1() {
        const passwordField = document.getElementById('password2');
        const toggleIcon = document.getElementById('togglePassword1');

        // Cek apakah password saat ini disembunyikan atau terlihat
        if (passwordField.type === 'password') {
            passwordField.type = 'text'; // Menampilkan password
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash'); // Ganti ikon ke mata tertutup
        } else {
            passwordField.type = 'password'; // Menyembunyikan password
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye'); // Ganti ikon ke mata terbuka
        }
    }



    // Fungsi untuk toggle password confirmation visibility
    function togglePassword1Confirmation() {
        const passwordConfirmationField = document.getElementById('password_confirmation1');
        const toggleIcon = document.getElementById('togglePassword1Confirmation');

        if (passwordConfirmationField.type === 'password') {
            passwordConfirmationField.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordConfirmationField.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }

    // Menambahkan event listener untuk tombol toggle password
    document.getElementById('togglePassword1').addEventListener('click', togglePassword1);
    document.getElementById('togglePassword1Confirmation').addEventListener('click', togglePassword1Confirmation);
</script>
