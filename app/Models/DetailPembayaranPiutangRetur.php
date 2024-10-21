<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaranPiutangRetur extends Model
{
    use HasFactory;

    //belongsToPembayaranPiutangRetur
    public function pembayaranPiutangRetur()
    {
        return $this->belongsTo(PembayaranPiutangRetur::class);
    }
}
