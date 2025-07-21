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

@section('content')
    <div class="row bg-white rounded shadow card m-3 mt-5"">
        <div class="card-header">
            <h5 class="fw-bold p-2 m-0">Detail Booking</h5>
        </div>
        <div class="col">
            <div class="row mt-2 " id="booking-text">
                <div class="col-4 border-end p-3 ps-4">
                    <table class="small">
                        <tr>
                            <td>ID BOOKING</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ $booking->id }}</td>
                        </tr>
                        <tr>
                            <td>Nama PIC</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ $booking->nama_pic }}</td>
                        </tr>
                        <tr>
                            <td>No Telp PIC</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ $booking->noTelpPIC }}</td>
                        </tr>
                        <tr>
                            <td>Organisasi</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ $booking->organisasi }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Visitor</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ $booking->visitor }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Booking</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Jam Booking</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ date('H:i', strtotime($booking->jam_mulai)) }} - {{ date('H:i', strtotime($booking->jam_selesai)) }}</td>
                        </tr>
                        <tr>
                            <td>Guide / Penanggung Jawab</td>
                            <td class="px-1 py-1">:</td>
                            <td>{{ $booking->guide->name }}</td>
                        </tr>
                    </table>
                    <p>Status Booking : <span class="fw-bold btn btn-info text-white">{{ $booking->status }}</span></p>
                    <a href="{{ route('admin.invoice', ['id' => $booking->id]) }}" class="btn btn-primary fw-bold "
                        style="font-size: 0.8rem ;">Cetak Struck</a>
                    <a href="{{ route('admin.invoice.send', ['id' => $booking->id]) }}" class="btn btn-warning fw-bold"
                        style="font-size: 0.8rem ;">Kirim Struck ke PIC</a>

                </div>
                <div class="col-8 p-3 ps-5">
                    
                </div>
            </div>
        </div>
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
@endsection
