<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\PindahStockIn;
use App\Traits\Buttons;
use App\Traits\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PindahStockInController extends Controller
{
    use Buttons, Stock;

    public function index()
    {
        $data = Barang::all();
        return view('in.pindah-stock.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = PindahStockIn::create($request->except('_token'));
        $data->update([
            'nama_barang_dan_no_lot' => $data->nama_barang
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data      = PindahStockIn::find($id);

        $data->update($request->except('_token'));
        $data->update([
            'nama_barang_dan_no_lot' => $data->nama_barang
        ]);

        return redirect()->route('stock-in.index');
    }

    public function edit($id)
    {
        $data = PindahStockIn::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PindahStockIn::latest();
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
        PindahStockIn::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
