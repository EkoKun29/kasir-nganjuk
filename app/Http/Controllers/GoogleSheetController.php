<?php

namespace App\Http\Controllers;

use App\Models\DetailPembayaranPiutangRetur;
use App\Models\DetailPenjualanCash;
use App\Models\DetailPenjualanPiutang;
use App\Models\DetailPenjualanTF;
use App\Models\DetailReturPembelianGudang;
use App\Models\DetailReturPembelianNa;
use App\Models\DetailReturPenjualan;
use App\Models\KasKeluarOperasional;
use App\Models\PembayaranPiutangCash;
use App\Models\PembelianAl;
use App\Models\PembelianNa;
use App\Models\PembelianNaTF;
use App\Models\PindahKasCash;
use App\Models\PindahKasTf;
use App\Models\PindahStockIn;
use App\Models\PindahStockOut;
use App\Models\StockAwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoogleSheetController extends Controller
{

    public function indexPembelianNa($startDate, $endDate)
    {
        $pembelianNaCash = PembelianAl::whereNot('nama_suplier', 'ALIANSYAH')
            ->whereNot('nama_suplier', 'CV. ALIANSYAH')
            ->whereNot('nama_suplier', 'CV Aliansyah')
            ->whereBetween('created_at', [$startDate, $endDate])->get();

        $pembelianNaHutang = PembelianNa::whereNot('nama_suplier', 'ALIANSYAH')
            ->whereNot('nama_suplier', 'CV. ALIANSYAH')
            ->whereNot('nama_suplier', 'CV Aliansyah')
            ->whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.pembelian-na-cash', compact('pembelianNaCash', 'pembelianNaHutang'));
    }

    public function indexPenjualan($startDate, $endDate)
    {
        $detailPenjualanCash = DetailPenjualanCash::whereBetween('created_at', [$startDate, $endDate])->get();
        $detailPenjualanPiutang = DetailPenjualanPiutang::whereBetween('created_at', [$startDate, $endDate])->get();
        $detailPenjualanTf = DetailPenjualanTF::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.penjualan', compact('detailPenjualanCash', 'detailPenjualanPiutang', 'detailPenjualanTf'));
    }

    public function indexReturPenjualan($startDate, $endDate)
    {
        $detailReturPenjualan = DetailReturPenjualan::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.retur-penjualan', compact('detailReturPenjualan'));
    }

    public function indexReturPembelianNa($startDate, $endDate)
    {
        $detailReturPembelianNa = DetailReturPembelianNa::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.retur-pembelian-na', compact('detailReturPembelianNa'));
    }

    public function indexPindahStockIn($startDate, $endDate)
    {
        $pindahStockIn = PindahStockIn::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.pindah-stock-in', compact('pindahStockIn'));
    }

    public function indexPindahStockOut($startDate, $endDate)
    {
        $pindahStockOut = PindahStockOut::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.pindah-stock-out', compact('pindahStockOut'));
    }

    public function indexKasKeluarOperasional($startDate, $endDate)
    {
        $kasKeluarOperasional = KasKeluarOperasional::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.kas-keluar-operasional', compact('kasKeluarOperasional'));
    }

    public function indexPindahKasTf($startDate, $endDate)
    {
        $pindahKasTf = PindahKasTf::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.pindah-kas-tf', compact('pindahKasTf'));
    }

    public function indexPembayaranPiutangCash($startDate, $endDate)
    {
        $pembayaranPiutangCash = PembayaranPiutangCash::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('export-google-sheet.pembayaran-piutang-cash', compact('pembayaranPiutangCash'));
    }
}
