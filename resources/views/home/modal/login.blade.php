<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Welcome back!</h5>
                <button type="button" class="close rounded-circle p-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="p-2"
                        style="background-color: rgba(0,0,0,.1); border-radius: 50%;">&times;</span>
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
