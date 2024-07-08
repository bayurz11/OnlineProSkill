<li class="mini-cart-icon" style="margin-left: 20px;">
    <a href="#" class="cart-count-two" id="notification-icon">
        <i class="far fa-bell" style="color: #007F73;"></i>
        <span class="mini-cart-count">{{ $notifikasiCount }}</span>
    </a>
    <div id="notification-dropdown" class="notification-dropdown" style="display: none;">
        @if ($notifikasiCount > 0)
            <button id="mark-all-read" style="margin: 10px; border: none;">Tandai
                Semua Telah Dibaca</button>
            <ul>
                @foreach ($notifikasi as $notif)
                    @if ($notif->status == 1)
                        <li>{{ $notif->message }} -
                            <small>{{ $notif->created_at->format('d-M-Y') }}</small>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <p style="margin: 10px;">Tidak ada notifikasi</p>
        @endif
    </div>
</li>

<style>
    .notification-dropdown {
        position: absolute;
        background: #fff;
        border-radius: 3px;
        border: 0px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
        top: 40px;
        right: 0;
    }

    .notification-dropdown ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .notification-dropdown ul li {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .notification-dropdown ul li:last-child {
        border-bottom: none;
    }

    .notification-dropdown p {
        padding: 10px;
    }
</style>
<!-- Modal Alert -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <p id="alertMessage"></p>
            </div>

        </div>
    </div>
</div>
<script>
    document.getElementById('notification-icon').addEventListener('click', function(event) {
        event.preventDefault();
        var dropdown = document.getElementById('notification-dropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });

    @if ($notifikasiCount > 0)
        document.getElementById('mark-all-read').addEventListener('click', function(event) {
            event.preventDefault();
            fetch('{{ route('notifikasi.bacaSemua') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert(data.message);
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        showAlert('Gagal menandai semua notifikasi sebagai telah dibaca.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function showAlert(message) {
            document.getElementById('alertMessage').textContent = message;
            $('#alertModal').modal('show');
        }
    @endif
</script>

{{-- <li class="mini-cart-icon" style="margin-left: 20px;">
    <a href="#" class="cart-count-two" id="notification-icon">
        <i class="far fa-bell" style="color: #007F73;"></i>
        <span class="mini-cart-count">{{ $notifikasiCount }}</span>
    </a>
    <div id="notification-dropdown" class="notification-dropdown"
        style="display: none;">
        @if ($notifikasiCount > 0)
            <button id="mark-all-read" style="margin: 10px; border: none;">Tandai
                Semua Telah Dibaca</button>
            <ul>
                @foreach ($notifikasi as $notif)
                    <li>{{ $notif->message }} -
                        <small>{{ $notif->created_at->format('d-M-Y') }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p style="margin: 10px;">Tidak ada notifikasi</p>
        @endif
    </div>
</li>

<style>
    .notification-dropdown {
        position: absolute;
        background: #fff;
        border: 0px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
        top: 40px;
        right: 0;
    }

    .notification-dropdown ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .notification-dropdown ul li {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .notification-dropdown ul li:last-child {
        border-bottom: none;
    }

    .notification-dropdown p {
        padding: 10px;
    }
</style>

<script>
    document.getElementById('notification-icon').addEventListener('click', function(event) {
        event.preventDefault();
        var dropdown = document.getElementById('notification-dropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });

    @if ($notifikasiCount > 0)
        document.getElementById('mark-all-read').addEventListener('click', function(event) {
            event.preventDefault();
            fetch('{{ route('notifikasi.bacaSemua') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        location.reload(); // Tambahkan baris ini untuk me-refresh halaman
                    } else {
                        alert('Gagal menandai semua notifikasi sebagai telah dibaca.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    @endif
</script> --}}
