<?php

namespace App\Http\Controllers;

use App\Models\Batik;
use App\Models\CocokTanam;
use App\Models\Homestay;
use App\Models\Kesenian;
use App\Models\Kuliner;
use App\Models\Permainan;
use App\Models\StudyBanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batiks = Batik::all();
        $kesenians = Kesenian::all();
        $cocok_tanams = CocokTanam::all();
        $kuliners = Kuliner::all();
        $permainans = Permainan::all();
        $study_bandings = StudyBanding::all();
        $homestays = Homestay::all();

        return view('admin.paket.index', [
            'pakets' => [
                'Paket Batik' => $batiks,
                'Paket Kesenian' => $kesenians,
                'Paket Cocok Tanam' => $cocok_tanams,
                'Paket Kuliner' => $kuliners,
                'Paket Permainan' => $permainans,
                'Paket Study Banding' => $study_bandings,
                'Paket Homestay' => $homestays,
            ],
        ]);
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
    public function update(Request $request, $model, $id)
    {
        // Peta nama model berdasarkan slug dari judul
        $models = [
            'paket_batik' => Batik::class,
            'paket_kesenian' => Kesenian::class,
            'paket_cocok_tanam' => CocokTanam::class,
            'paket_kuliner' => Kuliner::class,
            'paket_permainan' => Permainan::class,
            'paket_study_banding' => StudyBanding::class,
            'paket_homestay' => Homestay::class,
        ];

        // Pastikan model ditemukan
        if (!isset($models[$model])) {
            return redirect()->back()->with('error', 'Model tidak dikenali.');
        }

        $modelClass = $models[$model];
        $data = $modelClass::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|string',
            'harga_belajar' => 'nullable|string',
            'harga_pementasan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update deskripsi
        $data->deskripsi = $validated['deskripsi'] ?? $data->deskripsi;

        // Harga (hapus titik)
        if ($request->filled('harga')) {
            $data->harga = str_replace('.', '', $request->harga);
        }
        if ($request->filled('harga_belajar')) {
            $data->harga_belajar = str_replace('.', '', $request->harga_belajar);
        }
        if ($request->filled('harga_pementasan')) {
            $data->harga_pementasan = str_replace('.', '', $request->harga_pementasan);
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $folder = strtolower(str_replace(' ', '_', $model));

            // Hapus gambar lama
            if ($data->gambar && Storage::exists("public/{$folder}/{$data->gambar}")) {
                Storage::delete("public/{$folder}/{$data->gambar}");
            }

            $path = $request->file('gambar')->store("public/{$folder}");
            $data->gambar = basename($path);
        }

        $data->save();
        // Jika request dari AJAX (fetch)
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui!']);
        }

        // Jika bukan AJAX (form biasa)
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
