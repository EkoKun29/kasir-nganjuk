<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanPiutang extends Model
{
    use HasFactory;

    //hasManyToDetailPenjualanPiutang
    public function detailPenjualanPiutang()
    {
        return $this->hasMany(DetailPenjualanPiutang::class);
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
