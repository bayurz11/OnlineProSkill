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
                <div class="col-xl-9 col-lg-8">
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
                            {!! $blog->content !!}


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
                                                <li><a href="#">Cleaning</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-5">
                                        <div class="tg-post-social justify-content-start justify-content-md-end">
                                            <h5 class="social-title">Share :</h5>
                                            <ul class="list-wrap p-0 mb-0">
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog__post-author">
                        <div class="blog__post-author-thumb">
                            <a href="#"><img src="assets/img/blog/author.png" alt="img"></a>
                        </div>
                        <div class="blog__post-author-content">
                            <span class="designation">Author</span>
                            <h5 class="name">Brooklyn Simmons</h5>
                            <p>Finanappreciate your trust greatly Our clients choose dentace ducts a curae in tristique
                                liberois ultrices diamraesent varius diam dui. Class aptent taciti sociosqu ad litora
                                torquent per.</p>
                        </div>
                    </div>
                    <div class="blog-post-comment">
                        <div class="comment-wrap">
                            <div class="comment-wrap-title">
                                <h4 class="title">02 Comments</h4>
                            </div>
                            <div class="latest-comments">
                                <ul class="list-wrap">
                                    <li>
                                        <div class="comments-box">
                                            <div class="comments-avatar">
                                                <img src="assets/img/blog/comment01.png" alt="img">
                                            </div>
                                            <div class="comments-text">
                                                <div class="avatar-name">
                                                    <h6 class="name">Jessica Rose</h6>
                                                    <span class="date">20 July, 2024</span>
                                                </div>
                                                <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non
                                                    turpis semper bibendum. Ut ac nisi porta, malesuada risus nonVestibulum
                                                    ante ipsum primisMaximus ligula eleifend id nisl quis interdum. </p>
                                                <div class="comment-reply">
                                                    <a href="#" class="comment-reply-link">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comments-box">
                                            <div class="comments-avatar">
                                                <img src="assets/img/blog/comment02.png" alt="img">
                                            </div>
                                            <div class="comments-text">
                                                <div class="avatar-name">
                                                    <h6 class="name">Parker Willy</h6>
                                                    <span class="date">20 July, 2024</span>
                                                </div>
                                                <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non
                                                    turpis semper bibendum. Ut ac nisi porta, malesuada risus nonVestibulum
                                                    ante ipsum primis</p>
                                                <div class="comment-reply">
                                                    <a href="#" class="comment-reply-link">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="comment-respond">
                            <h4 class="comment-reply-title">Post a comment</h4>
                            <form action="#" class="comment-form">
                                <p class="comment-notes">
                                    <span>Your email address will not be published. Required fields are marked *</span>
                                </p>
                                <div class="comment-field">
                                    <textarea placeholder="Comment"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="comment-field">
                                            <input type="text" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="comment-field">
                                            <input type="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="comment-field">
                                            <input type="text" placeholder="Website">
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-field checkbox-grp">
                                    <input type="checkbox" id="checkbox_two">
                                    <label for="checkbox_two">Save my name, email, and website in this browser for the next
                                        time I comment.</label>
                                </div>
                                <p class="form-submit"></p>
                                <button class="btn btn-two arrow-btn">Post Comment <img
                                        src="assets/img/icons/right_arrow.svg" alt="img"
                                        class="injectable"></button>
                            </form>
                        </div>
                    </div>
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
                                        <img src="assets/img/blog/latest_post01.jpg" alt="img">
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
                                        <img src="assets/img/blog/latest_post02.jpg" alt="img">
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
                                        <img src="assets/img/blog/latest_post03.jpg" alt="img">
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
                                        <img src="assets/img/blog/latest_post04.jpg" alt="img">
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
    <!-- blog-details-area-end -->
@endsection
