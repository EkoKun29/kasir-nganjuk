<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\BankKeTtb;
use Illuminate\Http\Request;

class AmbilUangTtbController extends Controller
{
    public function index()
    {
        $data   = BankKeTtb::query()->paginate(10);
        $total  = BankKeTtb::count();
        $bank = collect([
            ['bank' => 'BRI'],
            ['bank' => 'BCA'],
            ['bank' => 'MANDIRI'],
        ]);
        return view('ambil-uang-di-bank.ttb.index', compact('data', 'total', 'bank'));
    }

    public function store(Request $request)
    {
        BankKeTtb::create($request->except('_token', '_method'));
        return redirect()->back()->with('success', 'Nominal berhasil ditambahkan');
    }

    public function update(Request $request, BankKeTtb $ambil_uang_ttb)
    {
        $ambil_uang_ttb->update($request->except('_token', '_method'));
        return redirect()->back()->with('success', 'Nominal berhasil diupdate');
    }

    public function destroy(BankKeTtb $ambil_uang_ttb)
    {
        $ambil_uang_ttb->delete();
        return redirect()->back()->with('delete', 'Nominal berhasil dihapus');
    }
}
