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
                                        // Ambil status penyelesaian dari localStorage di JS
                                        $sectionId = $section->id;
                                    @endphp
                                    @if ($section->link || $section->file_path)
                                        <a href="#"
                                            class="course-item-link {{ $loop->first ? 'active' : '' }} {{ !$completed && $loop->first ? 'unlocked' : (!$completed ? 'locked' : '') }}"
                                            data-title="{{ $section->title }}"
                                            data-link="{{ $section->link ? asset($section->link) : asset($section->file_path) }}"
                                            data-type="{{ $section->type }}" data-id="{{ $section->id }}"
                                            onclick="changeContent(this, event)">
                                            <span class="item-name">{{ $section->title }}</span>
                                            <div class="d-flex align-items-center justify-content-center check-icon"
                                                style="display: none;">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 24px; height: 24px;">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
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

        // Update the hidden input with the clicked section ID
        document.getElementById('sectionId').value = sectionId;

        // Update localStorage when a section is completed
        if (!localStorage.getItem(`section_${sectionId}_completed`)) {
            localStorage.setItem(`section_${sectionId}_completed`, 'true');
        }

        // Check if the section is completed
        var completed = localStorage.getItem(`section_${sectionId}_completed`) === 'true';

        // Show check icon if completed
        if (completed) {
            element.querySelector('.check-icon').style.display = 'flex';
        } else {
            element.querySelector('.check-icon').style.display = 'none';
        }

        // Logic for changing the content based on fileUrl and fileType here
        // ...

        // Remove active class from previously active links
        var activeLinks = document.querySelectorAll('.course-item-link.active');
        activeLinks.forEach(function(link) {
            link.classList.remove('active');
        });

        // Add active class to the clicked link
        element.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        var sections = document.querySelectorAll('.course-item-link');
        sections.forEach(section => {
            const sectionId = section.getAttribute('data-id');
            const completed = localStorage.getItem(`section_${sectionId}_completed`) === 'true';
            if (completed) {
                section.querySelector('.check-icon').style.display = 'flex'; // Tampilkan ikon centang
            }
        });

        var firstFileLink = document.querySelector('.course-item-link.active');
        if (firstFileLink) {
            changeContent(firstFileLink, new Event('click'));
        }
    });

    // Remaining functions: nextContent, prevContent, refreshKurikulumContent
    // ...
</script>
