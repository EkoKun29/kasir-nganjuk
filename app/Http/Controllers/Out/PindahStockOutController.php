<?php

namespace App\Http\Controllers\Out;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\PindahStockOut;
use App\Traits\Buttons;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PindahStockOutController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = Barang::all();
        return view('out.pindah-stock.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = PindahStockOut::create($request->except('_token'));
        $data->update([
            'nama_barang_dan_no_lot' => $data->nama_barang
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = PindahStockOut::find($id);
        $data->update($request->except('_token'));
        $data->update([
            'nama_barang_dan_no_lot' => $data->nama_barang
        ]);
        return redirect()->route('stock-out.index');
    }

    public function edit($id)
    {
        $data = PindahStockOut::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PindahStockOut::query();
            return DataTables::of($data)
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params,'');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function destroy($id)
    {
        PindahStockOut::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
