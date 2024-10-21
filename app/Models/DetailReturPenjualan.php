<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturPenjualan extends Model
{
    use HasFactory;

    //belongsToReturPenjualan
    public function returPenjualan()
    {
        return $this->belongsTo(ReturPenjualan::class);
    }
}
