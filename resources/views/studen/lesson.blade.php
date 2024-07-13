@extends('layout.mainlayout')

@section('content')
    <!-- lesson-area -->
    <section class="lesson__area section-pb-120">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-3 col-lg-4">
                    <div class="lesson__content">
                        <h2 class="title">Konten Kursus</h2>
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
                                                    <li class="course-item {{ $loop->first ? 'open-item' : '' }}">
                                                        <a href="#"
                                                            class="course-item-link {{ $loop->first ? 'active' : '' }}"
                                                            data-title="{{ $section->title }}"
                                                            data-link="{{ $section->link }}"
                                                            data-type="{{ $section->type }}">
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
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="lesson__video-wrap">
                        <div class="lesson__video-wrap-top">
                            <div class="lesson__video-wrap-top-left">
                                <a href="#"><i class="flaticon-arrow-right"></i></a>
                                <span>{{ $kurikulum[0]->sections->first()->title }}</span>
                            </div>
                            <div class="lesson__video-wrap-top-right">
                                <a href="#"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="lesson__video-embed">
                            @php
                                $youtubeUrl = $kurikulum[0]->sections->first()->link;
                                preg_match(
                                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                                    $youtubeUrl,
                                    $match,
                                );
                                $youtubeId = $match[1];
                            @endphp
                            <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="lesson__next-prev-button">
                            <button class="prev-button" title="Create a Simple React App"><i
                                    class="flaticon-arrow-right"></i></button>
                            <button class="next-button" title="React for the Rest of us"><i
                                    class="flaticon-arrow-right"></i></button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- lesson-area-end -->
@endsection
