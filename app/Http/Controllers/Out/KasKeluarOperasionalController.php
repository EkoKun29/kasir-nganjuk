<?php

namespace App\Http\Controllers\Out;

use App\Http\Controllers\Controller;
use App\Models\KasKeluarOperasional;
use App\Traits\Buttons;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KasKeluarOperasionalController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = collect([
            ['type' => 'BIAYA MAKAN DAN MINUM'],
            ['type' => 'BIAYA BBM'],
            ['type' => 'BIAYA PULSA DAN INTERNET'],
            ['type' => 'BIAYA PEMELIHARAAN SISTEM'],
            ['type' => 'BIAYA TOLL'],
            ['type' => 'BIAYA HOTEL'],
            ['type' => 'BIAYA LAIN-LAIN'],
            ['type' => 'BIAYA PERLENGKAPAN SALES'],
            ['type' => 'BIAYA SHODAQOH'],
        ]);
        return view('out.kas-keluar-operasional.index', compact('data'));
    }

    public function store(Request $request)
    {
        KasKeluarOperasional::create($request->except('_token'));
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = KasKeluarOperasional::find($id);
        $data->update($request->except('_token'));
        return redirect()->route('kas-keluar-operasional.index')->with('success', 'Data berhasil diupdate');
    }

    public function edit($id)
    {
        $data = KasKeluarOperasional::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = KasKeluarOperasional::query();
            return DataTables::of($data)
                ->addColumn('action', function ($params) {
                    return $this->_CheckRole($params,'');
                })
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function destroy($id)
    {
        KasKeluarOperasional::find($id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
