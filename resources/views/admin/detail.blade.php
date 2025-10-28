<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail | Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <!-- montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- montserrat -->
    <style>
        * {
            font-family: 'montserrat', sans-serif;

        }

        #booking-text p {
            font-size: 0.85rem;
        }
    </style>
</head>

<body style="background-color:rgb(243, 244, 246);">

    <section id="nav">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">
                <img src="\img\desa-krebet.png" alt="" class="img-fluid navbar-brand ps-4" id="logo">
                <div>
                    <ul class="navbar-nav d-flex  text-center mb-2 mb-lg-0">
                        <li class="nav-item d-flex me-4">
                            <a class="nav-link active fw-bold text-secondary me-3" aria-current="page"
                                href="{{ route('admin.booking') }}"><i class="bi bi-exclude"></i> Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <section id="detail">
        <div class="container">
            <div class="row justify-content-center bg-white rounded mt-5 p-4 shadow pb-3 ps-2">
                <p class="h5">Detail Booking</p>
                <hr>
                <div class="col">
                    <div class="row mt-2 " id="booking-text">
                        <div class="col-4 border-end p-3 ps-4">
                            <table class="table table-sm table-borderless align-middle">
                                <tbody>
                                    <tr>
                                        <th class="text-muted">ID BOOKING</th>
                                        <td class="fw-bold">00{{ $detail->id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Nama PIC</th>
                                        <td class="fw-bold">{{ $detail->nama_pic }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Organisasi</th>
                                        <td class="fw-bold">{{ $detail->organisasi }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">No. Telp PIC</th>
                                        <td class="fw-bold">{{ $detail->noTelpPIC }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Jumlah Visitor</th>
                                        <td class="fw-bold">{{ $detail->visitor }} Orang</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Tanggal Booking</th>
                                        <td class="fw-bold">{{ $detail->tanggal }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Jam Mulai</th>
                                        <td class="fw-bold">{{ $detail->jam_mulai }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Jam Selesai</th>
                                        <td class="fw-bold">{{ $detail->jam_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Penanggung Jawab</th>
                                        <td class="fw-bold">{{ $detail->guide->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Status Booking</th>
                                        <td>
                                            <span class="badge bg-info text-white fw-bold">{{ $detail->status }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('admin.invoice', ['id' => $detail->id]) }}"
                                    class="btn btn-primary btn-sm fw-bold">
                                    Cetak Struk
                                </a>
                                <a href="{{ route('admin.invoice.send', ['id' => $detail->id]) }}"
                                    class="btn btn-warning btn-sm fw-bold">
                                    Kirim Struk ke PIC
                                </a>
                            </div>
                        </div>

                        <div class="col-8 p-3 ps-5">
                            <p class="fw-bold"><small>ID PAKET : 00{{ $detail->paket_id }}</small></p>

                            @foreach ($bookingItems as $item)
                                @php
                                    $relation = $item->jenis === 'cocok_tanam' ? 'cocokTanam' : $item->jenis;
                                    $harga = $item->harga_nego > 0 ? $item->harga_nego : $item->harga_awal;
                                    $subtotal = $harga * ($item->jumlah_visitor ?? 0);
                                @endphp

                                @if ($subtotal > 0)
                                    <div class="justify-content-between d-flex border-bottom py-1">
                                        <p>
                                            Paket {{ ucfirst(str_replace('_', ' ', $item->jenis)) }}
                                            @if ($item->jenis === 'kesenian')
                                                <span class="fw-bold">({{ $detail->paket->ketKesenian }})</span>
                                            @endif
                                            :
                                            <span class="fw-bold">
                                                {{ $detail->paket->{$relation}->nama ?? '-' }}
                                            </span>
                                        </p>

                                        <p>
                                            Rp {{ number_format($harga, 0, ',', '.') }}
                                            @if (in_array($item->jenis, ['batik', 'cocok_tanam', 'permainan', 'kuliner', 'kesenian', 'study_banding', 'homestay']))
                                                X {{ $item->jumlah_visitor ?? 0 }} org =
                                            @else
                                                =
                                            @endif
                                            Rp {{ number_format($subtotal, 0, ',', '.') }},-
                                        </p>
                                    </div>
                                @endif
                            @endforeach

                            <!-- Total Tagihan -->
                            <div class="justify-content-between d-flex pt-3">
                                <p class="fw-bold">Total Tagihan</p>
                                <p class="fw-bold">Rp {{ number_format($totalTagihan, 0, ',', '.') }},-</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
