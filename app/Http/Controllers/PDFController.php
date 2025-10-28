<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingItemNego;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    //
    public function invoice($id)
    {
        $data = Booking::findOrFail($id);
        $bookingItems = BookingItemNego::where('booking_id', $id)->get();

        // tagihan kesenian tetap disiapkan kalau dipakai di view
        $tagihanKesenian = $data->paket->ketKesenian == 'pementasan' ? 150000 : 40000;

        // total
        $totalTagihan = 0;
        foreach ($bookingItems as $item) {
            $harga = $item->harga_nego > 0 ? $item->harga_nego : $item->harga_awal;
            $subtotal = $harga * ($item->jumlah_visitor ?? 0);
            $totalTagihan += $subtotal;
        }

        if (request("output") == "pdf") {
            $pdf = Pdf::loadView('tagihan.invoice_pdf', compact('data', 'bookingItems', 'totalTagihan', 'tagihanKesenian'))
                ->setPaper('a4', 'landscape');
            return $pdf->stream('invoice.pdf');
        }

        return view('tagihan.invoice', compact('data', 'bookingItems', 'totalTagihan', 'tagihanKesenian'));
    }


    public function send(Request $request, $id): RedirectResponse
    {
        $data = Booking::findOrFail($id);
        $no_telp = $data->noTelpPIC;
        $message = "Invoice Anda terlampir. Silakan unduh: " . url('/admin/invoice' . $data->id);

        // Redirect back with success message
        $token = 'LWk3d6eTgBZurFgZdKyu'; // Ganti token Fonnte kamu
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
                    'target' => $no_telp,
                    'message' => $message,
                ]);

        return Redirect::back()->with('success', 'Invoice terkirim ke WhatsApp');
    }

    public function laporan(Request $request)
    {
        $data = Booking::query();

        // Filter berdasarkan bulan dan tahun jika ada input dari form
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $data->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun);
        }

        $laporans = $data->orderBy('tanggal', 'desc')->get();
        $totalPendapatan = $laporans->sum('tagihan');

        return view('laporan/laporan', compact('laporans', 'totalPendapatan', 'request'));
    }

    public function laporan_pdf(Request $request)
    {
        $laporans = Booking::query();

        // Filter berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != '') {
            $laporans->whereMonth('tanggal', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $laporans->whereYear('tanggal', $request->tahun);
        }

        $laporans = $laporans->get();
        $totalPendapatan = $laporans->sum('tagihan');

        $pdf = Pdf::loadView('laporan.laporan_pdf', compact('laporans', 'totalPendapatan', 'request'))->setPaper('a4', 'landscape');
        // Storage::put('public/invoice/invoice.pdf', $pdf->output());
        return $pdf->stream('laporan.pdf');
    }
}
