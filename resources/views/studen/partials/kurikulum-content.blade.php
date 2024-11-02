@if ($kurikulum->isEmpty())
    <p>Data kurikulum belum tersedia.</p>
@else
    <div class="accordion" id="accordionExample">
        @foreach ($kurikulum as $index => $item)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
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
                                    @php
                                        $completed = Auth::user()->hasCompletedSection($section->id);
                                    @endphp
                                    @if ($section->link || $section->file_path)
                                        <a href="#"
                                            class="course-item-link {{ $loop->first ? 'active' : '' }} {{ !$completed && $loop->first ? 'unlocked' : (!$completed ? 'locked' : '') }}"
                                            data-title="{{ $section->title }}"
                                            data-link="{{ $section->link ? asset($section->link) : asset($section->file_path) }}"
                                            data-type="{{ $section->type }}" data-id="{{ $section->id }}"
                                            onclick="changeContent(this, event)">
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
                                    @else
                                        <span class="course-item-link inactive">
                                            <span class="item-name">{{ $section->title }}</span>
                                            <div class="course-item-meta">
                                                <span class="item-meta duration">{{ $section->duration }}</span>
                                            </div>
                                        </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
