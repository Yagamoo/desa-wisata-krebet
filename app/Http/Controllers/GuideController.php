<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(Auth::user()->getRoleNames());
        $userId = auth()->id();
        $filter = $request->input('filter', 'bulanan');
        $data = Booking::with('keuangan')
                ->whereHas('guide', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })
                ->orderBy('tanggal', 'asc')
                ->get();

        // Data yang digunakan untuk total pemasukan & pengeluaran sesuai filter
        $filteredData = $data;

        switch ($filter) {
            case 'tahunan':
                $filteredData = $data->filter(function ($item) {
                    return Carbon::parse($item->tanggal)->year === now()->year;
                });
                break;

            case 'bulanan':
                $filteredData = $data->filter(function ($item) {
                    $tanggal = Carbon::parse($item->tanggal);
                    return $tanggal->year === now()->year && $tanggal->month === now()->month;
                });
                break;

            case 'mingguan':
                $filteredData = $data->filter(function ($item) {
                    return Carbon::parse($item->tanggal)->isSameWeek(now());
                });
                break;

            default: // harian
                $filteredData = $data->filter(function ($item) {
                    return Carbon::parse($item->tanggal)->isSameDay(now());
                });
                break;
        }

        return view('guide.index', compact('filteredData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $booking = Booking::with('keuangan')->find($id);
        return view('guide.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
                // dd($request);
        $request->validate([
            'jenis' => 'required|string',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            // 'tipe_pembayaran' => 'required|in:dp,lunas,penuh',
            'jumlah' => 'required|string', // akan diformat
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        
        $jumlah = preg_replace('/\D/', '', $request->jumlah); // bersihkan Rp dan titik
        
        // dd($jumlah);
        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Keuangan::create([
            'booking_id' => $request->id,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'tipe_pembayaran' => 'penuh',
            'jumlah' => $jumlah,
            'bukti' => $path,
        ]);

        return redirect()->route('admin.laporan.show', $id)->with('success', 'Laporan keuangan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
