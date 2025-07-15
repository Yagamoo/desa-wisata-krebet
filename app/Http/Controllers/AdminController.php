<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\StudyBanding;
use Illuminate\Http\Request;
use App\Models\Batik;
use App\Models\Booking;
use App\Models\Kesenian;
use App\Models\CocokTanam;
use App\Models\Guide;
use App\Models\Homestay;
use App\Models\Permainan;
use App\Models\Kuliner;
use App\Models\Paket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggalBooking = $request->input('tanggal-booking', '');
        $namaBooking = $request->input('nama-booking', '');
        $noTelpPic = $request->input('no-telp-pic', '');
        $jamBookingMulai = $request->input('jam-booking-mulai', '');
        $jamBookingSelesai = $request->input('jam-booking-selesai', '');
        $jumlahVisitor = $request->input('jumlah-visitor', '');

        $batiks = Batik::all();
        $kesenians = Kesenian::all();
        $cocokTanams = CocokTanam::all();
        $permainans = Permainan::all();
        $kuliners = Kuliner::all();
        $homestays = Homestay::all();
        $studiBandings = StudyBanding::all();
        $bookings = Booking::all();
        return view('admin.kalender', compact(
            'batiks',
            'bookings',
            'homestays',
            'studiBandings',
            'kesenians',
            'cocokTanams',
            'permainans',
            'kuliners',
            'tanggalBooking',
            'namaBooking',
            'noTelpPic',
            'jamBookingMulai',
            'jamBookingSelesai',
            'jumlahVisitor'
        ));
    }

    public function dashboard()
    {
        $batiks = Batik::all();
        $kesenians = Kesenian::all();
        $cocokTanams = CocokTanam::all();
        $permainans = Permainan::all();
        $kuliners = Kuliner::all();
        $homestays = Homestay::all();
        $studiBandings = StudyBanding::all();


        $StartMonth = Carbon::now()->startOfMonth();
        $EndMonth = Carbon::now()->endOfMonth();
        $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');
        $kunjunganHarian = Booking::where('tanggal', Carbon::today('Asia/Jakarta'))->count();
        $kunjunganBulanan = Booking::whereBetween('tanggal', [$StartMonth, $EndMonth])->count();
        $totalKunjungan = Booking::count('id');
        $data = Booking::where('tanggal', '>=', $today)->orderBy('tanggal', 'asc')->take(2)->get();
        $appoitments = Booking::where('tanggal', '>=', $today)->orderBy('tanggal', 'asc')->take(2)->get();
        // dd($oneMonth);

        $trafikKunjungan = Booking::select(DB::raw('DATE(tanggal) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Format data untuk Chart.js
        $dates = $trafikKunjungan->pluck('date');
        $counts = $trafikKunjungan->pluck('count');

        // Kumpulkan data pendapatan harian
        $revenueData = Booking::select(DB::raw('tanggal, sum(tagihan) as total'))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Pisahkan tanggal dan total pendapatan untuk Chart.js
        $totals = $revenueData->pluck('total');

        return view('admin/dashboard', compact(
            'batiks',
            'homestays',
            'studiBandings',
            'kesenians',
            'cocokTanams',
            'permainans',
            'kuliners',
            'data',
            'dates',
            'totals',
            'counts',
            'appoitments',
            'kunjunganHarian',
            'kunjunganBulanan',
            'totalKunjungan'
        ));
    }

    public function laporan(Request $request)
    {
        $laporans = Booking::orderBy('tanggal', 'asc')->get();
        $totalPendapatan = $laporans->sum('tagihan');

        return view('admin/laporan', compact('laporans', 'request', 'totalPendapatan'));
    }

    public function laporanSearch(Request $request)
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

        // Menghitung total tagihan untuk semua data yang terfilter
        $totalPendapatan = $data->sum('tagihan');

        return view('admin.laporan', compact('laporans', 'totalPendapatan', 'request'));
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
        // dd($request->all());
        list($kesenianID, $ketKesenian) = explode('.', $request->kesenian);

        Paket::create([
            'batik_id' => $request->batik,
            'kesenian_id' => $kesenianID,
            'study_banding_id' => $request->studiBanding,
            'cocok_tanam_id' => $request->cocokTanam,
            'permainan_id' => $request->permainan,
            'homestay_id' => $request->homestay,
            'kuliner_id' => $request->kuliner,
            'ketKesenian' => $ketKesenian,
        ]);

        $paket = Paket::latest()->first();
        if ($ketKesenian == 'pementasan') {
            $tagihan = (($paket->batik->harga + $paket->kesenian->harga_pementasan + $paket->cocokTanam->harga + $paket->permainan->harga + $paket->kuliner->harga) * $request->visitor) + $paket->homestay->harga + $paket->study_banding->harga;
        } else {
            $tagihan = (($paket->batik->harga + $paket->kesenian->harga_belajar + $paket->cocokTanam->harga + $paket->permainan->harga + $paket->kuliner->harga) * $request->visitor) + $paket->homestay->harga + $paket->study_banding->harga;
        }
        Booking::create([
            'nama_pic' => $request->nama_pic,
            'organisasi' => $request->organisasi,
            'noTelpPIC' => $request->notelppic,
            'visitor' => $request->visitor,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'paket_id' => $paket->id,
            'tagihan' => $tagihan,
            'guide_id' => '1',
            'status' => 'Belum ACC',
        ]);

        return redirect()->route('admin.booking');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $bookings = Booking::all();
        return view('admin.booking', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $batiks = Batik::all();
        $kesenians = Kesenian::all();
        $cocokTanams = CocokTanam::all();
        $permainans = Permainan::all();
        $kuliners = Kuliner::all();
        $homestays = Homestay::all();
        $studiBandings = StudyBanding::all();
        $data = Booking::findOrFail($id);
        $guides = Guide::all();
        return view('admin.edit', compact('data', 'guides', 'batiks', 'homestays', 'studiBandings', 'kesenians', 'cocokTanams', 'permainans', 'kuliners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        if ($request->status) {
            $booking = Booking::findOrFail($id);
            if ($request->pembayaran == 'dp') {
                $booking->status = 'ACC - DP';
            } else if ($request->pembayaran == 'penuh') {
                $booking->status = 'ACC - Lunas';
            }

            $booking->save();

            // Jika status == "Sudah ACC", buat pemasukan
            if ($booking->status = 'ACC - DP' || $booking->status = 'ACC - Lunas') {
                // Cek apakah sudah ada pemasukan untuk booking ini agar tidak dobel
                $existing = Keuangan::where('booking_id', $booking->id)->first();
                if (!$existing) {
                    $jumlah = str_replace('.', '', $request->jumlah); // hilangkan titik
                    $jumlah = preg_replace('/\D/', '', $jumlah); // jaga-jaga: hilangkan non-digit

                    $filePath = null;

                    if ($request->hasFile('bukti_pembayaran')) {
                        $file = $request->file('bukti_pembayaran');
                        $filePath = $file->store('bukti_pembayaran', 'public'); // simpan di storage/app/public/bukti_pembayaran
                    }


                    Keuangan::create([
                        'booking_id' => $booking->id,
                        'keterangan' => 'Pemasukan dari Booking #' . $booking->id,
                        'tanggal' => now(),
                        'jenis' => 'pemasukan',
                        'type_pembayaran' => $request->pembayaran,
                        'jumlah' => $jumlah,
                        'bukti' => $filePath,
                    ]);
                }
            }

            return response()->json(['success' => true]);
        } else {
            if ($request->kesenianBelajar == "1.belajar") {
                list($kesenianID, $ketKesenian) = explode('.', $request->kesenianPementasan);
            } else if ($request->kesenianPementasan == "1.pementasan") {
                list($kesenianID, $ketKesenian) = explode('.', $request->kesenianBelajar);
            }
            $bookingID = Booking::findOrFail($id);
            $paketID = Paket::findOrFail($bookingID->paket_id);

            $paketID->update([
                'batik_id' => $request->batik,
                'kesenian_id' => $kesenianID,
                'study_banding_id' => $request->studiBanding,
                'cocok_tanam_id' => $request->cocokTanam,
                'permainan_id' => $request->permainan,
                'homestay_id' => $request->homestay,
                'kuliner_id' => $request->kuliner,
                'ketKesenian' => $ketKesenian,
            ]);

            $paket = $paketID;
            if ($ketKesenian == 'pementasan') {
                $tagihan = (($paket->batik->harga + $paket->kesenian->harga_pementasan + $paket->cocokTanam->harga + $paket->permainan->harga + $paket->kuliner->harga) * $request->visitor) + $paket->homestay->harga + $paket->study_banding->harga;
            } else {
                $tagihan = (($paket->batik->harga + $paket->kesenian->harga_belajar + $paket->cocokTanam->harga + $paket->permainan->harga + $paket->kuliner->harga) * $request->visitor) + $paket->homestay->harga + $paket->study_banding->harga;
            }

            $bookingID->update([
                'nama_pic' => $request->nama_pic,
                'organisasi' => $request->organisasi,
                'noTelpPIC' => $request->notelppic,
                'visitor' => $request->visitor,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'paket_id' => $paket->id,
                'tagihan' => $tagihan,
                'guide_id' => $request->guide,
                'status' => $request->statusData,
            ]);
            return redirect()->route('admin.booking');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin, $id)
    {
        $dataDelete = Booking::findOrFail($id);
        $paketDelete = Paket::findOrFail($dataDelete->paket_id);
        $dataDelete->delete();
        $paketDelete->delete();
        return redirect()->route('admin.booking');
    }

    public function detail(Request $request, $id)
    {
        $detail = Booking::findOrFail($id);
        if ($detail->paket->ketKesenian == 'pementasan') {
            $tagihanKesenian = 150000;
        } else {
            $tagihanKesenian = 40000;
        }
        return view('admin.detail', compact('detail', 'tagihanKesenian'));
    }

    public function searchPIC(Request $request)
    {
        $searchPIC = $request->namePIC;
        $searchTanggal = $request->tanggal;

        if ($searchTanggal !== '' && $searchPIC !== '') {
            $bookings = Booking::where('nama_pic', 'LIKE', '%' . $searchPIC . '%')
                ->where('tanggal', 'LIKE', '%' . $searchTanggal . '%')
                ->get();

            session(['nama_pic' => $searchPIC]);
            session(['tanggal' => $searchTanggal]);
        } else if ($searchTanggal == '' && $searchPIC !== '') {
            $bookings = Booking::where('nama_pic', 'LIKE', '%' . $searchPIC . '%')->get();
            session(['nama_pic' => $searchPIC]);
        } else if ($searchTanggal !== '' && $searchPIC == '') {
            $bookings = Booking::where('tanggal', 'LIKE', '%' . $searchTanggal . '%')->get();
            session(['tanggal' => $searchTanggal]);
        } else {
            $bookings = Booking::all();
            session(['nama_pic' => $searchPIC]);
            session(['tanggal' => $searchTanggal]);
        }

        return view('admin.booking', compact('bookings'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginProses(Request $request)
    {

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->hasRole('Sekretaris')) {
                return redirect()->route('admin.dashboard')->with('success', 'Anda berhasil login!');
            } elseif ($user->hasRole(roles: 'Bendahara')) {
                return redirect()->route('admin.keuangan.index')->with('success', 'Anda berhasil login!');
            }
        } else {
            return back()->with('error', 'Periksa Kembali Username atau Password Anda!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return view('admin.login');
    }

    // public function index(Request $request)
    // {
    //     $tanggalBooking = $request->input('tanggal-booking', '');
    //     $namaBooking = $request->input('nama-booking', '');
    //     $noTelpPic = $request->input('no-telp-pic', '');
    //     $jamBookingMulai = $request->input('jam-booking-mulai', '');
    //     $jamBookingSelesai = $request->input('jam-booking-selesai', '');
    //     $jumlahVisitor = $request->input('jumlah-visitor', '');

    //     return view('admin.kalender', compact(
    //         'tanggalBooking', 
    //         'namaBooking', 
    //         'noTelpPic', 
    //         'jamBookingMulai', 
    //         'jamBookingSelesai', 
    //         'jumlahVisitor'
    //     ));
    // }
}
