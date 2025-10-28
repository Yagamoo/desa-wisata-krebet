@extends('admin.layout')

@section('title', 'Laporan | Bendahara')

@section('titleNav', 'Laporan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Detail Laporan</h2>
        <ol class="breadcrumb">
            @if (Auth::user()->hasRole('Bendahara'))
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.laporan.index') }}">Laporan</a>
                </li>
            @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.guide.index') }}">Laporan</a>
                </li>
            @endif
            <li class="breadcrumb-item active">
                <strong>Detail Laporan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('menu')
    @if (Auth::user()->hasRole('Bendahara'))
        <li>
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
        <li class="active">
            <a href="{{ route('admin.laporan.index') }}"><i class="fa fa-book"></i>
                <span class="nav-label">Laporan</span></a>
        </li>
    @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
        <li class="active">
            <a href="{{ route('admin.guide.index') }}"><i class="fa fa-th-large"></i>
                <span class="nav-label">Laporan</span></a>
        </li>
    @endif


@endsection
{{-- @section('menu')
    @if (Auth::user()->hasRole('Bendahara'))
        <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.index') }}"
                class="text-secondary m-1 ms-3"><i class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
        <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.pemasukan') }}"
                class="text-secondary fw-bold m-1 ms-3 fw-bold"><i class=" me-2 bi bi-cash  ps-1 pe-1 rounded"></i>
                Pemasukan
            </a></p>
        <p class="d-flex justify-content-between align-items-center me-3 "><a
                href="{{ route('admin.keuangan.pengeluaran') }}" class="text-secondary m-1 ms-3 fw-bold"><i
                    class=" me-2 bi bi-box-arrow-in-left ps-1 pe-1 rounded"></i>
                Pengeluaran </a> </p>
        <p class="btn btn-primary text-light d-flex justify-content-between align-items-center me-3 "><a
                href="{{ route('admin.laporan.index') }}" class="text-light fw-bold m-1 ms-3 fw-bold"><i
                    class=" me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p>
    @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
        <p class="btn btn-primary text-light d-flex justify-content-between align-items-center me-3 "><a
                href="{{ route('admin.guide.index') }}" class="text-light fw-bold m-1 ms-3"><i
                    class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
        <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.laporan.index') }}"
                class="text-secondary m-1 ms-3"><i class=" me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p>
    @endif
@endsection --}}

@section('menuHp')
    @if (Auth::user()->hasRole('Bendahara'))
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
    @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
        <div class="col text-center rounded-top bg-primary">
            <a href="{{ route('admin.guide.index') }}" class="text-white">
                <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
                <p>Dashboard</p>
            </a>
        </div>
    @endif
@endsection

@section('content')
    {{-- <div class="card p-3 m-3 mt-5">
        <h5 class="m-0 fw-bold">Dashboard</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small m-0 mt-2">
                @if (Auth::user()->hasRole('Bendahara'))
                    <li class="breadcrumb-item small" aria-current="page">
                        <a href="{{ route('admin.laporan.index') }}">Laporan</a>
                    </li>
                @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
                    <li class="breadcrumb-item small" aria-current="page">
                        <a href="{{ route('admin.guide.index') }}">Dashboard</a>
                    </li>
                @endif
                <li class="breadcrumb-item small active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div> --}}
    <div class="row mt-3">
        <div class="col-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center px-3 py-2 bg-primary">
                    <h5 class="mb-0">Detail Booking</h5>
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
                    @if (Auth::user()->hasRole('Bendahara Lapangan'))
                        <div>
                            <a href="{{ route('admin.guide.create', $booking->id) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-plus"></i> Tambah
                                Pengeluaran</a>
                        </div>

                        {{-- Floating button khusus layar kecil --}}
                        <div class="d-xl-none">
                            <a href="{{ route('admin.guide.create', $booking->id) }}" class="btn btn-success shadow-lg"
                                style="position: fixed; bottom: 90px; right: 20px; z-index: 1050;">
                                <i class="fa-solid fa-plus me-2"></i>
                                Laporkan Keuangan
                            </a>
                        </div>
                    @endif
                    <div>
                                        <a href="{{ route('kas.export', $booking->id) }}" class="btn btn-sm btn-success"><i
                                                class="fa-solid fa-file-excel me-1"></i> Export Excel</a>
                                    </div>
                </div>

                <div class="ibox-content">
                    <div class="col">
                        <div class="row mt-2 " id="booking-text">
                            <div class="col-xl-4 col-sm-12 border-end p-3 ps-4">
                                <table class="table">
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
                                        <td>{{ date('H:i', strtotime($booking->jam_mulai)) }} -
                                            {{ date('H:i', strtotime($booking->jam_selesai)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Guide / Penanggung Jawab</td>
                                        <td class="px-1 py-1">:</td>
                                        <td>{{ $booking->guide->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Booking</td>
                                        <td class="px-1 py-1">:</td>
                                        <td>
                                            <span class="fw-bold badge bg-info py-1">{{ $booking->status }}</span>
                                        </td>
                                    </tr>
                                </table>
                                <hr class="border border-secondary">
                                <div>
                                    <h4 class="font-weight-bold">Rincian Tagihan</h4>
                                    <table class="table">
                                        <tr>
                                            <td>Tagihan</td>
                                            <td>Rp. {{ number_format($booking->tagihan, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>DP</td>
                                            <td>
                                                @php
                                                    $dp = $booking->keuangan
                                                        ->where('jenis', 'pemasukan')
                                                        ->where('status', 'approved')
                                                        ->where('tipe_pembayaran', 'dp')
                                                        ->sum('jumlah');
                                                @endphp
                                                Rp. {{ number_format($dp, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lain-lain</td>
                                            <td>
                                                @php
                                                    $lain = $booking->keuangan
                                                        ->where('jenis', 'pemasukan')
                                                        ->where('status', 'approved')
                                                        ->where('tipe_pembayaran', '!=', 'dp')
                                                        ->sum('jumlah');
                                                @endphp
                                                Rp. {{ number_format($lain, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Sisa</td>
                                            <td class="fw-bold">
                                                @php
                                                    $sisaBayar = $booking->tagihan - $dp - $lain;
                                                @endphp
                                                Rp. {{ number_format($sisaBayar, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <a href="{{ route('admin.invoice', ['id' => $booking->id]) }}"
                                    class="btn btn-primary fw-bold " style="font-size: 0.8rem ;">Cetak Struck</a>
                                <a href="{{ route('admin.invoice.send', ['id' => $booking->id]) }}"
                                    class="btn btn-warning fw-bold" style="font-size: 0.8rem ;">Kirim Struck ke PIC</a>
                            </div>
                            <div class="col-xl-8 col-sm-12 p-3 ps-xl-5 ps-sm-4">
                                {{-- <div class="d-flex justify-content-end gap-2 mb-3">
                                    
                                    <div>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa-solid fa-file-pdf me-1"></i> Export PDF</a>
                                    </div>
                                </div> --}}
                                <div>
                                    <h3 class="font-weight-bold">Pemasukan</h3>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Jumlah</th>
                                                    <th>Bukti</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pemasukans as $pemasukan)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($pemasukan->tanggal)->translatedFormat('d F Y') }}
                                                        </td>
                                                        <td>{{ $pemasukan->keterangan }}</td>
                                                        <td>Rp {{ number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                                                        <td>
                                                            @if ($pemasukan->bukti)
                                                                <a href="{{ asset('storage/' . $pemasukan->bukti) }}"
                                                                    target="_blank" class="btn btn-sm btn-info">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td class="d-flex align-items-center gap-2">
                                                            @if (Auth::user()->hasRole('Bendahara'))
                                                                @if ($pemasukan->status == 'pending')
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success approve-btn"
                                                                        data-id="{{ $pemasukan->id }}">
                                                                        <i class="fa-solid fa-check"></i>
                                                                    </button>

                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger reject-btn"
                                                                        data-id="{{ $pemasukan->id }}">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                    {{-- <span class="badge text-bg-warning">Menunggu</span> --}}
                                                                @elseif($pemasukan->status == 'approved')
                                                                    <span class="badge text-bg-success">Disetujui</span>
                                                                @elseif($pemasukan->status == 'rejected')
                                                                    <span class="badge text-bg-danger">Ditolak</span>
                                                                @endif
                                                            @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
                                                                @if ($pemasukan->status == 'pending')
                                                                    <span class="badge text-bg-warning">Menunggu</span>
                                                                @elseif($pemasukan->status == 'approved')
                                                                    <span class="badge text-bg-success">Disetujui</span>
                                                                @elseif($pemasukan->status == 'rejected')
                                                                    <span class="badge text-bg-danger">Ditolak</span>
                                                                @endif
                                                            @endif
                                                        </td>


                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">Belum ada pemasukan</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">Total Pemasukan</th>
                                                    <th colspan="2">Rp
                                                        {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <hr class="border border-secondary">
                                <div>
                                    <h3 class="font-weight-bold">Pengeluaran</h3>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Jumlah</th>
                                                    <th>Bukti</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pengeluarans as $pengeluaran)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->translatedFormat('d F Y') }}
                                                        </td>
                                                        <td>{{ $pengeluaran->keterangan }}</td>
                                                        <td>Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                                        <td>
                                                            @if ($pengeluaran->bukti)
                                                                <a href="{{ asset('storage/' . $pengeluaran->bukti) }}"
                                                                    target="_blank" class="btn btn-sm btn-info">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td class="d-flex align-items-center gap-2">
                                                            @if (Auth::user()->hasRole('Bendahara'))
                                                                @if ($pengeluaran->status == 'pending')
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success approve-btn"
                                                                        data-id="{{ $pengeluaran->id }}">
                                                                        <i class="fa-solid fa-check"></i>
                                                                    </button>

                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger reject-btn"
                                                                        data-id="{{ $pengeluaran->id }}">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                    {{-- <span class="badge text-bg-warning">Menunggu</span> --}}
                                                                @elseif($pengeluaran->status == 'approved')
                                                                    <span class="badge text-bg-success">Disetujui</span>
                                                                @elseif($pengeluaran->status == 'rejected')
                                                                    <span class="badge text-bg-danger">Ditolak</span>
                                                                @endif
                                                            @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
                                                                @if ($pengeluaran->status == 'pending')
                                                                    <span class="badge text-bg-warning">Menunggu</span>
                                                                @elseif($pengeluaran->status == 'approved')
                                                                    <span class="badge text-bg-success">Disetujui</span>
                                                                @elseif($pengeluaran->status == 'rejected')
                                                                    <span class="badge text-bg-danger">Ditolak</span>
                                                                @endif
                                                            @endif
                                                        </td>


                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">Belum ada pengeluaran</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">Total Pengeluaran</th>
                                                    <th colspan="2">Rp
                                                        {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <hr class="border border-secondary">
                                <table class="table">
                                    <tr>
                                        <td>Total Pemasukan</td>
                                        <td>Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pengeluaran</td>
                                        <td>Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sisa</td>
                                        <td class="fw-bold">Rp. {{ number_format($sisa, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row bg-white rounded shadow card m-3 mb-5"">
        @if (Auth::user()->hasRole('Bendahara'))
            <div class="card-header">
                <h5 class="fw-bold p-2 m-0">Detail Booking</h5>
            </div>
        @elseif(Auth::user()->hasRole('Bendahara Lapangan'))
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="fw-bold p-2 m-0">Detail Booking</h5>
                <div class="d-none d-xl-block">
                    <a href="{{ route('admin.guide.create', $booking->id) }}" class="btn btn-sm btn-success"><i
                            class="fa-solid fa-plus me-2"></i>Laporkan Keuangan</a>
                </div>
            </div> --}}
    {{-- Floating button khusus layar kecil --}}
    {{-- <div class="d-xl-none">
                <a href="{{ route('admin.guide.create', $booking->id) }}" class="btn btn-success shadow-lg"
                    style="position: fixed; bottom: 90px; right: 20px; z-index: 1050;">
                    <i class="fa-solid fa-plus me-2"></i>
                    Laporkan Keuangan
                </a>
            </div>
        @endif
        
    </div> --}}
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // APPROVE
            document.querySelectorAll(".approve-btn").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    let id = this.dataset.id;

                    if (!confirm("Apakah kamu yakin ingin MENYETUJUI ini?")) {
                        return;
                    }

                    fetch(`/laporan-keuangan/${id}/approve`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                status: "approved"
                            }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            alert("✅ " + data.message);
                            location.reload();
                        });
                });
            });

            // REJECT
            document.querySelectorAll(".reject-btn").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    let id = this.dataset.id;

                    if (!confirm("Apakah kamu yakin ingin MENOLAK ini?")) {
                        return;
                    }

                    fetch(`/laporan-keuangan/${id}/reject`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                status: "rejected"
                            }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            alert("❌ " + data.message);
                            location.reload();
                        });
                });
            });
        });
    </script>

@endsection
