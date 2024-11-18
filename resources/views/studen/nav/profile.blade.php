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
