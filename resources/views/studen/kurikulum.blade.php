<div id="kurikulum-content">
    @foreach ($kurikulum as $index => $kurikulumItem)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
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
                                    $totalDurationInSeconds += $hours * 3600 + $minutes * 60 + $seconds;
                                }
                            }
                            $hours = floor($totalDurationInSeconds / 3600);
                            $minutes = floor(($totalDurationInSeconds % 3600) / 60);
                            $totalDuration = $hours > 0 ? "{$hours} jam {$minutes} menit" : "{$minutes} menit";
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
                                    $completed = Auth::user()->hasCompletedSection($section->id);
                                @endphp
                                <li class="course-item open-item list-group-item list-group-item-action {{ $index === 0 && $sectionIndex === 0 ? 'active' : '' }}"
                                    data-video-id="{{ $section->link }}" data-file-path="{{ $section->file_path }}"
                                    data-id="{{ $section->id }}">
                                    <a href="javascript:void(0)" class="course-item-link active">
                                        <span class="item-name">{{ $section->title }}</span>
                                        @if ($completed)
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 24px; height: 24px;">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="course-item-meta">
                                            <span class="item-meta duration">{{ $section->duration }}</span>
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
