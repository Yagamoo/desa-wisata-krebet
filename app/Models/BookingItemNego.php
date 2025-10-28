<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingItemNego extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'jenis',
        'item_id',
        'harga_awal',
        'harga_nego',
        'jumlah_visitor',
        'catatan',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
