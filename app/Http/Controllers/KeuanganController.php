<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'bulanan');
        $data = Keuangan::orderBy('tanggal', 'asc')->get();

        $labels = [];
        $pemasukanChart = [];
        $pengeluaranChart = [];

        // Data yang digunakan untuk total pemasukan & pengeluaran sesuai filter
        $filteredData = $data;

        switch ($filter) {
            case 'tahunan':
                $grouped = $data->groupBy(function ($item) {
                    return Carbon::parse($item->tanggal)->format('Y');
                });

                foreach ($grouped as $year => $items) {
                    $labels[] = $year;
                    $pemasukanChart[] = $items->where('jenis', 'pemasukan')->sum('jumlah');
                    $pengeluaranChart[] = $items->where('jenis', 'pengeluaran')->sum('jumlah');
                }

                $filteredData = $data->filter(function ($item) {
                    return Carbon::parse($item->tanggal)->year === now()->year;
                });
                break;

            case 'bulanan':
                $grouped = $data->groupBy(function ($item) {
                    return Carbon::parse($item->tanggal)->format('Y-m');
                });

                foreach ($grouped as $ym => $items) {
                    $labels[] = Carbon::parse($ym . '-01')->translatedFormat('F Y');
                    $pemasukanChart[] = $items->where('jenis', 'pemasukan')->sum('jumlah');
                    $pengeluaranChart[] = $items->where('jenis', 'pengeluaran')->sum('jumlah');
                }

                $filteredData = $data->filter(function ($item) {
                    $tanggal = Carbon::parse($item->tanggal);
                    return $tanggal->year === now()->year && $tanggal->month === now()->month;
                });
                break;

            case 'mingguan':
                $grouped = $data->groupBy(function ($item) {
                    return Carbon::parse($item->tanggal)->startOfWeek()->format('Y-m-d');
                });

                foreach ($grouped as $weekStart => $items) {
                    $labels[] = 'Minggu ' . Carbon::parse($weekStart)->translatedFormat('d M Y');
                    $pemasukanChart[] = $items->where('jenis', 'pemasukan')->sum('jumlah');
                    $pengeluaranChart[] = $items->where('jenis', 'pengeluaran')->sum('jumlah');
                }

                $filteredData = $data->filter(function ($item) {
                    return Carbon::parse($item->tanggal)->isSameWeek(now());
                });
                break;

            default: // harian
                $grouped = $data->groupBy(function ($item) {
                    return Carbon::parse($item->tanggal)->format('Y-m-d');
                });

                foreach ($grouped as $date => $items) {
                    $labels[] = Carbon::parse($date)->translatedFormat('d M Y');
                    $pemasukanChart[] = $items->where('jenis', 'pemasukan')->sum('jumlah');
                    $pengeluaranChart[] = $items->where('jenis', 'pengeluaran')->sum('jumlah');
                }

                $filteredData = $data->filter(function ($item) {
                    return Carbon::parse($item->tanggal)->isSameDay(now());
                });
                break;
        }

        // Total berdasarkan data yang terfilter
        $pemasukan = $filteredData->where('jenis', 'pemasukan')->sum('jumlah');
        $pengeluaran = $filteredData->where('jenis', 'pengeluaran')->sum('jumlah');

        return view('keuangan.index', compact(
            'filteredData',
            'pemasukan',
            'pengeluaran',
            'labels',
            'pemasukanChart',
            'pengeluaranChart'
        ));
    }



    public function pemasukan()
    {
        $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');
        $data = Keuangan::where('jenis', 'pemasukan')->orderBy('tanggal', 'asc')->get();
        $pemasukan = $data->where('jenis', 'pemasukan')->sum('jumlah');

        return view('keuangan.pemasukan.index', compact('data', 'pemasukan'));
    }

    public function createPemasukan()
    {
        // $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');
        $bookings = Booking::all();

        return view('keuangan.pemasukan.create', compact('bookings'));
    }

    // Data Create Pemasukan | Booking
    public function getDetail($id)
    {
        $booking = Booking::findOrFail($id);

        return response()->json([
            'nama_pic' => $booking->nama_pic,
            'noTelpPIC' => $booking->noTelpPIC,
            'organisasi' => $booking->organisasi,
            'tanggal' => $booking->tanggal, // pastikan kolom ada
        ]);
    }


    public function storePemasukan(Request $request)
    {
        // dd($request);
        $request->validate([
            'booking_id' => 'nullable|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'tipe_pembayaran' => 'required|in:dp,lunas,penuh',
            'jumlah' => 'required|string', // akan diformat
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $jumlah = preg_replace('/\D/', '', $request->jumlah); // bersihkan Rp dan titik

        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Keuangan::create([
            'booking_id' => $request->booking_id,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'jenis' => 'pemasukan',
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'jumlah' => $jumlah,
            'bukti' => $path,
        ]);

        return redirect()->back()->with('success', 'Data pemasukan berhasil ditambahkan.');
    }

    // Pengeluaran
    public function pengeluaran()
    {
        $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');
        $data = Keuangan::where('jenis', 'pengeluaran')->orderBy('tanggal', 'asc')->get();
        $pengeluaran = $data->where('jenis', 'pengeluaran')->sum('jumlah');

        return view('keuangan.pengeluaran.index', compact('data', 'pengeluaran'));
    }

    public function createPengeluaran()
    {
        // $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');
        $bookings = Booking::all();

        return view('keuangan.pengeluaran.create', compact('bookings'));
    }

    public function storePengeluaran(Request $request)
    {
        // dd($request);
        $request->validate([
            'booking_id' => 'nullable|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'tipe_pembayaran' => 'required|in:dp,lunas,penuh',
            'jumlah' => 'required|string', // akan diformat
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $jumlah = preg_replace('/\D/', '', $request->jumlah); // bersihkan Rp dan titik

        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Keuangan::create([
            'booking_id' => $request->booking_id,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'jenis' => 'pengeluaran',
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'jumlah' => $jumlah,
            'bukti' => $path,
        ]);

        return redirect()->back()->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }
}
