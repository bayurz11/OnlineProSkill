<div class="modal fade" id="InstrukturModal" tabindex="-1" aria-labelledby="InstrukturModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('regisInstruktur') }}" class="account__form" method="POST" id="regisInstruktur">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="InstrukturModalLabel">Tambah Instruktur Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-grp">
                        <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap Anda">
                    </div>
                    <div class="form-grp">
                        <input type="email" id="email" placeholder="Email" name="email">
                    </div>
                    <div class="form-grp">
                        <input type="phone" id="phone_number" placeholder="08**********" name="phone_number"
                            maxlength="12">
                    </div>
                    <div class="form-grp">
                        <input type="password" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-grp">
                        <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                            name="password_confirmation">
                    </div>
                    <span>Password minimal 8 karakter terdiri simbol,
                        huruf, dan angka</span>
                    <button class="g-recaptcha btn btn-two arrow-btn"
                        data-sitekey="{{ config('services.recaptcha_v3.siteKey') }}"
                        data-callback="onSubmitregisInstruktur" data-action='submit'>Daftar
                        <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                            class="injectable">
                    </button>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize tags input
        var input = document.querySelector('input[name=tag]');
        new Tagify(input, {
            whitelist: [],
            dropdown: {
                enabled: 1,
                maxItems: 100
            }
        });

        // Gambar preview
        $("#gambar").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Isi tanggal dengan tanggal saat ini ketika modal dibuka
        $('#exampleModal').on('show.bs.modal', function() {
            var today = new Date().toISOString().split('T')[0];
            document.querySelector('#date').value = today;
        });
    });
</script>
