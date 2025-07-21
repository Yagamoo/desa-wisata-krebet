<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'bulanan');
        $data = Booking::with('keuangan')->orderBy('tanggal', 'asc')->get();

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

        return view('keuangan.laporan.index', compact('filteredData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keuangans = Keuangan::with('booking')->where('booking_id', $id)->get();
        $booking = $keuangans->first()?->booking;
        // dd($keuangan);
        return view('keuangan.laporan.show', compact('keuangans', 'booking'));
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
