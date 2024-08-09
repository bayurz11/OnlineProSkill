@section('title', 'ProSkill Akademia | Artikel Detail')
<?php $page = 'Artikel'; ?>

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
                        <h3 class="title">{{ $blog->title }}</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('blog') }}">Artikel</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">{{ $blog->title }}</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape01.svg') }}" alt="img" class="alltuchtopdown"
                loading="lazy">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape02.svg') }}" alt="img" data-aos="fade-right"
                data-aos-delay="300" loading="lazy">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape03.svg') }}" alt="img" data-aos="fade-up"
                data-aos-delay="400" loading="lazy">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape04.svg') }}" alt="img"
                data-aos="fade-down-left" data-aos-delay="400" loading="lazy">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape05.svg') }}" alt="img" data-aos="fade-left"
                data-aos-delay="400" loading="lazy">
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- blog-details-area -->
    <section class="blog-details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="blog__details-wrapper">
                        <div class="blog__details-thumb">
                            <img src="{{ asset('public/uploads/' . $blog->gambar) }}" alt="img">
                        </div>
                        <div class="blog__details-content">
                            <div class="blog__post-meta">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-calendar"></i>{{ Carbon::parse($blog->date)->format('d M, Y') }}
                                    </li>
                                    <li><i class="flaticon-user-1"></i> by <a href="#">{{ $blog->user->name }}</a>
                                    </li>

                                </ul>
                            </div>
                            <h3 class="title">{{ $blog->title }}</h3>
                            <div style="text-align: justify;">
                                {!! $blog->content !!}
                            </div>



                            <div class="blog__details-bottom">
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-md-7">
                                        <div class="tg-post-tag">
                                            <h5 class="tag-title">Tags :</h5>
                                            <ul class="list-wrap p-0 mb-0">
                                                <li><a href="#">@php
                                                    $tags = json_decode($blog->tag, true);
                                                @endphp

                                                        @if (is_array($tags))
                                                            @foreach ($tags as $tag)
                                                                {{ $tag['value'] }}
                                                            @endforeach
                                                        @endif
                                                    </a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-5">
                                        <div class="tg-post-social justify-content-start justify-content-md-end">
                                            <h5 class="social-title">Share :</h5>
                                            <ul class="list-wrap p-0 mb-0">
                                                <li><a href="#"
                                                        onclick="shareOnFacebook('{{ url()->current() }}')"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"
                                                        onclick="shareOnTwitter('{{ url()->current() }}', '{{ $blog->title }}')"><i
                                                            class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"
                                                        onclick="shareOnLinkedIn('{{ url()->current() }}')"><i
                                                            class="fab fa-linkedin-in"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-3 col-lg-4">
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
                                        $uniqueCategories = $blogs->unique('kategori_id');
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
                </div> --}}
            </div>
        </div>
    </section>
    <!-- blog-details-area-end -->

    <script>
        function shareOnFacebook(url) {
            const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            window.open(facebookUrl, 'facebook-share-dialog', 'width=800,height=600');
            return false;
        }

        function shareOnTwitter(url, text) {
            const twitterUrl =
                `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
            window.open(twitterUrl, 'twitter-share-dialog', 'width=800,height=600');
            return false;
        }

        function shareOnLinkedIn(url) {
            const linkedinUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
            window.open(linkedinUrl, 'linkedin-share-dialog', 'width=800,height=600');
            return false;
        }
    </script>
@endsection
