<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="singUp-wrap">
                    <h2 class="title">Masuk Ke ProSkill</h2>
                    <p>Silahkan masukkan informasi akun kamu.</p>

                    <form action="{{ route('login') }}" class="account__form" method="POST">
                        @csrf
                        <div class="form-grp">
                            <input id="email" type="text" placeholder="Email" name="email" autofocus>
                        </div>
                        <div class="form-grp">
                            <input id="password" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="account__check">
                            <div class="account__check-remember">
                                <input type="checkbox" class="form-check-input" value="" id="terms-check">
                                <label for="terms-check" class="form-check-label">Ingat saya</label>
                            </div>
                            <div class="account__check-forgot">
                                <a href="registration.html">Lupa Password?</a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-two arrow-btn">Masuk
                            <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                class="injectable">
                        </button>
                    </form><br>
                    <div class="account__social">
                        <a href="#" class="account__social-btn">
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
