<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanCash extends Model
{
    use HasFactory;

    //hasManyToDetailPenjualanCash
    public function detailPenjualanCash()
    {
        return $this->hasMany(DetailPenjualanCash::class);
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    
}
