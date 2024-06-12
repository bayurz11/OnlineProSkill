@if (session('success'))
    <div id="success-message" class="notify alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="error-message" class="notify alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<style>
    .notify {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: none;
        opacity: 0;
        transition: opacity 0.3s, top 0.3s;
    }

    .notify.show {
        display: block;
        opacity: 1;
        top: 50px;
    }

    .notify.alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .notify.alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }
</style>

<script>
    // Fungsi untuk menampilkan notifikasi
    function showNotification(element) {
        if (element) {
            element.classList.add('show');
            // Tunggu 3 detik kemudian hilangkan pesan
            setTimeout(function() {
                element.classList.remove('show');
            }, 3000);
        }
    }

    // Ambil elemen pesan keberhasilan
    var successMessage = document.getElementById('success-message');
    // Ambil elemen pesan kesalahan
    var errorMessage = document.getElementById('error-message');

    // Tampilkan pesan keberhasilan
    showNotification(successMessage);

    // Tampilkan pesan kesalahan
    showNotification(errorMessage);
</script>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</button>
