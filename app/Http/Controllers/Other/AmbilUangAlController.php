<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\BankKeAl;
use Illuminate\Http\Request;

class AmbilUangAlController extends Controller
{
    public function index()
    {
        $data   = BankKeAl::query()->paginate(10);
        $total  = BankKeAl::count();
        $bank = collect([
            ['bank' => 'BRI'],
            ['bank' => 'BCA'],
            ['bank' => 'MANDIRI'],
        ]);
        return view('ambil-uang-di-bank.aliansyah.index', compact('data', 'total', 'bank'));
    }

    public function store(Request $request)
    {
        BankKeAl::create($request->except('_token', '_method'));
        return redirect()->back()->with('success', 'Nominal berhasil ditambahkan');
    }

    public function update(Request $request, BankKeAl $ambil_uang_al)
    {
        $ambil_uang_al->update($request->except('_token', '_method'));
        return redirect()->back()->with('success', 'Nominal berhasil diupdate');
    }

    public function destroy(BankKeAl $ambil_uang_al)
    {
        $ambil_uang_al->delete();
        return redirect()->back()->with('delete', 'Nominal berhasil dihapus');
    }
}
