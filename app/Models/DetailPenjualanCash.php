<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualanCash extends Model
{
    use HasFactory;

    //belongsToDetailPenjualanCash
    public function penjualanCash()
    {
        return $this->belongsTo(PenjualanCash::class);
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
