@extends('layout.mainlayout')

@section('title', 'ProSkill Akademia | Kelas Tatap Muka')
<?php $page = 'classroom'; ?>

@section('content')

    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Kelas Tatap Muka</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Kelas Tatap Muka</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- all-courses -->
    <section class="all-courses-area section-py-120">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-xl-3 col-lg-4">
                    <div class="sidebar">
                        <h4 class="sidebar-title">Filter</h4>
                        <div class="sidebar-filter">
                            <h5>Kategori</h5>
                            <ul>
                                @foreach ($categori as $category)
                                    <li>
                                        <a
                                            href="{{ route('classroom.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar-filter">
                            <h5>Harga</h5>
                            <form method="GET" action="{{ route('classroom.index') }}">
                                <div class="price-range">
                                    <input type="number" name="min_price" placeholder="Min Price">
                                    <input type="number" name="max_price" placeholder="Max Price">
                                    <button type="submit">Filter</button>
                                </div>
                            </form>
                        </div>
                        <div class="sidebar-filter">
                            <h5>Tingkat Keterampilan</h5>
                            <ul>
                                @foreach ($skillLevels as $level)
                                    <li>
                                        <a
                                            href="{{ route('classroom.index', ['skill_level' => $level->id]) }}">{{ $level->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Filter End -->

                <!-- Courses Grid -->
                <div class="col-xl-9 col-lg-8">
                    <div class="courses-top-wrap">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="courses-top-left">
                                    <p>Menampilkan {{ $results->count() }} Hasil Total</p>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div
                                    class="d-flex justify-content-center justify-content-md-end align-items-center flex-wrap">
                                    <div class="courses-top-right m-0 ms-md-auto">
                                        <span class="sort-by">Urutkan Berdasarkan:</span>
                                        <div class="courses-top-right-select">
                                            <select name="orderby" class="orderby">
                                                <option value="Most Popular">Paling Populer</option>
                                                <option value="popularity">Popularitas</option>
                                                <option value="average rating">Rating Rata-rata</option>
                                                <option value="latest">Terbaru</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                        @foreach ($results as $cours)
                            <div class="col">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset('public/uploads/' . $cours->gambar) }}" alt="Banner">
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <h5 class="title">
                                            <a
                                                href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
                                        </h5>
                                        <p class="author">By <a href="#">{{ $cours->user->name }}</a></p>
                                        <div class="courses__item-bottom">
                                            <div class="button">
                                                <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}">
                                                    <span class="text">Detail</span>
                                                    <i class="flaticon-arrow-right"></i>
                                                </a>
                                            </div>
                                            <h5 class="price">Rp {{ number_format($cours->price, 0, ',', ',') }}</h5>
                                            @if ($cours->course_type == 'online')
                                                <span class="badge bg-primary">Online</span>
                                            @else
                                                <span class="badge bg-secondary">Offline</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            {{ $results->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- all-courses-end -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var paragraphs = document.querySelectorAll('.content p');
            paragraphs.forEach(function(p) {
                var parent = p.parentNode;
                while (p.firstChild) {
                    parent.insertBefore(p.firstChild, p);
                }
                parent.removeChild(p);
            });
        });
    </script>
@endsection
