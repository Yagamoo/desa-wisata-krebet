@extends('admin.layout')

@section('title', 'Pemasukan | Bendahara')

@section('titleNav', 'Pemasukan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
     --}}
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">


@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Pemasukan</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Pemasukan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('menu')
    <li>
        <a href="{{ route('admin.keuangan.index') }}"><i class="fa fa-th-large"></i>
            <span class="nav-label">Dashboard</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('admin.keuangan.pemasukan') }}"><i class="fa fa-money"></i>
            <span class="nav-label">Pemasukan</span></a>
    </li>
    <li>
        <a href="{{ route('admin.keuangan.pengeluaran') }}"><i class="fa fa-sign-out"></i>
            <span class="nav-label">Pengeluaran</span></a>
    </li>
    <li>
        <a href="{{ route('admin.laporan.index') }}"><i class="fa fa-book"></i>
            <span class="nav-label">Laporan</span></a>
    </li>
@endsection

@section('content')
    {{-- <div class="card p-3 m-3 mt-5">
        <h5 class="m-0 fw-bold">Pemasukan</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small m-0 mt-2">
                <li class="breadcrumb-item small active" aria-current="page">Pemasukan</li>
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
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <form method="GET" action="{{ route('admin.keuangan.pemasukan') }}" class="mb-3">
                                <select id="filter" class="form-control" name="filter" onchange="this.form.submit()">
                                    <option value="harian" {{ request('filter', 'bulanan') == 'harian' ? 'selected' : '' }}>
                                        Harian</option>
                                    <option value="mingguan"
                                        {{ request('filter', 'bulanan') == 'mingguan' ? 'selected' : '' }}>
                                        Mingguan</option>
                                    <option value="bulanan"
                                        {{ request('filter', 'bulanan') == 'bulanan' ? 'selected' : '' }}>
                                        Bulanan</option>
                                    <option value="tahunan"
                                        {{ request('filter', 'bulanan') == 'tahunan' ? 'selected' : '' }}>
                                        Tahunan</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="card bg-success text-white text-center p-4 shadow-sm"
                                style="text-decoration: none; border-radius: 0.75rem;">
                                <h4 class="font-weight-bold mb-2">Pemasukan</h4>
                                <p class="h5 mb-0">Rp. {{ number_format($pemasukan, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center px-3 py-2 bg-primary">
                    <h5 class="mb-0">Filter</h5>
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
                    <div>
                        <a href="{{ route('admin.keuangan.pemasukan.create') }}" class="btn btn-success"><i
                                class="fa-solid fa-plus"></i> Tambah Pemasukan</a>
                    </div>
                </div>

                <div class="ibox-content">
                    {{-- Tabel untuk layar besar --}}
                    <div class="table-responsive d-none d-lg-block">
                        <table id="keuangan-index" class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pembayaran</th>
                                    {{-- <th>Booking ID</th> --}}
                                    <th>Nama PIC</th>
                                    <th>Nama Organisasi</th>
                                    <th>No Telpon</th>
                                    <th>Pembayaran</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Bukti</th>
                                    {{-- <th>Keterangan</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $items)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}</td>
                                        {{-- <td>{{ $items->booking_id ?? $items->keterangan }}</td> --}}
                                        <td>{{ $items->booking->nama_pic ?? 'Admin' }}</td>
                                        <td>{{ $items->booking->organisasi ?? 'Admin' }}</td>
                                        <td>{{ $items->booking->noTelpPIC ?? 'Admin' }}</td>
                                        <td class="text-capitalize">{{ $items->tipe_pembayaran }}</td>
                                        <td class="text-capitalize">{{ $items->keterangan }}</td>
                                        <td>Rp. {{ number_format($items->jumlah, 0, ',', '.') }}</td>
                                        <td class="text-nowrap">
                                            @if ($items->bukti)
                                                <a href="{{ asset('storage/' . $items->bukti) }}" target="_blank"
                                                    class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        {{-- <td>
                                    <span class="badge text-capitalize"
                                        style="background-color: #00b894; color: white;">{{ $items->jenis }}</span>
                                </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Card untuk layar kecil dan menengah --}}
                    <div class="d-block d-lg-none">
                        @forelse ($data as $items)
                            <div class="card mb-3 shadow-sm" data-keterangan="{{ $items->jenis }}">
                                <div class="card-body">
                                    <div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <h3 class="font-weight-bold mb-0">{{ $items->booking->organisasi ?? 'Krebet' }}
                                            </h3>
                                            <span
                                                class="badge {{ $items->jenis == 'pemasukan' ? 'bg-success' : 'bg-warning' }}">
                                                {{ ucfirst($items->jenis) }}
                                            </span>
                                        </div>
                                        <table class="">
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
                                                    <strong>PIC</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ $items->booking->nama_pic ?? 'Admin' }}</td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>No Telp</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ $items->booking->noTelpPIC ?? 'Admin' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>Pembayaran</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>{{ ucfirst($items->tipe_pembayaran) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-top">
                                                    <strong>Nominal</strong>
                                                </td>
                                                <td class="px-2 align-top">:</td>
                                                <td>Rp. {{ number_format($items->jumlah, 0, ',', '.') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted">
                                <em>Belum ada data yang ditampilkan.</em>
                            </div>
                        @endforelse
                        <div id="no-card-data" class="text-center text-muted d-none">
                            <em>Tidak ada data yang ditampilkan.</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row justify-content-center mb-5 m-3 card p-3 px-1">
        <div class="card-title m-0 mb-2 px-4 p-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold m-0">Riwayat Pemasukan</h6>
            <a href="{{ route('admin.keuangan.pemasukan.create') }}" class="btn btn-outline-success bg-success-subtle"><i
                    class="fa-solid fa-plus"></i> Tambah Pemasukan</a>
        </div>
        <div class="col-12 bg-white rounde p-3">

        </div>
    </div> --}}
@endsection

@section('menuHp')
    <div class="col text-center">
        <a href="{{ route('admin.keuangan.index') }}" class="text-secondary">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="col text-center rounded-top bg-primary">
        <a href="{{ route('admin.keuangan.pemasukan') }}" class="text-white">
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
    <div class="col text-center border-start">
        <a href="{{ route('admin.laporan.index') }}" class="text-secondary">
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
    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            const table = $('#keuangan-index').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 25, -1],
                    [5, 10, 25, "Semua"]
                ],
                responsive: true,
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
