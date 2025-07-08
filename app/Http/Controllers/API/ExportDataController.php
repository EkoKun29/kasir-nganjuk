<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPenjualanCash;
use App\Models\DetailPenjualanPiutang;
use App\Models\DetailPenjualanTF;
use App\Models\DetailReturPembelianNa;
use App\Models\DetailReturPenjualan;
use App\Models\KasKeluarOperasional;
use App\Models\PembayaranPiutangCash;
use App\Models\PembelianAl;
use App\Models\PembelianNa;
use App\Models\PembelianNaTF;
use App\Models\PembelianTele;
use App\Models\PindahKasCash;
use App\Models\PindahKasTf;
use App\Models\PindahStockIn;
use App\Models\PindahStockOut;

class ExportDataController extends Controller
{
    public function indexPembelianTele($startDate, $endDate)
    {
        $pembelianTele = PembelianTele::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();
        return response()->json($pembelianTele);
    }

    public function indexPembelianNa($startDate, $endDate)
    {
        $pembelianNaCash = PembelianAl::whereNot('nama_suplier', 'ALIANSYAH')
            ->whereNot('nama_suplier', 'CV. ALIANSYAH')
            ->whereNot('nama_suplier', 'CV Aliansyah')->whereDate('tanggal', '>=', $startDate)
            ->whereDate('tanggal', '<=', $endDate)->get();

        $pembelianNaHutang = PembelianNa::whereNot('nama_suplier', 'ALIANSYAH')
            ->whereNot('nama_suplier', 'CV. ALIANSYAH')
            ->whereNot('nama_suplier', 'CV Aliansyah')->whereDate('tanggal', '>=', $startDate)
            ->whereDate('tanggal', '<=', $endDate)->get();

        $pembelianNa = $pembelianNaCash->concat($pembelianNaHutang);

        return response()->json($pembelianNa);
    }

    public function indexPenjualan($startDate, $endDate)
    {
        $detailPenjualanCash = DetailPenjualanCash::with('PenjualanCash')->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();
        $detailPenjualanPiutang = DetailPenjualanPiutang::with('PenjualanPiutang')->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();
        $detailPenjualanTf = DetailPenjualanTF::with('PenjualanTF')->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();
        
        $detailPenjualan = $detailPenjualanCash->concat($detailPenjualanPiutang)->concat($detailPenjualanTf);

        return  response()->json($detailPenjualan);
    }

    public function indexReturPenjualan($startDate, $endDate)
    {
        $detailReturPenjualan = DetailReturPenjualan::with('ReturPenjualan')->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();

        return response()->json($detailReturPenjualan);
    }

    public function indexReturPembelianNa($startDate, $endDate)
    {
        $detailReturPembelianNa = DetailReturPembelianNa::with('ReturPembelianNa')->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();

        return response()->json($detailReturPembelianNa);
    }

    public function indexPindahStockIn($startDate, $endDate)
    {
        $pindahStockIn = PindahStockIn::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();

        return response()->json($pindahStockIn);
    }

    public function indexPindahStockOut($startDate, $endDate)
    {
        $pindahStockOut = PindahStockOut::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();

        return response()->json($pindahStockOut);
    }

    public function indexKasKeluarOperasional($startDate, $endDate)
    {
        $kasKeluarOperasional = KasKeluarOperasional::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();

        return response()->json($kasKeluarOperasional);
    }

    public function indexPindahKasTf($startDate, $endDate)
    {
        $pindahKasTf = PindahKasTf::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();

        return response()->json($pindahKasTf);
    }

    public function indexPembayaranPiutangCash($startDate, $endDate)
    {
        $pembayaranPiutangCash = PembayaranPiutangCash::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();

        return response()->json($pembayaranPiutangCash);
    }
}
