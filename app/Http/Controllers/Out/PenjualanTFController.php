<?php

namespace App\Http\Controllers\Out;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\DetailPenjualanTF;
use App\Models\Konsumen;
use App\Models\PenjualanTF;
use App\Traits\Buttons;
use App\Traits\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanTFController extends Controller
{
    use Buttons, Stock;

    public function index()
    {
        $data = Barang::get();
        $bank = collect([
            ['bank' => 'BNI 898'],
            ['bank' => 'BRI 302'],
            ['bank' => 'BRI 503'],
            ['bank' => 'BRI 500'],
            ['bank' => 'BRI 535'],
            ['bank' => 'BRI 536'],
            ['bank' => 'MANDIRI 522'],
            ['bank' => 'MANDIRI 016'],
            ['bank' => 'MANDIRI 442'],
            ['bank' => 'BCA 703'],
            ['bank' => 'BCA 163'],
            ['bank' => 'DANAMON 503'],
        ]);
        $konsumens = Konsumen::all();
        return view('out.penjualan-tf.index', compact('data', 'bank', 'konsumens'));
    }

    public function store(Request $request)
    {
        $konsumen = Konsumen::where('nama',  $request->nama_konsumen)->first();

        if (!$konsumen) {
            return redirect()->back()->with('delete', 'Error, Nama Konsumen Tidak Ada Didatabase!');
        }

        // STORE PENJUALAN TF
        $new_data = PenjualanTF::create([
            'toko'          => 'TOKO NGANJUK',
            'nama_konsumen' => $request->nama_konsumen,
            'bank'          => $request->bank,
            'total'         => $request->total,
            'tf'            => $request->tf
        ]);

        // STORE DETAIL PENJUALAN TF
        $detail_data = $request->data;

        foreach ($detail_data as $item => $value) {
            $new_detail = DetailPenjualanTF::create([
                'penjualan_tf_id'         => $new_data->id,
                'nama_barang_dan_no_lot'    => $value['nama_barang_dan_no_lot'],
                'harga'                     => $value['harga'],
                'qty'                       => $value['qty'],
                'diskon'                    => $value['diskon'],
                'sub_total'                 => $value['subtotal']
            ]);
        }

        return redirect()->route('print.penjualan.tf')->with(compact('new_data'));
    }

    public function report()
    {
        return view('report.r-penjualan-tf.index');
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PenjualanTF::query();
            return DataTables::of($data)
                ->editColumn('created_at', function ($params) {
                    return Carbon::parse($params->created_at)->format('j F Y');
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'penjualan-tf');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function table($id)
    {
        $data = DetailPenjualanTF::where('penjualan_tf_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $head  = PenjualanTF::find($id);
        $data = DetailPenjualanTF::where('penjualan_tf_id', $id)->get();
        $barang = Barang::select('nama')->get();
        return view('report.r-penjualan-tf.edit', compact('data', 'barang', 'head'));
    }

    public function update($id, Request $request)
    {
        $data = DetailPenjualanTF::find($id);
        $data->update([
            'nama_barang_dan_no_lot' => $request->nama_barang_dan_no_lot,
            'harga'                  => $request->harga,
            'qty'                    => $request->qty,
            'diskon'                 => $request->diskon,
            'sub_total'              => ($request->harga * $request->qty)
        ]);
        $head = PenjualanTF::find($data->penjualan_tf_id);
        $total_penjualan = $head->detailPenjualanTf->sum('sub_total') - $head->detailPenjualanTf->sum('diskon');
        $head->update([ 'total' => $total_penjualan,
                        'tf' => $total_penjualan]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = PenjualanTF::find($id);
        DetailPenjualanTF::where('penjualan_tf_id', $data->id)->delete();
        $data->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function updateInduk(Request $request, $id)
    {
        $data = PenjualanTF::find($id);
        $data->update([
            'nama_konsumen' => $request->nama_konsumen,
            'created_at'    => $request->created_at,
        ]);

        // UPDATE DETAIL PENJUALAN
        $dataDetail = DetailPenjualanTF::where('penjualan_tf_id', $id)->get();
        foreach ($dataDetail as $item) {
            $item->update([
                'created_at' => $request->created_at,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }
}
