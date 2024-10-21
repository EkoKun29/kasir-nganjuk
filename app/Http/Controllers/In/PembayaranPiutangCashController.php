<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\PembayaranPiutangCash;
use App\Models\PenjualanPiutang;
use App\Traits\Buttons;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembayaranPiutangCashController extends Controller
{
    use Buttons;

    public function index()
    {
        $bank = collect([
            ['bank' => 'BNI 898'],
            ['bank' => 'BRI 302'],
            ['bank' => 'BRI 503'],
            ['bank' => 'BRI 500'],
            ['bank' => 'BRI 536'],
            ['bank' => 'MANDIRI 522'],
            ['bank' => 'MANDIRI 016'],
            ['bank' => 'MANDIRI 442'],
            ['bank' => 'BCA 703'],
            ['bank' => 'BCA 163'],
            ['bank' => 'DANAMON 503'],
        ]);
        $no_nota = PenjualanPiutang::select('no_nota')->get();
        $konsumens = Konsumen::all();
        return view('in.pembayaran-piutang-cash.index', compact('bank', 'no_nota', 'konsumens'));
    }

    public function store(Request $request)
    {
        $konsumen = Konsumen::where('nama',  $request->nama_konsumen)->first();

        if (!$konsumen) {
            return redirect()->back()->with('delete', 'Error, Nama Konsumen Tidak Ada Didatabase!');
        }

        PembayaranPiutangCash::create($request->except('_token'));
        // $piutang    = PenjualanPiutang::where('no_nota', $data->no_nota_piutang)->first();

        // // SISA = TOTAL - TUNAI - TF
        // $sisa       = $piutang->total - $data->tunai - $data->tf;

        // if ($sisa < 0) {
        //     return redirect()->back()->with('delete', 'Pembayaran melebihi total piutang');
        // }

        // $piutang->update([
        //     'sisa' => $sisa
        // ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $konsumen = Konsumen::where('nama',  $request->nama_konsumen)->first();

        if (!$konsumen) {
            return redirect()->back()->with('delete', 'Error, Nama Konsumen Tidak Ada Didatabase!');
        }

        $data       = PembayaranPiutangCash::find($id);
        // $piutang    = PenjualanPiutang::where('no_nota', $data->no_nota_piutang)->first();

        // // MENGEMBALIKAN NILAI SISA
        // $sebelum_sisa   = $piutang->sisa + $data->tunai + $data->tf;

        // // UPDATE SISA
        // $sisa           = $sebelum_sisa - $request->tunai - $request->tf;

        // if ($sisa < 0) {
        //     return redirect()->back()->with('delete', 'Pembayaran melebihi total piutang');
        // }

        $data->update(
            array_merge(
                $request->except('_token'),
                [
                    'created_at' => $request->tgl_bayar,
                    'updated_at' => $request->tgl_bayar
                ]
            )
        );
        // $piutang->update([
        //     'sisa' => $sisa
        // ]);
        return redirect()->route('pembayaran-piutang-cash.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $data = PembayaranPiutangCash::find($id);
        $no_nota = PenjualanPiutang::select('no_nota')->get();

        return response()->json([
            'data' => $data,
            'no_nota' => $no_nota,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PembayaranPiutangCash::query();
            return DataTables::of($data)
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, 'pembayaran-piutang-cash');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function destroy($id)
    {
        PembayaranPiutangCash::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
