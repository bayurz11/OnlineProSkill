@section('title', 'ProSkill Akademia | Hubungi Kami')
<?php $page = 'Hubungi_Kami'; ?>

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
                        <h3 class="title">Hubungi Kami</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Hubungi Kami</span>
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
    <!-- breadcrumb-area-end -->
    <!-- contact-area -->
    <section class="contact-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-info-wrap">
                        <ul class="list-wrap">
                            <li>
                                <div class="icon">
                                    <img src="public/assets/img/icons/map.svg" alt="img" class="injectable">
                                </div>
                                <div class="content">
                                    <h4 class="title">Alamat</h4>
                                    <p>{{ $contactUs->alamat }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="public/assets/img/icons/contact_phone.svg" alt="img" class="injectable">
                                </div>
                                <div class="content">
                                    <h4 class="title">Telepon</h4>

                                    <a href="tel:{{ $contactUs->telepon }}">{{ $contactUs->telepon }}</a>

                                </div>

                            </li>
                            <li>
                                <div class="icon">
                                    <img src="public/assets/img/icons/emial.svg" alt="img" class="injectable">
                                </div>
                                <div class="content">
                                    <h4 class="title">E-mail Address</h4>

                                    <a href="mailto:{{ $contactUs->email }}">{{ $contactUs->email }}</a>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form-wrap">
                        <h4 class="title">Kirimkan Kami Pesan</h4>
                        <p>Alamat email dan Nomor Telepon Anda tidak akan dipublikasikan. Kolom yang wajib diisi ditandai
                            dengan *</p>
                        <form id="contact-form" action="#" method="POST">
                            <div class="form-grp">
                                <textarea id="message" placeholder="Pesan Anda" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-grp">
                                        <input id="name" name="name" type="text" placeholder="Nama *" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-grp">
                                        <input id="email" name="email" type="email" placeholder="E-mail *" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-grp">
                                        <input id="phone" type="phone" name="phone" placeholder="Nomor Telepon *"
                                            required maxlength="12">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-two arrow-btn" onclick="sendMessage()">Kirim
                                Sekarang</button>

                        </form>
                        <p class="ajax-response mb-0"></p>
                    </div>
                </div>




            </div>
            <!-- contact-map -->
            <div class="contact-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1923.7919637366656!2d104.46155006362552!3d0.9007406620588777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d9729a2556642d%3A0xaa63e717cb0e87b9!2sProSkill%20Akademia!5e1!3m2!1sid!2sid!4v17232635"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <!-- contact-map-end -->
        </div>
    </section>
    <!-- contact-area-end -->
    <script>
        function sendMessage() {
            // Ambil nilai dari input form
            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var message = document.getElementById('message').value.trim();

            // Validasi apakah semua field terisi
            if (name === "" || email === "" || phone === "" || message === "") {
                alert("Semua field harus diisi sebelum mengirim pesan.");
                return; // Hentikan eksekusi jika ada field yang kosong
            }

            // Format pesan yang akan dikirimkan
            var whatsappMessage = `Halo, saya ${name},\n\n${message}\n\nEmail: ${email}\nNomor Telepon: ${phone}`;

            // Nomor WhatsApp tujuan (tanpa tanda '+' dan menggunakan kode negara, misalnya 6281266187125)
            var whatsappNumber = '6281266187125';

            // Buat URL WhatsApp API
            var whatsappURL =
                `https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodeURIComponent(whatsappMessage)}`;

            // Buka URL di tab baru
            window.open(whatsappURL, '_blank');
        }
    </script>
@endsection
