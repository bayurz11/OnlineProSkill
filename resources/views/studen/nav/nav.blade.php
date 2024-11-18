<div class="col-lg-3">
    <div class="dashboard__sidebar-wrap">
        <div class="dashboard__sidebar-title mb-20">
            <h6 class="title">Selamat datang, {{ $user->name }}</h6>
        </div>
        <nav class="dashboard__sidebar-menu">
            <ul class="list-wrap">
                <li class="{{ Request::is('akses_pembelian') ? 'active' : '' }}">
                    <a href="{{ route('akses_pembelian') }}">
                        <i class="skillgro-book"></i>
                        Akses Pembelian
                    </a>
                </li>
                <li class="{{ Request::is('quiz') ? 'active' : '' }}">
                    <a href="{{ route('quiz') }}">
                        <i class="skillgro-chat"></i>
                        Quiz
                    </a>
                </li>
                <li class="{{ Request::is('profil') ? 'active' : '' }}">
                    <a href="{{ route('profil') }}">
                        <i class="skillgro-avatar"></i>
                        Profil Saya
                    </a>
                </li>
                <li class="{{ Request::is('history') ? 'active' : '' }}">
                    <a href="{{ route('history') }}">
                        <i class="skillgro-satchel"></i>
                        Riwayat Transaksi
                    </a>
                </li>
                <li class="{{ Request::is('review') ? 'active' : '' }}">
                    <a href="{{ route('review') }}">
                        <i class="skillgro-book-2"></i>
                        Reviews
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</div>
