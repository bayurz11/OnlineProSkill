@section('title', 'ProSkill Akademia | Order History')
<?php $page = 'OrderHistory'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat Pembelian</li>
            </ol>
        </nav>

        @include('admin.modal.add_categories')
        @include('admin.modal.edit_categories')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Order</h6>

                        <p class="text-muted mb-3">Jumlah Kategori : {{ $orders->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Invoice</th>
                                        <th>Nama Kelas</th>
                                        <th>Tanggal</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
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
        </div>

    </div>



@endsection
