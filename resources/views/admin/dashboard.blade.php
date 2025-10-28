@extends('admin.layout')

@section('title', 'Dashboard | Admin')

@section('titleNav', 'Dashboard')

@section('css')

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">

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
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i>
            <span class="nav-label">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.kalender') }}"><i class="fa fa-calendar"></i>
            <span class="nav-label">Kalender</span></a>
    </li>
    <li>
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
    <div class="row mt-3">
        <div class="col-lg-6 col-12 informasi d-flex">
            <div class="ibox ">
                <div class="ibox-title bg-primary">
                    <h5>Informasi Kunjungan</h5>
                    <div class="ibox-tools">
                        {{-- <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a> --}}
                        {{-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="container mt-3">
                        <div class="row">
                            <!-- Kunjungan Hari Ini -->
                            <div class="col-12 col-md-4 p-2">
                                <div class="box-info text-center text-white bg-info rounded-3 shadow-sm p-3 h-100">
                                    <i class="fa-solid fa-calendar-day fs-2 mb-2"></i>
                                    <h4 class="fw-bold mb-0">{{ $kunjunganHarian }}</h4>
                                    <p class="fw-semibold mb-0">Kunjungan<br>Hari Ini</p>
                                </div>
                            </div>

                            <!-- Kunjungan Bulan Ini -->
                            <div class="col-12 col-md-4 p-2">
                                <div class="box-info text-center text-white bg-success rounded-3 shadow-sm p-3 h-100">
                                    <i class="fa-solid fa-calendar-days fs-2 mb-2"></i>
                                    <h4 class="fw-bold mb-0">{{ $kunjunganBulanan }}</h4>
                                    <p class="fw-semibold mb-0">Kunjungan<br>Bulan Ini</p>
                                </div>
                            </div>

                            <!-- Total Kunjungan -->
                            <div class="col-12 col-md-4 p-2">
                                <div class="box-info text-center text-white bg-secondary rounded-3 shadow-sm p-3 h-100">
                                    <i class="fa-solid fa-people-line fs-2 mb-2"></i>
                                    <h4 class="fw-bold mb-0">{{ $totalKunjungan }}</h4>
                                    <p class="fw-semibold mb-0">Total<br>Kunjungan</p>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="col-12 col-md-6 text-center p-2">
                                <a href="{{ route('admin.kalender') }}" class="btn btn-primary fw-bold py-3 w-100">
                                    <i class="fa-regular fa-square-plus fs-2 mb-1"></i><br>
                                    Buat Booking
                                </a>
                            </div>

                            <div class="col-12 col-md-6 text-center p-2">
                                <a href="{{ route('admin.laporan') }}" class="btn btn-danger fw-bold py-3 w-100">
                                    <i class="fa-solid fa-print fs-2 mb-1"></i><br>
                                    Cetak Laporan
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12" id="appointment">
            <div class="ibox ">
                <div class="ibox-title bg-primary">
                    <h5>Kunjungan Terdekat</h5>
                    <div class="ibox-tools">
                        {{-- <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a> --}}
                        {{-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="ibox-content">
                    {{-- <p class="text-center text-secondary font-weight-bold mb-3">Kunjungan Terdekat</p> --}}
                    <div class="row justify-content-center bg-white rounded">

                        @foreach ($appoitments as $appoitment)
                            <div class="col bg-primary text-white rounded p-3 m-2 shadow-sm">
                                <div class="mb-3">
                                    <p class="mb-1">
                                        <strong>Tanggal :</strong><br>
                                        {{ \Carbon\Carbon::parse($appoitment->tanggal)->translatedFormat('d F Y') }}
                                    </p>
                                    <p class="mb-0">
                                        <strong>Waktu :</strong><br>
                                        {{ $appoitment->jam_mulai }} - {{ $appoitment->jam_selesai }}
                                    </p>
                                </div>
                                <hr class="border-light my-2">
                                <div>
                                    <table>
                                        <tr>
                                            <td><strong>Nama PIC</strong></td>
                                            <td class="px-2">:</td>
                                            <td>{{ $appoitment->nama_pic }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Organisasi</strong></td>
                                            <td class="px-2">:</td>
                                            <td>{{ $appoitment->organisasi }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jumlah Orang</strong></td>
                                            <td class="px-2">:</td>
                                            <td>{{ $appoitment->visitor }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No Telepon</strong></td>
                                            <td class="px-2">:</td>
                                            <td>
                                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $appoitment->noTelpPIC) }}"
                                                    class="text-white" target="_blank" style="text-decoration: underline">
                                                    {{ $appoitment->noTelpPIC }}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-title bg-primary">
            <h5>Grafik Desa Wisata Krebet</h5>
            <div class="ibox-tools">
                {{-- <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a> --}}
                {{-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a> --}}
            </div>
        </div>
        <div class="ibox-content">
            <div class="container-fluid" id="grafik-main">
                <div class="row justify-content-center g-4" id="grafik-konten">
                    <div class="col-sm-12 col-xl-6 mb-3">
                        <div class="bg-white text-center rounded">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0 fw-bold">Grafik Kunjungan Desa Krebet</h5>
                            </div>
                            <canvas id="kunjungan-trafik"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6 mb-3">
                        <div class="bg-white text-center rounded">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0 fw-bold">Grafik Pendapatan Desa Krebet</h5>
                            </div>
                            <canvas id="pendapatan-trafik"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5" id="tabel-booking">
        <div class="bg-white rounded p-3 text-center">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama PIC</th>
                        <th scope="col">Nama Organisasi</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Jam Mulai</th>
                        <th scope="col">Jam Selesai</th>
                        <th scope="col">Jumlah Visitor</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $items)
                        <tr>
                            <th scope="row" class="pt-3">{{ $loop->iteration }}</th>
                            <td class="pt-3">{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="pt-3">{{ $items->nama_pic }}</td>
                            <td class="pt-3">{{ $items->organisasi }}</td>
                            <td class="pt-3">085868144268</td>
                            <td class="pt-3">{{ $items->jam_mulai }}</td>
                            <td class="pt-3">{{ $items->jam_selesai }}</td>
                            <td class="pt-3">{{ $items->visitor }}</td>
                            <td><a href="#" class="btn btn-warning" style="font-size: 0.8rem ;">Edit</a> | <a
                                    href="#" class="btn btn-danger" style="font-size: 0.8rem ;">Delete</a> | <a
                                    href="{{ route('admin.invoice', ['id' => $items->id]) }}" class="btn btn-info"
                                    style="font-size: 0.8rem ;">Cetak</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <a href="#" style="text-decoration: none;">Selengkapnya <i class="fa-solid fa-caret-right"></i></a>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Booking</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col">
                            <div class="row" id="progress">
                                <div class="col p-1 text-center" onclick="progress(0)">
                                    <div class="box box-active mb-1 progresBar"></div>
                                    <p>Data Diri</p>
                                </div>
                                <div class="col p-1 text-center " onclick="progress(1)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Studi Banding</p>
                                </div>
                                <div class="col p-1 text-center " onclick="progress(2)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Paket Batik</p>
                                </div>
                                <div class="col p-1 text-center " onclick="progress(3)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Paket Kesenian</p>
                                </div>
                                <div class="col p-1 text-center " onclick="progress(4)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Paket Cocok Tanam</p>
                                </div>
                                <div class="col p-1 text-center " onclick="progress(5)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Paket Permainan</p>
                                </div>
                                <div class="col p-1 text-center " onclick="progress(6)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Paket Kuliner</p>
                                </div>
                                <div class="col p-1 text-center " onclick="progress(7)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Paket Homestay</p>
                                </div>
                                <div class="col p-1 text-center" onclick="progress(8)">
                                    <div class="box mb-1 progresBar"></div>
                                    <p>Ringkasan</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="row justify-content-center rounded p-3 border m-3 step" id="dataDiri">
                                <h5 class="fw-bold m-3">Isi Data Diri Booking</h5>
                                <div class="col me-4">
                                    <form method="GET" action="{{ route('admin.bookingProses') }}">
                                        <div class="mb-3">
                                            <label for="tanggal-booking" class="form-label">Tanggal Visitor</label>
                                            <input type="date" class="form-control" name="tanggal"
                                                id="tanggal-booking" placeholder="Masukan tanggal YYYY-MM-DD"
                                                min="<?= date('Y-m-d') ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama-pembooking" class="form-label">Nama Pembooking</label>
                                            <input type="text" class="form-control" name="nama_pic"
                                                id="nama-pembooking" value="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="organisasi" class="form-label">Nama Organisasi</label>
                                            <input type="text" class="form-control" name="organisasi" id="organisasi"
                                                value="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no-telp-pic" class="mb-2">No. Telp PIC</label>
                                            <input type="text" placeholder="Masukan No. Telp" class="form-control"
                                                name="notelppic" id="no-telp-pic" value="" required>
                                        </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="jam-booking-mulai" class="form-label">Jam Booking Mulai</label>
                                        <input type="time" class="form-control" name="jam_mulai"
                                            id="jam-booking-mulai" value="" required>
                                        {{-- <input type="time" min="08:00" max="16:00" step="3600" class="form-control" name="jam_mulai" id="jam-booking-mulai" value="" required> --}}
                                    </div>
                                    <div class="mb-3" style="display: none;">
                                        <label for="jam-booking-selesai" class="form-label">Jam Booking Selesai</label>
                                        <input type="time" class="form-control" name="jam_selesai"
                                            id="jam-booking-selesai" value="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah-visitor" class="mb-2">Jumlah Visitor</label>
                                        <input type="number" onchange="validateVisitorCount()"
                                            placeholder="Masukan Jumlah Visitor" class="form-control" name="visitor"
                                            id="jumlah-visitor" value="" required>
                                    </div>

                                </div>
                            </div>
                            <!-- Input hidden untuk menyimpan nilai yang akan ditampilkan sebelum dikirim -->
                            {{-- <input type="hidden" name="organisasi" id="organisasi-hidden">
                            <input type="hidden" name="visitor" id="visitor-hidden">
                            <input type="hidden" name="tanggal" id="tanggal-hidden">
                            <input type="hidden" name="jam_mulai" id="jam-mulai-hidden">
                            <input type="hidden" name="jam_selesai" id="jam-selesai-hidden">
                            <input type="hidden" name="status" id="status-hidden">
                            <input type="hidden" name="nama_pic_hidden" id="nama-pembooking-hidden"> --}}

                            <div class="m-3" id="paketWisata">
                                <h5 class="fw-bold m-3 mt-2">Pilih Paket-Paket Desa Wisata</h5>
                                <div class="col step" id="studi-banding">
                                    <!-- Paket Homestay -->
                                    <div class="row border rounded p-4 mb-4">
                                        <!-- Judul -->
                                        <div class="col-12 mb-3">
                                            <label for="paket-kuliner" class="form-label fw-bold fs-5">Paket Study
                                                Banding</label>
                                        </div>

                                        <!-- Daftar Paket -->
                                        @foreach ($studiBandings as $studiBanding)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input me-2"
                                                                value="{{ $studiBanding->id }}" type="radio"
                                                                name="studiBanding"
                                                                id="studiBanding{{ $studiBanding->id }}"
                                                                @if ($loop->first) checked @endif
                                                                @if (!$loop->first) onclick="waktuStudy(4)" @endif
                                                                onclick="waktuStudy(0)">

                                                            <label class="form-check-label w-100"
                                                                for="studiBanding{{ $studiBanding->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">
                                                                    {{ $studiBanding->nama }}</h5>
                                                                <hr class="my-2">
                                                                <p class="mb-1"><small
                                                                        class="text-muted">Deskripsi:</small></p>
                                                                <p class="card-text small text-secondary">
                                                                    {{ $studiBanding->deskripsi }}</p>
                                                                <p class="mb-1"><small class="text-muted">Harga:</small>
                                                                </p>
                                                                <p class="fw-semibold text-success">
                                                                    Rp
                                                                    {{ number_format($studiBanding->harga, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Garis Pemisah -->
                                        <div class="col-12">
                                            <hr class="my-4">
                                        </div>

                                        <!-- Keterangan dan Fasilitas -->
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <h5 class="fw-bold">Keterangan Paket Study Banding:</h5>
                                                    <ul class="mb-0">
                                                        <li>Mendapat Materi Desa Wisata Krebet</li>
                                                        <li>Diskusi dan Tanya Jawab</li>
                                                        <li>Melihat Proses Produksi dan Kerajinan</li>
                                                        <li>Membatik Batik Paket III</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <h5 class="fw-bold">Fasilitas:</h5>
                                                    <ul class="mb-0">
                                                        <li>Sertifikat</li>
                                                        <li>Alat dan Bahan Membatik</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col step" id="batik">
                                    <!-- Paket Batik -->
                                    <div class="row border rounded p-4 mb-4">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold fs-5">Paket Batik</label>
                                        </div>

                                        @foreach ($batiks as $batik)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input batik me-2"
                                                                value="{{ $batik->id }}" type="radio"
                                                                name="batik" id="batik{{ $batik->id }}"
                                                                @if ($loop->first) checked @endif
                                                                @if (!$loop->first) onclick="waktuBatik(2)" @endif
                                                                onclick="waktuBatik(0)">
                                                            <label class="form-check-label w-100"
                                                                for="batik{{ $batik->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">{{ $batik->nama }}
                                                                </h5>
                                                                <hr class="my-2">
                                                                <p class="mb-1"><small class="text-muted">Souvenir yang
                                                                        didapat:</small></p>
                                                                <p class="small text-secondary">{{ $batik->deskripsi }}
                                                                </p>
                                                                <p class="mb-1"><small class="text-muted">Harga
                                                                        Paket:</small></p>
                                                                <p class="fw-semibold text-success card-text">
                                                                    Rp {{ number_format($batik->harga, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12">
                                            <hr class="my-4">
                                        </div>

                                        <div class="col-md-6">
                                            <h5 class="fw-bold">Keterangan Paket Membatik:</h5>
                                            <ul class="mb-0">
                                                <li>Hasil Karya Milik Peserta</li>
                                                <li>Minimal 10 orang</li>
                                                <li>Durasi 2 Jam</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="fw-bold">Fasilitas:</h5>
                                            <ul class="mb-0">
                                                <li>Sertifikat</li>
                                                <li>Alat dan Bahan Membatik</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="kesenian">
                                    <!-- Paket Kesenian -->
                                    <div class="row border rounded p-4 mb-4">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold fs-5">Paket Kesenian Belajar
                                                (Rp40.000)</label>
                                        </div>

                                        @foreach ($kesenians as $kesenian)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input kesenian me-2"
                                                                value="{{ $kesenian->id }}.belajar" type="radio"
                                                                name="kesenian" id="kesenian{{ $kesenian->id }}"
                                                                @if ($loop->first) checked @endif
                                                                @if (!$loop->first) onclick="waktuKesenian(1)" @endif
                                                                onclick="waktuKesenian(0)">
                                                            <label class="form-check-label w-100"
                                                                for="kesenian{{ $kesenian->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">
                                                                    {{ $kesenian->nama }}</h5>
                                                                <p class="text-success fw-semibold card-text mb-0">
                                                                    Rp
                                                                    {{ number_format($kesenian->harga_belajar, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12 my-3">
                                            <hr>
                                            <label class="form-label fw-bold fs-5">Paket Kesenian Belajar dan Pementasan
                                                (Rp150.000)</label>
                                        </div>

                                        @foreach ($kesenians as $kesenian)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input kesenian me-2"
                                                                value="{{ $kesenian->id }}.pementasan" type="radio"
                                                                name="kesenian" id="kesenian2{{ $kesenian->id }}"
                                                                @if ($loop->first) checked @endif
                                                                @if (!$loop->first) onclick="waktuKesenian(2)" @endif
                                                                onclick="waktuKesenian(0)">
                                                            <label class="form-check-label w-100"
                                                                for="kesenian2{{ $kesenian->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">
                                                                    {{ $kesenian->nama }}</h5>
                                                                <p class="text-success fw-semibold card-text mb-0">
                                                                    Rp
                                                                    {{ number_format($kesenian->harga_pementasan, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12 mt-3">
                                            <hr>
                                        </div>

                                        <div class="col-md-6">
                                            <h5 class="fw-bold">Keterangan Paket Kesenian:</h5>
                                            <ul>
                                                <li>Biaya Belajar Rp 40.000/orang</li>
                                                <li>Biaya Belajar & Pementasan Rp 150.000/orang</li>
                                                <li>Minimal Peserta 10 orang</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="fw-bold">Fasilitas:</h5>
                                            <ul>
                                                <li>Foto Kegiatan</li>
                                                <li>Pakaian Tradisional dan Make Up</li>
                                                <li>Tempat Pertunjukan</li>
                                                <li>Air Minum Kemasan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="cocok-tanam">
                                    <!-- Paket Cocok Tanam -->
                                    <div class="row border rounded p-4 mb-4">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold fs-5">Paket Cocok Tanam</label>
                                        </div>

                                        @foreach ($cocokTanams as $cocokTanam)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input cocokTanam me-2"
                                                                value="{{ $cocokTanam->id }}" type="radio"
                                                                name="cocokTanam" id="cocokTanam{{ $cocokTanam->id }}"
                                                                @if ($loop->first) checked @endif
                                                                @if (!$loop->first) onclick="waktuCocokTanam(1)" @endif
                                                                onclick="waktuCocokTanam(0)">
                                                            <label class="form-check-label w-100"
                                                                for="cocokTanam{{ $cocokTanam->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">
                                                                    {{ $cocokTanam->nama }}</h5>
                                                                <p class="fw-semibold text-success card-text mb-0">
                                                                    Rp {{ number_format($cocokTanam->harga, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12 mt-3">
                                            <hr>
                                        </div>

                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Fasilitas Paket Cocok Tanam:</h5>
                                            <ul>
                                                <li>Bibit dan Alat dan Bahan-bahan</li>
                                                <li>Pendamping (Petani)</li>
                                                <li>Tanaman menjadi milik/hak pemilik lahan</li>
                                                <li>Air Minum Kemasan</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col step" id="permainan">
                                    <!-- Paket Permainan -->
                                    <div class="row border rounded p-4 mb-4">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold fs-5">Paket Permainan (Rp12.500/orang)</label>
                                        </div>

                                        @foreach ($permainans as $permainan)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input permainan me-2"
                                                                value="{{ $permainan->id }}" type="radio"
                                                                name="permainan" id="permainan{{ $permainan->id }}"
                                                                @if ($loop->first) checked @endif
                                                                @if (!$loop->first) onclick="waktuPermainan(1)" @endif
                                                                onclick="waktuPermainan(0)">
                                                            <label class="form-check-label w-100"
                                                                for="permainan{{ $permainan->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">
                                                                    {{ $permainan->nama }}</h5>
                                                                <p class="text-success fw-semibold card-text mb-0">
                                                                    Rp {{ number_format($permainan->harga, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12 mt-3">
                                            <hr>
                                        </div>

                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Keterangan Paket Permainan:</h5>
                                            <ul>
                                                <li>Area Permainan</li>
                                                <li>Alat dan Bahan Permainan</li>
                                                <li>Air Minum Kemasan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="kuliner">
                                    <!-- Paket Kuliner -->
                                    <div class="row border rounded p-4 mb-4">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold fs-5">Paket Kuliner</label>
                                        </div>

                                        @foreach ($kuliners as $kuliner)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input kuliner me-2"
                                                                value="{{ $kuliner->id }}" type="radio"
                                                                name="kuliner" id="kuliner{{ $kuliner->id }}"
                                                                @if ($loop->first) checked @endif
                                                                @if (!$loop->first) onclick="waktuKuliner(1)" @endif
                                                                onclick="waktuKuliner(0)">
                                                            <label class="form-check-label w-100"
                                                                for="kuliner{{ $kuliner->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">{{ $kuliner->nama }}
                                                                </h5>
                                                                <p class="small text-secondary">{{ $kuliner->deskripsi }}
                                                                </p>
                                                                <p class="fw-semibold text-success card-text mb-0">
                                                                    Rp {{ number_format($kuliner->harga, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12 mt-3">
                                            <hr>
                                        </div>

                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Keterangan Paket Kuliner:</h5>
                                            <ul>
                                                <li>Paket Dhaharan minimal 25 pax</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="homestay">
                                    <!-- Paket Homestay -->
                                    <div class="row border rounded p-4 mb-4">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold fs-5">Paket Homestay</label>
                                        </div>

                                        @foreach ($homestays as $homestay)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input homestay me-2"
                                                                value="{{ $homestay->id }}" type="radio"
                                                                name="homestay" id="homestay{{ $homestay->id }}"
                                                                @if ($loop->first) checked @endif
                                                                onclick="waktuHomestay(0)">
                                                            <label class="form-check-label w-100"
                                                                for="homestay{{ $homestay->id }}">
                                                                <h5 class="fw-bold text-primary mb-2">
                                                                    {{ $homestay->nama }}</h5>
                                                                <p class="small text-secondary">{{ $homestay->deskripsi }}
                                                                </p>
                                                                <p class="fw-semibold text-success card-text mb-0">
                                                                    Rp {{ number_format($homestay->harga, 0, ',', '.') }}
                                                                </p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-12 mt-3">
                                            <hr>
                                        </div>

                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Keterangan Paket Homestay:</h5>
                                            <ul>
                                                <li>Satu Kamar untuk Dua Orang</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="ringkasan">
                                    <!-- Ringkasan Booking -->
                                    <div class="row border rounded p-4 mb-5">
                                        <div class="col-12">
                                            <h5 class="fw-bold text-center mb-3">Ringkasan Booking</h5>
                                            <div id="summaryPaketList"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tombol-lanjut text-center">
                                <button class="btn btn-warning" data-dismiss="modal" onclick="batal()">Batal</button>
                                <button class="btn btn-secondary" id="prevBtn"
                                    onclick="changeStep(-1)">Sebelumnya</button>
                                <button class="btn btn-primary" id="nextBtn"
                                    onclick="changeStep(1)">Selanjutnya</button>
                            </div>

                            <div id="kirim-data" class="text-center" style="display:none;">
                                <button type="text" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                <button class="btn btn-secondary" id="prevBtn"
                                    onclick="changeStep(-1)">Sebelumnya</button>
                                <a type="text" class="btn btn-primary" data-toggle="modal" data-target="#submitModal"
                                    onclick="waktuAkhir()">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coba -->
    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body" id="detailJam">
                    <!-- Event information will be injected here -->
                    <div class="row justify-content-center">
                        <div class="col m-3 border rounded p-0">
                            <div class="bg-secondary rounded">
                                <p class="h5 fw-bold p-2 text-white">Status Booking</p>
                            </div>
                            <div class="ps-3 mb-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Nama Pembooking</th>
                                            <td><strong id="nama-pembooking-display"></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Organisasi</th>
                                            <td><strong id="organisasi-display"></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Visitor</th>
                                            <td><strong id="visitor-display"></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <td><strong id="tanggal-display"></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Jam Mulai</th>
                                            <td><strong id="jam-mulai-display"></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Jam Selesai</th>
                                            <td><strong id="jam-selesai-display"></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><button class="btn btn-secondary" id="status-display"></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="cekStatus text-center p-3">
                                <p class="fw-bold">Periksa Status Booking ini lebih lanjut dengan menghubungi nomer Admin
                                    berikut :</p>
                                <a href="https://wa.me/6285868144268" class="btn btn-primary"><i
                                        class="fa-brands fa-whatsapp"></i> 08734348343 </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body" id="modalBody">
                    <!-- Event information will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('menuHp')
    <div class="col text-center rounded-top bg-secondary">
        <a href="{{ route('admin.dashboard') }}" class="text-white">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="col text-center menuHp">
        <a href="{{ route('admin.kalender') }}" class="text-secondary">
            <p><i class="fa-regular fa-calendar-days m-0 p-0 pt-2"></i></p>
            <p>Kalender</p>
        </a>
    </div>
    <div class="col text-center">
        <a href="{{ route('admin.booking') }}" class="text-secondary">
            <p><i class="fa-solid fa-house-lock m-0 p-0 pt-2"></i></p>
            <p>Booking</p>
        </a>
    </div>
    <div class="col text-center border-start">
        <a href="{{ route('admin.laporan') }}" class="text-secondary">
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('kunjungan-trafik').getContext('2d');
            var trafficChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($dates),
                    datasets: [{
                        label: 'Kunjungan Harian',
                        data: @json($counts),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false,
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Kunjungan'
                            }
                        }
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('pendapatan-trafik').getContext('2d');
            var revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($dates),
                    datasets: [{
                        label: 'Pendapatan Harian',
                        data: @json($totals),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            beginAtZero: true,

                            ticks: {
                                callback: function(value, index, values) {
                                    // Fungsi untuk mengubah nominal menjadi format '1 juta', '750 ribu', dll.
                                    return formatCurrency(value);
                                }
                            }
                        }
                    }
                }
            });

            // Fungsi untuk mengubah format nominal
            function formatCurrency(value) {
                if (value >= 1000000) {
                    var formattedValue = (value / 1000000).toFixed(1);
                    if (formattedValue.slice(-2) === '.0') {
                        formattedValue = formattedValue.slice(0, -2); // Menghapus desimal nol
                    }
                    return formattedValue + ' juta';
                } else if (value >= 1000) {
                    var formattedValue = (value / 1000).toFixed(1);
                    if (formattedValue.slice(-2) === '.0') {
                        formattedValue = formattedValue.slice(0, -2); // Menghapus desimal nol
                    }
                    return formattedValue + ' ribu';
                } else {
                    return value;
                }
            }
        });
    </script>
@endsection
