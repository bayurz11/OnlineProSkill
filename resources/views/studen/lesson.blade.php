@section('title', 'ProSkill Akademia | Materi Pelajaran')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- lesson-area -->
    <section class="lesson__area section-pb-120">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-3 col-lg-4">
                    <div class="lesson__content">
                        <h2 class="title">Konten Kursus</h2>
                        @foreach ($kurikulum as $item)
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $item->no_urut }}" aria-expanded="true"
                                            aria-controls="collapse{{ $item->no_urut }}">
                                            {{ $item->judul }}
                                            <span>{{ $item->no_urut }}/3</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $item->no_urut }}" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-wrap">
                                                @foreach ($item->courses as $course)
                                                    <li class="course-item">
                                                        <a href="#" class="course-item-link">
                                                            <span class="item-name">{{ $course->title }}</span>
                                                            <div class="course-item-meta">
                                                                <span
                                                                    class="item-meta duration">{{ $course->duration }}</span>
                                                                @if ($course->locked)
                                                                    <span class="item-meta course-item-status">
                                                                        <img src="{{ asset('public/assets/img/icons/lock.svg') }}"
                                                                            alt="icon">
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="lesson__video-wrap">
                        <div class="lesson__video-wrap-top">
                            <div class="lesson__video-wrap-top-left">
                                <a href="#"><i class="flaticon-arrow-right"></i></a>
                                <span>The Complete Design Course: From Zero to Expert!</span>
                            </div>
                            <div class="lesson__video-wrap-top-right">
                                <a href="{{ route('akses_pembelian') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <video id="player" playsinline controls data-poster="assets/img/bg/video_bg.webp">
                            <source src="assets/video/video.mp4" type="video/mp4" />
                            <source src="/path/to/video.webm" type="video/webm" />
                        </video>
                        <div class="lesson__next-prev-button">
                            <button class="prev-button" title="Create a Simple React App"><i
                                    class="flaticon-arrow-right"></i></button>
                            <button class="next-button" title="React for the Rest of us"><i
                                    class="flaticon-arrow-right"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- lesson-area-end -->
@endsection
