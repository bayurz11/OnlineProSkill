<!-- search_results.blade.php -->
@extends('layout.mainlayout')

@section('content')
    <h1>Hasil Pencarian</h1>
    @if ($results->isEmpty())
        <p>Tidak ada hasil yang ditemukan.</p>
    @else
        <ul>
            @foreach ($results as $result)
                <li>{{ $result->nama_kelas }}</li>
            @endforeach
        </ul>
    @endif
@endsection
