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
                        @foreach ($kurikulum as $key => $item)
                            <div class="accordion" id="accordionExample{{ $key }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $key }}" aria-expanded="true"
                                            aria-controls="collapse{{ $key }}">
                                            {{ $item->title }}
                                            <span>1/3</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $key }}" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample{{ $key }}">
                                        <div class="accordion-body">
                                            <ul class="list-wrap">
                                                <li class="course-item open-item">
                                                    <a href="#" class="course-item-link active">
                                                        <span class="item-name">Course Installation</span>
                                                        <div class="course-item-meta">
                                                            <span class="item-meta duration">03:03</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!-- Tambahkan item-item lainnya sesuai kebutuhan -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Accordion lainnya sesuai kebutuhan -->
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
