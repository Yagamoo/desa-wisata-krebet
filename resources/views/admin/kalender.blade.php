@extends('admin.layout')

@section('title', 'Kalender | Admin')

@section('titleNav', 'Kalender')

@section('css')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('css/kalender.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Kalender</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Kalender</strong>
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
    <li class="active">
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
    <div class="row justify-content-center m-lg-5 m-1 mt-5">
        <div class="col bg-white p-lg-5 p-3 rounded text-center">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahModal">Tambah
                Booking</button>
            <div id='calendar'></div>
        </div>
    </div>

    {{-- <div class="row justify-content-center">
    <div class="col m-5 border rounded p-0">
        <div class="bg-secondary rounded">
        <p class="h5 fw-bold p-2 text-white">Status Booking</p>
        </div>
        <div class="ps-3 mb-3">
            <p class="mt-3">Nama Pembooking : <strong> ${eventData.nama_pic} </strong></p>
            <p>Organisasi :<strong> ${eventData.organisasi} </strong> </p>
            <p>Visitor :<strong> ${eventData.visitor} </strong> </p>
            <p>Tanggal :<strong> ${eventData.tanggal} </strong> </p>
            <p>Jam Mulai :<strong> ${eventData.jam_mulai} </strong> </p>
            <p>Jam Selesai :<strong> ${eventData.jam_selesai} </strong> </p>
            <p>Status : <button class="btn btn-secondary"> ${eventData.status} </button>  </p>
        </div>
        <hr>
        <div class="cekStatus text-center">
            <p class="fw-bold">Periksa Status Booking ini lebih lanjut dengan menghubungi nomer Admin berikut :</p>
            <a href="#" class="btn btn-primary"><i class="fa-brands fa-whatsapp"></i> 08734348343 </a>
        </div>
    </div>
</div> --}}

    <div class="modal fade" id="tambahModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Booking</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col">
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
                                    <form method="GET" action="{{ route('user.bookingProses') }}">
                                        <div class="mb-3">
                                            <label for="tanggal-booking" class="form-label">Tanggal Visitor</label>
                                            <input type="date" class="form-control" name="tanggal" id="tanggal-booking"
                                                placeholder="Masukan tanggal YYYY-MM-DD" min="<?= date('Y-m-d') ?>"
                                                required>
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
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <label for="paket-kuliner" class="form-label fw-bold">Paket Study Banding</label>
                                        <div class="row justify-content-center">
                                            @foreach ($studiBandings as $studiBanding)
                                                <div class="col-lg-3 col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" value="{{ $studiBanding->id }}"
                                                            type="radio" name="studiBanding"
                                                            id="studiBanding{{ $studiBanding->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuStudy(4)" @endif
                                                            onclick="waktuStudy(0)">
                                                        <label class="form-check-label"
                                                            for="studiBanding{{ $studiBanding->id }}">
                                                            <h5 class="card-header fw-bold">{{ $studiBanding->nama }}</h5>
                                                            <hr>
                                                            <small>Deskripsi:</small>
                                                            <p class="card-text">{{ $studiBanding->deskripsi }}</p>
                                                            <small>Harga:</small>
                                                            <p class="card-text">Rp {{ $studiBanding->harga }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="mt-3">
                                        <div class="col-lg-12">
                                            <div class="row p-3">
                                                <div class="col-lg-6 col">
                                                    <p class="fw-medium h6">Keterangan Paket Study Banding :</p>
                                                    <ul>
                                                        <li>Mendapat Materi Desa Wisata Krebet</li>
                                                        <li>Diskusi dan Tanya Jawab</li>
                                                        <li>Melihat Proses Produksi dan Kerajinan</li>
                                                        <li>Membatik Batik Paket III</li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col">
                                                    <p class="fw-medium h6">Fasilitas :</p>
                                                    <ul>
                                                        <li>Sertifikat</li>
                                                        <li>Alat dan Bahan Membatik</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col step" id="batik">
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <label for="paket-batik" class="form-label fw-bold">Paket Batik</label>
                                        <div class="row justify-content-center">
                                            @foreach ($batiks as $batik)
                                                <div class="col-lg-3 col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input batik" value="{{ $batik->id }}"
                                                            type="radio" name="batik" id="batik{{ $batik->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuBatik(2)" @endif
                                                            onclick="waktuBatik(0)">
                                                        <label class="form-check-label" for="batik{{ $batik->id }}">
                                                            <h5 class="card-header fw-bold">{{ $batik->nama }}</h5>
                                                            <hr>
                                                            <small>Souvenir yang didapat:</small>
                                                            <p class="card-text">{{ $batik->deskripsi }}</p>
                                                            <small>Harga Paket:</small>
                                                            <p class="card-text">Rp {{ $batik->harga }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="mt-3">
                                        <div class="col-lg-12">
                                            <div class="row p-3">
                                                <div class="col-lg-6 col">
                                                    <p class="fw-medium h6">Keterangan Paket Membatik :</p>
                                                    <ul>
                                                        <li>Hasil Karya Milik Peserta</li>
                                                        <li>Minimal 10 orang</li>
                                                        <li>Durasi 2 Jam</li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col">
                                                    <p class="fw-medium h6">Fasilitas :</p>
                                                    <ul>
                                                        <li>Sertifikat</li>
                                                        <li>Alat dan Bahan Membatik</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="h-5">Hall0000o</div> -->
                                    </div>

                                </div>
                                <div class="col step" id="kesenian">
                                    <!-- Paket Kesenian -->
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <label for="paket-kesenian" class="form-label fw-bold">Paket Kesenian Belajar
                                            (Rp40.000)</label>
                                        <div class="row justify-content-center">
                                            @foreach ($kesenians as $kesenian)
                                                <div class="col-lg-3 col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input kesenian"
                                                            value="{{ $kesenian->id }}.belajar" type="radio"
                                                            name="kesenian" id="kesenian{{ $kesenian->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuKesenian(1)" @endif
                                                            onclick="waktuKesenian(0)">
                                                        <label class="form-check-label"
                                                            for="kesenian{{ $kesenian->id }}">
                                                            <h5 class="card-header fw-bold">{{ $kesenian->nama }}</h5>
                                                            <hr>
                                                            <small>Harga:</small>
                                                            <p class="card-text">Rp {{ $kesenian->harga_belajar }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <label for="paket-kesenian" class="form-label fw-bold">Paket Kesenian Belajar dan
                                            Pementasan (Rp150.000)</label>
                                        <div class="row justify-content-center">
                                            @foreach ($kesenians as $kesenian)
                                                <div class="col-lg-3 col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input kesenian"
                                                            value="{{ $kesenian->id }}.pementasan" type="radio"
                                                            name="kesenian" id="kesenian2{{ $kesenian->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuKesenian(2)" @endif
                                                            onclick="waktuKesenian(0)">
                                                        <label class="form-check-label"
                                                            for="kesenian2{{ $kesenian->id }}">
                                                            <h5 class="card-header fw-bold">{{ $kesenian->nama }}</h5>
                                                            <hr>
                                                            <small>Harga:</small>
                                                            <p class="card-text">Rp {{ $kesenian->harga_pementasan }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="mt-3">
                                        <div class="col-lg-12">
                                            <div class="row p-3">
                                                <div class="col-lg-6 col">
                                                    <p class="fw-medium h6">Keterangan Paket Kesenian :</p>
                                                    <ul>
                                                        <li>Biaya Belajar Rp 40.000/orang</li>
                                                        <li>Biaya Belajar & Pementasan Rp 150.000/orang</li>
                                                        <li>Minimal Peserta 10 orang</li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col">
                                                    <p class="fw-medium h6">Fasilitas :</p>
                                                    <ul>
                                                        <li>Foto Kegiatan</li>
                                                        <li>Pakaian Tradisional dan Make Up</li>
                                                        <li>Tempat Pertunjukan</li>
                                                        <li>Air Minum Kemasan</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="cocok-tanam">
                                    <!-- Paket Cocok Tanam -->
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <label for="paket-cocok-tanam" class="form-label fw-bold">Paket Cocok
                                            Tanam</label>
                                        <div class="row justify-content-center">
                                            @foreach ($cocokTanams as $cocokTanam)
                                                <div class="col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input cocokTanam"
                                                            value="{{ $cocokTanam->id }}" type="radio"
                                                            name="cocokTanam" id="cocokTanam{{ $cocokTanam->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuCocokTanam(1)" @endif
                                                            onclick="waktuCocokTanam(0)">
                                                        <label class="form-check-label"
                                                            for="cocokTanam{{ $cocokTanam->id }}">
                                                            <h5 class="card-header fw-bold">{{ $cocokTanam->nama }}</h5>
                                                            <hr>
                                                            <small>Harga:</small>
                                                            <p class="card-text">Rp {{ $cocokTanam->harga }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="mt-3">
                                        <div class="col-lg-12">
                                            <div class="row p-3">

                                                <div class="col">
                                                    <p class="fw-medium h6">Fasilitas Paket Cocok Tanam :</p>
                                                    <ul>
                                                        <li>Bibit dan Alat dan Bahan-bahan</li>
                                                        <li>Pendamping(Petani)</li>
                                                        <li>Tanaman menjadi milik/hak pemilik lahan</li>
                                                        <li>Air Minum Kemasan</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="permainan">
                                    <!-- Paket Permainan -->
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <label for="paket-permainan" class="form-label fw-bold">Paket Permainan
                                            (Rp12.500/orang)</label>
                                        <div class="row justify-content-center">
                                            @foreach ($permainans as $permainan)
                                                <div class="col-lg-3 col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input permainan"
                                                            value="{{ $permainan->id }}" type="radio" name="permainan"
                                                            id="permainan{{ $permainan->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuPermainan(1)" @endif
                                                            onclick="waktuPermainan(0)">
                                                        <label class="form-check-label"
                                                            for="permainan{{ $permainan->id }}">
                                                            <h5 class="card-header fw-bold">{{ $permainan->nama }}</h5>
                                                            <hr>
                                                            <small>Harga:</small>
                                                            <p class="card-text">Rp {{ $permainan->harga }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="mt-3">
                                        <div class="col-lg-12">
                                            <div class="row p-3">

                                                <div class="col">
                                                    <p class="fw-medium h6">Keterangan Paket Permainan :</p>
                                                    <ul>
                                                        <li>Area Permainan</li>
                                                        <li>Alat dan Bahan Permainan</li>
                                                        <li>Air Minum Kemasan</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="kuliner">
                                    <!-- Paket Kuliner -->
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <label for="paket-kuliner" class="form-label fw-bold">Paket Kuliner</label>
                                        <div class="row justify-content-center">
                                            @foreach ($kuliners as $kuliner)
                                                <div class="col-lg-3 col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input kuliner"
                                                            value="{{ $kuliner->id }}" type="radio" name="kuliner"
                                                            id="kuliner{{ $kuliner->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuKuliner(1)" @endif
                                                            onclick="waktuKuliner(0)">
                                                        <label class="form-check-label" for="kuliner{{ $kuliner->id }}">
                                                            <h5 class="card-header fw-bold">{{ $kuliner->nama }}</h5>
                                                            <hr>
                                                            <small>Deskripsi:</small>
                                                            <p class="card-text">{{ $kuliner->deskripsi }}</p>
                                                            <small>Harga:</small>
                                                            <p class="card-text">Rp {{ $kuliner->harga }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="mt-3">
                                        <div class="col-lg-12">
                                            <div class="row p-3">

                                                <div class="col">
                                                    <p class="fw-medium h6">Keterangan Paket Kuliner :</p>
                                                    <ul>
                                                        <li>Paket Dhaharan minimal 25 pax</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="homestay">
                                    <!-- Paket Homestay -->
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <label for="paket-homestay" class="form-label fw-bold col-12">Paket
                                            Homestay</label>
                                        <div class="row justify-content-center">
                                            @foreach ($homestays as $homestay)
                                                <div class="col-lg-3 col border p-3 m-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input homestay"
                                                            value="{{ $homestay->id }}" type="radio" name="homestay"
                                                            id="homestay{{ $homestay->id }}"
                                                            @if ($loop->first) checked @endif
                                                            @if (!$loop->first) onclick="waktuHomestay(0)" @endif
                                                            onclick="waktuHomestay(0)">
                                                        <label class="form-check-label"
                                                            for="homestay{{ $homestay->id }}">
                                                            <h5 class="card-header fw-bold">{{ $homestay->nama }}</h5>
                                                            <hr>
                                                            <small>Deskripsi:</small>
                                                            <p class="card-text">{{ $homestay->deskripsi }}</p>
                                                            <small>Harga:</small>
                                                            <p class="card-text">Rp {{ $homestay->harga }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="mt-3">
                                        <div class="col-lg-12">
                                            <div class="row p-3">
                                                <div class="col">
                                                    <p class="fw-medium h6">Keterangan Paket Homestay :</p>
                                                    <ul>
                                                        <li>Satu Kamar untuk Dua Orang</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col step" id="ringkasan">
                                    <div class="row border rounded p-4 mb-3 justify-content-center">
                                        <h5 class="fw-bold col-12">Ringkasan Booking</h5>
                                        <div class="row justify-content-center">
                                            <div class="" id="summaryPaketList"></div>
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
                                <a type="text" class="btn btn-primary" data-toggle="modal"
                                    data-target="#submitModal" onclick="waktuAkhir()">Booking Sekarang</a>
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
                                        class="fa-brands fa-whatsapp"></i> 085868144268 </a>
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
<div class="col text-center ">
    <a href="{{ route('admin.dashboard') }}" class="text-secondary">
        <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
        <p>Dashboard</p>
    </a>
</div>
    <div class="col text-center rounded-top bg-secondary">
        <a href="{{ route('admin.kalender') }}" class="text-white">
            <p><i class="fa-regular fa-calendar-days m-0 p-0 pt-2"></i></p>
            <p>Kalender</p>
        </a>
    </div>
    <div class="col text-center border-start">
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
<div class="col text-center">
        <a href="{{ route('admin.paket.index') }}" class="text-secondary">
            <p><i class="fa fa-bar-chart-o m-0 p-0 pt-2"></i></p>
            <p>Paket</p>
        </a>
    </div>

@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js"></script>

    <script src="{{ asset('js/kalender.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landingpage.js') }}"></script>
    <script src="{{ asset('js/slideForm.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) return;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                events: [
                    @foreach ($bookings as $booking)
                        {
                            title: '{{ $booking->organisasi }}',
                            start: '{{ $booking->tanggal }}T{{ $booking->jam_mulai }}',
                            end: '{{ $booking->tanggal }}T{{ $booking->jam_selesai }}'
                        },
                    @endforeach
                ]
            });
            calendar.render();

            // Ambil semua tanggal yang sudah dibooking
            const tanggalTerbooking = calendar.getEvents().map(e => e.start.toISOString().slice(0, 10));

            // Reference ke input date
            const inputTanggal = document.getElementById("tanggal-booking");

            // Disable tanggal yang sudah dibooking
            inputTanggal.addEventListener("input", function() {
                if (tanggalTerbooking.includes(this.value)) {
                    alert("Tanggal ini sudah dibooking. Silakan pilih tanggal lain.");
                    this.value = ""; // reset input
                }
            });
        });
    </script>
    <script>
        var calendar; // Declare calendar variable in the global scope

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            if (calendarEl) {
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    locale: 'id',
                    allDaySlot: false,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'timeGridDay,timeGridWeek,dayGridMonth'
                    },
                    buttonText: {
                        today: 'Hari ini',
                        month: 'Bulan',
                        week: 'Minggu',
                        day: 'Hari'
                    },
                    slotLabelFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    },
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    },
                    views: {
                        timeGridWeek: {
                            minTime: '08:00:00', // Set the start time for the timeGridWeek view
                            maxTime: '16:00:00' // Set the end time for the timeGridWeek view
                        },
                        timeGridDay: {
                            minTime: '08:00:00', // Set the start time for the timeGridDay view
                            maxTime: '16:00:00' // Set the end time for the timeGridDay view
                        }
                    },
                    events: [
                        @foreach ($bookings as $booking)
                            {
                                title: '{{ $booking->organisasi }}',
                                start: '{{ $booking->tanggal }}T{{ $booking->jam_mulai }}',
                                end: '{{ $booking->tanggal }}T{{ $booking->jam_selesai }}',
                                extendedProps: {
                                    nama_pic: '{{ $booking->nama_pic }}',
                                    noTelpPIC: '{{ $booking->noTelpPIC }}',
                                    visitor: '{{ $booking->visitor }}',
                                    jam_mulai: '{{ $booking->jam_mulai }}',
                                    jam_selesai: '{{ $booking->jam_selesai }}',
                                    paket_id: '{{ $booking->paket_id }}',
                                    tagihan: '{{ $booking->tagihan }}',
                                    guide_id: '{{ $booking->guide_id }}',
                                    status: '{{ $booking->status }}',
                                },
                                backgroundColor: '{{ $booking->status === 'Sudah ACC' ? '#5cb85c' : '#0275d8' }}', // Conditional color
                            },
                        @endforeach
                    ],
                    eventClick: function(info) {
                        // Prevent the browser from following the URL
                        info.jsEvent.preventDefault();

                        // Extract data from the eventinfo.jsEvent.preventDefault();
                        var options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        var event = info.event;
                        var eventData = {
                            nama_pic: event.extendedProps.nama_pic,
                            organisasi: event.title,
                            noTelpPIC: event.extendedProps.noTelpPIC,
                            visitor: event.extendedProps.visitor,
                            tanggal: event.start.toLocaleDateString('id-ID', options),
                            jam_mulai: event.extendedProps.jam_mulai,
                            jam_selesai: event.extendedProps.jam_selesai,
                            paket_id: event.extendedProps.paket_id,
                            tagihan: event.extendedProps.tagihan,
                            guide_id: event.extendedProps.guide_id,
                            status: event.extendedProps.status
                        };

                        const message = `Halo Admin, saya sudah melakukan booking dengan detail berikut:
                        - Nama: ${eventData.nama_pic}
                        - Organisasi: ${eventData.organisasi}
                        - Tanggal: ${eventData.tanggal}
                        - Jam: ${eventData.jam_mulai} - ${eventData.jam_selesai}
                        Mohon konfirmasi status booking saya. Terima kasih!`;

                        const encodedMessage = encodeURIComponent(message);

                        // Update the modal's content
                        var modalBody = document.getElementById('modalBody');
                        modalBody.innerHTML = `
                            <div class="row justify-content-center">
                                <div class="col m-3 border rounded p-0">
                                    <div class="bg-secondary rounded">
                                    <p class="h5 fw-bold p-2 text-white">Status Booking</p>
                                    </div>
                                    <div class="p-3">
                                        <table class="table table-bordered table-striped mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Nama Pembooking</th>
                                                    <td>${eventData.nama_pic}</td>
                                                </tr>
                                                <tr>
                                                    <th>Organisasi</th>
                                                    <td>${eventData.organisasi}</td>
                                                </tr>
                                                <tr>
                                                    <th>Visitor</th>
                                                    <td>${eventData.visitor}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <td>${eventData.tanggal}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jam Mulai</th>
                                                    <td>${eventData.jam_mulai}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jam Selesai</th>
                                                    <td>${eventData.jam_selesai}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td><button class="btn btn-secondary">${eventData.status}</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="cekStatus text-center p-3">
                                        <p class="fw-bold">Periksa Status Booking ini lebih lanjut dengan menghubungi nomer Admin berikut :</p>
                                        <a href="https://wa.me/6285868144268?text=${encodedMessage}" target="_blank" class="btn btn-primary"><i class="fa-brands fa-whatsapp"></i> 085868144268 </a>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Show the modal
                        $('#eventModal').modal('show');
                    }

                });

                calendar.render();
            } else {
                console.error("Element with id 'calendar' not found.");
            }
        });
    </script>
    <script>
        function validateVisitorCount() {
            var visitor = document.getElementById("jumlah-visitor");
            var visitorValue = visitor.value;
            // console.log(arr_email);
            if (visitorValue < 1) {
                alert("Visitor harus lebih dari 0 !!");
                visitor.value = "";
            }
        }
    </script>
@endsection
