<?php

namespace App\Http\Controllers;

use App\Models\API\Barang;
use App\Models\BarterPiutang;
use Illuminate\Http\Request;

class BarterPiutangController extends Controller
{
    public function index()
    {
        $data   = BarterPiutang::query()->paginate(10);
        $total  = BarterPiutang::count();
        $barang = Barang::all();
        return view('barter.piutang.index', compact('data', 'total', 'barang'));
    }

    public function store(Request $request)
    {
        $data = BarterPiutang::create($request->except('_token', '_method'));
        $data->update([
            'sub_total' => $data->harga * $data->qty,
            'nama_barang_dan_no_lot' => $data->nama_barang . " // " . $data->no_lot
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, BarterPiutang $barter_piutang)
    {
        $barter_piutang->update($request->except('_token', '_method'));
        $barter_piutang->update([
            'sub_total' => $barter_piutang->harga * $barter_piutang->qty,
            'nama_barang_dan_no_lot' => $barter_piutang->nama_barang . " // " . $barter_piutang->no_lot
        ]);
        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy(BarterPiutang $barter_piutang)
    {
        $barter_piutang->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }
}
