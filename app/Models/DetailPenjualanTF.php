<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualanTF extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualan_tfs';
    protected $fillable = ['penjualan_tf_id'];

    //belongsToDetailPenjualanTF
    public function penjualanTf()
    {
        return $this->belongsTo(PenjualanTF::class, 'penjualan_tf_id');
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
