<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\NominalAwal;
use Illuminate\Http\Request;

class NominalAwalController extends Controller
{
    public function index()
    {
        $data   = NominalAwal::query()->paginate(10);
        $total  = NominalAwal::count();
        $barang = Barang::all();
        return view('other.nominal-awal.index', compact('data', 'total', 'barang'));
    }

    public function store(Request $request)
    {
        // $check = NominalAwal::where('nama_barang', $request->nama_barang)->first();
        // if ($check) {
        //     return redirect()->back()->with('delete', 'Nominal sudah ada');
        // }
        NominalAwal::create([
            'kas'           => $request->kas,
            'saldo_bank'    => $request->saldo_bank,
        ]);
        return redirect()->back()->with('success', 'Nominal berhasil ditambahkan');
    }

    public function update(Request $request, NominalAwal $nominal_awal)
    {
        $nominal_awal->update([
            'kas'           => $request->kas,
            'saldo_bank'    => $request->saldo_bank,
        ]);
        return redirect()->back()->with('success', 'Nominal berhasil diupdate');
    }

    public function destroy(NominalAwal $nominal_awal)
    {
        $nominal_awal->delete();
        return redirect()->back()->with('delete', 'Nominal berhasil dihapus');
    }
}
