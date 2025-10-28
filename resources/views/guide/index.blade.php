@extends('admin.layout')

@section('title', 'Dashboard | Bendahara Lapangan')

@section('titleNav', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> --}}
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Dashboard</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('menu')
    <li class="active">
        <a href="{{ route('admin.guide.index') }}"><i class="fa fa-th-large"></i>
            <span class="nav-label">Dashboard</span>
        </a>
    </li>
@endsection

@section('content')
    {{-- <div class="card p-3 m-3 mt-5">
        <h5 class="m-0 fw-bold">Dashboard</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small m-0 mt-2">
                <li class="breadcrumb-item small active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div> --}}
    <div class="row mt-3">
        <div class="col-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center bg-primary">
                    <h5>Filter</h5>
                    <div class="ibox-tools">
                        {{-- <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a> --}}
                        {{-- 
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a></li>
                            <li><a href="#" class="dropdown-item">Config option 2</a></li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                        --}}
                    </div>
                </div>

                <div class="ibox-content">
                    <form method="GET" action="{{ route('admin.guide.index') }}">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <select class="form-control" name="filter" onchange="this.form.submit()">
                                <option value="harian" {{ request('filter', 'bulanan') == 'harian' ? 'selected' : '' }}>
                                    Harian
                                </option>
                                <option value="mingguan" {{ request('filter', 'bulanan') == 'mingguan' ? 'selected' : '' }}>
                                    Mingguan
                                </option>
                                <option value="bulanan" {{ request('filter', 'bulanan') == 'bulanan' ? 'selected' : '' }}>
                                    Bulanan
                                </option>
                                <option value="tahunan" {{ request('filter', 'bulanan') == 'tahunan' ? 'selected' : '' }}>
                                    Tahunan
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card p-3 m-3">
        <div class="row mb-3">

        </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center bg-primary">
                    <h5>Riwayat Transaksi</h5>
                    <div class="ibox-tools">
                        {{-- <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a> --}}
                        {{-- 
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a></li>
                            <li><a href="#" class="dropdown-item">Config option 2</a></li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                        --}}
                    </div>
                </div>

                <div class="ibox-content">
                    {{-- Tabel untuk layar besar --}}
                    <div class="table-responsive d-none d-lg-block">
                        <table id="keuangan-index" class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="vertical-align: top">No</th>
                                    <th scope="col">Nama PIC</th>
                                    <th scope="col" style="vertical-align: top">No Telpon</th>
                                    <th scope="col">Nama Organisasi</th>
                                    <th scope="col">Jumlah Visitor</th>
                                    <th scope="col">Tanggal Kunjungan</th>
                                    <th scope="col">Jam Kunjungan</th>
                                    {{-- <th scope="col" style="vertical-align: top">Detail</th> --}}
                                    <th scope="col" style="vertical-align: top">Guide</th>
                                    <th scope="col">Tagihan Kunjungan</th>
                                    {{-- <th scope="col" style="vertical-align: top">Status</th> --}}
                                    <th scope="col" style="width:10%; vertical-align: top">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filteredData as $booking)
                                    @php
                                        $isPast = \Carbon\Carbon::parse($booking->tanggal)->isPast();
                                    @endphp
                                    <tr>
                                        <td scope="row" class="pt-3">{{ $loop->iteration }}</td>
                                        <td class="pt-3">{{ $booking->nama_pic }}</td>
                                        <td class="pt-3">{{ $booking->noTelpPIC }}</td>
                                        <td class="pt-3">{{ $booking->organisasi }}</td>
                                        <td class="pt-3">{{ $booking->visitor }}</td>
                                        <td class="pt-3 {{ $isPast ? 'text-danger' : 'text-success' }}">
                                            {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="pt-3">{{ date('H:i', strtotime($booking->jam_mulai)) }} -
                                            {{ date('H:i', strtotime($booking->jam_selesai)) }}</td>
                                        <td scope="col">{{ $booking->guide->name }}</td>
                                        <td scope="col">Rp {{ number_format($booking->tagihan, 0, ',', '.') }}</td>
                                        {{-- <td class="">
                                    <span class="badge {{ $booking->latest_status_keuangan?->tipe_pembayaran === 'penuh' ? 'bg-success' : ($booking->latest_status_keuangan?->tipe_pembayaran === 'dp' ? 'bg-warning' : 'bg-secondary') }}">
                                        {{ $booking->latest_status_keuangan?->tipe_pembayaran === 'penuh' ? 'Lunas' : ($booking->latest_status_keuangan?->tipe_pembayaran === 'dp' ? 'Uang Muka' : 'Pelunasan') }}
                                    </span>
                                </td> --}}
                                        <td scope="col">
                                            <a href="{{ route('admin.laporan.show', $booking->id) }}"
                                                style="text-decoration: none; color:rgb(2, 77, 2); font-size:1.5rem;"><i
                                                    class="fa-solid fa-file-invoice"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Card untuk layar kecil dan menengah --}}
                    <div class="d-block d-lg-none">
                        @forelse ($filteredData  as $items)
                            <div class="card mb-3 shadow-sm" data-keterangan="{{ $items->jenis }}">
                                <div class="card-body">
                                    <div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <h5 class="font-weight-bold mb-0">{{ $items->organisasi ?? 'Krebet' }}</h5>
                                            {{-- <span class="badge {{ $items->latest_status_keuangan?->tipe_pembayaran === 'penuh' ? 'bg-success' : ($items->latest_status_keuangan?->tipe_pembayaran === 'dp' ? 'bg-warning' : 'bg-secondary') }}">
                                        {{ $items->latest_status_keuangan?->tipe_pembayaran === 'penuh' ? 'Lunas' : ($items->latest_status_keuangan?->tipe_pembayaran === 'dp' ? 'Uang Muka' : 'Pelunasan') }}
                                    </span> --}}

                                        </div>
                                        <table class="mb-2">
                                            <tr>
                                                <td class="align-top">
                                                    <strong>Tanggal</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}
                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>Jam Kunjungan</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ date('H:i', strtotime($booking->jam_mulai)) }} -
                                                    {{ date('H:i', strtotime($booking->jam_selesai)) }}</td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>PIC</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ $items->nama_pic ?? 'Admin' }}</td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>No Telp</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ $items->noTelpPIC ?? 'Admin' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>Guide</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ $booking->guide->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>Nominal</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>Rp. {{ number_format($items->tagihan, 0, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('admin.laporan.show', $items->id) }}"
                                                class="btn btn-info text-white"><i class="fa-solid fa-file-invoice"></i>
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted">
                                <em>Belum ada data yang ditampilkan.</em>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-5 m-3 card p-3 px-1">
        <div class="card-title m-0 px-4 p-1">
            <h6 class="fw-bold m-0">Riwayat Transaksi</h6>
            {{-- <a href="#" style="text-decoration: none;">Lihat Semua</a> --}}
        </div>
        <div class="col-12 bg-white rounde p-3">


        </div>
    </div>
@endsection

@section('menuHp')
    <div class="col text-center rounded-top bg-primary">
        <a href="{{ route('admin.guide.index') }}" class="text-white">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    {{-- <div class="col text-center border-start">
        <a href="{{ route('admin.laporan.index') }}" class="text-secondary">
            <p><i class="fa-solid fa-file-lines m-0 p-0 pt-2"></i></p>
            <p>Laporan</p>
        </a>
    </div> --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            const table = $('#keuangan-index').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 25, -1],
                    [5, 10, 25, "Semua"]
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords: "Tidak ada data yang ditemukan",
                },
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'copy',
                        text: 'Copy'
                    },
                    // {
                    //     extend: 'csv',
                    //     text: 'CSV'
                    // },
                    {
                        extend: 'excel',
                        title: 'Data Booking'
                    },
                    // {
                    //     extend: 'pdf',
                    //     title: 'Data Booking'
                    // },
                    // {
                    //     extend: 'print',
                    //     text: 'Print',
                    //     customize: function(win) {
                    //         $(win.document.body).addClass('white-bg');
                    //         $(win.document.body).css('font-size', '10px');
                    //         $(win.document.body).find('table')
                    //             .addClass('compact')
                    //             .css('font-size', 'inherit');
                    //     }
                    // }
                ]
            });

            // Filter berdasarkan keterangan (kolom ke-8, index ke-8)
            $('input[name="btnradio"]').on('change', function() {
                const value = $(this).val();
                if (value === "Semua") {
                    table.column(8).search('').draw();
                } else {
                    table.column(8).search(value).draw();
                }

                // === Filter CARD (Mobile) ===
                let visibleCount = 0;
                document.querySelectorAll('.d-block.d-lg-none .card').forEach(card => {
                    const ket = card.getAttribute('data-keterangan');
                    if (value === "Semua" || ket === value) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Tampilkan pesan jika tidak ada card yang cocok
                const noCardMessage = document.getElementById('no-card-data');
                if (visibleCount === 0) {
                    noCardMessage.classList.remove('d-none');
                } else {
                    noCardMessage.classList.add('d-none');
                }
            });
        });
        
    </script>
@endsection
