<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Invoice</title>
    <!-- <link rel="stylesheet" href="/css/invoice.css"> -->
    <style>
        /* .invoice {
            margin: 4rem 5rem;
        } */

        .invoice .navbar {
            width: 100%;
            /* display: flex;
            justify-content: space-between; */
        }

        .invoice .informasi {
            width: 100%;
            /* display: flex;
            justify-content: space-between; */
        }

        .invoice .informasi .booker {
            text-align: right;
        }

        .invoice .detail {
            width: 100%;
            /* Mengatur tabel agar mengisi 100% lebar kontainer */
            border-collapse: collapse;
            /* Menggabungkan border sel */
        }

        .invoice .detail th,
        .invoice .detail td {
            border: 1px solid #dddddd;
            /* Garis batas sel */
            text-align: left;
            /* Penyusunan teks */
            padding: 4px;
            /* Ruang isi dalam sel */
            height: 0.5rem;
        }

        .invoice .footer {
            width: 100%;

            /* display: flex;
            justify-content: space-between; */
        }

        .invoice .footer .tanda-tangan {
            width: 20rem;
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>

<body>

    <section class="invoice">
        <table class="navbar">
            <tr>
                <td>
                    <img src="{{ public_path('asset/Logo_Desa_Krebet.png') }}" alt="Logo Desa Krebet"
                        style="width: 70%; max-width: 250px">
                </td>
                <td>
                    <h1 style="text-align: right;">Invoice</h1>
                </td>
            </tr>
        </table>

        <table class="informasi">
            <tr>
                <td class="lokasi">
                    <p>DESA WISATA KREBET</p>
                    <p>Krebet, Sendangsari, Pajangan, Bantul, Yogyakarta</p>
                    <p>Email : pdwkrebet@gmail.com</p>
                </td>
                <td class="booker">
                    <p>Yogyakarta, {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</p>
                    <p>Kepada Yth. {{ $data->nama_pic }}</p>
                </td>
            </tr>
        </table>
        <table class="detail">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Banyaknya</td>
                    <td>Harga Satuan</td>
                    <td>Sub Total</td>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($bookingItems as $item)
                    @php
                        $relation = $item->jenis === 'cocok_tanam' ? 'cocokTanam' : $item->jenis;
                        $harga = $item->harga_nego > 0 ? $item->harga_nego : $item->harga_awal;
                        $subtotal = $harga * ($item->jumlah_visitor ?? 0);
                    @endphp

                    @if ($subtotal > 0)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                Paket {{ ucfirst(str_replace('_', ' ', $item->jenis)) }}
                                @if ($item->jenis === 'kesenian')
                                    <span>({{ $data->paket->ketKesenian }})</span>
                                @endif
                                : <strong>{{ $data->paket->{$relation}->nama ?? '-' }}</strong>
                            </td>
                            <td>{{ $item->jumlah_visitor ?? '-' }}</td>
                            <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endforeach

                <tr>
                    <td colspan="4" style="text-align: center;">TOTAL</td>
                    <td style="font-weight: bold">Rp. {{ number_format($data->tagihan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">DP</td>
                    <td style="font-weight: bold">
                        @php
                            $dp = $data->keuangan
                                ->where('jenis', 'pemasukan')
                                ->where('status', 'approved')
                                ->where('tipe_pembayaran', 'dp')
                                ->sum('jumlah');
                        @endphp
                        Rp. {{ number_format($dp, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">Lain-lain</td>
                    <td style="font-weight: bold">
                        @php
                            $lain = $data->keuangan
                                ->where('jenis', 'pemasukan')
                                ->where('status', 'approved')
                                ->where('tipe_pembayaran', '!=', 'dp')
                                ->sum('jumlah');
                        @endphp
                        Rp. {{ number_format($lain, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    @php
                        $sisa = $data->tagihan - $dp - $lain;
                    @endphp
                    <td colspan="4" style="text-align: center;">SISA</td>
                    <td style="font-weight: bold">Rp. {{ number_format($sisa, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        <table class="footer">
            <tr>
                <td style="vertical-align: top">
                    <p> </p>
                </td>
                <td class="tanda-tangan">
                    <p style="text-align: center;">Hormat Kami,</p>
                    <!-- <p style="padding: 2rem;"></p> -->
                    <img src="{{ public_path('/asset/desa-krebet-logo.png') }}" alt="Logo Desa Krebet"
                        style="width: 40%; max-width: 250px">
                    <p style="text-align: center;">AGUSJATI KUMARA</p>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
