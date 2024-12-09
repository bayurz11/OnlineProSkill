@section('title', 'ProSkill Akademia | Reviwe ')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')
    @include('studen.review.modal.reviewmodal')
    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
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

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            <div class="dashboard__top-wrap">
                <div class="dashboard__top-bg" data-background="{{ asset('public/assets/img/bg/student_bg.jpg') }}"></div>
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                alt="img" width="120" height="120" style="object-fit: cover;">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ $user->name }}</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    {{ $orders->count() }} Kelas
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @include('studen.nav.nav')

                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">Reviews</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="dashboard__review-table">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Course</th>
                                                <th>Feedback</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>
                                                        <a
                                                            href="{{ route('classroomdetail', ['id' => $order->product_id]) }}">
                                                            {{ $order->KelasTatapMuka->nama_kursus ?? 'Nama kelas tidak tersedia' }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @php
                                                            // Mengambil review untuk kelas ini dari setiap user tanpa duplikat
                                                            $uniqueReviewsCount = $order->reviews
                                                                ->unique('user_id')
                                                                ->count();
                                                            $userReview = $order->reviews
                                                                ->where('user_id', Auth::id())
                                                                ->first(); // Mengambil review pengguna yang login
                                                        @endphp
                                                        @if ($userReview)
                                                            <div class="review__wrap">
                                                                <div class="rating">
                                                                    @php
                                                                        $rating = round($userReview->rating);
                                                                        $maxStars = 5;
                                                                    @endphp
                                                                    @for ($i = 1; $i <= $maxStars; $i++)
                                                                        @if ($i <= $rating)
                                                                            <i class="fas fa-star"></i>
                                                                            <!-- Bintang solid -->
                                                                        @else
                                                                            <i class="far fa-star"></i>
                                                                            <!-- Bintang kosong -->
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <span>({{ $uniqueReviewsCount }} Reviews)</span>
                                                            </div>
                                                            <p>{{ $userReview->comment ?? 'No comment available' }}</p>
                                                        @else
                                                            <p>No reviews available</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dashboard__review-action">
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#reviewModal{{ $order->KelasTatapMuka->id }}"
                                                                title="Beri Review">
                                                                <i class="skillgro-edit"></i>
                                                            </a>
                                                            {{-- <a href="#" title="Delete">
                                                                <i class="skillgro-bin"></i>
                                                            </a> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- dashboard-area-end -->

@endsection
