<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualanPiutang extends Model
{
    use HasFactory;

    //belongsToDetailPenjualanPiutang
    public function penjualanPiutang()
    {
        return $this->belongsTo(PenjualanPiutang::class);
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
