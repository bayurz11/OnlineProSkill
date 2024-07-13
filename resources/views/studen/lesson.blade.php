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
                            <iframe id="content-iframe" style="width: 100%; height: 500px;"></iframe>
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
            const courseLinks = document.querySelectorAll('.course-item-link');
            const contentTitle = document.getElementById('section-title');
            const contentIframe = document.getElementById('content-iframe');

            courseLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const title = this.getAttribute('data-title');
                    const linkUrl = this.getAttribute('data-link');
                    const type = this.getAttribute('data-type');

                    contentTitle.textContent = title;

                    if (type === 'youtube') {
                        contentIframe.src =
                            `https://www.youtube.com/embed/${extractYouTubeID(linkUrl)}`;
                    } else if (type === 'pdf') {
                        contentIframe.src = linkUrl;
                    } else {
                        contentIframe.src = '';
                    }

                    // Remove active class from all links and add to the clicked one
                    courseLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            function extractYouTubeID(url) {
                const regExp = /^.*(?:youtu.be\/|v\/|embed\/|watch\?v=|&v=)([^#\&\?]*).*/;
                const match = url.match(regExp);
                return (match && match[1].length === 11) ? match[1] : null;
            }
        });
    </script>

@endsection
