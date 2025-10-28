<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BookingItemNego;
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
        // dd($bookings);
        return view('admin.booking', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $data = Booking::findOrFail($id);

        $batiks = Batik::all();
        $kesenians = Kesenian::all();
        $cocokTanams = CocokTanam::all();
        $permainans = Permainan::all();
        $kuliners = Kuliner::all();
        $homestays = Homestay::all();
        $studiBandings = StudyBanding::all();
        $guides = Guide::all();

        // Ambil semua item nego berdasarkan booking_id
        $negos = BookingItemNego::where('booking_id', $id)->get()->keyBy('jenis');

        // Ambil harga tiap jenis (kalau tidak ada, akan null)
        $hargaBatik = $negos->get('batik');
        $hargaCocokTanam = $negos->get('cocok_tanam');
        $hargaPermainan = $negos->get('permainan');
        $hargaKuliner = $negos->get('kuliner');
        $hargaHomestay = $negos->get('homestay');
        $hargaStudyBanding = $negos->get('study_banding');

        // Kesenian punya 2 versi → Belajar & Pementasan
        // Kalau data di tabel booking_item_negos cuma ada satu jenis “kesenian”,
        // maka kita duplikasi berdasarkan ketKesenian dari paket
        $hargaKesenianBelajar = null;
        $hargaKesenianPementasan = null;

        // Kalau kamu simpan 2 baris berbeda di DB (kesenian_belajar & kesenian_pementasan)
        // bisa langsung ambil begini:
        $hargaKesenianBelajar = $negos->get('kesenian_belajar');
        $hargaKesenianPementasan = $negos->get('kesenian_pementasan');

        // Kalau belum ada dua jenis terpisah di DB:
        // cukup set salah satu harga kesenian sebagai acuan
        if (!$hargaKesenianBelajar && !$hargaKesenianPementasan) {
            if ($data->paket->ketKesenian === 'belajar') {
                $hargaKesenianBelajar = $negos->get('kesenian');
            } else {
                $hargaKesenianPementasan = $negos->get('kesenian');
            }
        }
        // dd($hargaBatik->harga_nego);
        $totalBatik = ($hargaBatik->harga_nego && $hargaBatik->harga_nego > 0
            ? $hargaBatik->harga_nego
            : $hargaBatik->harga_awal) * $hargaBatik->jumlah_visitor;
        $totalCocokTanam = ($hargaCocokTanam->harga_nego && $hargaCocokTanam->harga_nego > 0
            ? $hargaCocokTanam->harga_nego
            : $hargaCocokTanam->harga_awal) * $hargaCocokTanam->jumlah_visitor;
        $totalPermainan = ($hargaPermainan->harga_nego && $hargaPermainan->harga_nego > 0
            ? $hargaPermainan->harga_nego
            : $hargaPermainan->harga_awal) * $hargaPermainan->jumlah_visitor;
        $totalKuliner = ($hargaKuliner->harga_nego && $hargaKuliner->harga_nego > 0
            ? $hargaKuliner->harga_nego
            : $hargaKuliner->harga_awal) * $hargaKuliner->jumlah_visitor;
        $totalHomestay = ($hargaHomestay->harga_nego && $hargaHomestay->harga_nego > 0
            ? $hargaHomestay->harga_nego
            : $hargaHomestay->harga_awal) * $hargaHomestay->jumlah_visitor;
        $totalStudyBanding = ($hargaStudyBanding->harga_nego && $hargaStudyBanding->harga_nego > 0
            ? $hargaStudyBanding->harga_nego
            : $hargaStudyBanding->harga_awal) * $hargaStudyBanding->jumlah_visitor;

        // Hitung total kesenian
        $hargaBelajar  = 0;
        $hargaPementasan  = 0;
        if ($data->paket->ketKesenian === 'belajar' && $hargaKesenianBelajar) {
            $hargaBelajar  = ($hargaKesenianBelajar->harga_nego && $hargaKesenianBelajar->harga_nego > 0
            ? $hargaKesenianBelajar->harga_nego
            : $hargaKesenianBelajar->harga_awal) * ($hargaKesenianBelajar->jumlah_visitor ?? 0);
        } elseif ($data->paket->ketKesenian === 'pementasan' && $hargaKesenianPementasan) {
            $hargaPementasan  = ($hargaKesenianPementasan->harga_nego && $hargaKesenianPementasan->harga_nego > 0
            ? $hargaKesenianPementasan->harga_nego
            : $hargaKesenianPementasan->harga_awal) * ($hargaKesenianPementasan->jumlah_visitor ?? 0);
        }
        // dd($totalKesenian);

        $totalAll = $totalBatik + $totalCocokTanam + $totalPermainan + $totalKuliner + $totalHomestay + $totalStudyBanding + $hargaBelajar + $hargaPementasan;

        return view('admin.edit', compact(
            'data',
            'guides',
            'batiks',
            'homestays',
            'studiBandings',
            'kesenians',
            'cocokTanams',
            'permainans',
            'kuliners',
            'hargaBatik',
            'hargaKesenianBelajar',
            'hargaKesenianPementasan',
            'hargaCocokTanam',
            'hargaPermainan',
            'hargaKuliner',
            'hargaHomestay',
            'hargaStudyBanding',
            'totalBatik',
            'totalCocokTanam',
            'totalPermainan',
            'totalKuliner',
            'totalHomestay',
            'totalStudyBanding',
            'hargaPementasan',
            'hargaBelajar',
            'totalAll'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

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
            // 'status' => $request->statusData,
        ]);


        $jenisList = [
            'batik',
            'cocok_tanam',
            'permainan',
            'kuliner',
            'homestay',
            'study_banding'
        ];

        // Update selain kesenian
        foreach ($jenisList as $jenis) {
            $model = BookingItemNego::where('booking_id', $bookingID->id)
                ->where('jenis', $jenis)
                ->first();

            if ($model) {
                // Ambil harga awal dari relasi paket
                $hargaAwal = match ($jenis) {
                    'batik' => $paket->batik->harga ?? 0,
                    'cocok_tanam' => $paket->cocokTanam->harga ?? 0,
                    'permainan' => $paket->permainan->harga ?? 0,
                    'kuliner' => $paket->kuliner->harga ?? 0,
                    'homestay' => $paket->homestay->harga ?? 0,
                    'study_banding' => $paket->study_banding->harga ?? 0,
                    default => 0,
                };

                $model->update([
                    'harga_awal' => $hargaAwal,
                    'harga_nego' => str_replace('.', '', $request->{'harga_nego_' . $jenis}),
                    'catatan' => $request->{'catatan_' . $jenis},
                    'jumlah_visitor' => $request->{'visitor_' . $jenis},
                ]);
            }
        }

        // 🔸 Kesenian — update sesuai jenis aktif
        $paket = $bookingID->paket; // pastikan relasi 'paket' ada
        $jenisKesenianAktif = $paket->ketKesenian; // isinya 'belajar' atau 'pementasan'

        $model = BookingItemNego::where('booking_id', $bookingID->id)
            ->where('jenis', 'kesenian')
            ->first();

        if ($model) {
            $hargaAwalKesenian = $jenisKesenianAktif == 'pementasan'
                ? ($paket->kesenian->harga_pementasan ?? 0)
                : ($paket->kesenian->harga_belajar ?? 0);

            $model->update([
                'harga_awal' => $hargaAwalKesenian,
                'harga_nego' => $request->filled('harga_nego_kesenian_' . $jenisKesenianAktif)
                    ? str_replace('.', '', $request->{'harga_nego_kesenian_' . $jenisKesenianAktif})
                    : 0,
                'catatan' => $request->{'catatan_kesenian_' . $jenisKesenianAktif},
                'jumlah_visitor' => $request->{'visitor_kesenian_' . $jenisKesenianAktif} ?? 0,
            ]);
        }

        $totalTagihan = 0;

        $items = BookingItemNego::where('booking_id', $bookingID->id)->get();

        foreach ($items as $item) {
            $harga = ($item->harga_nego && $item->harga_nego > 0)
                ? $item->harga_nego
                : $item->harga_awal;

            $totalTagihan += $harga * ($item->jumlah_visitor ?? 1);
        }

        $bookingID->update([
            'tagihan' => $totalTagihan,
        ]);

        return redirect()->back()->with('success', 'Data booking berhasil diperbarui!');
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
        $detail = Booking::with(['paket.kesenian', 'paket.batik', 'guide'])->findOrFail($id);
        $bookingItems = BookingItemNego::where('booking_id', $id)->get();

        // Hitung total tagihan dari item nego
        $totalTagihan = $bookingItems->sum(function ($item) {
            $harga = $item->harga_nego > 0 ? $item->harga_nego : $item->harga_awal;
            return $harga * ($item->jumlah_visitor ?? 0);
        });

        // Hitung khusus kesenian (jika mau)
        $tagihanKesenian = 0;
        $kesenianItem = $bookingItems->where('jenis', 'kesenian')->first();

        if ($kesenianItem) {
            $harga = $kesenianItem->harga_nego > 0 ? $kesenianItem->harga_nego : $kesenianItem->harga_awal;
            $tagihanKesenian = $harga * ($kesenianItem->jumlah_visitor ?? 0);
        }

        return view('admin.detail', compact('detail', 'bookingItems', 'totalTagihan', 'tagihanKesenian'));
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
            } elseif ($user->hasRole('Bendahara Lapangan')) {
                return redirect()->route('admin.guide.index')->with('success', 'Anda berhasil login!');
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
