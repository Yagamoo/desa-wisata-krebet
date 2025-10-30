@extends('admin.layout')

@section('title', 'Booking | Admin')

@section('titleNav', 'Booking')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Booking</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('menu')
    <li>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i>
            <span class="nav-label">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.kalender') }}"><i class="fa fa-calendar"></i>
            <span class="nav-label">Kalender</span></a>
    </li>
    <li class="active">
        <a href="{{ route('admin.booking') }}"><i class="fa fa-users"></i>
            <span class="nav-label">Booking</span></a>
    </li>
    <li>
        <a href="{{ route('admin.laporan') }}"><i class="fa fa-book"></i>
            <span class="nav-label">Laporan</span></a>
    </li>
    <li class="text-white px-4 mt-3">
        <h4>Manajemen Paket</h4>
    </li>
    <li>
        <a href="{{ route('admin.paket.index') }}"><i class="fa fa-bar-chart-o"></i>
            <span class="nav-label">Paket</span></a>
    </li>
@endsection

@section('content')
    <div class="row mt-3" id="search">
        <div class="ibox col-12">
            <div class="ibox-title d-flex justify-content-between align-items-center bg-primary">
                <h5>Filter</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
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
                <form action="{{ route('admin.booking.pic.search') }}" class="row">
                    {{-- Filter Nama PIC --}}
                    <div class="search-pic col-3">
                        <div class="">
                            <input type="text" class="form-control" id="floatingInputPIC" name="namePIC"
                                placeholder="Nama PIC" value="{{ session('nama_pic', '') }}">
                        </div>
                    </div>

                    {{-- Filter Tanggal --}}
                    <div class="search-tanggal col-3">
                        <div class="">
                            <input type="date" class="form-control" id="floatingInputTanggal" name="tanggal"
                                placeholder="Cari Tanggal" value="{{ session('tanggal', '') }}">
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-secondary fw-bold ms-3 w-75">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row" id="data-booking">
        <div class="ibox col-12">
            <div class="ibox-title d-flex justify-content-between align-items-center bg-primary">
                <h5>Data Booking</h5>
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
                <div class="col p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center dataTables-example w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama PIC</th>
                                    <th>Nama Organisasi</th>
                                    <th>No Telpon</th>
                                    <th>Jumlah Visitor</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Jam Kunjungan</th>
                                    <th>Detail</th>
                                    <th>Tagihan Kunjungan</th>
                                    <th>Status ACC</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->nama_pic }}</td>
                                        <td>{{ $booking->organisasi }}
                                        </td>
                                        <td>
                                            @php
                                                $noHp = preg_replace('/^0/', '62', $booking->noTelpPIC);
                                            @endphp
                                            <a href="https://wa.me/{{ $noHp }}" target="_blank"
                                                style="text-decoration: underline; color: #25D366;">
                                                {{ $booking->noTelpPIC }}
                                            </a>
                                        </td>
                                        <td>{{ $booking->visitor }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>{{ date('H:i', strtotime($booking->jam_mulai)) }} -
                                            {{ date('H:i', strtotime($booking->jam_selesai)) }}</td>
                                        <td>
                                            <a href="{{ route('admin.detail', ['id' => $booking->id]) }}"
                                                style="text-decoration: none; color:rgb(2, 77, 2); font-size:1.5rem;">
                                                <i class="fa-solid fa-file-invoice"></i>
                                            </a>
                                        </td>
                                        <td>Rp {{ number_format($booking->tagihan, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($booking->status == 'Belum ACC')
                                                <button class="btn text-light btn-dark btn-sm" data-toggle="modal"
                                                    data-target="#statusModal-{{ $booking->id }}">
                                                    {{ $booking->status }}
                                                </button>
                                            @else
                                                <span
                                                    class="badge 
                                        @if ($booking->status == 'ACC - Lunas') badge-success
                                        @elseif($booking->status == 'ACC - DP') badge-info
                                        @else badge-secondary @endif py-1">
                                                    {{ $booking->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Opsi Booking">
                                                <a href="{{ route('admin.edit.booking', ['id' => $booking->id]) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm text-white"
                                                    data-toggle="modal" data-target="#target{{ $booking->id }}"
                                                    title="Hapus">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>


                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="target{{ $booking->id }}" tabindex="-1"
                                                aria-labelledby="target{{ $booking->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Peringatan</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="h4 fw-bold">Yakin Menghapus Data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn btn-secondary text-white"
                                                                data-dismiss="modal">Batal</a>
                                                            <a class="btn btn-danger"
                                                                href="{{ route('admin.booking.delete', ['id' => $booking->id]) }}">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ACC Booking -->
    @foreach ($bookings as $booking)
        <div class="modal fade" id="statusModal-{{ $booking->id }}" tabindex="-1"
            aria-labelledby="statusModalLabel-{{ $booking->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title">ACC Status Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('admin.bookingUpdate', ['id' => $booking->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <!-- Status (hidden) -->
                            <input type="hidden" name="status" value="ACC">

                            <!-- Jenis Pembayaran -->
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Pembayaran</label>
                                <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                    <label class="btn btn-outline-primary w-50">
                                        <input type="radio" name="pembayaran" value="penuh" required> Lunas
                                    </label>
                                    <label class="btn btn-outline-warning w-50">
                                        <input type="radio" name="pembayaran" value="dp" required> DP
                                    </label>
                                </div>
                            </div>

                            <!-- Upload Bukti Pembayaran -->
                            <div class="form-group">
                                <label for="bukti_pembayaran_{{ $booking->id }}" class="font-weight-bold">
                                    Upload Bukti Pembayaran
                                </label>
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran_{{ $booking->id }}"
                                    class="form-control" accept="image/*,application/pdf"
                                    onchange="previewFile(event, {{ $booking->id }})" required>

                                <!-- Preview -->
                                <div class="mt-3" id="preview-container-{{ $booking->id }}">
                                    <img id="image-preview-{{ $booking->id }}" src="#"
                                        alt="Preview Bukti Pembayaran" class="img-thumbnail"
                                        style="max-width: 100%; display: none;">
                                    <p id="pdf-preview-{{ $booking->id }}" style="display: none;">
                                        File PDF dipilih:
                                        <span id="pdf-filename-{{ $booking->id }}" class="font-weight-bold"></span>
                                    </p>
                                </div>
                            </div>

                            <!-- Nominal -->
                            <div class="form-group">
                                <label for="jumlah_{{ $booking->id }}" class="font-weight-bold">Nominal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" name="jumlah" id="jumlah_{{ $booking->id }}"
                                        class="form-control" oninput="formatRupiah(this)" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


@endsection

@section('menuHp')
    <div class="col text-center ">
        <a href="{{ route('admin.dashboard') }}" class="text-secondary">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="col text-center border-end">
        <a href="{{ route('admin.kalender') }}" class="text-secondary">
            <p><i class="fa-regular fa-calendar-days m-0 p-0 pt-2"></i></p>
            <p>Kalender</p>
        </a>
    </div>
    <div class="col text-center rounded-top bg-secondary">
        <a href="{{ route('admin.booking') }}" class="text-white">
            <p><i class="fa-solid fa-house-lock m-0 p-0 pt-2"></i></p>
            <p>Booking</p>
        </a>
    </div>
    <div class="col text-center ">
        <a href="{{ route('admin.laporan') }}" class="text-secondary">
            <p><i class="fa-solid fa-file-lines m-0 p-0 pt-2"></i></p>
            <p>Laporan</p>
        </a>
    </div>
    <div class="col text-center">
        <a href="{{ route('admin.paket.index') }}" class="text-secondary">
            <p><i class="fa fa-bar-chart-o m-0 p-0 pt-2"></i></p>
            <p>Paket</p>
        </a>
    </div>
@endsection

@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script>
        function updateStatus(bookingId, status) {
            var formData = {
                _token: '{{ csrf_token() }}',
                status: status
            };

            $.ajax({
                type: 'GET',
                url: `/admin/update/${bookingId}`,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#status-button-' + bookingId).text(status);
                        Swal.fire({
                            icon: "success",
                            title: "Status berhasil diperbarui!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        updateSelectColor(bookingId, status);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Gagal memperbarui status.",
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Terjadi kesalahan: " + error.responseJSON.message,
                    });
                }
            });
        }

        function updateSelectColor(bookingId, status) {
            var selectElement = document.getElementById('status-' + bookingId);
            if (selectElement) {
                selectElement.classList.remove('bg-secondary', 'bg-success'); // Remove existing classes
                if (status === 'Belum ACC') {
                    selectElement.classList.add('bg-secondary');
                } else if (status === 'Sudah ACC') {
                    selectElement.classList.add('bg-success');
                }
            }
        }

        // Set initial color based on the current status
        document.addEventListener('DOMContentLoaded', function() {
            var selectElements = document.querySelectorAll('select[id^="status-"]');
            selectElements.forEach(function(selectElement) {
                var status = selectElement.value;
                var bookingId = selectElement.id.split('-')[1];
                updateSelectColor(bookingId, status);
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
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
        });
    </script>

    <script>
        // Format input nominal ke Rupiah
        function formatRupiah(input) {
            let value = input.value.replace(/\D/g, ''); // hanya angka
            input.value = new Intl.NumberFormat('id-ID').format(value);
        }

        // Preview gambar atau PDF
        function previewFile(event, id) {
            const file = event.target.files[0];
            const img = document.getElementById(`image-preview-${id}`);
            const pdf = document.getElementById(`pdf-preview-${id}`);
            const pdfName = document.getElementById(`pdf-filename-${id}`);

            if (!file) return;

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    img.style.display = 'block';
                    pdf.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                img.style.display = 'none';
                pdf.style.display = 'block';
                pdfName.textContent = file.name;
            } else {
                img.style.display = 'none';
                pdf.style.display = 'none';
            }
        }
    </script>


@endsection
