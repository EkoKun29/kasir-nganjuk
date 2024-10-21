<?php

namespace App\Http\Controllers\Out;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\DetailReturPembelianNa;
use App\Models\ReturPembelianNa;
use App\Traits\Buttons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReturPembelianNaController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = Barang::all();
        return view('out.retur-pembelian-na.index', compact('data'));
    }

    public function indexCash()
    {
        $data = Barang::all();
        return view('out.retur-pembelian-cash.index', compact('data'));
    }

    public function indexHutang()
    {
        $data = Barang::all();
        return view('out.retur-pembelian-hutang.index', compact('data'));
    }

    public function store(Request $request)
    {
        // STORE PENJUALAN CASH
        $new_data = ReturPembelianNa::create([
            'atas_nama_sales'   => 'TOKO NGANJUK',
            'yang_bawa_barang'  => $request->yang_bawa_barang,
            'nmr'               => $request->nmr,
            'tgl_retur'         => $request->tgl_retur,
            'nama_suplier'      => $request->nama_suplier
        ]);

        // STORE DETAIL PENJUALAN CASH
        $detail_data = $request->data;

        foreach ($detail_data as $item => $value) {
            DetailReturPembelianNa::create([
                'retur_pembelian_na_id'     => $new_data->id,
                'nama_barang'               => $value['nama_barang'],
                'no_lot'                    => $value['no_lot'],
                'nama_barang_dan_no_lot'    => $value['nama_barang'] . ' // ' . $value['no_lot'],
                'harga'                     => $value['harga'],
                'qty'                       => $value['qty'],
                'retur_ngurang_hutang'      => $value['retur_ngurang_hutang'],
                'retur_minta_cash'          => $value['retur_minta_cash'],
                'sub_total'                 => $value['subtotal']
            ]);
        }

        return redirect()->route('print.retur.pembelian.na')->with(compact('new_data'));
    }

    public function report()
    {
        return view('report.r-retur-pembelian-na.index');
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = ReturPembelianNa::query();
            return DataTables::of($data)
                ->editColumn('created_at', function ($params) {
                    return Carbon::parse($params->created_at)->format('j F Y');
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'retur-pembelian-na');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function table($id)
    {
        $data = DetailReturPembelianNa::where('retur_pembelian_na_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $data = DetailReturPembelianNa::where('retur_pembelian_na_id', $id)->get();
        $barang = Barang::all();
        return view('report.r-retur-pembelian-na.edit', compact('data', 'barang'));
    }

    public function update($id, Request $request)
    {
        $data = DetailReturPembelianNa::find($id);
        $data->update([
            'nama_barang'               => $request->nama_barang,
            'no_lot'                    => $request->no_lot,
            'nama_barang_dan_no_lot'    => $request->nama_barang . ' // ' . $request->no_lot,
            'harga'                     => $request->harga,
            'qty'                       => $request->qty,
            'retur_ngurang_hutang'      => $request->retur_ngurang_hutang,
            'retur_minta_cash'          => $request->retur_minta_cash,
            'sub_total'                 => ($request->qty * $request->harga) - $request->retur_ngurang_hutang - $request->retur_minta_cash,
        ]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = ReturPembelianNa::find($id);
        DetailReturPembelianNa::where('retur_pembelian_na_id', $data->id)->delete();
        $data->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }
}
