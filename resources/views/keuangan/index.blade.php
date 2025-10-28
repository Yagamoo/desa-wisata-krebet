@extends('admin.layout')

@section('title', 'Dashboard | Bendahara')

@section('titleNav', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    {{-- <style>
        .class {
            background-color: rgb(248, 172, 89);
        }
    </style> --}}
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
        <a href="{{ route('admin.keuangan.index') }}"><i class="fa fa-th-large"></i>
            <span class="nav-label">Dashboard</span>
        </a>
    </li>
    <li>
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
                    <!-- Filter -->
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <form method="GET" action="{{ route('admin.keuangan.index') }}">
                                <select name="filter" class="form-control" onchange="this.form.submit()">
                                    <option value="harian" {{ request('filter', 'bulanan') == 'harian' ? 'selected' : '' }}>
                                        Harian</option>
                                    <option value="mingguan"
                                        {{ request('filter', 'bulanan') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                    <option value="bulanan"
                                        {{ request('filter', 'bulanan') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="tahunan"
                                        {{ request('filter', 'bulanan') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <!-- Kartu Keuangan -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.keuangan.pemasukan') }}"
                                class="card bg-success text-white text-center p-4 shadow-sm"
                                style="text-decoration: none; border-radius: 0.75rem;">
                                <h4 class="font-weight-bold mb-2">Pemasukan</h4>
                                <p class="h5 mb-0">Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
                            </a>
                        </div>

                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.keuangan.pengeluaran') }}"
                                class="card bg-warning text-dark text-center p-4 shadow-sm"
                                style="text-decoration: none; border-radius: 0.75rem;">
                                <h4 class="font-weight-bold mb-2">Pengeluaran</h4>
                                <p class="h5 mb-0">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center bg-primary">
                    <h5>Perbandingan Pemasukan & Pengeluaran</h5>
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
                    <div class="row">
                        <div class="mt-4 col-lg-6">
                            <canvas id="keuanganChart"></canvas>
                        </div>
                        <div class="mt-4 col-lg-6">
                            <canvas id="barChartKeuangan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <!-- Filter Jenis Keuangan -->
                    <div class="d-flex justify-content-center mb-3">
                        <div class="btn-group" role="group" aria-label="Filter Keterangan">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="Semua" checked>
                            <label class="btn btn-outline-primary" for="btnradio1">Semua</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="pemasukan">
                            <label class="btn btn-outline-success" for="btnradio2">Pemasukan</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="pengeluaran">
                            <label class="btn btn-outline-warning" for="btnradio3">Pengeluaran</label>
                        </div>
                    </div>

                    <!-- Tabel untuk layar besar -->
                    <div class="table-responsive d-none d-lg-block">
                        <table id="keuangan-index" class="table table-bordered align-middle small">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Nama PIC</th>
                                    <th>Nama Organisasi</th>
                                    <th>No Telepon</th>
                                    <th>Pembayaran</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Bukti</th>
                                    <th>Jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filteredData as $items)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $items->booking->nama_pic ?? 'Admin' }}</td>
                                        <td>{{ $items->booking->organisasi ?? 'Admin' }}</td>
                                        <td>{{ $items->booking->noTelpPIC ?? 'Admin' }}</td>
                                        <td class="text-capitalize">{{ $items->tipe_pembayaran }}</td>
                                        <td class="text-capitalize">{{ $items->keterangan }}</td>
                                        <td>Rp {{ number_format($items->jumlah, 0, ',', '.') }}</td>
                                        <td class="text-nowrap">
                                            @if ($items->bukti)
                                                <a href="{{ asset('storage/' . $items->bukti) }}" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($items->jenis == 'pemasukan')
                                                <span class="badge bg-success text-capitalize">{{ $items->jenis }}</span>
                                            @elseif ($items->jenis == 'pengeluaran')
                                                <span
                                                    class="badge bg-warning text-dark text-capitalize">{{ $items->jenis }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Card tampilan untuk layar kecil -->
                    <div class="d-block d-lg-none">
                        @forelse ($filteredData as $items)
                            <div class="card mb-3 shadow-sm" data-keterangan="{{ $items->jenis }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="fw-bold mb-0">{{ $items->booking->organisasi ?? 'Krebet' }}</h6>
                                        <span
                                            class="badge {{ $items->jenis == 'pemasukan' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ ucfirst($items->jenis) }}
                                        </span>
                                    </div>

                                    <table class="small mb-0">
                                        <tr>
                                            <td><strong>Tanggal</strong></td>
                                            <td class="px-2">:</td>
                                            <td>{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>PIC</strong></td>
                                            <td class="px-2">:</td>
                                            <td>{{ $items->booking->nama_pic ?? 'Admin' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No Telp</strong></td>
                                            <td class="px-2">:</td>
                                            <td>{{ $items->booking->noTelpPIC ?? 'Admin' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pembayaran</strong></td>
                                            <td class="px-2">:</td>
                                            <td>{{ ucfirst($items->tipe_pembayaran) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nominal</strong></td>
                                            <td class="px-2">:</td>
                                            <td>Rp {{ number_format($items->jumlah, 0, ',', '.') }}</td>
                                        </tr>
                                    </table>
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

@endsection

@section('menuHp')
    <div class="col text-center rounded-top bg-primary">
        <a href="{{ route('admin.keuangan.index') }}" class="text-white">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="col text-center menuHp">
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
    <div class="col text-center border-start">
        <a href="{{ route('admin.laporan.index') }}" class="text-secondary">
            <p><i class="fa-solid fa-file-lines m-0 p-0 pt-2"></i></p>
            <p>Laporan</p>
        </a>
    </div>
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
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            const table = $('#keuangan-index').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'copy'
                    },
                    {
                        extend: 'csv'
                    },
                    {
                        extend: 'excel',
                        title: 'ExampleFile'
                    },
                    {
                        extend: 'pdf',
                        title: 'ExampleFile'
                    },

                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

            // Filter berdasarkan keterangan (kolom ke-8, index ke-8)
            $('input[name="btnradio"]').on('change', function() {
                const value = $(this).val();
                if (value === "Semua") {
                    table.column(9).search('').draw();
                } else {
                    table.column(9).search(value).draw();
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
        // $(document).ready(function() {
        //     const table = $('#keuangan-index').DataTable({
        //         responsive: true,
        //         pageLength: 5,
        //         lengthMenu: [
        //             [5, 10, 25, -1],
        //             [5, 10, 25, "Semua"]
        //         ],
        //         language: {
        //             search: "Cari:",
        //             lengthMenu: "Tampilkan _MENU_ data",
        //             info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        //             paginate: {
        //                 first: "Pertama",
        //                 last: "Terakhir",
        //                 next: "Berikutnya",
        //                 previous: "Sebelumnya"
        //             },
        //             zeroRecords: "Tidak ada data yang ditemukan",
        //         },
        //         dom: 'Bfrtip', // menampilkan tombol di atas table
        //         buttons: [{
        //             extend: 'excelHtml5',
        //             text: '<i class="fa-solid fa-file-excel"></i> Excel',
        //             className: 'btn btn-success btn-sm',
        //             title: 'Kas_Keuangan_' + new Date().toISOString().slice(0, 10) // nama file
        //         }]
        //     });

        //     // Filter berdasarkan keterangan (kolom ke-8, index ke-8)
        //     $('input[name="btnradio"]').on('change', function() {
        //         const value = $(this).val();
        //         if (value === "Semua") {
        //             table.column(9).search('').draw();
        //         } else {
        //             table.column(9).search(value).draw();
        //         }

        //         // === Filter CARD (Mobile) ===
        //         let visibleCount = 0;
        //         document.querySelectorAll('.d-block.d-lg-none .card').forEach(card => {
        //             const ket = card.getAttribute('data-keterangan');
        //             if (value === "Semua" || ket === value) {
        //                 card.style.display = 'block';
        //                 visibleCount++;
        //             } else {
        //                 card.style.display = 'none';
        //             }
        //         });

        //         // Tampilkan pesan jika tidak ada card yang cocok
        //         const noCardMessage = document.getElementById('no-card-data');
        //         if (visibleCount === 0) {
        //             noCardMessage.classList.remove('d-none');
        //         } else {
        //             noCardMessage.classList.add('d-none');
        //         }
        //     });
        // });
    </script>

    <script>
        const ctx = document.getElementById('keuanganChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                        label: 'Pemasukan',
                        data: {!! json_encode($pemasukanChart) !!},
                        borderColor: '#1c84c6',
                        backgroundColor: 'rgba(28, 132, 198, 0.2)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Pengeluaran',
                        data: {!! json_encode($pengeluaranChart) !!},
                        borderColor: '#f8ac59',
                        backgroundColor: 'rgba(248, 172, 89, 0.2)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp. ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        const ctxBar = document.getElementById('barChartKeuangan').getContext('2d');
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                        label: 'Pemasukan',
                        data: {!! json_encode($pemasukanChart) !!},
                        backgroundColor: '#1c84c6', // biru
                        borderColor: '#1c84c6',
                        borderWidth: 1
                    },
                    {
                        label: 'Pengeluaran',
                        data: {!! json_encode($pengeluaranChart) !!},
                        backgroundColor: '#f8ac59', // kuning
                        borderColor: '#f8ac59',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp. ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
