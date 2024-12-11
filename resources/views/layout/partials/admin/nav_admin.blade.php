<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('public/assets_admin/images/logo1.svg') }}" alt="Logo" style="height: 40px;">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Kategori Setting</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#kategori" role="button" aria-expanded="false"
                    aria-controls="kategori">
                    <i class="link-icon" data-feather="folder"></i>
                    <span class="link-title">Kategori</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="kategori">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('categories') }}" class="nav-link">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subcategories') }}" class="nav-link">Sub Kategori</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Kelas Tatap Muka SETTING</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
                    aria-controls="uiComponents">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Kelola Kursus</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('classroomsetting') }}" class="nav-link">Daftar Kelas</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Kelas Online Setting</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false"
                    aria-controls="advancedUI">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Kelola Kursus</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('CourseMaster') }}" class="nav-link">Daftar Kursus</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Bootcamp SETTING</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#Bootcamp" role="button" aria-expanded="false"
                    aria-controls="Bootcamp">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Kelola Bootcamp</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="Bootcamp">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('bootcampsetting') }}" class="nav-link">Daftar Bootcamp</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('HistoryOrder') }}" class="nav-link">Riwayat Pembayaran</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Produk</li>
            {{-- <li class="nav-item">
                <a href="{{ route('kategoriproduk') }}" class="nav-link">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">Kategori Produk</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#produk" role="button" aria-expanded="false"
                    aria-controls="produk">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Kelola Produk</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="produk">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('produksetting') }}" class="nav-link">Tambah Produk</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="pages/auth/register.html" class="nav-link">Register</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Quiz Setting</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#quiz-pages" role="button"
                    aria-expanded="false" aria-controls="quiz-pages">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Kelola Quiz</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="quiz-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('instruktur.quiz') }}" class="nav-link">Daftar Quiz</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Manajemen User</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#instruktur-pages" role="button"
                    aria-expanded="false" aria-controls="instruktur-pages">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Kelola Instruktur</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="instruktur-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('instruktursetting') }}" class="nav-link">Daftar Instruktur</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button"
                    aria-expanded="false" aria-controls="general-pages">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Kelola Siswa</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('daftar_siswa') }}" class="nav-link">Daftar Siswa</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('sertifikat') }}" class="nav-link">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">Sertifikat</span>
                </a>
            </li>

            <li class="nav-item nav-category">Pembayaran</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#authPages" role="button"
                    aria-expanded="false" aria-controls="authPages">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Transaksi</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="authPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('OrderHistoryManager') }}" class="nav-link">Riwayat Pembelian Kelas</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="pages/auth/register.html" class="nav-link">Register</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Iklan Setting</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#fbsetting" role="button"
                    aria-expanded="false" aria-controls="fbsetting">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Facebook Setting</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="fbsetting">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('pixel.settings') }}" class="nav-link">Facebook Setting</a>
                        </li>

                    </ul>
                </div>

            </li>
            {{-- 
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false"
                    aria-controls="forms">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Forms</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/forms/basic-elements.html" class="nav-link">Basic Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced-elements.html" class="nav-link">Advanced Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">Editors</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/wizard.html" class="nav-link">Wizard</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#charts" role="button" aria-expanded="false"
                    aria-controls="charts">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title">Charts</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/charts/apex.html" class="nav-link">Apex</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">ChartJs</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">Flot</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/peity.html" class="nav-link">Peity</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/sparkline.html" class="nav-link">Sparkline</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#tables" role="button" aria-expanded="false"
                    aria-controls="tables">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Table</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/tables/basic-table.html" class="nav-link">Basic Tables</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data-table.html" class="nav-link">Data Table</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item nav-category">Docs</li>
             --}}
            <li class="nav-item nav-category">Pengaturan Umum</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#charts" role="button" aria-expanded="false"
                    aria-controls="charts">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Pengaturan</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('herosection') }}" class="nav-link">Banner Area</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('settingcontactus') }}" class="nav-link">Hubungi Kami</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/peity.html" class="nav-link">Faq</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#errorPages" role="button"
                    aria-expanded="false" aria-controls="errorPages">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Event & Artikel</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="errorPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('kelola_event') }}" class="nav-link">Event</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori_blog') }}" class="nav-link">Kategori Artikel</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kelola_blog') }}" class="nav-link">Artikel</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
