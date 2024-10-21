<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PersediaanDagang;
use Illuminate\Http\Request;

class PersediaanDagangController extends Controller
{
    public function index()
    {
        $data   = PersediaanDagang::All();
        $total  = PersediaanDagang::count();
        return view('output.persediaan-dagang.index', compact('data', 'total'));
    }

    public function delete($id)
    {
        $data = PersediaanDagang::where('id', $id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
