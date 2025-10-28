@extends('admin.layout')

@section('title', 'Laporkan Keuangan | Guide')

@section('titleNav', 'Laporkan Keuangan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('menu')
    <p class="btn btn-primary text-light d-flex justify-content-between align-items-center me-3 "><a
            href="{{ route('admin.guide.index') }}" class=" text-light fw-bold m-1 ms-3"><i
                class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
    {{-- <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.laporan.index') }}"
            class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p> --}}
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

@section('content')
    <div class="card p-3 m-3 mt-5">
        <h5 class="m-0 fw-bold">Laporkan Keuangan</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small m-0 mt-2">
                <li class="breadcrumb-item small" aria-current="page">
                    <a href="{{ route('admin.guide.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item small" aria-current="page">
                    <a href="{{ route('admin.laporan.show', $booking->id) }}">Detail</a>
                </li>
                <li class="breadcrumb-item small active" aria-current="page">Laporkan Keuangan</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center mb-5 m-3 card p-3 px-1">
        <div class="card-title m-0 px-4 p-1">
            <h6 class="fw-bold m-0">Laporkan Keuangan</h6>
        </div>
        <div class="card-body col-12 bg-white rounde p-3">
            <form action="{{ route('admin.guide.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card p-3 bg-secondary-subtle">
                    <!-- Tempat Tampil Detail Booking -->
                    <h6 class="fw-bold">Detail Booking</h6>
                    <div id="booking-detail" class="border p-3 rounded">
                        <table>
                            <tr>
                                <td><strong>Booking ID</strong></td>
                                <td class="px-2">:</td>
                                <td>{{ $booking->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama PIC</strong></td>
                                <td class="px-2">:</td>
                                <td>{{ $booking->nama_pic }}</td>
                            </tr>
                            <tr>
                                <td><strong>No Telp PIC</strong></td>
                                <td class="px-2">:</td>
                                <td>{{ $booking->noTelpPIC }}</td>
                            </tr>
                            <tr>
                                <td><strong>Organisasi</strong></td>
                                <td class="px-2">:</td>
                                <td>{{ $booking->organisasi }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal</strong></td>
                                <td class="px-2">:</td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</td>
                            </tr>
                        </table>
                        <!-- Tambah info lain jika perlu -->
                    </div>
                </div>
                <hr class="border border-secondary border-1 opacity-50 my-4">
                <div class="row mb-3">
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select name="jenis" id="jenis" class="form-select">
                            <option value="">--- Pilih Jenis ---</option>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>

                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label class="form-label">Tipe Pembayaran</label>
                            <select name="tipe_pembayaran" class="form-select" required>
                                <option value="" disabled selected>Pilih tipe</option>
                                <option value="dp">DP</option>
                                <option value="lunas">Pelunasan</option>
                                <option value="penuh">Penuh</option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bukti" class="form-label">Upload Bukti (JPG/PNG)</label>
                            <input type="file" name="bukti" id="bukti" class="form-control"
                                accept="image/*,application/pdf" onchange="previewBukti()">
                        </div>

                        <!-- Preview Container -->
                        <div id="preview-container" class="mt-3">
                            <img id="image-preview" src="#" alt="Preview Gambar" class="img-thumbnail"
                                style="max-width: 30%; display: none;">
                            <p id="pdf-preview" class="text-muted" style="display: none;">File PDF: <span
                                    id="pdf-filename"></span></p>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
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

    <script>
        const jumlahInput = document.getElementById('jumlah');

        jumlahInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // hapus semua non-digit
            value = new Intl.NumberFormat('id-ID').format(value); // format ribuan
            this.value = value;
        });
    </script>
@endsection
