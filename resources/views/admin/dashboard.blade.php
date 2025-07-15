@extends('admin.layout')

@section('title', 'Dashboard | Admin')

@section('titleNav', 'Dashboard')

@section('css')

    <link rel="stylesheet" href="/css/dashboard.css">
@endsection

@section('menu')
    <p class="btn btn-secondary text-light d-flex justify-content-between align-items-center me-3 "><a
            href="{{ route('admin.dashboard') }}" class=" text-light fw-bold m-1 ms-3"><i
                class="bi bi-view-list me-2  ps-1 pe-1 rounded"></i> Dashboard </a></p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.kalender') }}"
            class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-person-fill-up  ps-1 pe-1 rounded"></i> Kalender
        </a></p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.booking') }}"
            class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-key ps-1 pe-1 rounded"></i> Booking </a> </p>
    <p class="d-flex justify-content-between align-items-center me-3 "><a href="{{ route('admin.laporan') }}"
            class="text-secondary m-1 ms-3 fw-bold"><i class=" me-2 bi bi-journal ps-1 pe-1 rounded"></i> Laporan </a> </p>
@endsection

@section('content')
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-lg-5 col-12 informasi d-flex">
            <div class="row justify-content-between m-3 bg-white rounded p-4" id="menuCount">
                <div class="col-4 mt-2 mb-2">
                    <div class="box-info p-2 text-center text-white bg-info rounded shadow">
                        <p class="m-1 icon-menu"><i class="fa-solid fa-calendar-day"></i></p>
                        <p class="m-0 total-menu fw-bold">{{ $kunjunganHarian }}</p>
                        <p class="m-0 fw-bold keterangan-menu">Kunjungan<br>Hari ini</p>
                    </div>
                </div>
                <div class="col-4 mt-2 mb-2">
                    <div class="box-info p-2 text-white text-center bg-success rounded shadow">
                        <p class="m-1 icon-menu"><i class="fa-solid fa-calendar-days"></i></p>
                        <p class="m-0 total-menu fw-bold">{{ $kunjunganBulanan }}</p>
                        <p class="m-0 fw-bold keterangan-menu">Kunjungan<br>Bulan ini</p>
                    </div>
                </div>
                <div class="col-4 mt-2 mb-2">
                    <div class="box-info p-2 text-white text-center bg-secondary rounded shadow">
                        <p class="m-1 icon-menu"><i class="fa-solid fa-people-line"></i></p>
                        <p class="m-0 total-menu fw-bold">{{ $totalKunjungan }}</p>
                        <p class="m-0 fw-bold keterangan-menu">Total<br>Kunjungan</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center m-3 bg-white rounded px-3 py-4">
                <div class="col text-center">
                    <a href="#" class="btn btn-primary fw-bold p-3"><span><i
                                class="fa-regular fa-square-plus fs-1 p-2" data-bs-toggle="modal"
                                data-bs-target="#tambahModal"></i></span><br>Buat Booking</a>
                </div>
                <div class="col text-center">
                    <a href="{{ route('admin.laporan') }}" class="btn btn-danger fw-bold p-3 "><span><i
                                class="fa-solid fa-print fs-1 p-2"></i></span><br>Cetak Laporan</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12" id="appointment">
            <div class="row justify-content-center m-3 bg-white rounded p-4 pt-2">
                <p class=" m-0 fw-bold text-center text-secondary p-2">Kunjungan Terdekat</p>
                @foreach ($appoitments as $appoitment)
                    <div class="col-5 bg-primary me-2 ms-2 p-3 rounded">
                        <div class="waktu-appointment text-white fw-medium">
                            <p class="m-0 pb-2"><strong>Tanggal : </strong><br> {{ $appoitment->tanggal }} </p>
                            <p class="m-0"><strong>Waktu : </strong><br> {{ $appoitment->jam_mulai }} -
                                {{ $appoitment->jam_selesai }}</p>
                        </div>
                        <hr>
                        <div class="appointment-info text-white">
                            <p class="mt-2"><span><strong>Nama PIC : </strong></span> {{ $appoitment->nama_pic }}</p>
                            <p class="mt-1"><span><strong>Organisasi : </strong></span> {{ $appoitment->organisasi }}</p>
                            <p class="mt-1"><span><strong>Jumlah Orang : </strong></span> {{ $appoitment->visitor }}
                                Orang</p>
                            <p class="mt-1"><span><strong>No Telepon : </strong></span> {{ $appoitment->noTelpPIC }} </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="container-fluid  px-4" id="grafik-main">
        <div class="row justify-content-center g-4" id="grafik-konten">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-white text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0 fw-bold">Grafik Kunjungan Desa Krebet</h6>
                    </div>
                    <canvas id="kunjungan-trafik"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-white text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0 fw-bold">Grafik Pendapatan Desa Krebet</h6>
                    </div>
                    <canvas id="pendapatan-trafik"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3 mx-3 mb-5" id="tabel-booking">
        <div class="col-11 bg-white rounded p-3 text-center">
            <table class="table text-center ">
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
                            <td class="pt-3">{{ \Carbon\Carbon::parse($items->tanggal)->translatedFormat('d F Y') }}</td>
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fw-bold m-3">Isi Data Diri Booking</h5>
                    <div class="row justify-content-center border rounded p-4 m-3">
                        <div class="col me-4">
                            <form method="GET" action="{{ route('admin.bookingProses') }}">
                                <div class="mb-3">
                                    <label for="tanggal-booking" class="form-label">Tanggal Visitor</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal-booking"
                                        placeholder="Masukan tanggal YYYY-MM-DD" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama-pembooking" class="form-label">Nama Pembooking</label>
                                    <input type="text" class="form-control" name="nama_pic" id="nama-pembooking"
                                        value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama-pembooking" class="form-label">Nama Organisasi</label>
                                    <input type="text" class="form-control" name="organisasi" id="nama-pembooking"
                                        value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="no-telp-pic" class="mb-2">No. Telp PIC</label>
                                    <input type="text" placeholder="Masukan No. Telp" class="form-control"
                                        name="notelppic" id="no-telp-pic" value="" required>
                                </div>


                        </div>
                        <!-- <div class="col">
                                <div class="mb-3">
                                    <label for="tanggal-booking" class="form-label">Tanggal Visitor</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal-booking" placeholder="Masukan tanggal YYYY-MM-DD" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="nama-pembooking" class="form-label">Nama Pembooking</label>
                                    <input type="text" class="form-control" name="nama_pic" id="nama-pembooking" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="nama-pembooking" class="form-label">Nama Organisasi</label>
                                    <input type="text" class="form-control" name="organisasi" id="nama-pembooking" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="no-telp-pic" class="mb-2">No. Telp PIC</label>
                                    <input type="text" placeholder="Masukan No. Telp" class="form-control" name="notelppic" id="no-telp-pic" value="">
                                </div>


                        </div> -->
                        <div class="col">
                            <div class="mb-3">
                                <label for="jam-booking-mulai" class="form-label">Jam Booking Mulai</label>
                                <input type="time" class="form-control" name="jam_mulai" id="jam-booking-mulai"
                                    value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="jam-booking-selesai" class="form-label">Jam Booking Selesai</label>
                                <input type="time" class="form-control" name="jam_selesai" id="jam-booking-selesai"
                                    value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah-visitor" class="mb-2">Jumlah Visitor</label>
                                <input type="text" placeholder="Masukan Jumlah Visitor" class="form-control"
                                    name="visitor" id="jumlah-visitor" value="" required>
                            </div>

                        </div>

                        <h5 class="fw-bold m-3 mt-5">Pilih Paket-Paket Desa Wisata</h5>
                        <div class="row justify-content-center m-3">
                            <div class="col">
                                <div class="row border rounded p-4 mb-3">
                                    <label for="paket-batik" class="form-label fw-bold">Paket Batik</label>
                                    @foreach ($batiks as $batik)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $batik->id }}"
                                                    type="radio" name="batik" id="batik{{ $batik->id }}"
                                                    @if ($loop->first) checked @endif>
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

                                <!-- Paket Kesenian -->
                                <div class="row border rounded p-4 mb-3">
                                    <label for="paket-kesenian" class="form-label fw-bold">Paket Kesenian Belajar
                                        (Rp40.000)</label>
                                    @foreach ($kesenians as $kesenian)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $kesenian->id }}.belajar"
                                                    type="radio" name="kesenian" id="kesenian{{ $kesenian->id }}"
                                                    @if ($loop->first) checked @endif>
                                                <label class="form-check-label" for="kesenian{{ $kesenian->id }}">
                                                    <h5 class="card-header fw-bold">{{ $kesenian->nama }}</h5>
                                                    <hr>
                                                    <small>Harga Belajar:</small>
                                                    <p class="card-text">{{ $kesenian->harga_belajar }}</p>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>
                                    <label for="paket-kesenian" class="form-label fw-bold">Paket Kesenian Belajar dan
                                        Pementasan (Rp150.000)</label>
                                    @foreach ($kesenians as $kesenian)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $kesenian->id }}.pementasan"
                                                    type="radio" name="kesenian" id="kesenian2{{ $kesenian->id }}"
                                                    @if ($loop->first) checked @endif>
                                                <label class="form-check-label" for="kesenian2{{ $kesenian->id }}">
                                                    <h5 class="card-header fw-bold">{{ $kesenian->nama }}</h5>
                                                    <hr>
                                                    <small>Harga Pementasan:</small>
                                                    <p class="card-text">Rp {{ $kesenian->harga_pementasan }}</p>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr class="mt-3">
                                    <div class="col-lg-12">
                                        <div class="row p-3">
                                            <div class="col-6">
                                                <p class="fw-medium h6">Keterangan Paket Kesenian :</p>
                                                <ul>
                                                    <li>Biaya Belajar Rp 40.000/orang</li>
                                                    <li>Biaya Belajar & Pementasan Rp 150.000/orang</li>
                                                    <li>Minimal Peserta 10 orang</li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
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

                                <!-- Paket Cocok Tanam -->
                                <div class="row border rounded p-4 mb-3">
                                    <label for="paket-cocok-tanam" class="form-label fw-bold">Paket Cocok Tanam</label>
                                    @foreach ($cocokTanams as $cocokTanam)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $cocokTanam->id }}"
                                                    type="radio" name="cocokTanam"
                                                    id="cocokTanam{{ $cocokTanam->id }}"
                                                    @if ($loop->first) checked @endif>
                                                <label class="form-check-label" for="cocokTanam{{ $cocokTanam->id }}">
                                                    <h5 class="card-header fw-bold">{{ $cocokTanam->nama }}</h5>
                                                    <hr>
                                                    <small>Deskripsi:</small>
                                                    <p class="card-text">{{ $cocokTanam->deskripsi }}</p>
                                                    <small>Harga:</small>
                                                    <p class="card-text">Rp {{ $cocokTanam->harga }}</p>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Paket Permainan -->
                                <div class="row border rounded p-4 mb-3">
                                    <label for="paket-permainan" class="form-label fw-bold">Paket Permainan</label>
                                    @foreach ($permainans as $permainan)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $permainan->id }}"
                                                    type="radio" name="permainan" id="permainan{{ $permainan->id }}"
                                                    @if ($loop->first) checked @endif>
                                                <label class="form-check-label" for="permainan{{ $permainan->id }}">
                                                    <h5 class="card-header fw-bold">{{ $permainan->nama }}</h5>
                                                    <hr>
                                                    <small>Deskripsi:</small>
                                                    <p class="card-text">{{ $permainan->deskripsi }}</p>
                                                    <small>Harga:</small>
                                                    <p class="card-text">Rp {{ $permainan->harga }}</p>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Paket Kuliner -->
                                <div class="row border rounded p-4 mb-3">
                                    <label for="paket-kuliner" class="form-label fw-bold">Paket Kuliner</label>
                                    @foreach ($kuliners as $kuliner)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $kuliner->id }}"
                                                    type="radio" name="kuliner" id="kuliner{{ $kuliner->id }}"
                                                    @if ($loop->first) checked @endif>
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

                                <!-- Paket Homestay -->
                                <div class="row border rounded p-4 mb-3">
                                    <label for="paket-kuliner" class="form-label fw-bold">Paket Homestay</label>
                                    @foreach ($homestays as $homestay)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $homestay->id }}"
                                                    type="radio" name="homestay" id="homestay{{ $homestay->id }}"
                                                    @if ($loop->first) checked @endif>
                                                <label class="form-check-label" for="homestay{{ $homestay->id }}">
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

                                <!-- Paket Homestay -->
                                <div class="row border rounded p-4 mb-3">
                                    <label for="paket-kuliner" class="form-label fw-bold">Paket Study Banding</label>
                                    @foreach ($studiBandings as $studiBanding)
                                        <div class="col-lg-3 col border p-3 m-3">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{ $studiBanding->id }}"
                                                    type="radio" name="studiBanding"
                                                    id="studiBanding{{ $studiBanding->id }}"
                                                    @if ($loop->first) checked @endif>
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
                                {{-- <button type="submit" class="btn btn-primary" onclick="tambahBooking(event)">Submit</button> --}}
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                <button type="text" class="btn btn-warning mt-3"
                                    data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>

                    </div>



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
