<?php

namespace App\Http\Controllers;

use App\Models\Batik;
use App\Models\Booking;
use App\Models\BookingItemNego;
use App\Models\Kesenian;
use App\Models\CocokTanam;
use App\Models\Homestay;
use App\Models\Permainan;
use App\Models\Kuliner;
use App\Models\Paket;
use App\Models\StudyBanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;


class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $batiks = Batik::all();
        $kesenians = Kesenian::all();
        $cocokTanams = CocokTanam::all();
        $permainans = Permainan::all();
        $kuliners = Kuliner::all();
        $homestays = Homestay::all();
        $studiBandings = StudyBanding::all();
        $bookings = Booking::all();
        return view('user/landingpage', compact('batiks', 'bookings', 'homestays', 'studiBandings', 'kesenians', 'cocokTanams', 'permainans', 'kuliners', 'request'));
    }

    public function store(Request $request)
    {
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

        $booking = Booking::create([
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

        // === Simpan ke booking_item_negos ===
        $items = [
            ['jenis' => 'batik', 'item_id' => $paket->batik_id, 'harga' => $paket->batik->harga],
            ['jenis' => 'kesenian', 'item_id' => $paket->kesenian_id, 'harga' => $ketKesenian == 'pementasan' ? $paket->kesenian->harga_pementasan : $paket->kesenian->harga_belajar],
            ['jenis' => 'study_banding', 'item_id' => $paket->study_banding_id, 'harga' => $paket->study_banding    ->harga],
            ['jenis' => 'cocok_tanam', 'item_id' => $paket->cocok_tanam_id, 'harga' => $paket->cocokTanam->harga],
            ['jenis' => 'permainan', 'item_id' => $paket->permainan_id, 'harga' => $paket->permainan->harga],
            ['jenis' => 'homestay', 'item_id' => $paket->homestay_id, 'harga' => $paket->homestay->harga],
            ['jenis' => 'kuliner', 'item_id' => $paket->kuliner_id, 'harga' => $paket->kuliner->harga],
        ];

        foreach ($items as $item) {
            BookingItemNego::create([
                'booking_id' => $booking->id,
                'jenis' => $item['jenis'],
                'item_id' => $item['item_id'],  
                'harga_awal' => $item['harga'],
                'harga_nego' => null,
                'jumlah_visitor' => $booking->visitor,
                'catatan' => null,
            ]);
        }

        return redirect()->route('user.landingpage');
    }

    // public function detail(Request $request, $id) {
    //     $detail = Booking::findOrFail($id);
    //     if($detail->paket->ketKesenian == 'pementasan'){
    //         $tagihanKesenian = 150000;
    //     }else{
    //         $tagihanKesenian = 40000;
    //     } 
    //     return view('user.detail', compact('detail','tagihanKesenian'));
    // }

    public function send(Request $request, $id): RedirectResponse
    {
        $data = Booking::findOrFail($id);
        $no_telp = $data->noTelpPIC;
        $token = 'LWk3d6eTgBZurFgZdKyu';

        // Path to your generated PDF invoice
        // $pdfPath = public_path('invoice.invoice.pdf');

        // Example WhatsApp message with PDF link
        $message = "Hallo, saya sudah melakukan booking via website. </br> Silakan unduh: " . url('/admin/invoice' . $data->id);

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
}
