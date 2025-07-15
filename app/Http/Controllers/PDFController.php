<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    //
    public function invoice($id)
    {
        $data = Booking::findOrFail($id);
        if ($data->paket->ketKesenian == 'pementasan') {
            $tagihanKesenian = 150000;
        } else {
            $tagihanKesenian = 40000;
        }

        if (request("output") == "pdf") {
            $pdf = Pdf::loadView('tagihan.invoice_pdf', compact('data', 'tagihanKesenian'))->setPaper('a4', 'landscape');
            // Storage::put('public/invoice/invoice.pdf', $pdf->output());
            return $pdf->stream('invoice.pdf');
            // $pdf->save(public_path('invoice/invoice.pdf'));
            // Storage::put('public/invoice/invoice.pdf', $pdf->output());
            // $url = Storage::url('public/invoice/invoice.pdf');
            // return response()->download(public_path('invoice/invoice.pdf'))->deleteFileAfterSend(true);
        }



        return view('tagihan/invoice', compact('data', 'tagihanKesenian'));
    }

    public function send(Request $request, $id): RedirectResponse
    {
        $data = Booking::findOrFail($id);
        $no_telp = $data->noTelpPIC;
        $token = 'LWk3d6eTgBZurFgZdKyu';

        // Path to your generated PDF invoice
        // $pdfPath = public_path('invoice.invoice.pdf');

        // Example WhatsApp message with PDF link
        $message = "Invoice Anda terlampir. Silakan unduh: " . url('/admin/invoice' . $data->id);

        // Initialize CURL
        $curl = curl_init();

        // Set CURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $no_telp, 'message' => $message),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        // Execute CURL request
        $response = curl_exec($curl);

        // Close CURL
        curl_close($curl);

        // Delete PDF file after sending (optional)
        // unlink($pdfPath);

        // Redirect back with success message
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
