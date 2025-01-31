<?php

namespace App\Http\Controllers\Out;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\DetailPenjualanCash;
use App\Models\Konsumen;
use App\Models\PenjualanCash;
use App\Traits\Buttons;
use App\Traits\Formatting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanCashController extends Controller
{
    use Buttons, Formatting;

    public function index()
    {
        $data = Barang::get();
        $konsumens = Konsumen::all();
        return view('out.penjualan-cash.index', compact('data', 'konsumens'));
    }

    public function store(Request $request)
{
    // Menyimpan data retur penjualan ke dalam array (simulasi tanpa DB)
    $new_data = [
        'toko'              => 'TOKO NGANJUK',
        'nama_konsumen'     => $request->nama_konsumen,
        'total'             => $request->total,
        'uang_keluar'       => $request->uang_keluar,
        'kembalian'         => $request->kembalian,
        'no_nota_piutang'   => $request->no_nota_piutang,
        'tgl_nota_piutang'  => $request->tgl_nota_piutang,
        'sisa_piutang'      => $request->sisa_piutang
    ];

    // Menyimpan detail retur penjualan ke dalam array (simulasi tanpa DB)
    $detail_data = [];
    foreach ($request->data as $value) {
        $detail_data[] = [
            'nama_barang'               => $value['nama_barang'],
            'no_lot'                    => 0, // Sesuaikan dengan logika Anda
            'nama_barang_dan_no_lot'    => $value['nama_barang'],
            'harga'                     => $value['harga'],
            'qty'                       => $value['qty'],
            'sub_total'                 => $value['subtotal']
        ];
    }

    // Menyimpan data ke session agar bisa digunakan di view
    session([
        'new_data' => $new_data,
        'detail_data' => $detail_data
    ]);

    // Mengembalikan respons atau redirect ke halaman print
    return response()->json([
        'message' => 'Data berhasil disimpan (simulasi tanpa DB)',
        'redirect_url' => route('print.retur.penjualan')
    ]);
}


    public function report()
    {
        return view('report.r-penjualan-cash.index');
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PenjualanCash::query();
            return DataTables::of($data)
                ->editColumn('total', function ($params) {
                    return $this->_Money($params->total);
                })
                ->editColumn('bayar', function ($params) {
                    return $this->_Money($params->bayar);
                })
                ->editColumn('kembalian', function ($params) {
                    return $this->_Money($params->kembalian);
                })
                ->editColumn('created_at', function ($params) {
                    return Carbon::parse($params->created_at)->format('j F Y');
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'penjualan-cash');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function table($id)
    {
        $data = DetailPenjualanCash::where('penjualan_cash_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $head  = PenjualanCash::find($id);
        $data   = DetailPenjualanCash::where('penjualan_cash_id', $id)->get();
        $barang = Barang::select('nama')->get();
        return view('report.r-penjualan-cash.edit', compact('head','data', 'barang'));
    }

    public function update($id, Request $request)
    {
        $data = DetailPenjualanCash::find($id);
        $data->update([
            'nama_barang_dan_no_lot' => $request->nama_barang_dan_no_lot,
            'harga'                  => $request->harga,
            'qty'                    => $request->qty,
            'diskon'                 => $request->diskon,
            'sub_total'              => ($request->harga * $request->qty)
        ]);
        $head = PenjualanCash::find($data->penjualan_cash_id);
        $total_penjualan = $head->detailPenjualanCash->sum('sub_total') - $head->detailPenjualanCash->sum('diskon');
        $head->update([ 'total' => $total_penjualan,
                        'bayar' => $total_penjualan]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = PenjualanCash::find($id);
        DetailPenjualanCash::where('penjualan_cash_id', $data->id)->delete();
        $data->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function updateInduk(Request $request, $id)
    {
        $data = PenjualanCash::find($id);
        $data->update([
            'nama_konsumen' => $request->nama_konsumen,
            'created_at'    => $request->created_at,
        ]);

        // UPDATE DETAIL PENJUALAN
        $dataDetail = DetailPenjualanCash::where('penjualan_cash_id', $id)->get();
        foreach ($dataDetail as $item) {
            $item->update([
                'created_at' => $request->created_at,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }
}
