@extends('admin.layout')

@section('title', 'Dashboard | Admin')

@section('titleNav', 'Dashboard')

@section('css')

    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2>Laporan</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Laporan</strong>
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
    <li>
        <a href="{{ route('admin.booking') }}"><i class="fa fa-users"></i>
            <span class="nav-label">Booking</span></a>
    </li>
    <li class="active">
        <a href="{{ route('admin.laporan') }}"><i class="fa fa-book"></i>
            <span class="nav-label">Laporan</span></a>
    </li>
@endsection

@section('content')
    <div class="row mt-3" id="tabel-laporan">
        <div class="col-12">
            <div class="ibox">
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
                    <div class="d-flex px-4 py-2">

                        <!-- Filter Form -->
                        <form action="{{ route('admin.laporan.search') }}" method="GET" class="form-inline mb-2">
                            @csrf

                            <div class="form-group mr-3">
                                <label for="bulan" class="mr-2">Bulan:</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">Tampilkan Semua</option>
                                    @foreach ([
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ] as $num => $month)
                                        <option value="{{ $num }}"
                                            {{ request('bulan') == $num || (!request()->has('bulan') && date('n') == $num) ? 'selected' : '' }}>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-3">
                                <label for="tahun" class="mr-2">Tahun:</label>
                                <input type="number" name="tahun" id="tahun" class="form-control"
                                    value="{{ request('tahun', date('Y')) }}">
                            </div>


                            <button type="submit" class="btn btn-primary  mr-2 px-4">Filter</button>
                            <a href="{{ route('admin.laporan') }}" class="btn btn-secondary ">Hapus Filter</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center px-3 bg-primary">
                    <h5>Filter</h5>
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
                        <!-- Cetak PDF -->
                    </div>
                    <div class="">
                        <a href="{{ route('admin.laporan.print', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                            class="btn btn-danger">
                            Cetak PDF
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="" id="tabel-laporan">
                        <div class="col p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center dataTables-example w-100">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="vertical-align: top">No</th>
                                            <th scope="col" style="vertical-align: top">Nama PIC</th>
                                            <th scope="col" style="vertical-align: top">Nama Organisasi</th>
                                            <th scope="col" style="vertical-align: top">No Telpon</th>
                                            <th scope="col" style="vertical-align: top">Jumlah Visitor</th>
                                            <th scope="col" style="vertical-align: top">Tanggal</th>
                                            <th scope="col" style="vertical-align: top">Jam Mulai</th>
                                            <th scope="col" style="vertical-align: top">Jam Selesai</th>
                                            {{-- <th scope="col" style="vertical-align: top">Guide</th> --}}
                                            <th scope="col" style="vertical-align: top">Tagihan</th>
                                            <th scope="col" style="vertical-align: top">Detail</th>
                                            <th scope="col" style="vertical-align: top">Cetak</th>
                                            <!-- <th scope="col">Status</th> -->
                                            <!-- <th scope="col" style="width:10%;">Opsi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporans as $laporan)
                                            <tr>
                                                <th scope="row" class="pt-3">{{ $loop->iteration }}</th>
                                                <td class="pt-3">{{ $laporan->nama_pic }}</td>
                                                <td class="pt-3">{{ $laporan->organisasi }}</td>
                                                <td class="pt-3">
                                                    @php
                                                        $noHp = preg_replace('/^0/', '62', $laporan->noTelpPIC); // ubah 0 di awal jadi 62
                                                    @endphp
                                                    <a href="https://wa.me/{{ $noHp }}" target="_blank"
                                                        style="text-decoration: underline; color: #25D366;">
                                                        {{ $laporan->noTelpPIC }}
                                                    </a>
                                                </td>

                                                <td class="pt-3">{{ $laporan->visitor }}</td>
                                                <td class="pt-3">
                                                    {{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('d F Y') }}
                                                </td>
                                                <td class="pt-3">{{ $laporan->jam_mulai }}</td>
                                                <td class="pt-3">{{ $laporan->jam_selesai }}</td>
                                                {{-- <th scope="col">{{ $laporan->guide->name }}</th> --}}
                                                <th scope="col">Rp {{ number_format($laporan->tagihan, 0, ',', '.') }}
                                                </th>
                                                <th scope="col" class="text-center"><a
                                                        href="{{ route('admin.detail', ['id' => $laporan->id]) }}"
                                                        style="text-decoration: none; color:rgb(2, 77, 2); font-size:1.5rem;"><i
                                                            class="fa-solid fa-file-invoice"></i></a></th>
                                                <th><a href="{{ route('admin.invoice', ['id' => $laporan->id]) }}"
                                                        class="btn btn-info" style="font-size: 0.8rem ;">Cetak</a></th>

                                                <!-- <td><a href="#" class="btn btn-warning" style="font-size: 0.8rem ;" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="fa-solid fa-pen-to-square"></i></a> | <a href="#" class="btn btn-danger" style="font-size: 0.8rem ;"><i class="fa-solid fa-trash-can"></i></a></td> -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8">Total Pendapatan</th>
                                            <th>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav> --}}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('menuHp')
    <div class="col text-center border-end">
        <a href="{{ route('admin.kalender') }}" class="text-secondary">
            <p><i class="fa-regular fa-calendar-days m-0 p-0 pt-2"></i></p>
            <p>Kalender</p>
        </a>
    </div>
    <div class="col text-center border-end">
        <a href="{{ route('admin.dashboard') }}" class="text-secondary">
            <p><i class="fa-solid fa-globe m-0 p-0 pt-2"></i></p>
            <p>Dashboard</p>
        </a>
    </div>
    <div class="col text-center ">
        <a href="{{ route('admin.booking') }}" class="text-secondary">
            <p><i class="fa-solid fa-house-lock m-0 p-0 pt-2"></i></p>
            <p>Booking</p>
        </a>
    </div>
    <div class="col text-center rounded-top bg-secondary">
        <a href="{{ route('admin.laporan') }}" class="text-white">
            <p><i class="bi bi-journal m-0 p-0 pt-2"></i></p>
            <p>Laporan</p>
        </a>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
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
        // Set value from sessionStorage if exists
        document.addEventListener('DOMContentLoaded', function() {
            var selectedMonth = sessionStorage.getItem('selectedMonth');
            if (selectedMonth) {
                document.getElementById('bulan').value = selectedMonth;
            }

            var selectedYear = sessionStorage.getItem('selectedYear');
            if (selectedYear) {
                document.getElementById('tahun').value = selectedYear;
            }
        });

        // Update sessionStorage when value changes
        document.getElementById('bulan').addEventListener('change', function() {
            var selectedValue = this.value;
            sessionStorage.setItem('selectedMonth', selectedValue);
        });

        document.getElementById('tahun').addEventListener('input', function() {
            var selectedValue = this.value;
            sessionStorage.setItem('selectedYear', selectedValue);
        });
    </script>

@endsection
