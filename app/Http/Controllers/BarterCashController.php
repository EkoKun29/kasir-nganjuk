<?php

namespace App\Http\Controllers;

use App\Models\API\Barang;
use App\Models\BarterCash;
use Illuminate\Http\Request;

class BarterCashController extends Controller
{
    public function index()
    {
        $data   = BarterCash::where('cash', !0)->paginate(10);
        $total  = BarterCash::count();
        $barang = Barang::all();
        return view('barter.cash.index', compact('data', 'total', 'barang'));
    }

    public function store(Request $request)
    {
        $data = BarterCash::create($request->except('_token', '_method'));
        $data->update([
            'sub_total' => $data->harga * $data->qty,
            'nama_barang_dan_no_lot' => $data->nama_barang . " // " . $data->no_lot
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, BarterCash $barter_cash)
    {
        $barter_cash->update($request->except('_token', '_method'));
        $barter_cash->update([
            'sub_total' => $barter_cash->harga * $barter_cash->qty,
            'nama_barang_dan_no_lot' => $barter_cash->nama_barang . " // " . $barter_cash->no_lot
        ]);
        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy(BarterCash $barter_cash)
    {
        $barter_cash->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }

    //Barang

    public function indexBarang()
    {
        $data   = BarterCash::where('cash', 0)->paginate(10);
        $total  = BarterCash::count();
        $barang = Barang::all();
        return view('barter.barang.index', compact('data', 'total', 'barang'));
    }

    public function storeBarang(Request $request)
    {
        $data = BarterCash::create($request->except('_token', '_method'));
        $data->update([
            'sub_total' => $data->harga * $data->qty,
            'nama_barang_dan_no_lot' => $data->nama_barang . " // " . $data->no_lot
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function updateBarang(Request $request, BarterCash $barter_barang)
    {
        $barter_barang->update($request->except('_token', '_method'));
        $barter_barang->update([
            'sub_total' => $barter_barang->harga * $barter_barang->qty,
            'nama_barang_dan_no_lot' => $barter_barang->nama_barang . " // " . $barter_barang->no_lot
        ]);
        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroyBarang(BarterCash $barter_barang)
    {
        $barter_barang->delete();
        return redirect()->back()->with('delete', 'Data berhasil dihapus');
    }
}
