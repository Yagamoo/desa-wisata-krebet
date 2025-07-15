@extends('admin.layout')

@section('title', 'Laporan | Bendahara')

@section('titleNav', 'Laporan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('menu')
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.index') }}"
            class="text-secondary m-1 ms-3"><i class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.pemasukan') }}"
            class="text-secondary fw-bold m-1 ms-3 fw-bold"><i class=" me-2 bi bi-cash  ps-1 pe-1 rounded"></i> Pemasukan
        </a></p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.pengeluaran') }}"
            class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-box-arrow-in-left ps-1 pe-1 rounded"></i>
            Pengeluaran </a> </p>
    <p class="btn btn-primary text-light d-flex justify-content-between align-items-center me-3 "><a
            href="{{ route('admin.laporan.index') }}" class="text-light fw-bold m-1 ms-3 fw-bold"><i
                class=" me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p>
@endsection

@section('content')
    <div class="card p-3 m-3 mt-5">
        <h5 class="m-0 fw-bold">Laporan Keuangan</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small m-0 mt-2">
                <li class="breadcrumb-item small active" aria-current="page">Laporan Keuangan</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center mb-5 mt-4 m-3 gap-3">
        <div class="col p-3 pt-0 px-1 card">
            <div class="card-title p-3">
                <h6 class="m-0 fw-bold">Arus Kas</h6>
            </div>
            <div class="card-body">

            </div>
        </div>
        <div class="col p-3 pt-0 px-1 card">
            <div class="card-title p-3">
                <h6 class="m-0 fw-bold">Rincian Transaksi</h6>
            </div>
            <div class="card-body">

            </div>

        </div>
    </div>
@endsection

@section('menuHp')
    <div class="col text-center">
        <a href="{{ route('admin.keuangan.index') }}" class="text-secondary">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="col text-center">
        <a href="{{ route('admin.keuangan.pemasukan') }}" class="text-secondary">
            <p><i class="fa-solid fa-money-bill m-0 p-0 pt-2"></i></p>
            <p>Pemasukan</p>
        </a>
    </div>
    <div class="col text-center">
        <a href="{{ route('admin.keuangan.pengeluaran') }}" class="text-secondary">
            <p><i class="fa-solid fa-right-from-bracket m-0 p-0 pt-2"></i></p>
            <p>Pengeluaran</p>
        </a>
    </div>
    <div class="col text-center rounded-top bg-primary">
        <a href="{{ route('admin.laporan.index') }}" class="text-white">
            <p><i class="fa-solid fa-file-lines m-0 p-0 pt-2"></i></p>
            <p>Laporan</p>
        </a>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (SESSION('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ SESSION('success') }}",
            });
        </script>
    @endif
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@endsection
