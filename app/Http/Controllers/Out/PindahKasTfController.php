<?php

namespace App\Http\Controllers\Out;

use App\Http\Controllers\Controller;
use App\Models\PindahKasTf;
use App\Traits\Buttons;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PindahKasTfController extends Controller
{
    use Buttons;

    public function index()
    {
        $data = collect([
            ['bank' => 'BRI'],
            ['bank' => 'BCA'],
            ['bank' => 'MANDIRI'],
        ]);
        return view('out.pindah-kas-tf.index', compact('data'));
    }

    public function store(Request $request)
    {
        PindahKasTf::create($request->except('_token'));
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = PindahKasTf::find($id);
        $data->update($request->except('_token'));
        return redirect()->route('pindah-kas-tf.index');
    }

    public function edit($id)
    {
        $data = PindahKasTf::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PindahKasTf::query();
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
        PindahKasTf::where('id', $id)->delete();
        return response()->json([
            'delete' => 'Data Berhasil Dihapus!.',
        ]);
    }
}
