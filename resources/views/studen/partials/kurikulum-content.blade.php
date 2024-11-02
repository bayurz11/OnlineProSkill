@if ($sections->isNotEmpty())
    <ul class="section-list">
        @foreach ($sections as $section)
            <li>
                <div class="course-item-link" onclick="changeContent(this, event)" data-link="{{ $section->link }}"
                    data-type="{{ pathinfo($section->file_path, PATHINFO_EXTENSION) }}" data-id="{{ $section->id }}"
                    data-title="{{ $section->title }}">
                    {{ $section->title }}
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p>Tidak ada konten untuk ditampilkan.</p>
@endif
