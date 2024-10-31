@section('title', 'ProSkill Akademia | Detail Kelas Tatap Muka')
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
                            <span property="itemListElement" typeof="ListItem">
                                @if ($courses->course_type == 'online')
                                    <a href="{{ route('course') }}">Kelas Online</a>
                                @else
                                    <a href="{{ route('classroom') }}">Kelas Tatap Muka</a>
                                @endif
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">{{ $courses->nama_kursus }}</span>
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

    <!-- courses-details-area -->
    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="courses__details-thumb">
                        <img src="{{ asset('public/uploads/' . $courses->gambar) }}" alt="img">
                    </div>
                    <div class="courses__details-content">

                        <h2 class="title">{{ $courses->nama_kursus }}</h2>
                        <div class="courses__details-meta">
                            <ul class="list-wrap">
                                <li class="author-two">
                                    <img src="{{ $courses->user->userprofile && $courses->user->userprofile->gambar ? (strpos($courses->user->userprofile->gambar, 'googleusercontent') !== false ? $courses->user->userprofile->gambar : asset('public/uploads/' . $courses->user->userprofile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                        alt="Profile Image"
                                        style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                                    <a
                                        href="{{ route('profile_instruktur', ['id' => $courses->user->id]) }}">{{ $courses->user->name }}</a>
                                </li>

                                <li class="date">
                                    <i class="flaticon-calendar"></i>{{ $courses->created_at->format('d/m/Y') }}
                                </li>

                                <li><i class="flaticon-mortarboard"></i>{{ $sertifikatCount }} Lulusan</li>
                                @if ($courses->course_type === 'online')
                                    <li>
                                        <i class="fas fa-users"></i>
                                        Member
                                        <span>{{ $jumlahPendaftaran }}</span>
                                    </li>
                                @endif

                            </ul>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview-tab-pane" type="button" role="tab"
                                    aria-controls="overview-tab-pane" aria-selected="true">Ringkasan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab"
                                    data-bs-target="#curriculum-tab-pane" type="button" role="tab"
                                    aria-controls="curriculum-tab-pane" aria-selected="false">Kurikulum</button>
                            </li>
                            @if ($courses->course_type !== 'online')
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="jadwal-tab" data-bs-toggle="tab"
                                        data-bs-target="#jadwal-tab-pane" type="button" role="tab"
                                        aria-controls="jadwal-tab-pane" aria-selected="false">Jadwal Kelas</button>
                                </li>
                            @endif
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                    aria-controls="reviews-tab-pane" aria-selected="false">reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                aria-labelledby="overview-tab" tabindex="0">
                                <div class="courses__overview-wrap">
                                    <h3 class="title">Apa yang akan Anda pelajari</h3>
                                    <ul class="about__info-list list-wrap">
                                        @foreach ($courseList as $course)
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">{{ $course }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <h3 class="title">Persyaratan</h3>
                                    <ul class="about__info-list list-wrap">
                                        @foreach ($perstaratan as $perstaratan)
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">{{ $perstaratan }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <h3 class="title">Deskripsi Kelas</h3>
                                    <p> {!! $courses->content !!}</p>

                                </div>
                                @if ($courses->course_type !== 'online')
                                    <h3 class="title mt-4">Kegiatan Kelas</h3>
                                @endif
                                @if ($courses->nama_kursus === 'Mahir Aplikasi Office Tingkat Advance')
                                    <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-start mt-5">
                                        <div class="courses__details-video w-100" style="height: 400px;">
                                            <!-- Ganti height sesuai kebutuhan -->
                                            <iframe class="w-100 rounded" style="height: 120%;"
                                                src="https://www.youtube.com/embed/J8s5kuaTiqo"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                @endif
                                @if ($courses->nama_kursus === 'Fundamental Computer Skill')
                                    <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-start mt-5">
                                        <div class="courses__details-video w-100" style="height: 400px;">
                                            <!-- Ganti height sesuai kebutuhan -->
                                            <iframe class="w-100 rounded" style="height: 120%;"
                                                src="https://www.youtube.com/embed/J8s5kuaTiqo"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                @endif
                                @if ($courses->nama_kursus === 'Digital Design Menggunakan Canva dan Figma')
                                    <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-start mt-5">
                                        <div class="courses__details-video w-100" style="height: 400px;">
                                            <!-- Ganti height sesuai kebutuhan -->
                                            <iframe class="w-100 rounded" style="height: 120%;"
                                                src="https://www.youtube.com/embed/J8s5kuaTiqo"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                @endif


                            </div>
                            <div class="tab-pane fade" id="curriculum-tab-pane" role="tabpanel"
                                aria-labelledby="curriculum-tab" tabindex="0">
                                <div class="courses__curriculum-wrap">
                                    <h3 class="title">Kurikulum Kelas</h3>
                                    <p>Apa saja yang akan dipelajari di kelas ini</p>
                                    <div class="accordion" id="accordionExample">
                                        @foreach ($kurikulum as $index => $kurikulumItem)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $index }}">
                                                    <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $index }}"
                                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                        aria-controls="collapse{{ $index }}">
                                                        {{ $kurikulumItem->title }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $index }}"
                                                    class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                                    aria-labelledby="heading{{ $index }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="list-wrap">

                                                            @foreach ($section[$kurikulumItem->id] ?? [] as $sectionItem)
                                                                <li
                                                                    class="course-item {{ $userHasAccess ? 'open-item' : '' }}">
                                                                    <a href="{{ $userHasAccess ? '#' : 'javascript:void(0);' }}"
                                                                        class="course-item-link {{ !$userHasAccess ? 'disabled-link' : '' }}"
                                                                        id="lesson-link-{{ $sectionItem->id }}">
                                                                        <span
                                                                            class="item-name">{{ $sectionItem->title }}</span>
                                                                        <div class="course-item-meta">
                                                                            <span
                                                                                class="item-meta duration">{{ $sectionItem->duration }}</span>
                                                                            @if (!$userHasAccess)
                                                                                <span class="item-meta course-item-status">
                                                                                    <img src="{{ asset('public/assets/img/icons/lock.svg') }}"
                                                                                        alt="icon">
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach

                                                            @if ($userHasAccess)
                                                                <script>
                                                                    // Extract the pageId from the current URL
                                                                    const currentUrl = window.location.href;
                                                                    const match = currentUrl.match(/classroomdetail\/(\d+)/);
                                                                    const pageId = match ? match[1] : null;

                                                                    // Apply the href to all lesson-link elements if pageId is found
                                                                    if (pageId) {
                                                                        const lessonLinks = document.querySelectorAll('[id^="lesson-link-"]');
                                                                        lessonLinks.forEach(link => {
                                                                            link.href = `/lesson/${pageId}`;
                                                                        });
                                                                    }
                                                                </script>
                                                            @endif


                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="jadwal-tab-pane" role="tabpanel" aria-labelledby="jadwal-tab"
                                tabindex="0">
                                @if ($courses->nama_kursus === 'Mahir Aplikasi Office Tingkat Advance')
                                    <div class="courses__curriculum-wrap">
                                        <h3 class="title">Senin dan Rabu</h3>

                                        <ul class="about__info-list list-wrap">
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Pagi : 10.00 - 11.30</p>
                                            </li>
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Siang : 14.30 - 16.00</p>
                                            </li>
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Malam : 19.00 - 20.30</p>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                @if ($courses->nama_kursus === 'Fundamental Computer Skill')
                                    <div class="courses__curriculum-wrap">
                                        <h3 class="title">Selasa dan Kamis</h3>

                                        <ul class="about__info-list list-wrap">
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Pagi : 10.00 - 11.30</p>
                                            </li>
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Siang : 14.30 - 16.00</p>
                                            </li>
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Malam : 19.00 - 20.30</p>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                @if ($courses->nama_kursus === 'Digital Design Menggunakan Canva dan Figma')
                                    <div class="courses__curriculum-wrap">
                                        <h3 class="title">Jumat dan Sabut</h3>

                                        <ul class="about__info-list list-wrap">
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Pagi : 09.30 - 11.00</p>
                                            </li>
                                            <li class="about__info-list-item">
                                                <i class="flaticon-angle-right"></i>
                                                <p class="content">Siang : 13.30 - 15.00</p>
                                            </li>

                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                aria-labelledby="reviews-tab" tabindex="0">
                                <div class="courses__rating-wrap">
                                    <h2 class="title">Reviews</h2>
                                    <div class="course-rate">
                                        <div class="course-rate__summary">
                                            <div class="course-rate__summary-value">

                                                {{ number_format($reviews->avg('rating'), 1) }}
                                            </div>
                                            <div class="course-rate__summary-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $reviews->avg('rating'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="course-rate__summary-text">
                                                {{ $reviews->count() }} Ratings
                                            </div>
                                        </div>

                                        <div class="course-rate__details">
                                            @for ($rating = 5; $rating >= 1; $rating--)
                                                <div class="course-rate__details-row">
                                                    <div class="course-rate__details-row-star">
                                                        {{ $rating }}
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="course-rate__details-row-value">
                                                        <div class="rating-gray"></div>
                                                        <div class="rating"
                                                            style="width:{{ ($reviews->where('rating', $rating)->count() / max(1, $reviews->count())) * 100 }}%;"
                                                            title="{{ ($reviews->where('rating', $rating)->count() / max(1, $reviews->count())) * 100 }}%">
                                                        </div>
                                                        <span
                                                            class="rating-count">{{ $reviews->where('rating', $rating)->count() }}</span>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <div id="review-container">
                                        @foreach ($reviews as $index => $review)
                                            <div class="course-review-head review"
                                                style="display: {{ $index < 1 ? 'block' : 'none' }};">
                                                <div class="review-author-thumb">
                                                    <img src="{{ $review->user->userprofile && $review->user->userprofile->gambar ? (strpos($review->user->userprofile->gambar, 'googleusercontent') !== false ? $review->user->userprofile->gambar : asset('public/uploads/' . $review->user->userprofile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                        alt="img"
                                                        style="border-radius: 50%; width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="review-author-content">
                                                    <div class="author-name">
                                                        <h5 class="name">{{ $review->user->name }}
                                                            <span>{{ $review->created_at->diffForHumans() }}</span>
                                                        </h5>
                                                        <div class="author-rating">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <i class="fas fa-star"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <h4 class="title">{{ $review->kelasTatapMuka->nama_kursus }}</h4>
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button id="load-more"
                                        style="display: {{ count($reviews) > 3 ? 'block' : 'none' }};">Tampilkan Lebih
                                        Banyak</button>

                                    <script>
                                        document.getElementById('load-more').addEventListener('click', function() {
                                            const reviews = document.querySelectorAll('.review');
                                            let displayed = 0;
                                            reviews.forEach((review, index) => {
                                                if (index < 3 + displayed) {
                                                    review.style.display = 'block';
                                                    displayed++;
                                                }
                                            });

                                            // Jika sudah menampilkan semua ulasan, sembunyikan tombol
                                            if (displayed >= reviews.length) {
                                                this.style.display = 'none';
                                            }
                                        });
                                    </script>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-xl-3 col-lg-4">
                    <div class="courses__details-sidebar">
                        <div class="courses__cost-wrap">
                            <span>Kursus Fee:</span>
                            <h2 class="title">
                                @if (!empty($courses->discountedPrice) && $courses->discount != 0)
                                    <div>
                                        <span style="font-size: 15px; text-decoration: line-through; opacity: 0.8;">
                                            Rp {{ number_format($courses->price, 0, ',', '.') }}
                                        </span>
                                        <span style="font-size: 30px; font-weight: bold;">
                                            Rp {{ number_format($courses->discountedPrice, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @else
                                    <span>Rp {{ number_format($courses->price, 0, ',', '.') }}</span>
                                @endif

                            </h2>

                        </div>
                        <div class="courses__information-wrap">
                            <h5 class="title">Keterangan:</h5>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon01.svg') }}" alt="img"
                                        class="injectable">
                                    Tingkat
                                    <span>{{ $courses->tingkat }}</span>
                                </li>
                                @if ($courses->course_type !== 'online')
                                    <li>
                                        <img src="{{ asset('public/assets/img/icons/course_icon02.svg') }}"
                                            alt="img" class="injectable">
                                        Durasi
                                        <span>{{ $courses->durasi }}</span>
                                    </li>
                                @endif
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon05.svg') }}" alt="img"
                                        class="injectable">
                                    Sertifikat
                                    <span>{{ $courses->sertifikat }}</span>
                                </li>
                                @if ($courses->course_type !== 'online')
                                    <li>
                                        <img src="{{ asset('public/assets/img/icons/course_icon06.svg') }}"
                                            alt="img" class="injectable">
                                        Kuota Kelas
                                        <span>{{ $jumlahPendaftaran }}/{{ $courses->kuota }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        @if (in_array($courses->id, $joinedCourses))
                            <div class="courses__details-enroll">
                                <div class="tg-button-wrap">
                                    <a href="{{ route('lesson', ['id' => $courses->id]) }}"
                                        class="btn btn-two arrow-btn">Lanjut Belajar</a>
                                </div>
                            </div>
                        @elseif ($courses->course_type == 'online')
                            {{-- Kursus online tanpa batasan kuota dan tanpa tombol pendaftaran penuh --}}
                            <div class="courses__details-enroll">
                                <div class="tg-button-wrap">
                                    <a href="{{ route('cart.checkout', ['id' => $courses->id]) }}"
                                        class="btn btn-two arrow-btn">
                                        Checkout
                                        <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                            class="injectable">
                                    </a>
                                </div>
                                <br>
                                <div class="tg-button-wrap">
                                    <a href="{{ route('cart.adddetail', ['id' => $courses->id]) }}"
                                        class="btn">Masukkan keranjang
                                        <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                            class="injectable">
                                    </a>
                                </div>
                            </div>
                        @elseif ($jumlahPendaftaran < $courses->kuota)
                            <div class="courses__details-enroll">
                                <div class="tg-button-wrap">
                                    <a href="{{ route('cart.checkout', ['id' => $courses->id]) }}"
                                        class="btn btn-two arrow-btn">
                                        Checkout
                                        <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                            class="injectable">
                                    </a>
                                </div>
                                <br>
                                <div class="tg-button-wrap">
                                    <a href="{{ route('cart.adddetail', ['id' => $courses->id]) }}"
                                        class="btn">Masukkan keranjang
                                        <img src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img"
                                            class="injectable">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="courses__details-enroll">
                                <div class="tg-button-wrap">
                                    <a href="#" class="btn btn-secondary disabled">Pendaftaran Penuh</a>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- courses-details-area-end -->

@endsection
