<div class="modal fade" id="exampleModalDaftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="singUp-wrap">
                    <h2 class="title">Buat Akun ProSkill</h2>
                    <p>Silahkan isi form berikut untuk melanjutkan.</p>

                    <form action="{{ route('stdregister') }}" class="account__form" method="POST">
                        @csrf
                        <div class="form-grp">
                            <input type="text" id="name" name="name" placeholder="nama">
                        </div>
                        <div class="form-grp">
                            <input type="email" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="form-grp">
                            <input type="password" id="password" placeholder="Password" name="password">
                        </div>
                        <div class="form-grp">
                            <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                                name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-two arrow-btn">Daftar<img
                                src="public/assets/img/icons/right_arrow.svg" alt="img"
                                class="injectable"></button>
                    </form><br>
                    <div class="account__social">
                        <a href="#" class="account__social-btn">
                            <img src="public/assets/img/icons/google.svg" alt="img">
                            Daftar Dengan Google
                        </a>
                    </div>
                    <div class="account__switch">
                        <p>Apakah Punya Akun?<a href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
