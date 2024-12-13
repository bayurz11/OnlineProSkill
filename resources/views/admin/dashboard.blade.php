@section('title', 'ProSkill Akademia | Dashboard Admin')
<?php $page = 'Dashboard_admin'; ?>

@extends('layout.mainlayout_admin')
@section('content')


    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Selamat datang {{ $user->name }}</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                {{-- <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i
                            data-feather="calendar" class="text-primary"></i></span>
                    <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date"
                        data-input>
                </div> --}}
                {{-- <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="printer"></i>
                    Print
                </button>
                <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                    Download Report
                </button> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Siswa</h6>
                                    <div class="dropdown mb-2">
                                        <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('daftar_siswa') }}"><i data-feather="eye"
                                                    class="icon-sm me-2"></i> <span class="">View</span></a>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $daftar_siswa->count() }} Siswa</h3>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Instruktur</h6>
                                    <div class="dropdown mb-2">
                                        <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                    class="">Edit</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="trash" class="icon-sm me-2"></i> <span
                                                    class="">Delete</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="printer" class="icon-sm me-2"></i> <span
                                                    class="">Print</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="download" class="icon-sm me-2"></i> <span
                                                    class="">Download</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">89.87%</h3>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Kelas Online</h6>
                                    <div class="dropdown mb-2">
                                        <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('CourseMaster') }}"><i data-feather="eye"
                                                    class="icon-sm me-2"></i> <span class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $onlinecourse->count() }} Kelas</h3>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Kelas tatap Muka</h6>
                                    <div class="dropdown mb-2">
                                        <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('classroomsetting') }}"><i data-feather="eye"
                                                    class="icon-sm me-2"></i> <span class="">View</span></a>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $course->count() }} Kelas</h3>
                                        {{-- <div class="d-flex align-items-baseline">
                                            <p class="text-success">
                                                <span>+2.8%</span>
                                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                            </p>
                                        </div> --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- row -->


        <div class="row">
            <div class="col-lg-7 col-xl-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Transaksi Kursus Online, Ofline, dan Produk</h6>

                        <p class="text-muted mb-3">Jumlah Transaksi : {{ $orders->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        <th>No Invoice</th>
                                        <th>Nama Kelas</th>
                                        <th>Tanggal</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            {{-- <td>{{ $key + 1 }}</td> --}}
                                            <td>{{ $order->nomor_invoice }}</td>
                                            <td>{{ $order->KelasTatapMuka->nama_kursus ?? 'Nama kelas tidak tersedia' }}
                                            </td>
                                            <td>
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ number_format($order->price, 0) }}
                                            </td>
                                            <td>
                                                @if ($order->status == 'PAID' || $order->status == 'SETTLED' || $order->status == 'paid' || $order->status == 'settled')
                                                    <span class="badge bg-success">
                                                        Sukses
                                                    </span>
                                                @else
                                                    <span class="badge bg-info">
                                                        Belum Dibayar
                                                    </span>
                                                @endif

                                            </td>

                                            <td>

                                                <a href="{{ route('prin', ['id' => $order->id]) }}" target="_blank"
                                                    class="btn btn-success btn-icon" title="Cetak">
                                                    <i data-feather="printer"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row --> <br>
        <div class="row">
            <div class="col-lg-7 col-xl-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Transaksi Bootcamp</h6>

                        <p class="text-muted mb-3">Jumlah Transaksi : {{ $bootcamp->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        <th>No Invoice</th>
                                        <th>Nama Kelas</th>
                                        <th>Tanggal</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bootcamp as $order)
                                        <tr>
                                            {{-- <td>{{ $key + 1 }}</td> --}}
                                            <td>{{ $order->nomor_invoice }}</td>
                                            <td>{{ $order->KelasTatapMuka->nama_kursus ?? 'Nama kelas tidak tersedia' }}
                                            </td>
                                            <td>
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ number_format($order->price, 0) }}
                                            </td>
                                            <td>
                                                @if ($order->status == 'PAID' || $order->status == 'SETTLED' || $order->status == 'paid' || $order->status == 'settled')
                                                    <span class="badge bg-success">
                                                        Sukses
                                                    </span>
                                                @else
                                                    <span class="badge bg-info">
                                                        Belum Dibayar
                                                    </span>
                                                @endif
                                            </td>

                                            <td>

                                                <a href="{{ route('prin', ['id' => $order->id]) }}" target="_blank"
                                                    class="btn btn-success btn-icon" title="Cetak">
                                                    <i data-feather="printer"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

    </div>
@endsection
