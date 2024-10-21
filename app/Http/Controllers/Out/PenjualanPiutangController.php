<?php

namespace App\Http\Controllers\Out;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\DetailPenjualanPiutang;
use App\Models\Konsumen;
use App\Models\PenjualanPiutang;
use App\Traits\Buttons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenjualanPiutangController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = Barang::get();
        $konsumens = Konsumen::all();
        return view('out.penjualan-piutang.index', compact('data', 'konsumens'));
    }

    public function store(Request $request)
    {
        //check konsumen is exist
        $konsumen = Konsumen::where('nama',  $request->nama_konsumen)->first();
        //check no_nota is exist
        $check = PenjualanPiutang::where('no_nota', $request->no_nota)->first();

        if ($check) {
            return redirect()->back()->with('delete', 'Error, No Nota Sudah Dipakai!');
        }
        if (!$konsumen) {
            return redirect()->back()->with('delete', 'Error, Nama Konsumen Tidak Ada Didatabase!');
        }

        //start transaction
        DB::beginTransaction();

        try {
            //store data penjualan piutang
            $new_data = PenjualanPiutang::create([
            'no_nota'       => $request->no_nota,
            'toko'          => 'TOKO NGANJUK',
            'nama_konsumen' => $request->nama_konsumen,
            'total'         => $request->total,
            'sisa'          => $request->total,
            ]);

            //store detail penjualan piutang
            $detail_data = $request->data;

            foreach ($detail_data as $item => $value) {
            $new_detail = DetailPenjualanPiutang::create([
                'penjualan_piutang_id'      => $new_data->id,
                'nama_barang_dan_no_lot'    => $value['nama_barang_dan_no_lot'],
                'harga'                     => $value['harga'],
                'qty'                       => $value['qty'],
                'diskon'                    => $value['diskon'],
                'sub_total'                 => $value['subtotal']
            ]);
            }

            //commit database transaction
            DB::commit();

            return redirect()->route('print.penjualan.piutang')->with(compact('new_data'));
        } catch (\Exception $e) {
            //rollback database transaction
            DB::rollback();

            return redirect()->back()->with('error', 'Error occurred while storing data. Please try again.');
        }
    }

    public function report()
    {
        return view('report.r-penjualan-piutang.index');
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PenjualanPiutang::query();
            return DataTables::of($data)
                ->editColumn('created_at', function ($params) {
                    return Carbon::parse($params->created_at)->format('j F Y');
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'penjualan-piutang');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function table($id)
    {
        $data = DetailPenjualanPiutang::where('penjualan_piutang_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $head  = PenjualanPiutang::find($id);
        $data   = DetailPenjualanPiutang::where('penjualan_piutang_id', $id)->get();
        $barang = Barang::select('nama')->get();
        return view('report.r-penjualan-piutang.edit', compact('head', 'data', 'barang'));
    }

    public function update($id, Request $request)
    {
        $data = DetailPenjualanPiutang::find($id);
        $data->update([
            'nama_barang_dan_no_lot' => $request->nama_barang_dan_no_lot,
            'harga'                  => $request->harga,
            'qty'                    => $request->qty,
            'diskon'                 => $request->diskon,
            'sub_total'              => ($request->harga * $request->qty)
        ]);
        $head = PenjualanPiutang::find($data->penjualan_piutang_id);
        $total_penjualan = $head->detailPenjualanPiutang->sum('sub_total') - $head->detailPenjualanPiutang->sum('diskon');
        $head->update([ 'total' => $total_penjualan]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = PenjualanPiutang::find($id);
        DetailPenjualanPiutang::where('penjualan_piutang_id', $data->id)->delete();
        $data->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function updateInduk(Request $request, $id)
    {
        $data = PenjualanPiutang::find($id);
        $data->update([
            'nama_konsumen' => $request->nama_konsumen,
            'created_at'    => $request->created_at,
            'no_nota'       => $request->no_nota,
        ]);

        // UPDATE DETAIL PENJUALAN
        $dataDetail = DetailPenjualanPiutang::where('penjualan_piutang_id', $id)->get();
        foreach ($dataDetail as $item) {
            $item->update([
                'created_at' => $request->created_at,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }
}
