<!-- search_results.blade.php -->
@extends('layout.mainlayout')

@section('content')
    <h1>Hasil Pencarian</h1>
    @if ($results->isEmpty())
        <p>Tidak ada hasil yang ditemukan.</p>
    @else
        <div class="row">
            @foreach ($results as $cours)
                <div class="col">
                    <div class="courses__item shine__animate-item">
                        <div class="courses__item-thumb">
                            <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}" class="shine__animate-link">
                                <img src="{{ asset('public/uploads/' . $cours->gambar) }}" alt="Banner"
                                    class="wd-100 wd-sm-150 me-3">
                            </a>
                        </div>
                        <div class="courses__item-content">
                            <h5 class="title">
                                <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}">{{ $cours->nama_kursus }}</a>
                            </h5>
                            <p class="author">By <a href="#">{{ $cours->user->name }}</a>&nbsp;&nbsp;
                                <img src="{{ asset('public/assets/img/icons/course_icon06.svg') }}" alt="img"
                                    class="injectable">
                                Kuota Kelas <span>{{ $cours->jumlah_pendaftaran }}/{{ $cours->kuota }}</span>

                                @if (in_array($cours->id, $joinedCourses))
                                    <span
                                        style="color: green; font-weight: bold; padding: 2px 6px; border: 1px solid green; border-radius: 10rem; background-color: #e0f7e9;">
                                        Joined
                                    </span>
                                @endif
                            </p>
                            <div class="courses__item-bottom">
                                <div class="button">
                                    <a href="{{ route('classroomdetail', ['id' => $cours->id]) }}">
                                        <span class="text">Detail</span>
                                        <i class="flaticon-arrow-right"></i>
                                    </a>
                                </div>
                                <h5 class="price">Rp {{ number_format($cours->price, 0, ',', ',') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
