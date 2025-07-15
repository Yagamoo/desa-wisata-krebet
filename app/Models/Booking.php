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
    public function pemasukan()
    {
        return $this->hasMany(Pemasukan::class, 'booking_id');
    }
    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'booking_id');
    }
}
