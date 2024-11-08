@section('title', 'ProSkill Akademia | In-house Training Formulir')
<?php $page = 'Tentang_Kami'; ?>

@extends('layout.mainlayout')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg" loading="lazy">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Tinggalkan pesan</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">In-house Training Form</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
                data-aos-delay="400" loading="lazy">
        </div>
    </section>
    <div class="row">
        <div class="col-lg-12 ">
            <div class="dashboard__content-wrap">
                <div class="dashboard__content-title text-center">
                    <h4 class="title">Leave a Message</h4>
                    <p>Jika kamu masih bingung memilih materi dan kelas yang sesuai atau ingin mendapatkan penawaran untuk
                        training corporate dll, silahkan isi form berikut:</p>
                </div>
                <div class="row">
                    <div class="col-lg-12  px-5">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="itemOne-tab-pane" role="tabpanel"
                                aria-labelledby="itemOne-tab" tabindex="0">
                                <div class="instructor__profile-form-wrap">
                                    <form action="#" class="instructor__profile-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="nama">Nama <span class="text-danger">*</span></label>
                                                    <input id="nama" name="nama" type="text"
                                                        placeholder="masukkan nama anda" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="phonenumber">Nomor Telepon <span
                                                            class="text-danger">*</span></label>
                                                    <input id="phonenumber" name="phonenumber" type="number" min="0"
                                                        placeholder="masukkan nomor telepon" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="email">Email<span class="text-danger">*</span></label>
                                                    <input id="lastname" type="email" placeholder="masukkan email anda"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="displayname">Peruntukan Training <span
                                                            class="text-danger">*</span></label>
                                                    <select id="displayname" name="displayname">
                                                        <option>Pilih</option>
                                                        <option value="company">Company</option>
                                                        <option value="individu">Individu</option>
                                                        <option value="Kelompok_Kecil">Kelompok Kecil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="displayname">Berapa jumlah peserta yang ikut serta dalam
                                                        training?</label>
                                                    <select id="displayname" name="displayname">
                                                        <option>Pilih</option>
                                                        <option value="1-5">1-5 Orang</option>
                                                        <option value="6-10">6-10 Orang</option>
                                                        <option value="11-15">11-15 Orang</option>
                                                        <option value=">15">>15</option>
                                                    </select>
                                                </div>
                                                <small class="form-text text-muted">Diisi jika kebutuhan untuk Corporate
                                                    Training.</small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="targetPeserta">Ditujukan kepada siapa yang menjadi peserta
                                                        program ini? <span class="text-danger">*</span></label>
                                                    <select id="targetPeserta" name="targetPeserta">
                                                        <option>Pilih Peserta</option>
                                                        <option value="Staf">Staf</option>
                                                        <option value="Middle Management">Middle Management</option>
                                                        <option value="Senior Management">Senior Management</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <small class="form-text text-muted">Diisi jika kebutuhan untuk Corporate
                                                    Training.</small>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="bulanTraining">Kapan training rencana diadakan?<span
                                                            class="text-danger">*</span></label>
                                                    <select id="bulanTraining" name="bulanTraining">
                                                        <option>Pilih Bulan</option>
                                                        <option value="Januari">Januari</option>
                                                        <option value="Februari">Februari</option>
                                                        <option value="Maret">Maret</option>
                                                        <option value="April">April</option>
                                                        <option value="Mei">Mei</option>
                                                        <option value="Juni">Juni</option>
                                                        <option value="Juli">Juli</option>
                                                        <option value="Agustus">Agustus</option>
                                                        <option value="September">September</option>
                                                        <option value="Oktober">Oktober</option>
                                                        <option value="November">November</option>
                                                        <option value="Desember">Desember</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="industri">Pilih Industri di mana Kamu Bekerja<span
                                                            class="text-danger">*</span></label>
                                                    <select id="industri" name="industri">
                                                        <option>Pilih Industri</option>
                                                        <option value="Teknologi">Teknologi</option>
                                                        <option value="Pendidikan">Pendidikan</option>
                                                        <option value="Kesehatan">Kesehatan</option>
                                                        <option value="Keuangan">Keuangan</option>
                                                        <option value="Manufaktur">Manufaktur</option>
                                                        <option value="Ritel">Ritel</option>
                                                        <option value="Perbankan">Perbankan</option>
                                                        <option value="Pariwisata">Pariwisata</option>
                                                        <option value="Konstruksi">Konstruksi</option>
                                                        <option value="Transportasi">Transportasi</option>
                                                        <option value="Energi">Energi</option>
                                                        <option value="Pertanian">Pertanian</option>
                                                        <option value="Hukum">Hukum</option>
                                                        <option value="Media">Media</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="departemen">Pilih Departemen di mana peserta training
                                                        bekerja<span class="text-danger">*</span></label>
                                                    <select id="departemen" name="departemen">
                                                        <option>Pilih Departemen</option>
                                                        <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                                                        <option value="Keuangan">Keuangan</option>
                                                        <option value="Pemasaran">Pemasaran</option>
                                                        <option value="Penjualan">Penjualan</option>
                                                        <option value="Operasional">Operasional</option>
                                                        <option value="IT">IT</option>
                                                        <option value="Produksi">Produksi</option>
                                                        <option value="R&D">R&D (Penelitian dan Pengembangan)</option>
                                                        <option value="Legal">Legal</option>
                                                        <option value="Layanan Pelanggan">Layanan Pelanggan</option>
                                                        <option value="Pengadaan">Pengadaan</option>
                                                        <option value="Kesehatan dan Keselamatan Kerja">Kesehatan dan
                                                            Keselamatan Kerja</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="levelPemahaman">Di level manakah kamu/peserta training
                                                        memahami tools? <span class="text-danger">*</span></label>
                                                    <select id="levelPemahaman" name="levelPemahaman">
                                                        <option>Pilih Level Pemahaman</option>
                                                        <option value="Pemula">Pemula</option>
                                                        <option value="Menengah">Menengah</option>
                                                        <option value="Mahir">Mahir</option>
                                                        <option value="Ahli">Ahli</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-grp">
                                            <label for="tujuan">Apa harapan terhadap pelatihan ini?</label>
                                            <textarea id="tujuan"></textarea>
                                        </div>
                                        <div class="form-grp">
                                            <label for="materi">Adakah materi/modul yang ingin kamu pelajari sebagai
                                                topik wajib dalam program?
                                            </label>
                                            <textarea id="materi"></textarea>
                                        </div>
                                        <div class="submit-btn mt-25 d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn">Kirim Pesan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
