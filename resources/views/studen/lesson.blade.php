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
                        <div class="accordion" id="accordionExample">
                            @foreach ($orders as $order)
                                @php
                                    $kelasTatapMuka = $order->KelasTatapMuka;
                                @endphp
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $kelasTatapMuka->id }}" aria-expanded="false"
                                            aria-controls="collapse{{ $kelasTatapMuka->id }}">
                                            {{ $kelasTatapMuka->name }}
                                            <span>{{ count($kelasTatapMuka->lessons) }}/{{ count($kelasTatapMuka->lessons) }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $kelasTatapMuka->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-wrap">
                                                @foreach ($kelasTatapMuka->lessons as $lesson)
                                                    <li class="course-item">
                                                        <a href="#" class="course-item-link">
                                                            <span class="item-name">{{ $lesson->title }}</span>
                                                            <div class="course-item-meta">
                                                                <span
                                                                    class="item-meta duration">{{ $lesson->duration }}</span>
                                                                @if ($lesson->is_locked)
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
                            @endforeach
                        </div>
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
                        <video id="player" playsinline controls
                            data-poster="{{ asset('assets/img/bg/video_bg.webp') }}">
                            <source src="{{ asset('assets/video/video.mp4') }}" type="video/mp4" />
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
