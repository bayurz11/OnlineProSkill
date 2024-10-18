<div class="modal fade" id="ModalDaftarInstruktur" tabindex="-1" aria-labelledby="modalInstrukturLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInstrukturLabel">Buat Akun Instruktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="signUp-wrap">
                    <h2 class="title">Daftar sebagai Instruktur</h2>
                    <p>Silahkan isi form berikut untuk membuat akun instruktur.</p>

                    <form action="{{ route('regisInstruktur') }}" class="account__form" method="POST"
                        id="regisInstrukturForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap Anda"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone_number" name="phone_number" placeholder="08**********"
                                maxlength="12" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Password" minlength="8"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Konfirmasi Password" required>
                        </div>
                        <span>Password minimal 8 karakter terdiri dari simbol, huruf, dan angka.</span>

                        <button class="g-recaptcha btn btn-primary"
                            data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                            data-callback="onSubmitRegisInstruktur" data-action="submit">Daftar
                            <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                class="injectable">
                        </button>
                    </form><br>

                    <div class="account__switch">
                        <p>Sudah punya akun? <a href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
