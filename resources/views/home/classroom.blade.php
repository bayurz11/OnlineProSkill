@extends('layout.mainlayout')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <!-- ... -->
    </section>
    <!-- breadcrumb-area-end -->

    <!-- all-courses -->
    <section class="all-courses-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="courses-top-wrap courses-top-wrap">
                        <!-- ... -->
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                            <div
                                class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                @foreach ($course as $cours)
                                    @if ($cours->status == 1)
                                        <div class="col">
                                            <div class="courses__item shine__animate-item">
                                                <div class="courses__item-thumb">
                                                    <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}"
                                                        class="shine__animate-link">
                                                        <img src="{{ asset('public/uploads/' . $cours->gambar) }}"
                                                            alt="Banner" class="wd-100 wd-sm-150 me-3">
                                                    </a>
                                                </div>
                                                <div class="courses__item-content">
                                                    <h5 class="title">
                                                        <a
                                                            href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
                                                    </h5>
                                                    <p class="author">By <a href="#">{{ $cours->user->name }}</a></p>
                                                    <div>
                                                        <img src="{{ asset('public/assets/img/icons/course_icon06.svg') }}"
                                                            alt="img" class="injectable">
                                                        Kuota Kelas
                                                        <span>{{ $jumlahPendaftaran->get($cours->id, 0) }}/{{ $cours->kuota }}</span>
                                                    </div>
                                                    <div class="courses__item-bottom">
                                                        <div class="button">
                                                            <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}">
                                                                <span class="text">Detail</span>
                                                                <i class="flaticon-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                        <h5 class="price">Rp
                                                            {{ number_format($cours->price, 0, ',', ',') }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- ... -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- all-courses-end -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var paragraphs = document.querySelectorAll('.content p');
            paragraphs.forEach(function(p) {
                var parent = p.parentNode;
                while (p.firstChild) {
                    parent.insertBefore(p.firstChild, p);
                }
                parent.removeChild(p);
            });
        });
    </script>
@endsection
