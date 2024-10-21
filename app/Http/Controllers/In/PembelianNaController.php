<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Models\PembelianNa;
use App\Traits\Buttons;
use App\Traits\Formatting;
use App\Traits\Stock;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembelianNaController extends Controller
{
    use Buttons, Stock, Formatting;

    public function index()
    {
        // HIT API SUPPLIER
        try {
            $client = new Client();

            $url = "https://script.googleusercontent.com/macros/echo?user_content_key=wymnaJdgaf9PWebGlr6AKtqbMTeb8sLMViKDXwZjZ_WUdufnJCPBF0h4h8YQR4vV2opWJTKtY5BCfmH_WRf_RaBG_-oIpW3-OJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHa97Jlfpqb5gk5DD9ga4qFp9vsAFaor28-33lfEd9aDExbHFKlnzT0cG5-eiLc3q17JDeUbMBS6kZWsCtmzGBfg6vHprm2nCKwQtBHn44AOQPcZzeRtEUbgGWVkaSvQ_EsQ&lib=MwrS5UL2suXhr7r5eut16IRQ628Yks6X1";

            $response = $client->request('GET', $url, [
                'verify'  => false,
            ]);

            $data = json_decode($response->getBody());
            $suppliers = collect($data); // Change to collection
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal Mengambil Data Supplier!.');
        }

        $data = Barang::all();
        return view('in.pembelian-na.index', compact('data', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = new PembelianNa();
        $data->tanggal = $request->tanggal;
        $data->no_nota = $request->no_nota;
        $data->atas_nama_sales = $request->atas_nama_sales;
        $data->yang_bawa_barang = $request->yang_bawa_barang;
        $data->nama_suplier = $request->nama_suplier;
        $data->nama_barang = $request->nama_barang;
        $data->no_lot = "0";
        $data->nama_barang_dan_no_lot = $request->nama_barang;
        $data->harga = $request->harga;
        $data->qty = $request->qty;
        $data->hutang = $request->harga * $request->qty;
        $data->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = PembelianNa::find($id);
        $total_hutang = $request->harga * $request->qty;

        $data->update($request->except('_token'));
        $data->update([
            'nama_barang' => $request->nama_barang,
            'nama_barang_dan_no_lot' => $data->nama_barang,
            'hutang' => $total_hutang,
        ]);

        return redirect()->route('pembelian-na.index');
    }

    public function edit($id)
    {
        $data = PembelianNa::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PembelianNa::query();
            return DataTables::of($data)
                ->editColumn('hutang', function ($params) {
                    return $this->_Money($params->hutang);
                })
                ->editColumn('tunai', function ($params) {
                    return $this->_Money($params->tunai);
                })
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params, '');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function destroy($id)
    {
        PembelianNa::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
