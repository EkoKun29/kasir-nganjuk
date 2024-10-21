<?php

namespace App\Http\Controllers;

use App\Models\PembelianNa;
use Illuminate\Http\Request;

class BukuHutangController extends Controller
{
    public function index()
    {
        $data   = PembelianNa::select('atas_nama_sales', 'nama_barang_dan_no_lot', 'qty', 'hutang')
            ->where('hutang', '!=', '')
            ->paginate(10);
        $total  = PembelianNa::count();
        return view('output.buku-hutang.index', compact('data', 'total'));
    }
}
