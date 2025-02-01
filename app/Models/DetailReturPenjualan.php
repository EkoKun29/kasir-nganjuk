<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturPenjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'retur_penjualan_id', 'nama_barang', 'no_lot', 'nama_barang_dan_no_lot', 
        'harga', 'qty', 'sub_total'
    ];

    //belongsToReturPenjualan
    public function returPenjualan()
    {
        return $this->belongsTo(ReturPenjualan::class);
    }
}
