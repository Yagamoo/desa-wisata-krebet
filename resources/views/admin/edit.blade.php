@extends('admin.layout')

@section('title', 'Edit Booking | Admin')

@section('titleNav', 'Edit Booking')

@section('css')
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Edit Booking</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.booking') }}">Booking</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit</strong>
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
    <form method="POST" action="{{ route('admin.bookingUpdate', ['id' => $data->id]) }}">
        @csrf
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-title d-flex justify-content-between align-items-center bg-primary">
                        <h5>Data Diri Booking</h5>
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
                            <!-- Kolom Kiri -->
                            {{-- <div class="col me-4">
                                </div> --}}
                            <div class="col-12 mb-3">
                                <label for="nama-pembooking" class="form-label fw-semibold">Nama Pembooking</label>
                                <input type="text" class="form-control" name="nama_pic" id="nama-pembooking"
                                    value="{{ $data->nama_pic }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="nama-organisasi" class="form-label fw-semibold">Nama Organisasi</label>
                                <input type="text" class="form-control" name="organisasi" id="nama-organisasi"
                                    value="{{ $data->organisasi }}">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="no-telp-pic" class="form-label fw-semibold">No. Telp PIC</label>
                                <input type="text" class="form-control" name="notelppic" id="no-telp-pic"
                                    placeholder="Masukan No. Telp" value="{{ $data->noTelpPIC }}">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="tanggal-booking" class="form-label fw-semibold">Tanggal Visitor</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal-booking"
                                    placeholder="Masukan tanggal YYYY-MM-DD" value="{{ $data->tanggal }}">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="jam-booking-mulai" class="form-label fw-semibold">Jam Booking
                                    Mulai</label>
                                <input type="time" class="form-control" name="jam_mulai" id="jam-booking-mulai"
                                    value="{{ $data->jam_mulai }}">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="jam-booking-selesai" class="form-label fw-semibold">Jam Booking
                                    Selesai</label>
                                <input type="time" class="form-control" name="jam_selesai" id="jam-booking-selesai"
                                    value="{{ $data->jam_selesai }}">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="jumlah-visitor" class="form-label fw-semibold">Jumlah Visitor</label>
                                <input type="text" class="form-control" name="visitor" id="jumlah-visitor"
                                    placeholder="Masukan Jumlah Visitor" value="{{ $data->visitor }}">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="guide" class="form-label fw-semibold">Guide</label>
                                <select class="form-control" name="guide" id="guide">
                                    <option value="{{ $data->guide->id }}" selected>{{ $data->guide->name }}
                                    </option>
                                    @foreach ($guides as $guide)
                                        <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-sm-12 col-md-12 mb-3">
                                <label for="status" class="form-label fw-semibold">Status</label>
                                <select class="form-control" name="statusData" id="status">
                                    <option value="{{ $data->status }}" selected>{{ $data->status }}</option>
                                    <option value="Belum ACC">Belum ACC</option>
                                    <option value="Sudah ACC">Sudah ACC</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-title d-flex justify-content-between align-items-center bg-primary">
                        <h5>Paket-Paket Desa Wisata</h5>
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
                        <!-- Paket Desa Wisata -->
                        {{-- <h5 class="fw-bold mt-5 mb-3 text-center">Pilih Paket-Paket Desa Wisata</h5> --}}

                        <div class="container">
                            <!-- Paket Batik -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Batik</label>
                                    <select
                                        class="form-control {{ $data->paket->batik->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="batik">
                                        <option value="{{ $data->paket->batik->id }}" selected>
                                            {{ $data->paket->batik->nama }}
                                        </option>
                                        @foreach ($batiks as $batik)
                                            <option value="{{ $batik->id }}">{{ $batik->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_batik" class="form-control"
                                            value="{{ number_format(optional($hargaBatik)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_batik" class="form-control"
                                            value="{{ number_format(optional($hargaBatik)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_batik" class="form-control"
                                        value="{{ $hargaBatik->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_batik" class="form-control"
                                        value="{{ $hargaBatik->jumlah_visitor }}" max="{{ $data->visitor }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($totalBatik, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Paket Kesenian Belajar -->
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Kesenian Belajar</label>
                                    <select
                                        class="form-control {{ $data->paket->ketKesenian == 'belajar' && $data->paket->kesenian->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="kesenianBelajar">
                                        @if ($data->paket->ketKesenian == 'belajar')
                                            <option value="{{ $data->paket->kesenian->id }}.belajar" selected>
                                                {{ $data->paket->kesenian->nama }}
                                            </option>
                                        @endif
                                        @foreach ($kesenians as $kesenian)
                                            <option value="{{ $kesenian->id }}.belajar">{{ $kesenian->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_kesenian_belajar" class="form-control"
                                            value="{{ number_format(optional($hargaKesenianBelajar)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_kesenian_belajar" class="form-control"
                                            value="{{ number_format(optional($hargaKesenianBelajar)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_kesenian_belajar" class="form-control"
                                        value="{{ $hargaKesenianBelajar->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_kesenian_belajar" class="form-control"
                                        value="{{ $hargaKesenianBelajar->jumlah_visitor ?? 0 }}" max="{{ $data->visitor ?? 0 }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($hargaBelajar, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Paket Kesenian Belajar + Pementasan -->
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Kesenian Belajar + Pementasan</label>
                                    <select
                                        class="form-control {{ $data->paket->ketKesenian == 'pementasan' && $data->paket->kesenian->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="kesenianPementasan">
                                        @if ($data->paket->ketKesenian == 'pementasan')
                                            <option value="{{ $data->paket->kesenian->id }}.pementasan" selected>
                                                {{ $data->paket->kesenian->nama }}
                                            </option>
                                        @endif

                                        @foreach ($kesenians as $kesenian)
                                            <option value="{{ $kesenian->id }}.pementasan">{{ $kesenian->nama }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_kesenian_pementasan" class="form-control"
                                            value="{{ number_format(optional($hargaKesenianPementasan)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_kesenian_pementasan" class="form-control"
                                            value="{{ number_format(optional($hargaKesenianPementasan)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_kesenian_pementasan" class="form-control"
                                        value="{{ $hargaKesenianPementasan->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_kesenian_pementasan" class="form-control"
                                        value="{{ $hargaKesenianPementasan->jumlah_visitor ?? 0 }}" max="{{ $data->visitor ?? 0 }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($hargaPementasan, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Paket Cocok Tanam -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Cocok Tanam</label>
                                    <select
                                        class="form-control {{ $data->paket->cocokTanam->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="cocokTanam">
                                        <option value="{{ $data->paket->cocokTanam->id }}" selected>
                                            {{ $data->paket->cocokTanam->nama }}
                                        </option>
                                        @foreach ($cocokTanams as $cocokTanam)
                                            <option value="{{ $cocokTanam->id }}">{{ $cocokTanam->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_cocok_tanam" class="form-control"
                                            value="{{ number_format(optional($hargaCocokTanam)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_cocok_tanam" class="form-control"
                                            value="{{ number_format(optional($hargaCocokTanam)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_cocok_tanam" class="form-control"
                                        value="{{ $hargaCocokTanam->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_cocok_tanam" class="form-control"
                                        value="{{ $hargaCocokTanam->jumlah_visitor }}" max="{{ $data->visitor}}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($totalCocokTanam, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Paket Permainan -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Permainan</label>
                                    <select
                                        class="form-control {{ $data->paket->permainan->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="permainan">
                                        <option value="{{ $data->paket->permainan->id }}" selected>
                                            {{ $data->paket->permainan->nama }}
                                        </option>
                                        @foreach ($permainans as $permainan)
                                            <option value="{{ $permainan->id }}">{{ $permainan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_permainan" class="form-control"
                                            value="{{ number_format(optional($hargaPermainan)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_permainan" class="form-control"
                                            value="{{ number_format(optional($hargaPermainan)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_permainan" class="form-control"
                                        value="{{ $hargaPermainan->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_permainan" class="form-control"
                                        value="{{ $hargaPermainan->jumlah_visitor }}" max="{{ $data->visitor}}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($totalPermainan, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Paket Kuliner -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Kuliner</label>
                                    <select
                                        class="form-control {{ $data->paket->kuliner->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="kuliner">
                                        <option value="{{ $data->paket->kuliner->id }}" selected>
                                            {{ $data->paket->kuliner->nama }}
                                        </option>
                                        @foreach ($kuliners as $kuliner)
                                            <option value="{{ $kuliner->id }}">{{ $kuliner->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_kuliner" class="form-control"
                                            value="{{ number_format(optional($hargaKuliner)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_kuliner" class="form-control"
                                            value="{{ number_format(optional($hargaKuliner)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_kuliner" class="form-control"
                                        value="{{ $hargaKuliner->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_kuliner" class="form-control"
                                        value="{{ $hargaKuliner->jumlah_visitor }}" max="{{ $data->visitor}}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($totalKuliner, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Paket Homestay -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Homestay</label>
                                    <select
                                        class="form-control {{ $data->paket->homestay->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="homestay">
                                        <option value="{{ $data->paket->homestay->id }}" selected>
                                            {{ $data->paket->homestay->nama }}
                                        </option>
                                        @foreach ($homestays as $homestay)
                                            <option value="{{ $homestay->id }}">{{ $homestay->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_homestay" class="form-control"
                                            value="{{ number_format(optional($hargaHomestay)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_homestay" class="form-control"
                                            value="{{ number_format(optional($hargaHomestay)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_homestay" class="form-control"
                                        value="{{ $hargaHomestay->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_homestay" class="form-control"
                                        value="{{ $hargaHomestay->jumlah_visitor }}" max="{{ $data->visitor}}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($totalHomestay, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Paket Studi Banding -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label font-weight-bold">Paket Studi Banding</label>
                                    <select
                                        class="form-control {{ $data->paket->study_banding->nama == 'Tidak Pesan' ? 'border-danger' : 'border-primary' }}"
                                        name="studiBanding">
                                        <option value="{{ $data->paket->study_banding->id }}" selected>
                                            {{ $data->paket->study_banding->nama }}
                                        </option>
                                        @foreach ($studiBandings as $studiBanding)
                                            <option value="{{ $studiBanding->id }}">{{ $studiBanding->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_awal_study_banding" class="form-control"
                                            value="{{ number_format(optional($hargaStudyBanding)->harga_awal ?? 0, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Harga Nego</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="harga_nego_study_banding" class="form-control"
                                            value="{{ number_format(optional($hargaStudyBanding)->harga_nego ?? 0, 0, ',', '.') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <input type="text" name="catatan_study_banding" class="form-control"
                                        value="{{ $hargaStudyBanding->catatan ?? 'Nego Harga' }}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Jumlah Visitor</label>
                                    <input type="number" name="visitor_study_banding" class="form-control"
                                        value="{{ $hargaStudyBanding->jumlah_visitor }}" max="{{ $data->visitor}}">
                                </div>
                                <div class="col">
                                    <label class="form-label fw-semibold">Total Harga Paket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($totalStudyBanding, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-end">
                                <div class="col-2">
                                    <label class="form-label fw-semibold">Total Tagihan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">Rp.</span>
                                        </div>
                                        <input type="text" name="total" class="form-control"
                                            value="{{ number_format($totalAll, 0, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- Tombol Submit -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4">Ubah Data</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </form>

@endsection

@section('menuHp')
    <div class="col text-center border-end">
        <a href="{{ route('admin.kalender') }}" class="text-secondary">
            <p><i class="fa-regular fa-calendar-days m-0 p-0 pt-2"></i></p>
            <p>Kalender</p>
        </a>
    </div>
    <div class="col text-center ">
        <a href="{{ route('admin.dashboard') }}" class="text-secondary">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
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
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', e => {
                if (e.target.options[e.target.selectedIndex].text === 'Tidak Pesan') {
                    e.target.classList.remove('border-primary');
                    e.target.classList.add('border-danger');
                } else {
                    e.target.classList.remove('border-danger');
                    e.target.classList.add('border-primary');
                }
            });
        });
    </script>

@endsection
