@extends('admin.layout')

@section('title', 'Pengeluaran | Bendahara')

@section('titleNav', 'Pengeluaran')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

@endsection

@section('menu')
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.index') }}"
            class="text-secondary m-1 ms-3 "><i class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.pemasukan') }}"
            class="text-secondary m-1 ms-3"><i class=" me-2 bi bi-cash  ps-1 pe-1 rounded"></i> Pemasukan </a></p>
    <p class="btn btn-primary text-light d-flex justify-content-between align-items-center me-3 "><a
            href="{{ route('admin.keuangan.pengeluaran') }}" class="text-light fw-bold m-1 ms-3"><i
                class=" me-2 bi bi-box-arrow-in-left ps-1 pe-1 rounded"></i>
            Pengeluaran </a> </p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.laporan.index') }}"
            class="text-secondary m-1 ms-3 "><i class="me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p>
@endsection

@section('content')
    <div class="card p-3 m-3 mt-5">
        <h5 class="m-0 fw-bold">Pengeluaran</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small m-0 mt-2">
                <li class="breadcrumb-item small active" aria-current="page">Pengeluaran</li>
            </ol>
        </nav>
    </div>
    <div class="card p-3 m-3">
        <div class="row mb-3">
            <form method="GET" action="{{ route('admin.keuangan.pengeluaran') }}">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <select class="form-select" name="filter" onchange="this.form.submit()">
                        <option value="harian" {{ request('filter', 'bulanan') == 'harian' ? 'selected' : '' }}>Harian
                        </option>
                        <option value="mingguan" {{ request('filter', 'bulanan') == 'mingguan' ? 'selected' : '' }}>Mingguan
                        </option>
                        <option value="bulanan" {{ request('filter', 'bulanan') == 'bulanan' ? 'selected' : '' }}>Bulanan
                        </option>
                        <option value="tahunan" {{ request('filter', 'bulanan') == 'tahunan' ? 'selected' : '' }}>Tahunan
                        </option>
                    </select>
                </div>
            </form>
        </div>

        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card bg-warning text-center p-3">
                    <h5 class="fw-bold">Pengeluaran</h5>
                    <p class="m-0 mt-2">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5 m-3 card p-3 px-1">
        <div class="card-title m-0 mb-2 px-4 p-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold m-0">Riwayat Pengeluaran</h6>
            <a href="{{ route('admin.keuangan.pengeluaran.create') }}" class="btn btn-outline-warning bg-warning-subtle"><i class="fa-solid fa-plus"></i> Tambah
                Pengeluaran</a>
        </div>
        <div class="col-12 bg-white rounde p-3">
            {{-- Tabel untuk layar besar --}}
            <div class="table-responsive d-none d-lg-block">
                <table id="keuangan-index" class="table table-bordered align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Booking ID</th>
                            <th>Nama PIC</th>
                            <th>Nama Organisasi</th>
                            <th>No Telpon</th>
                            <th>Pembayaran</th>
                            <th>Jumlah</th>
                            <th>Bukti</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $items)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $items->booking_id ?? $items->keterangan }}</td>
                                <td>{{ $items->booking->nama_pic ??'Admin' }}</td>
                                <td>{{ $items->booking->organisasi ??'Admin' }}</td>
                                <td>{{ $items->booking->noTelpPIC ??'Admin' }}</td>
                                <td class="text-capitalize">{{ $items->tipe_pembayaran }}</td>
                                <td>Rp. {{ number_format($items->jumlah, 0, ',', '.') }}</td>
                                <td class="text-nowrap">
                                    @if ($items->bukti)
                                        <a href="{{ asset('storage/' . $items->bukti) }}" target="_blank">Lihat Bukti</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge text-capitalize"
                                        style="background-color: #f0e813; color: #333;">{{ $items->jenis }}</span>
                                </td>
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
                                    <h6 class="fw-bolder mb-0">{{ $items->booking->organisasi ?? 'Krebet' }}</h6>
                                    <span class="badge {{ $items->jenis == 'pemasukan' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($items->jenis) }}
                                    </span>
                                </div>
                                <table class="small">
                                    <tr>
                                        <td class="align-top">
                                            <strong>Tanggal</strong>
                                        </td>
                                        <td class="px-2 align-top">:</td>
                                        <td>{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}</td>
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
    <div class="col text-center rounded-top bg-primary">
        <a href="{{ route('admin.keuangan.pengeluaran') }}" class="text-white">
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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
                }
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
