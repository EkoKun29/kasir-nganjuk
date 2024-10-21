<?php

namespace App\Http\Controllers;

use App\Models\PindahKasCash;
use App\Traits\Buttons;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PindahKasCashController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = collect([
            ['kas' => 'KAS ALIANSYAH'],
            ['kas' => 'KAS TTB'],
            ['kas' => 'LAIN-LAIN'],
        ]);
        return view('out.pindah-kas-cash.index', compact('data'));
    }

    public function store(Request $request)
    {
        PindahKasCash::create($request->except('_token'));
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = PindahKasCash::find($id);
        $data->update($request->except('_token'));
        return redirect()->route('pindah-kas-cash.index');
    }

    public function edit($id)
    {
        $data = PindahKasCash::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PindahKasCash::query();
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
        PindahKasCash::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
