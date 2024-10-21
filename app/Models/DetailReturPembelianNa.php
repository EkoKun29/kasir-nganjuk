<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturPembelianNa extends Model
{
    use HasFactory;

    //belongsToReturPembelianNa
    public function returPembelianNa()
    {
        return $this->belongsTo(ReturPembelianNa::class);
    }
}
