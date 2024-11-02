@extends('layout.mainlayout')

@section('content')
    <!-- lesson-area -->
    <section class="lesson__area section-pb-120">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-4 col-lg-4">
                    <div class="lesson__content">
                        <h2 class="title">Konten Kursus</h2>


                        @include('studen.partials.kurikulum-content')
                    </div>
                </div>
                @if (!$kurikulum->isEmpty())
                    <div class="col-xl-8 col-lg-8">
                        <div class="lesson__video-wrap">
                            <div class="lesson__video-wrap-top">
                                <div class="lesson__video-wrap-top-left">
                                    <a href="{{ route('akses_pembelian') }}"><i class="flaticon-arrow-right"></i></a>
                                    <span id="currentContentTitle">{{ $kurikulum[0]->sections->first()->title }}</span>
                                </div>
                                <div class="lesson__video-wrap-top-right">
                                    <a href="{{ route('/') }}"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                            <div class="lesson__video-embed">
                                @if ($kurikulum->isEmpty())
                                    <p>Data kurikulum belum tersedia.</p>
                                @else
                                    <iframe id="lessonContent" width="100%" height="500" src="" frameborder="0"
                                        allowfullscreen></iframe>
                                @endif
                            </div>

                            <div class="lesson__next-prev-button d-flex justify-content-between">
                                <button class="prev-button" title="Previous Content" onclick="prevContent()"><i
                                        class="flaticon-arrow-left"></i></button>
                                <button class="next-button" title="Next Content" onclick="nextContent()"><i
                                        class="flaticon-arrow-right"></i></button>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <div class="d-flex align-items-center">
                                    <form id="statusForm"
                                        action="{{ route('sectionstatus', $kurikulum[0]->sections->first()->id) }}"
                                        method="POST" onsubmit="submitStatusForm(event)">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="sectionId" name="sectionId"
                                            value="{{ $kurikulum[0]->sections->first()->id }}">
                                        <input type="hidden" name="status" value="true">
                                        <button type="submit" class="btn btn-primary">Menyelesaikan</button>
                                    </form>

                                    @if ($allSectionsCompleted)
                                        <form id="printForm" action="{{ route('print_certificate', ['id' => $user->id]) }}"
                                            method="POST" class="ms-3" target="_blank" onsubmit="openInNewTab(event)">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">Sertifikat
                                                Penyelesaian</button>
                                        </form>
                                        <script>
                                            function openInNewTab(event) {
                                                event.preventDefault();
                                                const form = event.target;
                                                const formData = new FormData(form);
                                                const actionUrl = form.action;

                                                fetch(actionUrl, {
                                                        method: 'POST',
                                                        body: formData,
                                                        headers: {
                                                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                                                        }
                                                    })
                                                    .then(response => response.blob())
                                                    .then(blob => {
                                                        const url = window.URL.createObjectURL(blob);
                                                        const a = document.createElement('a');
                                                        a.href = url;
                                                        a.target = '_blank';
                                                        a.click();
                                                        window.URL.revokeObjectURL(url);
                                                    })
                                                    .catch(error => console.error('Error:', error));
                                            }
                                        </script>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- lesson-area-end -->

    <script>
        function changeContent(element, event) {
            if (element.classList.contains('disabled')) {
                event.preventDefault();
                alert('Bagian ini terkunci, selesaikan bagian sebelumnya untuk membuka bagian ini.');
                return;
            }

            var fileUrl = element.getAttribute('data-link');
            var fileType = element.getAttribute('data-type');
            var sectionId = element.getAttribute('data-id');
            console.log('fileUrl:', fileUrl);
            console.log('fileType:', fileType);
            console.log('sectionId:', sectionId);

            // Update the hidden input with the clicked section ID
            document.getElementById('sectionId').value = sectionId;

            var youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
            var driveRegex =
                /(?:drive\.google\.com\/file\/d\/|drive\.google\.com\/open\?id=|docs.google\.com\/(?:presentation|document|spreadsheets)\/d\/)([^"&?\/\s]+)/;
            var youtubeMatch = fileUrl.match(youtubeRegex);
            var driveMatch = fileUrl.match(driveRegex);
            var fileSrc = '';

            if (youtubeMatch) {
                var youtubeId = youtubeMatch[1];
                fileSrc = 'https://www.youtube.com/embed/' + youtubeId;
            } else if (driveMatch) {
                var driveId = driveMatch[1];

                if (fileType === 'video') {
                    fileSrc = 'https://drive.google.com/file/d/' + driveId + '/preview';
                } else if (fileType === 'presentation' || fileType === 'pptx') {
                    fileSrc = 'https://docs.google.com/presentation/d/' + driveId + '/embed';
                } else if (fileType === 'document' || fileType === 'docx') {
                    fileSrc = 'https://docs.google.com/document/d/' + driveId + '/embed';
                } else if (fileType === 'spreadsheet' || fileType === 'xlsx') {
                    fileSrc = 'https://docs.google.com/spreadsheets/d/' + driveId + '/embed';
                } else if (fileType === 'pdf') {
                    fileSrc = 'https://drive.google.com/file/d/' + driveId + '/preview';
                } else {
                    alert('Jenis file tidak didukung: ' + fileType);
                    return;
                }
            } else if (fileType === 'pdf' || fileUrl.includes('uploads/')) {
                if (fileUrl.startsWith('https://')) {
                    fileSrc = '/public/' + fileUrl.split('/').slice(3).join('/');
                } else if (!fileUrl.startsWith('/public/uploads/')) {
                    fileSrc = '/public/' + fileUrl;
                } else {
                    fileSrc = fileUrl;
                }
            } else {
                alert('Link file tidak valid: ' + fileUrl);
                return;
            }

            document.getElementById('lessonContent').src = fileSrc;
            document.getElementById('currentContentTitle').innerText = element.getAttribute('data-title');

            // Remove active class from previously active links
            var activeLinks = document.querySelectorAll('.course-item-link.active');
            activeLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to the clicked link
            element.classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var firstFileLink = document.querySelector('.course-item-link.active');
            if (firstFileLink) {
                changeContent(firstFileLink, new Event('click'));
            }
        });

        function nextContent() {
            var activeLink = document.querySelector('.course-item-link.active');
            var nextLink = activeLink.parentElement.nextElementSibling?.querySelector('.course-item-link');
            if (nextLink) {
                changeContent(nextLink, new Event('click'));
            }
        }

        function prevContent() {
            var activeLink = document.querySelector('.course-item-link.active');
            var prevLink = activeLink.parentElement.previousElementSibling?.querySelector('.course-item-link');
            if (prevLink) {
                changeContent(prevLink, new Event('click'));
            }
        }

        function submitStatusForm(event) {
            event.preventDefault();
            const form = document.getElementById('statusForm');
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Pindah ke konten berikutnya setelah status diperbarui
                        const activeLink = document.querySelector('.course-item-link.active');
                        const nextLink = activeLink.parentElement.nextElementSibling?.querySelector(
                        '.course-item-link');

                        if (nextLink) {
                            changeContent(nextLink, new Event('click'));
                        }

                        // Tampilkan tanda penyelesaian jika kursus telah selesai
                        const completionStatus = document.getElementById('completionStatus');
                        if ( /* kondisi untuk memeriksa apakah kursus selesai */ ) {
                            completionStatus.style.display = 'flex'; // Tampilkan tanda
                        } else {
                            completionStatus.style.display = 'none'; // Sembunyikan tanda
                        }
                    } else {
                        console.error("Error: " + response.statusText);
                    }
                })
                .catch(error => console.error("Fetch error:", error));
        }
    </script>

@endsection
