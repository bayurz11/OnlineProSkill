@extends('layout.mainlayout')

@section('content')
    <section class="lesson__area section-pb-120">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-4 col-lg-4">
                    <div class="lesson__content">
                        <h2 class="title">Konten Kursus</h2>

                        @if ($kurikulum->isEmpty())
                            <p>Data kurikulum belum tersedia.</p>
                        @else
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
                                                        <li class="course-item">
                                                            <a href="#" class="course-item-link"
                                                                data-title="{{ $section->title }}"
                                                                data-link="{{ $section->link ? asset($section->link) : asset($section->file_path) }}"
                                                                data-type="{{ $section->type }}"
                                                                data-id="{{ $section->id }}"
                                                                onclick="changeContent(this, event)">
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
                        @endif
                    </div>
                </div>
                @if (!$kurikulum->isEmpty())
                    <div class="col-xl-8 col-lg-8">
                        <div class="lesson__video-wrap">
                            <div class="lesson__video-wrap-top">
                                <span id="currentContentTitle">{{ $kurikulum[0]->sections->first()->title }}</span>
                            </div>
                            <div class="lesson__video-embed">
                                <iframe id="lessonContent" width="100%" height="500" src="" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="lesson__next-prev-button d-flex justify-content-between">
                                <button class="prev-button" onclick="prevContent()"><i
                                        class="flaticon-arrow-left"></i></button>
                                <button class="next-button" onclick="nextContent()"><i
                                        class="flaticon-arrow-right"></i></button>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button id="completeButton" class="btn btn-primary"
                                    onclick="markAsComplete()">Menyelesaikan</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadInitialContent();
            loadCompletionStatus();
        });

        function changeContent(element, event) {
            event.preventDefault();

            const fileUrl = element.getAttribute('data-link');
            const fileType = element.getAttribute('data-type');
            const sectionId = element.getAttribute('data-id');
            const title = element.getAttribute('data-title');

            let fileSrc = '';
            const youtubeRegex = /(?:youtube\.com|youtu\.be)/;
            const driveRegex = /(?:drive\.google\.com)/;

            if (youtubeRegex.test(fileUrl)) {
                const youtubeId = fileUrl.split('v=')[1].split('&')[0];
                fileSrc = `https://www.youtube.com/embed/${youtubeId}`;
            } else if (driveRegex.test(fileUrl)) {
                const driveId = fileUrl.split('/d/')[1].split('/')[0];
                fileSrc = `https://drive.google.com/file/d/${driveId}/preview`;
            } else {
                fileSrc = fileUrl;
            }

            document.getElementById('lessonContent').src = fileSrc;
            document.getElementById('currentContentTitle').innerText = title;
            document.getElementById('sectionId').value = sectionId;
        }

        function loadInitialContent() {
            const firstSection = document.querySelector('.course-item-link');
            if (firstSection) {
                changeContent(firstSection, new Event('click'));
            }
        }

        function markAsComplete() {
            const sectionId = document.getElementById('sectionId').value;
            const completedSections = JSON.parse(localStorage.getItem('completedSections')) || [];

            if (!completedSections.includes(sectionId)) {
                completedSections.push(sectionId);
                localStorage.setItem('completedSections', JSON.stringify(completedSections));
                updateCompletionStatus(sectionId);
                alert("Section telah diselesaikan!");
            }
        }

        function loadCompletionStatus() {
            const completedSections = JSON.parse(localStorage.getItem('completedSections')) || [];

            completedSections.forEach(sectionId => {
                updateCompletionStatus(sectionId);
            });
        }

        function updateCompletionStatus(sectionId) {
            const sectionLinks = document.querySelectorAll(`.course-item-link[data-id="${sectionId}"]`);

            sectionLinks.forEach(link => {
                link.classList.add('completed');
                const checkIcon = document.createElement('i');
                checkIcon.className = 'fas fa-check text-success';
                link.appendChild(checkIcon);
            });
        }

        function nextContent() {
            const activeLink = document.querySelector('.course-item-link.active');
            const nextLink = activeLink.parentElement.nextElementSibling?.querySelector('.course-item-link');

            if (nextLink) {
                changeContent(nextLink, new Event('click'));
            }
        }

        function prevContent() {
            const activeLink = document.querySelector('.course-item-link.active');
            const prevLink = activeLink.parentElement.previousElementSibling?.querySelector('.course-item-link');

            if (prevLink) {
                changeContent(prevLink, new Event('click'));
            }
        }
    </script>
@endsection
