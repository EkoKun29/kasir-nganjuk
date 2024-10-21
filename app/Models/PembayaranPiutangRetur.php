<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranPiutangRetur extends Model
{
    use HasFactory;

    //hasManyDetailPembayaranPiutangRetur
    public function detailPembayaranPiutangRetur()
    {
        return $this->hasMany(DetailPembayaranPiutangRetur::class);
    }
}
