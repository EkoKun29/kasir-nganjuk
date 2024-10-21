<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualanPiutang;
use App\Models\PenjualanPiutang;

class BukuPiutangController extends Controller
{
    public function index()
    {
        $data       = PenjualanPiutang::query()->paginate(10);
        $total      = PenjualanPiutang::count();
        return view('output.buku-piutang.index', compact('data', 'total'));
    }
}
