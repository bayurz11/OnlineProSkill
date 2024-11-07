@extends('layout.mainlayout')

@section('content')
    <section class="lesson__area section-pb-120">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-3 col-lg-4">
                    <div class="lesson__content">
                        <h2 class="title">Course Content</h2>
                        <div id="kurikulum-content">
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
                                                        $hours > 0
                                                            ? "{$hours} jam {$minutes} menit"
                                                            : "{$minutes} menit";
                                                @endphp
                                                <span>{{ count($kurikulumItem->sections) }} Materi
                                                    ({{ $totalDuration }})
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}"
                                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul class="list-wrap">
                                                    @foreach ($kurikulumItem->sections as $sectionIndex => $section)
                                                        @php
                                                            $completed = Auth::user()->hasCompletedSection(
                                                                $section->id,
                                                            );
                                                        @endphp
                                                        <li class="course-item open-item list-group-item list-group-item-action {{ $index === 0 && $sectionIndex === 0 ? 'active' : '' }}"
                                                            data-video-id="{{ $section->link }}"
                                                            data-file-path="{{ $section->file_path }}"
                                                            data-id="{{ $section->id }}">
                                                            <a href="javascript:void(0)" class="course-item-link active">
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
                </div>
                <div class="col-xl-9 col-lg-8">
                    @include('studen.partials.lesson-video-wrap')
                </div>

                <button id="completeSectionBtn" class="btn btn-primary" style="display: none;" data-section-id="">
                    Tandai Selesai
                </button>
            </div>
        </div>


    </section>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const courseItems = document.querySelectorAll('.course-item');
            const completeSectionBtn = document.getElementById('completeSectionBtn');
            let currentIndex = 0;

            // Fungsi untuk memperbarui konten iframe dan kelas aktif berdasarkan indeks
            function updateVideo(index) {
                if (index >= 0 && index < courseItems.length) {
                    const item = courseItems[index];
                    const filePath = item.getAttribute('data-file-path');
                    const videoId = item.getAttribute('data-video-id');
                    const videoTitle = item.querySelector('.item-name').innerText;

                    // Perbarui judul video
                    document.getElementById('video-title').innerText = videoTitle;

                    const player = document.getElementById('player');

                    // Menghapus kelas 'active' dari semua item dan menambahkannya pada item yang dipilih
                    courseItems.forEach((el) => el.classList.remove('active'));
                    item.classList.add('active');

                    // Memperbarui tombol "Tandai Selesai"
                    updateCompleteButton(item);

                    // Menangani file PDF
                    if (filePath.endsWith('.pdf')) {
                        const correctFilePath = '/public/' + filePath;
                        player.src = correctFilePath;
                    }
                    // Menangani video YouTube
                    else if (videoId.includes('youtube.com')) {
                        const videoIdMatch = videoId.match(/(?:v=|\/)([a-zA-Z0-9_-]{11})/);
                        if (videoIdMatch) {
                            const videoEmbedUrl = `https://www.youtube.com/embed/${videoIdMatch[1]}`;
                            if (videoId.includes('t=')) {
                                const timeParam = videoId.split('t=')[1].split('&')[0];
                                player.src = `${videoEmbedUrl}?start=${timeParam}`;
                            } else {
                                player.src = videoEmbedUrl;
                            }
                        }
                    }
                    // Menangani file video biasa
                    else {
                        player.src = filePath;
                    }
                }
            }

            // Fungsi untuk memperbarui tampilan tombol "Tandai Selesai"
            function updateCompleteButton(item) {
                const sectionId = item.getAttribute('data-id');
                const isCompleted = item.querySelector('.bg-success'); // Mengecek apakah section sudah selesai
                completeSectionBtn.setAttribute('data-section-id', sectionId);

                // Tampilkan tombol jika section belum selesai, sembunyikan jika sudah selesai
                completeSectionBtn.style.display = isCompleted ? 'none' : 'block';
            }

            // Event listener untuk setiap item kursus
            courseItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentIndex = index;
                    updateVideo(currentIndex);
                });
            });

            // Menampilkan video pertama saat halaman dimuat
            updateVideo(currentIndex);

            // Tombol Previous Lesson
            document.querySelector('.prev-button').addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateVideo(currentIndex);
                }
            });

            // Tombol Next Lesson
            document.querySelector('.next-button').addEventListener('click', function() {
                if (currentIndex < courseItems.length - 1) {
                    currentIndex++;
                    updateVideo(currentIndex);
                }
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

                            // Reload halaman untuk menjaga status dan bagian aktif
                            location.reload();
                        } else {
                            // Jika gagal, tidak ada alert
                            console.error('Gagal memperbarui status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const courseItems = document.querySelectorAll('.course-item');
            const completeSectionBtn = document.getElementById('completeSectionBtn');
            let currentIndex = 0;

            // Fungsi untuk memperbarui konten iframe dan kelas aktif berdasarkan indeks
            function updateVideo(index) {
                if (index >= 0 && index < courseItems.length) {
                    const item = courseItems[index];
                    const filePath = item.getAttribute('data-file-path');
                    const videoId = item.getAttribute('data-video-id');
                    const videoTitle = item.querySelector('.item-name').innerText;

                    // Perbarui judul video
                    document.getElementById('video-title').innerText = videoTitle;

                    const player = document.getElementById('player');

                    // Menghapus kelas 'active' dari semua item dan menambahkannya pada item yang dipilih
                    courseItems.forEach((el) => el.classList.remove('active'));
                    item.classList.add('active');

                    // Memperbarui tombol "Tandai Selesai"
                    updateCompleteButton(item);

                    // Menangani file PDF
                    if (filePath.endsWith('.pdf')) {
                        const correctFilePath = '/public/' + filePath;
                        player.src = correctFilePath;
                    }
                    // Menangani video YouTube
                    else if (videoId.includes('youtube.com')) {
                        const videoIdMatch = videoId.match(/(?:v=|\/)([a-zA-Z0-9_-]{11})/);
                        if (videoIdMatch) {
                            const videoEmbedUrl = `https://www.youtube.com/embed/${videoIdMatch[1]}`;
                            if (videoId.includes('t=')) {
                                const timeParam = videoId.split('t=')[1].split('&')[0];
                                player.src = `${videoEmbedUrl}?start=${timeParam}`;
                            } else {
                                player.src = videoEmbedUrl;
                            }
                        }
                    }
                    // Menangani file video biasa
                    else {
                        player.src = filePath;
                    }
                }
            }

            // Fungsi untuk memperbarui tampilan tombol "Tandai Selesai"
            function updateCompleteButton(item) {
                const sectionId = item.getAttribute('data-id');
                const isCompleted = item.querySelector('.bg-success'); // Mengecek apakah section sudah selesai
                completeSectionBtn.setAttribute('data-section-id', sectionId);

                // Tampilkan tombol jika section belum selesai, sembunyikan jika sudah selesai
                completeSectionBtn.style.display = isCompleted ? 'none' : 'block';
            }

            // Event listener untuk setiap item kursus
            courseItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentIndex = index;
                    updateVideo(currentIndex);
                });
            });

            // Menampilkan video pertama saat halaman dimuat
            updateVideo(currentIndex);

            // Tombol Previous Lesson
            document.querySelector('.prev-button').addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateVideo(currentIndex);
                }
            });

            // Tombol Next Lesson
            document.querySelector('.next-button').addEventListener('click', function() {
                if (currentIndex < courseItems.length - 1) {
                    currentIndex++;
                    updateVideo(currentIndex);
                }
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

                            // Memperbarui bagian kurikulum tanpa me-reload halaman
                            const kurikulumContainer = document.getElementById('kurikulum-content');
                            fetch('/kurikulum') // Mengambil konten terbaru kurikulum
                                .then(response => response.text())
                                .then(html => {
                                    kurikulumContainer.innerHTML =
                                        html; // Mengganti konten kurikulum
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });

                        } else {
                            console.error('Gagal memperbarui status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
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
