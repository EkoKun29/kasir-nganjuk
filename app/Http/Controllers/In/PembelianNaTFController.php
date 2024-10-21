<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\PembelianNaTF;
use App\Traits\Buttons;
use App\Traits\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembelianNaTFController extends Controller
{
    use Buttons, Stock;

    public function index()
    {
        $data = Barang::all();
        return view('in.pembelian-na-tf.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = new PembelianNaTf();
        $data->tanggal = $request->tanggal;
        $data->no_nota = $request->no_nota;
        $data->atas_nama_sales = $request->atas_nama_sales;
        $data->yang_bawa_barang = $request->yang_bawa_barang;
        $data->nama_suplier = $request->nama_suplier;
        $data->nama_barang = $request->nama_barang;
        $data->no_lot = "0";
        $data->nama_barang_dan_no_lot = $request->nama_barang;
        $data->harga = $request->harga;
        $data->qty = $request->qty;
        $data->tf = $request->harga * $request->qty;
        $data->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = PembelianNaTF::find($id);
        $total_tf = $request->harga * $request->qty;

        $data->update($request->except('_token'));
        $data->update([
            'nama_barang' => $request->nama_barang,
            'nama_barang_dan_no_lot' => $data->nama_barang,
            'tf' => $total_tf,
        ]);

        return redirect()->route('pembelian-na-tf.index');
    }

    public function edit($id)
    {
        $data = PembelianNaTF::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PembelianNaTF::query();
            return DataTables::of($data)
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, '');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function destroy($id)
    {

        PembelianNaTF::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
