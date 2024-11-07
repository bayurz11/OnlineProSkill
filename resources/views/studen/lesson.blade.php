@extends('layout.mainlayout')

@section('content')
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
                                <iframe id="lessonContent" width="100%" height="500" src="" frameborder="0"
                                    allowfullscreen></iframe>
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        // JavaScript untuk navigasi dan status
        function changeContent(element, event) {
            if (element.classList.contains('disabled')) {
                event.preventDefault();
                alert('Bagian ini terkunci, selesaikan bagian sebelumnya untuk membuka bagian ini.');
                return;
            }
            var fileUrl = element.getAttribute('data-link');
            var fileType = element.getAttribute('data-type');
            var sectionId = element.getAttribute('data-id');
            document.getElementById('sectionId').value = sectionId;

            if (fileType === 'video') {
                fileSrc = 'https://drive.google.com/file/d/' + fileUrl + '/preview';
            }
            document.getElementById('lessonContent').src = fileSrc;
            document.getElementById('currentContentTitle').innerText = element.getAttribute('data-title');
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
                        const activeLink = document.querySelector('.course-item-link.active');
                        const nextLink = activeLink.parentElement.nextElementSibling?.querySelector(
                        '.course-item-link');
                        if (nextLink) {
                            changeContent(nextLink, new Event('click'));
                        }
                        if (activeLink) {
                            localStorage.setItem('activeCourseItem', activeLink.dataset.id);
                        }
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const activeItemId = localStorage.getItem('activeCourseItem');
            if (activeItemId) {
                const activeItem = document.querySelector(`.course-item-link[data-id="${activeItemId}"]`);
                if (activeItem) activeItem.classList.add('active');
            }
        });
    </script>
@endsection
