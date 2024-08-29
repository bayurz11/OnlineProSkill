@section('title', 'ProSkill Akademia | Event')
<?php $page = 'classroom'; ?>

@extends('layout.mainlayout')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp
    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-two"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Event</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Event</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape01.svg') }}" alt="img" class="alltuchtopdown">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape02.svg') }}" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape03.svg') }}" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape04.svg') }}" alt="img"
                data-aos="fade-down-left" data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape05.svg') }}" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    @if ($event->count() > 0)
        <!-- event-area -->
        <section class="event__area-two section-py-120">
            <div class="container">
                <div class="event__inner-wrap">
                    <div class="row justify-content-center">
                        @foreach ($event as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="event__item shine__animate-item">
                                    <div class="event__item-thumb">
                                        <a href="{{ route('event_detail', ['id' => $item->id]) }}"
                                            class="shine__animate-link">
                                            <img src="{{ asset('public/uploads/events/' . $item->gambar) }}" alt="img"
                                                loading="lazy">
                                        </a>
                                    </div>
                                    <div class="event__item-content">
                                        <span class="date">{{ Carbon::parse($item->tgl)->format('d - F - Y') }}</span>
                                        <h2 class="title event-name">
                                            <a
                                                href="{{ route('event_detail', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                        </h2>
                                        <a href="{{ $item->link_maps }}" class="location" target="_blank">
                                            <i class="flaticon-map"></i>{{ $item->lokasi }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav class="pagination__wrap mt-30">
                        {{ $event->links($paginationView) }}
                    </nav>
                </div>
            </div>
        </section>
        <!-- event-area-end -->
    @else
        <section class="event__area-two section-py-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">

                            <p>Belum Ada Event yang Akan di Selengarakan</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <script>
        // Mengatur tinggi untuk elemen event-name
        var eventNames = document.querySelectorAll('.event-name');
        var maxEventNameHeight = 0;

        // Temukan tinggi maksimum untuk event-name
        eventNames.forEach(function(eventName) {
            var height = eventName.offsetHeight;
            if (height > maxEventNameHeight) {
                maxEventNameHeight = height;
            }
        });

        // Tetapkan tinggi maksimum ke semua elemen event-name
        eventNames.forEach(function(eventName) {
            eventName.style.height = maxEventNameHeight + 'px';
        });
    </script>

@endsection
