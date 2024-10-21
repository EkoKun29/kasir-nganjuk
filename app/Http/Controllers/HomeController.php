<?php

namespace App\Http\Controllers;

use App\Models\BarterCash;
use App\Models\DetailPembayaranPiutangRetur;
use App\Models\DetailPenjualanCash;
use App\Models\DetailPenjualanPiutang;
use App\Models\DetailPenjualanTF;
use App\Models\DetailReturPembelianGudang;
use App\Models\DetailReturPembelianNa;
use App\Models\DetailReturPenjualan;
use App\Models\KasKeluarOperasional;
use App\Models\NominalAwal;
use App\Models\PembayaranPiutangCash;
use App\Models\PembayaranPiutangRetur;
use App\Models\PembelianNa;
use App\Models\PembelianNaTF;
use App\Models\PenjualanCash;
use App\Models\PenjualanPiutang;
use App\Models\PenjualanTF;
use App\Models\PindahKasCash;
use App\Models\PindahKasTf;
use App\Models\ReturPembelianGudang;
use App\Models\ReturPembelianNa;
use App\Models\ReturPenjualan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // PERHITUNGAN SALDO KAS
        $saldo_awal_kas             = NominalAwal::sum('kas');
        $pembelian_distributor_cash = PembelianNa::sum('tunai');
        $pindah_kas_tf              = PindahKasTf::sum('nominal');
        $pindah_kas_cash            = PindahKasCash::sum('nominal');
        $kas_keluar_operasional     = KasKeluarOperasional::sum('nominal');
        $penjualan_cash             = PenjualanCash::sum('total');
        $pembayaran_piutang_cash    = PembayaranPiutangCash::sum('tunai');
        $barter_cash                = BarterCash::sum('cash');

        // PERHITUNGAN SALDO BANK
        $saldo_awal_bank            = NominalAwal::sum('saldo_bank');
        $pembelian_tf               = PembelianNaTF::sum('tf');
        $penjualan_tf               = PenjualanTF::sum('tf');
        $pembayaran_piutang_tf      = PembayaranPiutangCash::sum('tf');

        // PERHITUNGAN HUTANG
        $hutang                     = PembelianNa::sum('hutang');

        // PERHITUNGAN PIUTANG
        $piutang                    = PenjualanPiutang::sum('total');

        // DATA
        $saldo_kas  = $saldo_awal_kas - $pembelian_distributor_cash - $pindah_kas_tf - $pindah_kas_cash - $kas_keluar_operasional + $penjualan_cash + $pembayaran_piutang_cash + $barter_cash;
        $saldo_bank = $saldo_awal_bank - $pembelian_tf + $penjualan_tf + $pembayaran_piutang_tf;
        return view('home', compact('saldo_kas', 'saldo_bank'));
    }


    // ------------------- IN ------------------- //
    public function print_pembayaran_piutang_retur()
    {
        $new_data = session('new_data');
        $details = DetailPembayaranPiutangRetur::where('piutang_retur_id', $new_data->id)->get();

        return view('print.pembayaran_piutang_retur', compact('new_data', 'details'));
    }

    public function print_retur_penjualan()
    {
        $new_data = session('new_data');
        $details = DetailReturPenjualan::where('retur_penjualan_id', $new_data->id)->get();

        return view('print.retur_penjualan', compact('new_data', 'details'));
    }

    // ------------------- OUT ------------------- //
    public function print_cash()
    {
        $new_data = session('new_data');
        $details = DetailPenjualanCash::where('penjualan_cash_id', $new_data->id)->get();

        return view('print.penjualan_cash', compact('new_data', 'details'));
    }

    public function print_piutang()
    {
        $new_data = session('new_data');
        $details = DetailPenjualanPiutang::where('penjualan_piutang_id', $new_data->id)->get();

        return view('print.penjualan_piutang', compact('new_data', 'details'));
    }

    public function print_tf()
    {
        $new_data = session('new_data');
        $details = DetailPenjualanTF::where('penjualan_tf_id', $new_data->id)->get();

        return view('print.penjualan_tf', compact('new_data', 'details'));
    }

    public function print_retur_pembelian_na()
    {
        $new_data = session('new_data');
        $details = DetailReturPembelianNa::where('retur_pembelian_na_id', $new_data->id)->get();

        return view('print.retur_pembelian_na', compact('new_data', 'details'));
    }

    public function print_retur_pembelian_gudang()
    {
        $new_data = session('new_data');
        $details = DetailReturPembelianGudang::where('retur_pembelian_gudang_id', $new_data->id)->get();

        return view('print.retur_pembelian_gudang', compact('new_data', 'details'));
    }

    // ------------------- REPRINT ------------------- //
    public function reprint_cash($id)
    {
        $details = DetailPenjualanCash::where('penjualan_cash_id', $id)->get();
        $new_data = PenjualanCash::find($id);
        return view('print.penjualan_cash', compact('new_data', 'details'));
    }

    public function reprint_piutang($id)
    {
        $details = DetailPenjualanPiutang::where('penjualan_piutang_id', $id)->get();
        $new_data = PenjualanPiutang::find($id);
        return view('print.penjualan_piutang', compact('new_data', 'details'));
    }

    public function reprint_tf($id)
    {
        $details = DetailPenjualanTF::where('penjualan_tf_id', $id)->get();
        $new_data = PenjualanTF::find($id);
        return view('print.penjualan_tf', compact('new_data', 'details'));
    }

    public function reprint_retur_pembelian_na($id)
    {
        $details = DetailReturPembelianNa::where('retur_pembelian_na_id', $id)->get();
        $new_data = ReturPembelianNa::find($id);
        return view('print.retur_pembelian_na', compact('new_data', 'details'));
    }

    public function reprint_retur_pembelian_gudang($id)
    {
        $details = DetailReturPembelianGudang::where('retur_pembelian_gudang_id', $id)->get();
        $new_data = ReturPembelianGudang::find($id);
        return view('print.retur_pembelian_gudang', compact('new_data', 'details'));
    }

    public function reprint_pembayaran_piutang_na($id)
    {
        $details = DetailPembayaranPiutangRetur::where('piutang_retur_id', $id)->get();
        $new_data = PembayaranPiutangRetur::find($id);
        return view('print.pembayaran_piutang_retur', compact('new_data', 'details'));
    }

    public function reprint_retur_penjualan($id)
    {
        $details = DetailReturPenjualan::where('retur_penjualan_id', $id)->get();
        $new_data = ReturPenjualan::find($id);
        return view('print.retur_penjualan', compact('new_data', 'details'));
    }
}
