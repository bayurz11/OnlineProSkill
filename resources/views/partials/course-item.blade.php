{{-- resources/views/partials/course-item.blade.php --}}
@php
    $kurikulumExists = \App\Models\Kurikulum::where('course_id', $kelas['id'])->exists();
@endphp
@if ($kurikulumExists)
    <div class="swiper-slide">
        <div class="courses__item courses__item-two shine__animate-item d-flex flex-column h-100">
            <div class="courses__item-thumb courses__item-thumb-two">
                <a href="{{ route('classroomdetail', ['id' => $kelas['id']]) }}" class="shine__animate-link">
                    <img src="{{ asset('public/uploads/' . $kelas['gambar']) }}" alt="img" class="img-fluid"
                        loading="lazy">
                </a>
            </div>
            <div class="courses__item-content courses__item-content-two d-flex flex-column flex-grow-1">
                <ul class="courses__item-meta list-wrap">
                    <li class="courses__item-tag">
                        <span class="badge {{ $kelas['course_type'] == 'online' ? 'bg-primary' : 'bg-secondary' }}">
                            {{ $kelas['course_type'] == 'online' ? 'Online' : 'Kelas Tatap Muka' }}
                        </span>
                    </li>
                    <li class="price">
                        @if (!empty($kelas['discountedPrice']) && $kelas['discount'] != 0)
                            <del>Rp {{ number_format($kelas['price'], 0, ',', '.') }}</del>
                            Rp {{ number_format($kelas['discountedPrice'], 0, ',', '.') }}
                        @else
                            Rp {{ number_format($kelas['price'], 0, ',', '.') }}
                        @endif
                    </li>
                    @if (in_array($kelas['id'], $joinedCourses))
                        <i class="fas fa-check-circle fa-lg" style="color: green;"></i>
                    @endif
                </ul>
                <h5 class="title course-title flex-grow-1">
                    <a href="{{ route('classroomdetail', ['id' => $kelas['id']]) }}">{{ $kelas['nama_kursus'] }}</a>
                </h5>
                <div class="courses__item-bottom">
                    <div class="button">
                        <a href="{{ route('classroomdetail', ['id' => $kelas['id']]) }}">
                            <span class="text">Detail Kelas</span>
                            <i class="flaticon-arrow-right"></i>
                        </a>
                    </div>
                    @php
                        $averageRating = $kelas->reviews()->avg('rating');

                    @endphp
                    <div class="avg-rating">
                        <i class="fas fa-star"></i> ({{ $averageRating ? number_format($averageRating, 1) : '0.0' }}
                        Reviews)
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
