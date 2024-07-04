@extends('layout.mainlayout')

@section('title', 'Notifikasi')

@section('content')
    <div class="container">
        <h1>Notifikasi</h1>
        @if ($notifikasi->isEmpty())
            <p>Tidak ada notifikasi saat .</p>
        @else
            <ul class="list-group">
                @foreach ($notifikasi as $notif)
                    <li class="list-group-item">
                        <p>{{ $notif->message }}</p>
                        <small>{{ $notif->created_at->format('d M Y, H:i') }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
