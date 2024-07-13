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
                                                            data-type="{{ $section->type }}" onclick="changeVideo(this)">
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
                        <div class="lesson__video-wrap-top">
                            <div class="lesson__video-wrap-top-left">
                                <a href="#"><i class="flaticon-arrow-right"></i></a>
                                <span id="currentVideoTitle">{{ $kurikulum[0]->sections->first()->title }}</span>
                            </div>
                            <div class="lesson__video-wrap-top-right">
                                <a href="#"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="lesson__video-embed">
                            <iframe id="lessonVideo" width="100%" height="500" src="" frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                        <div class="lesson__next-prev-button">
                            <button class="prev-button" title="Previous Video" onclick="prevVideo()"><i
                                    class="flaticon-arrow-left"></i></button>
                            <button class="next-button" title="Next Video" onclick="nextVideo()"><i
                                    class="flaticon-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- lesson-area-end -->

    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        var player;
        var videoFinished = false;

        // YouTube API ready
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('lessonVideo', {
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // Function to handle video state change
        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                videoFinished = true;
            }
        }

        // Function to change the video iframe source
        function changeVideo(element) {
            var youtubeUrl = element.getAttribute('data-link');
            var regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
            var match = youtubeUrl.match(regex);
            var youtubeId = match[1];
            document.getElementById('lessonVideo').src = 'https://www.youtube.com/embed/' + youtubeId;
            document.getElementById('currentVideoTitle').innerText = element.getAttribute('data-title');

            // Remove active class from previously active links
            var activeLinks = document.querySelectorAll('.course-item-link.active');
            activeLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to the clicked link
            element.classList.add('active');

            // Reset video finished flag
            videoFinished = false;
        }

        // Initialize the first video on page load
        document.addEventListener('DOMContentLoaded', function() {
            var firstVideoLink = document.querySelector('.course-item-link.active');
            if (firstVideoLink) {
                changeVideo(firstVideoLink);
            }
        });

        // Function to get the next video
        function nextVideo() {
            if (!videoFinished) {
                alert("Selesaikan video saat ini sebelum melanjutkan ke video berikutnya.");
                return;
            }

            var activeLink = document.querySelector('.course-item-link.active');
            var nextLink = activeLink.parentElement.nextElementSibling?.querySelector('.course-item-link');
            if (nextLink) {
                changeVideo(nextLink);
            }
        }

        // Function to get the previous video
        function prevVideo() {
            var activeLink = document.querySelector('.course-item-link.active');
            var prevLink = activeLink.parentElement.previousElementSibling?.querySelector('.course-item-link');
            if (prevLink) {
                changeVideo(prevLink);
            }
        }
    </script>
@endsection
