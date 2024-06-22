<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Welcome back!</h5>
                <button type="button" class="close rounded-circle" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in action
                    in no time. Let's go!</p>
                <div class="account__social">
                    <a href="#" class="account__social-btn">
                        <img src="public/assets/img/icons/google.svg" alt="img">
                        Continue with Google
                    </a>
                </div>
                <div class="account__divider">
                    <span>or</span>
                </div>
                <form action="{{ route('login') }}" class="account__form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="text" placeholder="Email" name="email" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms-check">
                        <label class="form-check-label" for="terms-check">Remember me</label>
                    </div>
                    <div class="account__check-forgot">
                        <a href="registration.html">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-two arrow-btn">Masuk <img
                            src="public/assets/img/icons/right_arrow.svg" alt="img" class="injectable"></button>
                </form>
                <div class="account__switch">
                    <p>Don't have an account? <a href="registration.html">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (diperlukan untuk Bootstrap JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha384-FqpYut+0ITe8Hv0OcQ6mGXJ3d1iEtAVIEbYB2yUwh1vX00aWKj//SK28/n+ThjiR" crossorigin="anonymous">
</script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
    integrity="sha384-TM+pzfSqMqpXJ2oiFvDU8rxWoRJ/G0sN6EISOs6RP/HsGJ/JA1JQ5im6U6Z6wu89" crossorigin="anonymous">
</script>

<!-- Optional: FontAwesome (jika Anda ingin menggunakan ikon tambahan, tidak diperlukan jika sudah ada di proyek Anda) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"
    integrity="sha512-+QmNnmH5S+yIw8xQgg/+uXpC+V9HjBOBwR2+I65dK4S3mfnYzC3HmeW5IHefkGOyZ5uHdKXHvP8rGgd3yB11ew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
