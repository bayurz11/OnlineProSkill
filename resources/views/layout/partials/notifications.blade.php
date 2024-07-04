@if ($notifikasi->isEmpty())
    <li class="dropdown-item">Tidak ada notifikasi saat ini.</li>
@else
    @foreach ($notifikasi as $notif)
        <li class="dropdown-item">
            <p>{{ $notif->message }}</p>
            <small>{{ $notif->created_at->format('d M Y, H:i') }}</small>
        </li>
    @endforeach
@endif
