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
                            @foreach ($kurikulum as $index => $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            {{ $item->title }}
                                            <span>{{ $item->sections->count() }}/{{ $item->sections->count() }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-wrap">
                                                @foreach ($item->sections as $section)
                                                    <li class="course-item {{ $loop->first ? 'open-item' : '' }}">
                                                        <a href="#"
                                                            class="course-item-link {{ $loop->first ? 'active' : '' }}"
                                                            data-title="{{ $section->title }}"
                                                            data-link="{{ $section->link }}"
                                                            data-type="{{ $section->type }}">
                                                            <span class="item-name">{{ $section->title }}</span>
                                                            <div class="course-item-meta">
                                                                <span
                                                                    class="item-meta duration">{{ $section->duration }}</span>
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
                        <div class="lesson__video-wrap-top d-flex justify-content-between align-items-center">
                            <div class="lesson__video-wrap-top-left d-flex align-items-center">
                                <a href="#"><i class="flaticon-arrow-right"></i></a>
                                <span id="section-title">The Complete Design Course: From Zero to Expert!</span>
                            </div>
                            <div class="lesson__video-wrap-top-right">
                                <a href="{{ route('akses_pembelian') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div id="content-display">
                            <!-- Konten pelajaran pertama akan diinisialisasi di sini menggunakan JavaScript -->
                        </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil pelajaran pertama
            let firstCourseItem = document.querySelector('.course-item-link');
            if (firstCourseItem) {
                firstCourseItem.click();
            }
        });

        document.querySelectorAll('.course-item-link').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                let title = this.getAttribute('data-title');
                let link = this.getAttribute('data-link');
                let type = this.getAttribute('data-type');

                console.log('Title:', title);
                console.log('Link:', link);
                console.log('Type:', type);

                document.getElementById('section-title').textContent = title;

                let contentDisplay = document.getElementById('content-display');
                contentDisplay.innerHTML = ''; // Clear previous content

                if (type === 'video') {
                    let video = document.createElement('video');
                    video.setAttribute('id', 'player');
                    video.setAttribute('playsinline', '');
                    video.setAttribute('controls', '');
                    video.setAttribute('data-poster', 'assets/img/bg/video_bg.webp');

                    let sourceMP4 = document.createElement('source');
                    sourceMP4.setAttribute('src', link);
                    sourceMP4.setAttribute('type', 'video/mp4');

                    video.appendChild(sourceMP4);
                    contentDisplay.appendChild(video);
                    console.log('Video element added:', video);
                } else if (type === 'pdf') {
                    let iframe = document.createElement('iframe');
                    iframe.setAttribute('src', link);
                    iframe.setAttribute('width', '100%');
                    iframe.setAttribute('height', '500px');

                    contentDisplay.appendChild(iframe);
                } else if (type === 'youtube') {
                    let videoId = link.split('v=')[1];
                    let ampersandPosition = videoId.indexOf('&');
                    if (ampersandPosition !== -1) {
                        videoId = videoId.substring(0, ampersandPosition);
                    }
                    let iframe = document.createElement('iframe');
                    iframe.setAttribute('width', '100%');
                    iframe.setAttribute('height', '500px');
                    iframe.setAttribute('src', `https://www.youtube.com/embed/${videoId}`);
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allow',
                        'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                    );
                    iframe.setAttribute('allowfullscreen', '');

                    contentDisplay.appendChild(iframe);
                }
            });
        });
    </script>
@endsection
