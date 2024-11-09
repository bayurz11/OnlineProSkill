<div class="dashboard__top-wrap">
    <div class="dashboard__top-bg"
        data-background="{{ $profile && $profile->cover ? asset('public/uploads/' . $profile->cover) : asset('public/assets/img/bg/instructor_dashboard_bg.jpg') }}">
    </div>
    <div class="dashboard__instructor-info">
        <div class="dashboard__instructor-info-left">
            <div class="thumb">
                <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                    alt="img" width="120" height="120" style="object-fit: cover;">
            </div>
            <div class="content">
                <h4 class="title">{{ $user->name }}</h4>
                <div class="review__wrap review__wrap-two">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    {{-- <span>(15 Reviews)</span> --}}
                </div>
            </div>
        </div>
        <div class="dashboard__instructor-info-right">
            <a href="#" data-bs-toggle="modal" data-bs-target="#CoursesModal"
                class="btn btn-two arrow-btn">Membuat Kursus Baru <img
                    src="{{ asset('public/assets/img/icons/right_arrow.svg') }}" alt="img" class="injectable"></a>
        </div>
    </div>
</div>
