<?php

namespace App\Http\Controllers;

use App\Models\API\Barang;
use App\Models\DetailReturPembelianGudang;
use App\Models\ReturPembelianGudang;
use App\Traits\Buttons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReturPembelianGudangController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = Barang::all();
        return view('in.retur-pembelian-gudang.index', compact('data'));
    }

    public function store(Request $request)
    {
        // STORE PENJUALAN CASH
        $new_data = ReturPembelianGudang::create([
            'toko'   => $request->toko,
            'gudang' => $request->gudang,
        ]);

        // STORE DETAIL PENJUALAN CASH
        $detail_data = $request->data;

        foreach ($detail_data as $item => $value) {
            DetailReturPembelianGudang::create([
                'retur_pembelian_gudang_id' => $new_data->id,
                'nama_barang'               => $value['nama_barang'],
                'no_lot'                    => $value['no_lot'],
                'nama_barang_dan_no_lot'    => $value['nama_barang'] . ' // ' . $value['no_lot'],
                'qty'                       => $value['qty'],
            ]);
        }

        return redirect()->route('print.retur.pembelian.gudang')->with(compact('new_data'));
    }

    public function report()
    {
        return view('report.r-retur-pembelian-gudang.index');
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = ReturPembelianGudang::query();
            return DataTables::of($data)
                ->editColumn('created_at', function ($params) {
                    return Carbon::parse($params->created_at)->format('j F Y');
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'retur-pembelian-gudang');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function table($id)
    {
        $data = DetailReturPembelianGudang::where('retur_pembelian_gudang_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $data = DetailReturPembelianGudang::where('retur_pembelian_gudang_id', $id)->get();
        $barang = Barang::all();
        return view('report.r-retur-pembelian-gudang.edit', compact('data', 'barang'));
    }

    public function update($id, Request $request)
    {
        $data = DetailReturPembelianGudang::find($id);
        $data->update([
            'nama_barang' => $request->nama_barang,
            'no_lot' => $request->no_lot,
            'nama_barang_dan_no_lot' => $request->nama_barang . ' // ' . $request->no_lot,
            'qty' => $request->qty,
        ]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = ReturPembelianGudang::find($id);
        DetailReturPembelianGudang::where('retur_pembelian_gudang_id', $data->id)->delete();
        $data->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }
}
