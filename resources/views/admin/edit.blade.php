@extends('admin.layout')

@section('title', 'Edit Booking | Admin')

@section('titleNav', 'Edit Booking')

@section('css')
@endsection

@section('menu')
    <p class=" d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.dashboard') }}" class=" text-secondary fw-bold m-1 ms-3"><i class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.kalender') }}" class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-person-fill-up  ps-1 pe-1 rounded"></i> Kalender </a></p>
    <p class="btn btn-secondary text-light d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.booking') }}" class="text-light m-1 ms-3 fw-bold"><i class=" me-2 bi bi-key    ps-1 pe-1 rounded"></i> Booking </a> </p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.laporan') }}" class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p>
@endsection

@section('content')
<section id="Edit" class="m-5">
    <div class="container bg-white p-3 rounded">
        <h5 class="fw-bold m-3">Isi Data Diri Booking</h5>
        <div class="row justify-content-center border rounded p-4 m-3">
            <div class="col me-4">
                <form method="POST" action="{{ route('admin.bookingUpdate',['id' => $data->id]) }}">
                    <div class="mb-3">
                        <label for="tanggal-booking" class="form-label">Tanggal Visitor</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal-booking" placeholder="Masukan tanggal YYYY-MM-DD" value="{{ $data->tanggal }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama-pembooking" class="form-label">Nama Pembooking</label>
                        <input type="text" class="form-control" name="nama_pic" id="nama-pembooking" value="{{ $data->nama_pic }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama-pembooking" class="form-label">Nama Organisasi</label>
                        <input type="text" class="form-control" name="organisasi" id="nama-pembooking" value="{{ $data->organisasi }}">
                    </div>
                    <div class="mb-3">
                        <label for="no-telp-pic" class="mb-2">No. Telp PIC</label>
                        <input type="text" placeholder="Masukan No. Telp" class="form-control" name="notelppic" id="no-telp-pic" value="{{ $data->noTelpPIC }}">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="jam-booking-mulai" class="form-label">Jam Booking Mulai</label>
                        <input type="time" class="form-control" name="jam_mulai" id="jam-booking-mulai" value="{{ $data->jam_mulai }}">
                    </div>
                    <div class="mb-3">
                        <label for="jam-booking-selesai" class="form-label">Jam Booking Selesai</label>
                        <input type="time" class="form-control" name="jam_selesai" id="jam-booking-selesai" value="{{ $data->jam_selesai }}">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-visitor" class="mb-2">Jumlah Visitor</label>
                        <input type="text" placeholder="Masukan Jumlah Visitor" class="form-control" name="visitor" id="jumlah-visitor" value="{{ $data->visitor }}">
                    </div>
                    <div class="mb-3">
                            <label for="guide" class="form-label fw-bold">Guide</label>
                            <select class="form-select" name="guide" id="guide">
                                <option value="{{ $data->guide->id }}" selected>{{ $data->guide->name }}</option>
                                @foreach ($guides as $guide)
                                <option value="{{ $guide->id }}">
                                    {{ $guide->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-select" name="statusData" id="status">
                                <option value="{{ $data->status }}" selected>{{ $data->status }}</option>
                                <option value="Belum ACC"> Belum ACC </option>
                                <option value="Sudah ACC"> Sudah ACC </option>
                            </select>
                        </div>
                </div>

                <h5 class="fw-bold m-3 mt-5">Pilih Paket-Paket Desa Wisata</h5>
                <div class="row justify-content-center m-3">
                    <div class="col">
                        <!-- Paket Batik -->
                        <div class="mb-3">
                            <label for="paket-batik" class="form-label fw-bold">Paket Batik</label>
                            <select class="form-select" name="batik" id="paket-batik">
                                <option value="{{ $data->paket->batik->id }}" selected>{{ $data->paket->batik->nama }}</option>
                                @foreach ($batiks as $batik)
                                <option value="{{ $batik->id }}">
                                    {{ $batik->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Paket Kesenian -->
                        <div class="mb-3">
                            <label for="paket-kesenian" class="form-label fw-bold">Paket Kesenian Belajar</label>
                            <select class="form-select" name="kesenianBelajar" id="paket-kesenian">
                                <option value="
                                @if ($data->paket->ketKesenian == 'belajar')
                                        {{$data->paket->kesenian->id}}.belajar
                                    @elseif ($data->paket->ketKesenian == 'pementasan')
                                        1.belajar
                                    @endif
                                " selected>
                                @if ($data->paket->ketKesenian == 'belajar')
                                    {{ $data->paket->kesenian->nama }}
                                @endif
                            
                                </option>
                                @foreach ($kesenians as $kesenian)
                                <option value="{{ $kesenian->id }}.belajar">
                                    {{ $kesenian->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="paket-kesenian" class="form-label fw-bold">Paket Kesenian Belajar + Pementasan</label>
                            <select class="form-select" name="kesenianPementasan" id="paket-kesenian">
                                <option value="
                                    @if ($data->paket->ketKesenian == 'pementasan')
                                        {{$data->paket->kesenian->id}}.pementasan
                                    @elseif ($data->paket->ketKesenian == 'belajar')
                                        1.pementasan
                                    @endif
                                " selected>
                                @if ($data->paket->ketKesenian == 'pementasan')
                                    {{ $data->paket->kesenian->nama }}
                                @endif
                                </option>
                                @foreach ($kesenians as $kesenian)
                                <option value="{{ $kesenian->id }}.pementasan">
                                    {{ $kesenian->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Paket Cocok Tanam -->
                        <div class="mb-3">
                            <label for="paket-cocok-tanam" class="form-label fw-bold">Paket Cocok Tanam</label>
                            <select class="form-select" name="cocokTanam" id="paket-cocok-tanam">
                                <option value="{{ $data->paket->cocokTanam->id }}" selected>{{ $data->paket->cocokTanam->nama }}</option>
                                @foreach ($cocokTanams as $cocokTanam)
                                <option value="{{ $cocokTanam->id }}">
                                    {{ $cocokTanam->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Paket Permainan -->
                        <div class="mb-3">
                            <label for="paket-permainan" class="form-label fw-bold">Paket Permainan</label>
                            <select class="form-select" name="permainan" id="paket-permainan">
                                <option value="{{ $data->paket->permainan->id }}" selected>{{ $data->paket->permainan->nama }}</option>
                                @foreach ($permainans as $permainan)
                                <option value="{{ $permainan->id }}">
                                    {{ $permainan->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        

                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                    <div class="col">
                        <!-- Paket Kuliner -->
                        <div class="mb-3">
                            <label for="paket-kuliner" class="form-label fw-bold">Paket Kuliner</label>
                            <select class="form-select" name="kuliner" id="paket-kuliner">
                                <option value="{{ $data->paket->kuliner->id }}" selected>{{ $data->paket->kuliner->nama }}</option>
                                @foreach ($kuliners as $kuliner)
                                <option value="{{ $kuliner->id }}">
                                    {{ $kuliner->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Paket Homestay -->
                        <div class="mb-3">
                            <label for="paket-homestay" class="form-label fw-bold">Paket Homestay</label>
                            <select class="form-select" name="homestay" id="paket-homestay">
                                <option value="{{ $data->paket->homestay->id }}" selected>{{ $data->paket->homestay->nama }}</option>
                                @foreach ($homestays as $homestay)
                                <option value="{{ $homestay->id }}">
                                    {{ $homestay->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Paket Studi Banding -->
                        <div class="mb-3">
                            <label for="paket-studiBanding" class="form-label fw-bold">Paket Studi Banding</label>
                            <select class="form-select" name="studiBanding" id="paket-studiBanding">
                                <option value="{{ $data->paket->study_banding->id }}" selected>{{ $data->paket->study_banding->nama }}</option>
                                @foreach ($studiBandings as $studiBanding)
                                <option value="{{ $studiBanding->id }}">
                                    {{ $studiBanding->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection

@section('menuHp')
                <div class="col text-center border-end">
                    <a href="{{ route('admin.kalender') }}" class="text-secondary"><p><i class="fa-regular fa-calendar-days m-0 p-0 pt-2"></i></p>
                    <p>Kalender</p></a>
                </div>
                <div class="col text-center ">
                    <a href="{{ route('admin.dashboard') }}" class="text-secondary"><p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
                    <p>Dashboard</p></a>
                </div>
                <div class="col text-center rounded-top bg-secondary">
                    <a href="{{ route('admin.booking') }}" class="text-white"><p><i class="fa-solid fa-house-lock m-0 p-0 pt-2"></i></p>
                    <p>Booking</p></a>
                </div>
                <div class="col text-center ">
                    <a href="{{ route('admin.laporan') }}" class="text-secondary">
                        <p><i class="fa-solid fa-file-lines m-0 p-0 pt-2"></i></p>
                        <p>Laporan</p>
                    </a>
                </div>
@endsection

@section('scripts')

@endsection