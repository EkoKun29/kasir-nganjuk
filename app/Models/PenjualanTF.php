<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanTF extends Model
{
    use HasFactory;

    protected $table = 'penjualan_tfs';

    //hasManyToDetailPenjualanTf
    public function detailPenjualanTf()
    {
        return $this->hasMany(DetailPenjualanTF::class, 'penjualan_tf_id');
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
