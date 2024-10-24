@section('title', 'ProSkill Akademia | Kurikulum')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

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

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            @include('instruktur.nav.profile')

            <div class="row">
                @include('instruktur.nav.navbar')
                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">Kurikulum</h4>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                    data-bs-target="#kurikulumModal" data-id="{{ $kurikulum->id }}">
                                    <i class="btn-icon-prepend" data-feather="plus-circle"></i> + Kurikulum Baru
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-body">

                                <p class="text-muted mb-3">Jumlah Pertemuan: {{ $kurikulum->count() }}</p>
                                <div class="table-responsive">
                                    @foreach ($kurikulum as $kuri)
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body d-flex justify-content-between align-items-center">
                                                    <div>
                                                        Bagian {{ $kuri->no_urut }}. {{ $kuri->title }}
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalEdit"
                                                            title="Edit Kurikulum" data-id="{{ $kuri->id }}">
                                                            <i class="btn-icon-prepend" data-feather="edit"></i>
                                                        </button>
                                                        <button onclick="hapus('{{ $kuri->id }}')"
                                                            class="btn btn-outline-danger btn-icon" title="Hapus">
                                                            <i data-feather="trash-2"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-primary"
                                                            data-bs-toggle="modal" data-id="{{ $kuri->id }}"
                                                            data-bs-target="#materiModal">
                                                            <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                                                            Tambah Materi
                                                        </button>
                                                    </div>
                                                </div>

                                                @foreach ($kuri->sections as $section)
                                                    <div class="card">
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center">
                                                            Pelajaran {{ $section->no_urut }}. {{ $section->title }}
                                                            <div class="d-flex gap-2">
                                                                <button type="button" class="btn btn-outline-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#sectionModalEdit" title="Edit Section"
                                                                    data-id="{{ $section->id }}">
                                                                    <i class="btn-icon-prepend" data-feather="edit"></i>
                                                                </button>
                                                                <button onclick="hapus1('{{ $section->id }}')"
                                                                    class="btn btn-outline-danger btn-icon" title="Hapus">
                                                                    <i data-feather="trash-2"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
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
