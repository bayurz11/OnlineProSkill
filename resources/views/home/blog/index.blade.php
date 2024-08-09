@section('title', 'ProSkill Akademia | Blog')
<?php $page = 'classroom'; ?>

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
                        <h3 class="title">Blog</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Blog</span>
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

    <!-- blog-area -->
    <section class="blog-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="row gutter-20">
                        @if ($blog->isEmpty())
                            <p>Tidak ditemukan postingan blog yang sesuai dengan kriteria pencarian Anda.</p>
                        @else
                            @foreach ($blog as $item)
                                <div class="col-xl-4 col-md-6">
                                    <div class="blog__post-item shine__animate-item">
                                        <div class="blog__post-thumb">
                                            <a href="{{ route('blog_detail', ['id' => $item->id]) }}"
                                                class="shine__animate-link">
                                                <img src="{{ asset('public/uploads/' . $item->gambar) }}" alt="img">
                                            </a>
                                            <a href="" class="post-tag">
                                                {{ json_decode($item->tag, true)[0]['value'] }}
                                            </a>
                                        </div>
                                        <div class="blog__post-content">
                                            <div class="blog__post-meta">
                                                <ul class="list-wrap">
                                                    <li><i
                                                            class="flaticon-calendar"></i>{{ Carbon::parse($item->date)->format('d M, Y') }}
                                                    </li>
                                                    <li><i class="flaticon-user-1"></i>by <a
                                                            href="{{ route('blog_detail', ['id' => $item->id]) }}">{{ $item->user->name }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <h4 class="title blog-name"><a
                                                    href="{{ route('blog_detail', ['id' => $item->id]) }}">{{ $item->title }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Tambahkan pagination -->
                    <nav class="pagination__wrap mt-25">
                        {{ $blog->links($paginationView) }}
                    </nav>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <aside class="blog-sidebar">
                        <div class="blog-widget widget_search">
                            <div class="sidebar-search-form">
                                <form action="{{ route('blog') }}" method="GET">
                                    <input type="text" name="search" placeholder="Search here"
                                        value="{{ request()->input('search') }}">
                                    <button type="submit"><i class="flaticon-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="blog-widget">
                            <h4 class="widget-title">Kategori</h4>
                            <div class="shop-cat-list">
                                <ul class="list-wrap">
                                    @php
                                        // Mengambil hanya kategori yang unik berdasarkan kategori_id
                                        $uniqueCategories = $categories->unique('kategori_id');
                                    @endphp

                                    @foreach ($uniqueCategories as $category)
                                        <li>
                                            <a href="{{ route('blog', ['category' => $category->kategori_id]) }}">
                                                <i
                                                    class="flaticon-angle-right"></i>{{ $category->kategori->name_kategori }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <div class="blog-widget">
                            <h4 class="widget-title">Tags</h4>
                            <div class="tagcloud">
                                @foreach ($tags as $tag)
                                    <a href="{{ route('blog', ['tag' => $tag]) }}">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>

    <!-- blog-area-end -->

    <script>
        // Mengatur tinggi untuk elemen blog-name
        var blogNames = document.querySelectorAll('.blog-name');
        var maxEventNameHeight = 0;

        // Temukan tinggi maksimum untuk blog-name
        blogNames.forEach(function(eventName) {
            var height = eventName.offsetHeight;
            if (height > maxEventNameHeight) {
                maxEventNameHeight = height;
            }
        });

        // Tetapkan tinggi maksimum ke semua elemen blog-name
        blogNames.forEach(function(eventName) {
            eventName.style.height = maxEventNameHeight + 'px';
        });
    </script>

@endsection
