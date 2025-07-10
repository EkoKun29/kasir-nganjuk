<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\PembelianTele;
use Illuminate\Http\Request;
use App\Traits\Buttons;
use App\Traits\Stock;
use Yajra\DataTables\Facades\DataTables;
use GuzzleHttp\Client;

class PembelianTeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Buttons;

    public function index()
    {
        $client2 = new Client();

        $url2 = "https://gudangbaru.dodolanobattani.com/api/no-surat";

        $response2 = $client2->request('GET', $url2, [
            'verify'  => false,
        ]);

        $dataApi2 = json_decode($response2->getBody());
        $surat = collect($dataApi2); // Change to collection


        $client = new Client();

        $url = "https://script.google.com/macros/s/AKfycbwo2HwRj3LEq7nsj4LK_m_WXXXhf42VTUiXnIIuDE4XW0NN3BQqvC5znH6vYt2zSNcO/exec";

        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        $dataApi = json_decode($response->getBody());
        $hpp = collect($dataApi); // Change to collection
        $data = Barang::all();
        $bayar = collect([
            ['via' => 'CASH'],
            ['via' => 'HUTANG'],
        ]);
        return view('in.pembelian-tele.index', compact('data', 'bayar', 'hpp', 'surat'));
    }

    public function store(Request $request)
    {
        $pembelianTele = new PembelianTele();
        $pembelianTele->tanggal = $request->tanggal;
        $pembelianTele->no_nota = $request->no_nota;
        $pembelianTele->atas_nama_sales = $request->atas_nama_sales;
        $pembelianTele->yang_bawa_barang = $request->yang_bawa_barang;
        $pembelianTele->nama_suplier = $request->nama_suplier;
        $pembelianTele->nama_barang = $request->nama_barang;
        $pembelianTele->no_lot = '0';
        $pembelianTele->nama_barang_dan_no_lot = $request->nama_barang;
        $pembelianTele->harga = $request->harga;
        $pembelianTele->qty = $request->qty;

        if ($request->pembayaran === 'CASH') {
            $pembelianTele->cash = $request->harga * $request->qty;
            $pembelianTele->hutang = 0;
        } elseif ($request->pembayaran === 'HUTANG') {
            $pembelianTele->hutang = $request->harga * $request->qty;
            $pembelianTele->cash = 0;
        }

        $pembelianTele->save();
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = PembelianTele::find($id);
        $total_cash = $request->harga * $request->qty;

        $data->update($request->except('_token'));
        $data->update([
            'nama_barang' => $request->nama_barang,
            'nama_barang_dan_no_lot' => $data->nama_barang,
            'cash'=>$total_cash,
        ]);
        return redirect()->route('pembelian-tele.index');
    }

    public function edit($id)
    {
        $data = PembelianTele::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PembelianTele::query();
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

        PembelianTele::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }


}
