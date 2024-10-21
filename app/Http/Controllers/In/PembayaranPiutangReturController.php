<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\DetailPembayaranPiutangRetur;
use App\Models\PembayaranPiutangRetur;
use App\Traits\Buttons;
use App\Traits\FromApi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembayaranPiutangReturController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = Barang::all();
        return view('in.pembayaran-piutang-retur.index', compact('data'));
    }

    public function store(Request $request)
    {
        // STORE PEMBAYARAN PIUTANG RETUR
        $new_data = PembayaranPiutangRetur::create([
            'toko'              => 'TOKO NGANJUK',
            'nama_konsumen'     => $request->nama_konsumen,
            'no_nota_piutang'   => $request->no_nota_piutang,
            'tgl_nota_piutang'  => $request->tgl_nota_piutang,
            'sisa_piutang'      => $request->sisa_piutang
        ]);

        // STORE DETAIL PEMBAYARAN PIUTANG RETUR
        $detail_data = $request->data;

        foreach ($detail_data as $item => $value) {
            DetailPembayaranPiutangRetur::create([
                'piutang_retur_id'         => $new_data->id,
                'nama_barang'               => $value['nama_barang'],
                'no_lot'                    => $value['no_lot'],
                'nama_barang_dan_no_lot'    => $value['nama_barang'] . ' // ' . $value['no_lot'],
                'harga'                     => $value['harga'],
                'qty'                       => $value['qty'],
                'sub_total'                 => $value['subtotal']
            ]);
        }

        return redirect()->route('print.pembayaran.piutang.retur')->with(compact('new_data'));
    }

    public function report()
    {
        return view('report.r-pembayaran-piutang.index');
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PembayaranPiutangRetur::query();
            return DataTables::of($data)
                ->editColumn('created_at', function ($params) {
                    return Carbon::parse($params->created_at)->format('j F Y');
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'pembayaran-piutang');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function table($id)
    {
        $data = DetailPembayaranPiutangRetur::where('piutang_retur_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $data = DetailPembayaranPiutangRetur::where('piutang_retur_id', $id)->get();
        $barang = Barang::all();
        return view('report.r-pembayaran-piutang.edit', compact('data', 'barang'));
    }

    public function update($id, Request $request)
    {
        $data = DetailPembayaranPiutangRetur::find($id);
        $data->update([
            'nama_barang' => $request->nama_barang,
            'no_lot' => $request->no_lot,
            'harga' => $request->harga,
            'qty' => $request->qty,
            'sub_total' => $request->harga * $request->qty
        ]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = PembayaranPiutangRetur::find($id);
        DetailPembayaranPiutangRetur::where('piutang_retur_id', $data->id)->delete();
        $data->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ]);
    }
}
