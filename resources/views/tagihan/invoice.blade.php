<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Invoice</title>
    <!-- <link rel="stylesheet" href="/css/invoice.css"> -->
    <style>
        .invoice {
            margin: 4rem 5rem;
        }

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
            padding: 3px;
            /* Ruang isi dalam sel */
            height: 1rem;
            border: 1px black solid;
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

        center {
            margin: 2rem;
        }

        a {
            padding: 0.8rem 1.5rem;
            border-radius: 0.3rem;
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>
    <center>
        <a href="{{ route('admin.invoice.pdf', ['id' => $data->id]) }}" target="_blank">Cetak</a>
    </center>
    <section class="invoice">
        <table class="navbar">
            <tr>
                <td>
                    <img src="/asset/Logo_Desa_Krebet.png" alt="Logo Desa Krebet" style="width: 20%; max-width: 250px">
                </td>
                <td>
                    <h1 style="text-align: right;">Invoice</h1>
                </td>
            </tr>
        </table>

        <table class="informasi">
            <tr>
                <td class="lokasi">
                    <p style="font-weight: bold; margin: 0px; margin-bottom: 4px;">DESA WISATA KREBET</p>
                    <p style="margin: 0px; margin-bottom: 4px;">Krebet, Sendangsari, Pajangan, Bantul, Yogyakarta</p>
                    <p style="margin: 0px; margin-bottom: 4px;">Telp : +62 822-2323-6199 | e-mail : pdwkrebet@gmail.com
                    </p>
                    <p style="margin: 0px; margin-bottom: 24px;">Website : www.krebet.com</p>
                </td>
                <td class="booker">
                    <p style="margin: 0px; margin-bottom: 4px;">Yogyakarta,
                        {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</p>
                    <p style="margin: 0px; margin-bottom: 4px;">Kepada Yth. {{ $data->nama_pic }}</p>
                    <p style="margin: 0px; margin-bottom: 4px;">{{ $data->organisasi }}</p>
                </td>
            </tr>
        </table>
        <table class="detail">
            <thead style="background-color: black; color: white;">
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
                    <td colspan="3" style="text-align: center; border: 0px"></td>
                    <td style="text-align: center; background-color: black; color: white;">JUMLAH</td>
                    <td style="font-weight: bold">Rp. {{ number_format($data->tagihan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="border: 0px; font-weight: bold;">Rencana Kegiatan</td>
                    <td colspan="1" style="border: 0px"></td>
                    <td style="text-align: center; background-color: black; color: white;">DP</td>
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
                    <td colspan="2" style="border: 0px;">
                        {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('l, d F Y') }}</td>
                    <td colspan="1" style="border: 0px"></td>
                    <td style="text-align: center; background-color: black; color: white;">Lain-lain</td>
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
                    <td colspan="2" style="border: 0px;">{{ $data->jam_mulai }} - Selesai</td>
                    {{-- {{ $data->jam_selesai }} --}}
                    <td colspan="1" style="border: 0px"></td>
                    <td style="text-align: center; background-color: black; color: white;">TOTAL</td>
                    <td style="font-weight: bold">Rp. {{ number_format($sisa, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        <table class="footer">
            <tr>
                <td style="vertical-align: top;">
                    <p style="margin-bottom: 4px"><strong>Ketentuan Pembayaran & Peserta:</strong></p>
                    <ol style="padding-left: 15px; margin-top: 0;">
                        <li>Pembayaran uang muka (DP) minimal sebesar 30% dari total biaya wajib dilakukan sebagai tanda
                            jadi pemesanan.</li>
                        <li>Pembayaran dapat dikirimkan melalui:
                            <ul style="margin-top: 4px; margin-bottom: 4px;">
                                <li>Rekening Bank BPD<br>
                                    Nomor Rekening: <strong>004221053654</strong> A/N: <strong>Panut Wibowo</strong>
                                </li>
                                <li>Atau melalui <strong>QRIS Desa Wisata Krebet</strong>.</li>
                            </ul>
                        </li>
                        <li>Konfirmasi jumlah peserta yang hadir wajib dilakukan paling lambat H-3 sebelum acara
                            berlangsung.</li>
                        <li>Apabila terjadi pengurangan jumlah peserta pada hari-H, maka pembayaran tetap mengacu pada
                            jumlah peserta yang telah tercantum dalam invoice ini.</li>
                    </ol>
                </td>
                <td class="tanda-tangan" style="text-align: center; width: 40%;">
                    <p>Hormat Kami,</p>
                    <img src="/asset/desa-krebet-logo.png" alt="Logo Desa Krebet"
                        style="width: 30%; max-width: 250px; margin: 0.5rem 0;">
                    <p><strong>AGUSJATI KUMARA</strong></p>
                </td>
            </tr>
        </table>

    </section>
</body>

</html>
