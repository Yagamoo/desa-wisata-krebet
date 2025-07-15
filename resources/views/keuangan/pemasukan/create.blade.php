@extends('admin.layout')

@section('title', 'Pemasukan | Bendahara')

@section('titleNav', 'Pemasukan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

@endsection

@section('menu')
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.index') }}"
            class="text-secondary m-1 ms-3"><i class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
    <p class="btn btn-primary text-light d-flex justify-content-between align-items-center me-3 "><a
            href="{{ route('admin.keuangan.pemasukan') }}" class="text-light fw-bold m-1 ms-3 fw-bold"><i
                class=" me-2 bi bi-cash  ps-1 pe-1 rounded"></i> Pemasukan </a></p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.keuangan.pengeluaran') }}"
            class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-box-arrow-in-left ps-1 pe-1 rounded"></i>
            Pengeluaran </a> </p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.laporan') }}"
            class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p>
@endsection

@section('content')
    <div class="card p-3 m-3 mt-5">
        <h5 class="m-0 fw-bold">Form Tambah Pemasukan</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small m-0 mt-2">
                <li class="breadcrumb-item small"><a href="{{ route('admin.keuangan.pemasukan') }}"
                        class="text-decoration-none">Pemasukan</a></li>
                <li class="breadcrumb-item small active" aria-current="page">Tambah Pemasukan</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center mb-5 m-3 card p-3 px-1">
        <div class="col-12 p-3 px-4">
            <form action="{{ route('admin.keuangan.pemasukan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="booking_id" class="form-label">Booking ID</label>
                    <select name="booking_id" id="booking_id" class="form-control" onchange="getBookingDetail(this.value)">
                        <option value="">Pilih Booking Id</option>
                        @foreach ($bookings as $booking)
                            <option value="{{ $booking->id }}">{{ $booking->id }} - {{ $booking->nama_pic }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="card p-3 bg-secondary-subtle">
                    <!-- Tempat Tampil Detail Booking -->
                    <h6 class="fw-bold">Detail Booking</h6>
                    <div id="booking-detail" class="border p-3 rounded" style="display: none;">
                        <table>
                            <tr>
                                <td><strong>Nama PIC</strong></td>
                                <td class="px-2">:</td>
                                <td id="nama-pic"></td>
                            </tr>
                            <tr>
                                <td><strong>No Telp PIC</strong></td>
                                <td class="px-2">:</td>
                                <td id="no_telp"></td>
                            </tr>
                            <tr>
                                <td><strong>Organisasi</strong></td>
                                <td class="px-2">:</td>
                                <td id="organisasi"></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal</strong></td>
                                <td class="px-2">:</td>
                                <td id="tanggal-booking"></td>
                            </tr>
                        </table>
                        <!-- Tambah info lain jika perlu -->
                    </div>
                    <div id="before-select" style="display: block" class="text-center">
                        <i class="m-0">Tidak Menggunakan Booking ID</i>
                    </div>
                </div>
                <hr class="border border-secondary border-1 opacity-50 my-4">
                <div class="row mb-3">
                    <div class="col">


                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipe Pembayaran</label>
                            <select name="tipe_pembayaran" class="form-select" required>
                                <option value="" disabled selected>Pilih tipe</option>
                                <option value="dp">DP</option>
                                <option value="lunas">Pelunasan</option>
                                <option value="penuh">Penuh</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        function previewBukti() {
            const fileInput = document.getElementById('bukti');
            const imagePreview = document.getElementById('image-preview');
            const pdfPreview = document.getElementById('pdf-preview');
            const pdfFileName = document.getElementById('pdf-filename');

            const file = fileInput.files[0];

            if (file) {
                const fileType = file.type;

                if (fileType.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        pdfPreview.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                } else if (fileType === 'application/pdf') {
                    imagePreview.style.display = 'none';
                    pdfFileName.textContent = file.name;
                    pdfPreview.style.display = 'block';
                } else {
                    imagePreview.style.display = 'none';
                    pdfPreview.style.display = 'none';
                }
            }
        }
    </script>

    <script>
        function getBookingDetail(bookingId) {
            if (!bookingId) {
                document.getElementById('booking-detail').style.display = 'none';
                return;
            }

            fetch(`/booking-detail/${bookingId}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('nama-pic').textContent = data.nama_pic;
                    document.getElementById('no_telp').textContent = data.noTelpPIC;
                    document.getElementById('organisasi').textContent = data.organisasi;
                    document.getElementById('tanggal-booking').textContent = data.tanggal;
                    document.getElementById('booking-detail').style.display = 'block';
                    document.getElementById('before-select').style.display = 'none';
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('before-select').style.display = 'block';
                    document.getElementById('booking-detail').style.display = 'none';
                });
        }
    </script>

    <script>
        const jumlahInput = document.getElementById('jumlah');

        jumlahInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // hapus semua non-digit
            value = new Intl.NumberFormat('id-ID').format(value); // format ribuan
            this.value = value;
        });
    </script>


@endsection
