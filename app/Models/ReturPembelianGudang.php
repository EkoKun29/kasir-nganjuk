<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelianGudang extends Model
{
    use HasFactory;

    //hasManyDetailReturPembelianGudang
    public function detailReturPembelianGudang()
    {
        return $this->hasMany(DetailReturPembelianGudang::class);
    }
}
