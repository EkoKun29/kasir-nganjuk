<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\DetailReturPenjualan;
use App\Models\PersediaanDagang;
use App\Models\ReturPenjualan;
use App\Traits\Buttons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class ReturPenjualanController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = Barang::all();
        return view('in.retur-penjualan.index', compact('data'));
    }

    public function indexCash()
    {
        $data = Barang::all();
        return view('in.retur-penjualan-cash.index', compact('data'));
    }

    public function indexPiutang()
    {
        $data = Barang::all();
        return view('in.retur-penjualan-piutang.index', compact('data'));
    }

    public function store(Request $request)
{
    DB::beginTransaction();
    try {
        // STORE RETUR PENJUALAN
        $new_data = ReturPenjualan::create([
            'toko'              => 'TOKO NGANJUK',
            'nama_konsumen'     => $request->nama_konsumen,
            'total'             => $request->total,
            'uang_keluar'       => $request->uang_keluar,
            'kembalian'         => $request->kembalian,
            'no_nota_piutang'   => $request->no_nota_piutang,
            'tgl_nota_piutang'  => $request->tgl_nota_piutang,
            'sisa_piutang'      => $request->sisa_piutang
        ]);

        // STORE DETAIL RETUR PENJUALAN
        $detail_data = $request->data;
        foreach ($detail_data as $item => $value) {
            DetailReturPenjualan::create([
                'retur_penjualan_id'        => $new_data->id,
                'nama_barang'               => $value['nama_barang'],
                'no_lot'                    => 0,
                'nama_barang_dan_no_lot'    => $value['nama_barang'],
                'harga'                     => $value['harga'],
                'qty'                       => $value['qty'],
                'sub_total'                 => $value['subtotal']
            ]);
        }

        DB::commit();
        return redirect()->route('print.retur.penjualan')->with(compact('new_data'));
    } catch (\Exception $e) {
        DB::rollBack();

        // Log error ke storage/logs/laravel.log
        Log::error('Error saat menyimpan retur penjualan: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

    public function report()
    {
        return view('report.r-retur-penjualan.index');
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = ReturPenjualan::query();
            return DataTables::of($data)
                ->editColumn('created_at', function ($params) {
                    return Carbon::parse($params->created_at)->format('j F Y');
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'retur-penjualan');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function table($id)
    {
        $data = DetailReturPenjualan::where('retur_penjualan_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $head  = ReturPenjualan::find($id);
        $data   = DetailReturPenjualan::where('retur_penjualan_id', $id)->get();
        $barang = Barang::all();
        return view('report.r-retur-penjualan.edit', compact('head','data', 'barang'));
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $data = DetailReturPenjualan::find($id);
            $data->update([
            'nama_barang'            => $request->nama_barang,
            'harga'                  => $request->harga,
            'qty'                    => $request->qty,
            'sub_total'              => ($request->harga * $request->qty),
            'hpp'                    => $request->hpp
            ]);
            $head = ReturPenjualan::find($data->retur_penjualan_id);
            $total_retur = $head->detailReturPenjualan->sum('sub_total');
            $head->update(['total' => $total_retur]);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', 'Error! Data gagal diubah!');
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = ReturPenjualan::find($id);
            DetailReturPenjualan::where('retur_penjualan_id', $data->id)->delete();
            $data->delete();
            DB::commit();
            return response()->json([
            'data' => $data,
            'message' => 'Success'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
            'message' => 'Error',
            'error' => $e->getMessage()
            ]);
        }
    }

    public function updateInduk(Request $request, $id)
    {
        $data = ReturPenjualan::find($id);
        $data->update([
            'nama_konsumen' => $request->nama_konsumen,
            'no_nota_piutang' => $request->no_nota_piutang,
            'tgl_nota_piutang' => $request->tgl_nota_piutang,
            'created_at'    => $request->created_at,
            'uang_keluar' => $request->uang_keluar,
            'sisa_piutang' => $request->sisa_piutang,
        ]);
        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }
}
