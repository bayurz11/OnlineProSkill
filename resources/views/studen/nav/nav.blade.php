<div class="col-lg-3">
    <div class="dashboard__sidebar-wrap">
        <div class="dashboard__sidebar-title mb-20">
            <h6 class="title">Selamat datang, {{ $user->name }}</h6>
        </div>
        <nav class="dashboard__sidebar-menu">
            <ul class="list-wrap">

                <li class="{{ Request::is('profil') ? 'active' : '' }}">
                    <a href="{{ route('profil') }}">
                        <i class="skillgro-avatar"></i>
                        Profil Saya
                    </a>
                </li>
                <li class="{{ Request::is('student-enrolled-courses') ? 'active' : '' }}">
                    <a href="student-enrolled-courses.html">
                        <i class="skillgro-book"></i>
                        Akses Pembelian
                    </a>
                </li>
                <li class="{{ Request::is('student-history') ? 'active' : '' }}">
                    <a href="student-history.html">
                        <i class="skillgro-satchel"></i>
                        Riwayat Transaksi
                    </a>
                </li>
                <li class="{{ Request::is('student-history') ? 'active' : '' }}">
                    <a href="student-history.html">
                        <img src="{{ asset('public/assets/img/icons/course_icon05.svg') }}" alt="img"
                            class="injectable">
                        Sertifikat
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</div>
