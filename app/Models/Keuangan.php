<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'keuangans'; // pastikan nama tabelnya benar

    protected $fillable = [
        'booking_id',
        'keterangan',
        'tanggal',
        'jenis',
        'tipe_pembayaran',
        'jumlah',
        'bukti',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];

    // Relasi ke Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Scope pemasukan
    public function scopePemasukan($query)
    {
        return $query->where('jenis', 'pemasukan');
    }

    // Scope pengeluaran
    public function scopePengeluaran($query)
    {
        return $query->where('jenis', 'pengeluaran');
    }

    // Scope DP
    public function scopeDp($query)
    {
        return $query->where('tipe_pembayaran', 'dp');
    }

    // Scope pelunasan
    public function scopePelunasan($query)
    {
        return $query->where('tipe_pembayaran', 'pelunasan');
    }

    // Scope penuh (langsung lunas)
    public function scopePenuh($query)
    {
        return $query->where('tipe_pembayaran', 'penuh');
    }
}
