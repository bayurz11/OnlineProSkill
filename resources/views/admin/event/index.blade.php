@section('title', 'ProSkill Akademia | Event')
<?php $page = 'Event'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Event</li>
            </ol>
        </nav>

        @include('admin.modal.add_event')
        @include('admin.modal.edit_even')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Event</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Event
                        </button>
                        <p class="text-muted mb-3">Jumlah Event : </p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Nama </th>
                                        <th>Tanggal Event</th>
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event as $event)
                                        <tr>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->tgl }}</td>
                                            <td>{{ $event->lokasi }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-icon edit-button"
                                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $event->id }}">
                                                    <i data-feather="edit"></i>
                                                </button>
                                                <button onclick="hapus('{{ $event->id }}')"
                                                    class="btn btn-danger btn-icon" title="Hapus">
                                                    <i data-feather="trash-2"></i>
                                                </button>
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

    <script>
        function hapus(id) {
            const confirmationBox = `
            <div id="confirmationModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
                <div style="background: white; padding: 40px; border-radius: 8px; text-align: center;">
                    <h4>Konfirmasi Penghapusan</h4><br>
                    <p>Apakah Anda yakin ingin menghapus ini?</p><br>
                    <button id="confirmDelete" class="btn btn-danger btn-lg">Ya, Hapus</button>
                    <button id="cancelDelete" class="btn btn-secondary btn-lg">Batal</button>
                </div>
            </div>
        `;

            document.body.insertAdjacentHTML('beforeend', confirmationBox);

            document.getElementById('confirmDelete').onclick = function() {
                fetch(`/event/${id}/destroy`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                }).then(response => {
                    document.getElementById('confirmationModal').remove();
                    if (response.ok) {
                        console.log('event berhasil dihapus. Mengalihkan ke halaman pengaturan event.');
                        window.location.href = '{{ route('kelola_event') }}';
                    } else {
                        response.text().then(text => {
                            console.error('Gagal menghapus event:', text);
                        });
                    }
                }).catch(error => {
                    document.getElementById('confirmationModal').remove();
                    console.error('Terjadi kesalahan:', error);
                });
            };

            document.getElementById('cancelDelete').onclick = function() {
                document.getElementById('confirmationModal').remove();
            };
        }
    </script>


@endsection
