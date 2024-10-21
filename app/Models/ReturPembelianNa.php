<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelianNa extends Model
{
    use HasFactory;

    //hasManyDetailReturPembelianNa
    public function detailReturPembelianNa()
    {
        return $this->hasMany(DetailReturPembelianNa::class);
    }
}
