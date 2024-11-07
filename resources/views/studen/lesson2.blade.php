@extends('layout.mainlayout')

@section('content')
    <section class="lesson__area section-pb-120">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-3 col-lg-4">
                    <div class="lesson__content">
                        <h2 class="title">Course Content</h2>
                        @foreach ($kurikulum as $index => $kurikulumItem)
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            {{ $kurikulumItem->title }}
                                            @php
                                                $totalDurationInSeconds = 0;
                                                foreach ($kurikulumItem->sections as $section) {
                                                    // Perhitungan durasi total
                                                    $durationParts = explode(':', $section->duration);
                                                    if (count($durationParts) === 3) {
                                                        [$hours, $minutes, $seconds] = $durationParts;
                                                        $totalDurationInSeconds +=
                                                            $hours * 3600 + $minutes * 60 + $seconds;
                                                    }
                                                }
                                                $hours = floor($totalDurationInSeconds / 3600);
                                                $minutes = floor(($totalDurationInSeconds % 3600) / 60);
                                                $totalDuration =
                                                    $hours > 0 ? "{$hours} jam {$minutes} menit" : "{$minutes} menit";
                                            @endphp
                                            <span>{{ count($kurikulumItem->sections) }} Materi ({{ $totalDuration }})</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-wrap">
                                                @foreach ($kurikulumItem->sections as $sectionIndex => $section)
                                                    @php
                                                        $completed = Auth::user()->hasCompletedSection($section->id);
                                                    @endphp
                                                    <li class="course-item open-item list-group-item list-group-item-action {{ $index === 0 && $sectionIndex === 0 ? 'active' : '' }}"
                                                        data-video-id="{{ $section->link }}"
                                                        data-file-path="{{ $section->file_path }}"
                                                        data-id="{{ $section->id }}">
                                                        <a href="javascript:void(0)" class="course-item-link">
                                                            <span class="item-name">{{ $section->title }}</span>
                                                            @if ($completed)
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                                                        style="width: 24px; height: 24px;">
                                                                        <i class="fas fa-check"></i>
                                                                    </div>
                                                                </div>
                                                            @endif
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
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    @include('studen.partials.lesson-video-wrap')
                </div>

                <div class="d-none d-lg-block position-fixed" style="right: 20px; bottom: 20px; z-index: 1000;">
                    <button id="completeSectionBtn" class="btn btn-primary" data-section-id="">
                        Tandai Selesai
                    </button>
                </div>

            </div>
        </div>


    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoElements = document.querySelectorAll('.course-item[data-id]');
            const completeSectionBtn = document.getElementById('completeSectionBtn');

            // Fungsi untuk mengatur tombol sesuai dengan section aktif
            function setActiveSectionButton(sectionId, isCompleted) {
                completeSectionBtn.setAttribute('data-section-id', sectionId);

                if (!isCompleted) {
                    completeSectionBtn.style.display = 'block';
                } else {
                    completeSectionBtn.style.display = 'none';
                }
            }

            // Mengatur tombol untuk section pertama yang aktif saat halaman dimuat
            const firstActiveSection = document.querySelector('.course-item.active');
            if (firstActiveSection) {
                const sectionId = firstActiveSection.getAttribute('data-id');
                const isCompleted = firstActiveSection.querySelector(
                    '.bg-success'); // Mengecek apakah section sudah selesai
                setActiveSectionButton(sectionId, isCompleted);
            }

            // Mengatur event klik untuk setiap item section
            videoElements.forEach((videoItem) => {
                videoItem.addEventListener('click', function() {
                    // Menghapus kelas 'active' dari semua item dan menambahkannya pada item yang dipilih
                    videoElements.forEach((item) => item.classList.remove('active'));
                    videoItem.classList.add('active');

                    // Ambil ID section yang aktif
                    const sectionId = videoItem.getAttribute('data-id');
                    const isCompleted = videoItem.querySelector(
                        '.bg-success'); // Mengecek apakah section sudah selesai
                    setActiveSectionButton(sectionId, isCompleted);
                });
            });

            // Event klik untuk tombol "Tandai Selesai"
            completeSectionBtn.addEventListener('click', function() {
                const sectionId = this.getAttribute('data-section-id');

                fetch(`/sectionupdatestatus/${sectionId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            sectionId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update UI untuk menunjukkan section sudah selesai
                            const activeItem = document.querySelector(
                                `.course-item[data-id="${sectionId}"]`);
                            activeItem.querySelector('.course-item-link').insertAdjacentHTML(
                                'beforeend',
                                '<div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;"><i class="fas fa-check"></i></div>'
                            );
                            completeSectionBtn.style.display = 'none';
                        } else {
                            alert('Gagal memperbarui status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan.');
                    });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const videoElements = document.querySelectorAll('.course-item[data-video-id]');

            videoElements.forEach((videoItem) => {
                videoItem.addEventListener('click', function() {
                    // Menghapus kelas 'active' dari semua item
                    videoElements.forEach((item) => {
                        item.classList.remove('active');
                    });

                    // Menambahkan kelas 'active' pada item yang dipilih
                    videoItem.classList.add('active');
                });
            });
        });
    </script>
    <style>
        .course-item.active {
            background-color: #f0f0f0;
            border-left: 5px solid #007bff;
        }
    </style>
@endsection
