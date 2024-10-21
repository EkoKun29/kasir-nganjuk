<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturPembelianGudang extends Model
{
    use HasFactory;

    //belongsToReturPembelianGudang
    public function returPembelianGudang()
    {
        return $this->belongsTo(ReturPembelianGudang::class);
    }
}
