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
                        <div class="col-xl-4 col-md-6">
                            <div class="blog__post-item shine__animate-item">
                                <div class="blog__post-thumb">
                                    <a href="blog-details.html" class="shine__animate-link"><img
                                            src="public/assets/img/blog/blog_post01.jpg" alt="img"></a>
                                    <a href="blog.html" class="post-tag">Marketing</a>
                                </div>
                                <div class="blog__post-content">
                                    <div class="blog__post-meta">
                                        <ul class="list-wrap">
                                            <li><i class="flaticon-calendar"></i>20 July, 2024</li>
                                            <li><i class="flaticon-user-1"></i>by <a href="blog-details.html">Admin</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="title blog-name"><a href="blog-details.html">How To Become idiculously
                                            Self-Aware In
                                            20 Minutes</a></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                    <nav class="pagination__wrap mt-25">
                        <ul class="list-wrap">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="blog.html">2</a></li>
                            <li><a href="blog.html">3</a></li>
                            <li><a href="blog.html">4</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <aside class="blog-sidebar">
                        <div class="blog-widget widget_search">
                            <div class="sidebar-search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search here">
                                    <button><i class="flaticon-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="blog-widget">
                            <h4 class="widget-title">Categories</h4>
                            <div class="shop-cat-list">
                                <ul class="list-wrap">
                                    <li>
                                        <a href="#"><i class="flaticon-angle-right"></i>Art & Design</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="flaticon-angle-right"></i>Business</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="flaticon-angle-right"></i>Data Science</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="flaticon-angle-right"></i>Development</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="flaticon-angle-right"></i>Finance</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="flaticon-angle-right"></i>Health & Fitness</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="flaticon-angle-right"></i>Lifestyle</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-widget">
                            <h4 class="widget-title">Latest Post</h4>
                            <div class="rc-post-item">
                                <div class="rc-post-thumb">
                                    <a href="blog-details.html">
                                        <img src="public/assets/img/blog/latest_post01.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="rc-post-content">
                                    <span class="date"><i class="flaticon-calendar"></i> April 13, 2024</span>
                                    <h4 class="title"><a href="blog-details.html">the Right Learning Path for your</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="rc-post-item">
                                <div class="rc-post-thumb">
                                    <a href="blog-details.html">
                                        <img src="public/assets/img/blog/latest_post02.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="rc-post-content">
                                    <span class="date"><i class="flaticon-calendar"></i> April 13, 2024</span>
                                    <h4 class="title"><a href="blog-details.html">The Growing Need Management</a></h4>
                                </div>
                            </div>
                            <div class="rc-post-item">
                                <div class="rc-post-thumb">
                                    <a href="blog-details.html">
                                        <img src="public/assets/img/blog/latest_post03.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="rc-post-content">
                                    <span class="date"><i class="flaticon-calendar"></i> April 13, 2024</span>
                                    <h4 class="title"><a href="blog-details.html">the Right Learning Path for your</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="rc-post-item">
                                <div class="rc-post-thumb">
                                    <a href="blog-details.html">
                                        <img src="public/assets/img/blog/latest_post04.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="rc-post-content">
                                    <span class="date"><i class="flaticon-calendar"></i> April 13, 2024</span>
                                    <h4 class="title"><a href="blog-details.html">The Growing Need Management</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="blog-widget">
                            <h4 class="widget-title">Tags</h4>
                            <div class="tagcloud">
                                <a href="#">Education</a>
                                <a href="#">Training</a>
                                <a href="#">Online</a>
                                <a href="#">Learn</a>
                                <a href="#">Course</a>
                                <a href="#">LMS</a>
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
    </script> --}}

@endsection
