<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
     protected $fillable = [
        'nama_pic', 
        'organisasi',
        'noTelpPIC', 
        'visitor', 
        'tanggal', 
        'jam_mulai', 
        'jam_selesai', 
        'paket_id', 
        'tagihan', 
        'guide_id', 
        'status'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }
    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'booking_id');
    }
    public function nego()
    {
        return $this->hasMany(BookingItemNego::class, 'booking_id');
    }

    public function getLatestStatusKeuanganAttribute()
    {
        return $this->keuangan->firstWhere('tipe_pembayaran', 'penuh')
            ?? $this->keuangan->firstWhere('tipe_pembayaran', 'dp');
    }
}
