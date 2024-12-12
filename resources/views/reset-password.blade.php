@extends('layout.mainlayout')

@section('title', 'ProSkill Akademia | Reset Password')

@section('content')
    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>

        <!-- Cek apakah variabel $cart ada, jika ada tampilkan informasi terkait cart -->
        @isset($cart)
            @if (!empty($cart))
                <div class="cart-summary mt-4">
                    <h4>Keranjang Anda</h4>
                    <ul>
                        @foreach ($cart as $item)
                            <li>{{ $item['name'] }} - {{ $item['quantity'] }} x {{ $item['price'] }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p>Keranjang Anda kosong.</p>
            @endif
        @endisset

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
@endsection
