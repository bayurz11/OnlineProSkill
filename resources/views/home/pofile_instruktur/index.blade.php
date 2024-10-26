@section('title', 'ProSkill Akademia | Profile Instruktur')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-two"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>

                            <span property="itemListElement" typeof="ListItem">Profile Instruktur</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape01.svg') }}" alt="img" class="alltuchtopdown">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape02.svg') }}" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape03.svg') }}" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape04.svg') }}" alt="img"
                data-aos="fade-down-left" data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape05.svg') }}" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- instructor-details-area -->
    <section class="instructor__details-area section-pt-120 section-pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="instructor__details-wrap">
                        <div class="instructor__details-info">
                            <div class="instructor__details-thumb">
                                <img src="{{ $instructorProfile && $instructorProfile->gambar ? (strpos($instructorProfile->gambar, 'googleusercontent') !== false ? $instructorProfile->gambar : asset('public/uploads/' . $instructorProfile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                    alt="img"
                                    style="border-radius: 50%; width: 250px; height: 250px; object-fit: cover;">
                            </div>
                            <div class="instructor__details-content">
                                <h2 class="title">{{ $instructorProfile->user->name }}</h2>
                                <span class="designation">Mentor sejak
                                    {{ \Carbon\Carbon::parse($instructorProfile->created_at)->format('d M Y') }}</span>
                                <ul class="list-wrap">
                                    <li class="avg-rating"><i class="fas fa-star"></i>(4.8 Reviews)</li>
                                    <li><i class="far fa-envelope"></i><a
                                            href="mailto:{{ $instructorProfile->user->email }}">{{ $instructorProfile->user->email }}</a>
                                    </li>
                                    <li><i class="fas fa-phone-alt"></i><a
                                            href="tel:0123456789">{{ $instructorProfile->phone_number }}</a></li>
                                </ul>

                                <div class="instructor__details-social">
                                    <ul class="list-wrap">
                                        <li>
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://wa.me/{{ $instructorProfile->phone_number }}" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="instructor__details-courses">
                            <div class="row align-items-center mb-30">
                                <div class="col-md-8">
                                    <h2 class="main-title">Kelas Saya</h2>
                                    <p>Temukan berbagai kelas yang telah saya buat untuk mendukung perjalanan belajar Anda.
                                        Pilih kelas yang sesuai dan mulai tingkatkan keterampilan Anda sekarang!</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="instructor__details-nav">
                                        <button class="courses-button-prev"><i class="flaticon-arrow-right"></i></button>
                                        <button class="courses-button-next"><i class="flaticon-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper courses-swiper-active-two">
                                <div class="swiper-wrapper">
                                    @if ($kelas->isNotEmpty())
                                        @foreach ($kelas as $item)
                                            @if ($item->status == 1)
                                                <div class="swiper-slide">
                                                    <div class="courses__item shine__animate-item">
                                                        <div class="courses__item-thumb">
                                                            <a href="{{ route('classroomdetail', ['id' => $item['id']]) }}"
                                                                class="shine__animate-link">
                                                                <img src="{{ asset('public/uploads/' . $item['gambar']) }}"
                                                                    alt="img" class="img-fluid" loading="lazy">
                                                            </a>
                                                        </div>
                                                        <div class="courses__item-content">
                                                            <ul class="courses__item-meta list-wrap">
                                                                <li class="courses__item-tag">
                                                                    @if ($item['course_type'] == 'online')
                                                                        <span class="badge bg-primary">Online</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">Kelas Tatap
                                                                            Muka</span>
                                                                    @endif
                                                                </li>
                                                                <li class="avg-rating"><i class="fas fa-star"></i> (4.3
                                                                    Reviews)</li>
                                                                <li class="price">
                                                                    @if (!empty($item['discountedPrice']))
                                                                        <del style="color: red; margin-right: 8px;">Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}</del>
                                                                        <span
                                                                            style="color: #007F73; font-weight: bold; font-size: 1.2em;">Rp
                                                                            {{ number_format($item['discountedPrice'], 0, ',', '.') }}</span>
                                                                    @else
                                                                        <span style="color: red;">Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}</span>
                                                                    @endif
                                                                </li>

                                                                @if (in_array($item->id, $joinedCourses))
                                                                    <i class="fas fa-check-circle fa-lg"
                                                                        style="color: #007F73;"></i>
                                                                @endif
                                                            </ul>
                                                            <h5 class="title"><a
                                                                    href="{{ route('classroomdetail', ['id' => $item['id']]) }}">{{ $item['nama_kursus'] }}</a>
                                                            </h5>
                                                            <p class="author">By <a
                                                                    href="{{ route('profile_instruktur', ['id' => $instructorProfile->user->id]) }}">{{ $instructorProfile->user->name }}</a>
                                                            </p>

                                                            <div class="courses__item-bottom">
                                                                <div class="button">
                                                                    <a
                                                                        href="{{ route('classroomdetail', ['id' => $item['id']]) }}">
                                                                        <span class="text">Detail Kelas</span>
                                                                        <i class="flaticon-arrow-right"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                        {{-- Duplicate the items again after the original items --}}
                                        @foreach ($kelas as $item)
                                            @if ($item->status == 1)
                                                <div class="swiper-slide">
                                                    <div class="courses__item shine__animate-item">
                                                        <div class="courses__item-thumb">
                                                            <a href="{{ route('classroomdetail', ['id' => $item['id']]) }}"
                                                                class="shine__animate-link">
                                                                <img src="{{ asset('public/uploads/' . $item['gambar']) }}"
                                                                    alt="img" class="img-fluid" loading="lazy">
                                                            </a>
                                                        </div>
                                                        <div class="courses__item-content">
                                                            <ul class="courses__item-meta list-wrap">
                                                                <li class="courses__item-tag">
                                                                    @if ($item['course_type'] == 'online')
                                                                        <span class="badge bg-primary">Online</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">Kelas Tatap
                                                                            Muka</span>
                                                                    @endif
                                                                </li>
                                                                <li class="avg-rating"><i class="fas fa-star"></i> (4.3
                                                                    Reviews)</li>
                                                                <li class="price">
                                                                    @if (!empty($item['discountedPrice']))
                                                                        <del style="color: red; margin-right: 8px;">Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}</del>
                                                                        <span
                                                                            style="color: #007F73; font-weight: bold; font-size: 1.2em;">Rp
                                                                            {{ number_format($item['discountedPrice'], 0, ',', '.') }}</span>
                                                                    @else
                                                                        <span style="color: red;">Rp
                                                                            {{ number_format($item['price'], 0, ',', '.') }}</span>
                                                                    @endif
                                                                </li>

                                                                @if (in_array($item->id, $joinedCourses))
                                                                    <i class="fas fa-check-circle fa-lg"
                                                                        style="color: #007F73;"></i>
                                                                @endif
                                                            </ul>
                                                            <h5 class="title"><a
                                                                    href="{{ route('classroomdetail', ['id' => $item['id']]) }}">{{ $item['nama_kursus'] }}</a>
                                                            </h5>
                                                            <p class="author">By <a
                                                                    href="{{ route('profile_instruktur', ['id' => $instructorProfile->user->id]) }}">{{ $instructorProfile->user->name }}</a>
                                                            </p>

                                                            <div class="courses__item-bottom">
                                                                <div class="button">
                                                                    <a
                                                                        href="{{ route('classroomdetail', ['id' => $item['id']]) }}">
                                                                        <span class="text">Detail Kelas</span>
                                                                        <i class="flaticon-arrow-right"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>Tidak ada kelas yang ditemukan untuk instruktur ini.</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="instructor__sidebar">
                        <h4 class="title">Quick Contact</h4>
                        <p>Feel free to contact us through Twitter or Facebook if you prefer!</p>
                        <form id="contactForm" onsubmit="sendWhatsAppMessage(event)">
                            <div class="form-grp">
                                <input type="text" id="name" placeholder="Name" required>
                            </div>
                            <div class="form-grp">
                                <input type="email" id="email" placeholder="E-mail" required>
                            </div>
                            <div class="form-grp">
                                <input type="text" id="topic" placeholder="Topic" required>
                            </div>
                            <div class="form-grp">
                                <input type="text" id="phone" placeholder="Phone" maxlength="12" required
                                    title="Please enter a number with a maximum of 12 digits.">
                                <small id="error-message" style="color: red; display: none;">Masukkan nomor telepon
                                    anda</small>
                            </div>
                            <div class="form-grp">
                                <textarea id="message" placeholder="Type Message" required></textarea>
                            </div>
                            <button type="submit" class="btn arrow-btn">Kirim Pesan <img
                                    src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                    class="injectable"></button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- instructor-details-area-end -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen dengan class 'swiper-slide'
            var slides = document.querySelectorAll('.swiper-slide');

            // Tambahkan event listener untuk setiap slide
            slides.forEach(function(slide) {
                slide.addEventListener('click', function() {
                    // Cari elemen <a> di dalam slide yang diklik
                    var link = slide.querySelector('a');

                    // Jika elemen <a> ditemukan, lakukan redirect ke href-nya
                    if (link) {
                        window.location.href = link.getAttribute('href');
                    }
                });
            });
        });
        //phone
        const phoneInput = document.getElementById('phone');
        const errorMessage = document.getElementById('error-message');

        phoneInput.addEventListener('input', function() {
            // Menghapus karakter non-digit
            this.value = this.value.replace(/[^0-9]/g, '');

            // Menampilkan pesan kesalahan jika input tidak valid
            if (this.value.length > 12) {
                this.value = this.value.slice(0, 12);
            }

            // Cek jika input kosong atau bukan angka
            if (this.value === '') {
                errorMessage.style.display = 'none'; // Sembunyikan pesan jika tidak ada input
            } else if (isNaN(this.value)) {
                errorMessage.style.display = 'block'; // Tampilkan pesan jika input bukan angka
            } else {
                errorMessage.style.display = 'none'; // Sembunyikan pesan jika input valid
            }
        });

        // Validasi saat form disubmit
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            if (phoneInput.value === '') {
                errorMessage.style.display = 'block'; // Tampilkan pesan jika input kosong saat submit
                event.preventDefault(); // Mencegah form submit
            }
        });
        //wa
        function sendWhatsAppMessage(event) {
            event.preventDefault(); // Mencegah form submit default

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const topic = document.getElementById('topic').value;
            const phone = document.getElementById('phone').value;
            const message = document.getElementById('message').value;

            // Logging untuk memeriksa nilai yang diambil
            console.log("Name:", name);
            console.log("Email:", email);
            console.log("Topic:", topic);
            console.log("Phone:", phone);
            console.log("Message:", message);

            // Nomor telepon tujuan dari variabel PHP
            const instructorPhone = "{{ $instructorProfile->phone_number }}";

            // Konversi nomor telepon ke format internasional jika perlu
            let formattedPhone = instructorPhone;
            if (formattedPhone.startsWith('0')) {
                formattedPhone = '62' + formattedPhone.substring(1); // Mengganti 0 di awal dengan 62
            } else if (formattedPhone.startsWith('62')) {
                // Sudah dalam format internasional, tidak perlu diubah
            } else {
                console.error("Nomor telepon tidak valid.");
                return;
            }

            // Membuat pesan WhatsApp
            const whatsappMessage =
                `Halo, saya ${name}.%0AEmail: ${email}%0ATopik: ${topic}%0ANomor Telepon: ${phone}%0APesan: ${message}`;

            // Logging untuk memeriksa isi pesan dan URL
            console.log("WhatsApp Message:", whatsappMessage);

            // Mengarahkan ke URL WhatsApp
            const whatsappURL = `https://wa.me/${formattedPhone}?text=${whatsappMessage}`;
            console.log("WhatsApp URL:", whatsappURL); // Cek URL yang dibentuk

            window.open(whatsappURL, '_blank');
        }
    </script>
@endsection
