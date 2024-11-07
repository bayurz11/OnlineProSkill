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
                                                    // Pastikan format duration valid
                                                    $durationParts = explode(':', $section->duration);

                                                    // Cek apakah duration memiliki 3 bagian (jam, menit, detik)
                                                    if (count($durationParts) === 3) {
                                                        [$hours, $minutes, $seconds] = $durationParts;
                                                        // Konversikan ke detik
                                                        $totalDurationInSeconds +=
                                                            $hours * 3600 + $minutes * 60 + $seconds;
                                                    } else {
                                                        // Jika format tidak valid, atur durasi ke 0 detik
                                                        $totalDurationInSeconds += 0;
                                                    }
                                                }

                                                // Mengonversi total detik menjadi format jam dan menit
                                                $hours = floor($totalDurationInSeconds / 3600);
                                                $minutes = floor(($totalDurationInSeconds % 3600) / 60);

                                                // Tentukan format durasi berdasarkan nilai jam dan menit
                                                if ($hours > 0) {
                                                    $totalDuration = "{$hours} jam {$minutes} menit";
                                                } else {
                                                    $totalDuration = "{$minutes} menit";
                                                }
                                            @endphp
                                            <span>{{ count($kurikulumItem->sections) }} Materi ({{ $totalDuration }})</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-wrap">
                                                @foreach ($kurikulumItem->sections as $section)
                                                    @php
                                                        $completed = Auth::user()->hasCompletedSection($section->id);
                                                    @endphp
                                                    <li class="course-item open-item {{ request()->get('section_id') == $section->id ? 'active' : '' }}"
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


            </div>
        </div>
    </section>
    <script>
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
