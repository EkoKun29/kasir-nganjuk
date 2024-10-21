<?php

use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\BarterCashController;
use App\Http\Controllers\BarterPiutangController;
use App\Http\Controllers\BukuHutangController;
use App\Http\Controllers\BukuPiutangController;
use App\Http\Controllers\GoogleSheetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\In\PembayaranPiutangCashController;
use App\Http\Controllers\In\PembayaranPiutangReturController;
use App\Http\Controllers\In\PindahStockInController;
use App\Http\Controllers\Out\KasKeluarOperasionalController;
use App\Http\Controllers\Out\PindahKasTfController;
use App\Http\Controllers\Out\PindahStockOutController;
use App\Http\Controllers\In\PembelianAliansyahController;
use App\Http\Controllers\In\PembelianNaController;
use App\Http\Controllers\In\PembelianNaTFController;
use App\Http\Controllers\In\PembelianTeleController;
use App\Http\Controllers\In\ReturPenjualanController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\ReturPenjualanCashController;
use App\Http\Controllers\Manajemen\UserController;
use App\Http\Controllers\Other\AmbilUangAlController;
use App\Http\Controllers\Other\AmbilUangTtbController;
use App\Http\Controllers\Other\NominalAwalController;
use App\Http\Controllers\Other\StockAwalController;
use App\Http\Controllers\Out\PenjualanCashController;
use App\Http\Controllers\Out\PenjualanPiutangController;
use App\Http\Controllers\Out\PenjualanTFController;
use App\Http\Controllers\Out\ReturPembelianNaController;
use App\Http\Controllers\PersediaanDagangController;
use App\Http\Controllers\PindahKasCashController;
use App\Http\Controllers\ReturPembelianGudangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

     // --------------------------------------------------------AUDIT1-------------------------------------------------------------
     Route::get('/audit', [AuditController::class, 'index'])->name('audit1.index');
     Route::post('/audit', [AuditController::class,'create'])->name('audit1.create');
     Route::get('/audit/edit/{id}', [AuditController::class, 'edit'])->name('audit1.edit');
     Route::put('/audit/update/{id}', [AuditController::class, 'update'])->name('audit1.update');
     Route::delete('/audit/delete/{id}', [AuditController::class, 'delete'])->name('audit1.delete');
  
     // --------------------------------------------------------AUDIT2-------------------------------------------------------------
     Route::get('/audit2', [AuditController::class, 'index2'])->name('audit2.index');
     Route::post('/audit2', [AuditController::class,'create2'])->name('audit2.create');
     Route::get('/audit2/edit/{id}', [AuditController::class, 'edit2'])->name('audit2.edit');
     Route::put('/audit2/update/{id}', [AuditController::class, 'update2'])->name('audit2.update');
     Route::delete('/audit2/delete/{id}', [AuditController::class, 'delete2'])->name('audit2.delete');
  
     // --------------------------------------------------------AUDIT3-------------------------------------------------------------
     Route::get('/audit3', [AuditController::class, 'index3'])->name('audit3.index');
     Route::post('/audit3', [AuditController::class,'create3'])->name('audit3.create');
     Route::get('/audit3/edit/{id}', [AuditController::class, 'edit3'])->name('audit3.edit');
     Route::put('/audit3/update/{id}', [AuditController::class, 'update3'])->name('audit3.update');
     Route::delete('/audit3/delete/{id}', [AuditController::class, 'delete3'])->name('audit3.delete');
  
     // -------------------------------------------------------OPNAME GLOBAL-------------------------------------------------------
     Route::get('/opname-global', [OpnameGlobalController::class, 'index'])->name('stokglobal.index');
     Route::post('/opname-global', [OpnameGlobalController::class,'create'])->name('stokglobal.create');
     Route::get('/opname-global/{id}', [AuditController::class, 'detailAudit'])->name('stokglobal.detail');

    // ------------------------------------------------------ CETAK LABEL ------------------------------------------------------ //
    Route::resource('label', LabelController::class);
    Route::get('label-print/{id}', [LabelController::class, 'print'])->name('label.print');

    // ------------------------------------------------------ IN ------------------------------------------------------ //
    // PEMBELIAN TELE
    Route::get('pembelian-tele', [PembelianTeleController::class, 'index'])->name('pembelian-tele.index');
    Route::post('pembelian-tele/edit/{id}', [PembelianTeleController::class, 'edit'])->name('pembelian-tele.edit');
    Route::post('pembelian-tele/update/{id}', [PembelianTeleController::class, 'update'])->name('pembelian-tele.update');
    Route::get('pembelian-tele/show', [PembelianTeleController::class, 'show'])->name('pembelian-tele.show');
    Route::post('pembelian-tele', [PembelianTeleController::class, 'store'])->name('pembelian-tele.store');
    Route::delete('pembelian-tele/{id}', [PembelianTeleController::class, 'destroy'])->name('pembelian-tele.delete');

    // PEMBELIAN ALIANSYAH
    Route::get('pembelian-al', [PembelianAliansyahController::class, 'index'])->name('pembelian-al.index');
    Route::post('pembelian-al/edit/{id}', [PembelianAliansyahController::class, 'edit'])->name('pembelian-al.edit');
    Route::post('pembelian-al/update/{id}', [PembelianAliansyahController::class, 'update'])->name('pembelian-al.update');
    Route::get('pembelian-al/show', [PembelianAliansyahController::class, 'show'])->name('pembelian-al.show');
    Route::post('pembelian-al', [PembelianAliansyahController::class, 'store'])->name('pembelian-al.store');
    Route::delete('pembelian-al/{id}', [PembelianAliansyahController::class, 'destroy'])->name('pembelian-al.delete');

    // PEMBELIAN NA
    Route::get('pembelian-na', [PembelianNaController::class, 'index'])->name('pembelian-na.index');
    Route::post('pembelian-na/edit/{id}', [PembelianNaController::class, 'edit'])->name('pembelian-na.edit');
    Route::post('pembelian-na/update/{id}', [PembelianNaController::class, 'update'])->name('pembelian-na.update');
    Route::get('pembelian-na/show', [PembelianNaController::class, 'show'])->name('pembelian-na.show');
    Route::post('pembelian-na', [PembelianNaController::class, 'store'])->name('pembelian-na.store');
    Route::delete('pembelian-na/{id}', [PembelianNaController::class, 'destroy'])->name('pembelian-na.delete');

    // PEMBELIAN NA TF
    Route::get('pembelian-na-tf', [PembelianNaTFController::class, 'index'])->name('pembelian-na-tf.index');
    Route::post('pembelian-na-tf/edit/{id}', [PembelianNaTFController::class, 'edit'])->name('pembelian-na-tf.edit');
    Route::post('pembelian-na-tf/update/{id}', [PembelianNaTFController::class, 'update'])->name('pembelian-na-tf.update');
    Route::get('pembelian-na-tf/show', [PembelianNaTFController::class, 'show'])->name('pembelian-na-tf.show');
    Route::post('pembelian-na-tf', [PembelianNaTFController::class, 'store'])->name('pembelian-na-tf.store');
    Route::delete('pembelian-na-tf/{id}', [PembelianNaTFController::class, 'destroy'])->name('pembelian-na-tf.delete');

    // RETUR PENJUALAN
    Route::get('retur-penjualan', [ReturPenjualanController::class, 'index'])->name('retur-penjualan.index');
    Route::get('retur-penjualan-cash', [ReturPenjualanController::class, 'indexCash'])->name('retur-penjualan.index-cash');
    Route::get('retur-penjualan-piutang', [ReturPenjualanController::class, 'indexPiutang'])->name('retur-penjualan.index-piutang');
    Route::post('retur-penjualan/submit', [ReturPenjualanController::class, 'store'])->name('retur-penjualan.store');

    // PEMBAYARAN PIUTANG CASH
    Route::get('pembayaran-piutang-cash', [PembayaranPiutangCashController::class, 'index'])->name('pembayaran-piutang-cash.index');
    Route::post('pembayaran-piutang-cash/edit/{id}', [PembayaranPiutangCashController::class, 'edit'])->name('pembayaran-piutang-cash.edit');
    Route::post('pembayaran-piutang-cash/update/{id}', [PembayaranPiutangCashController::class, 'update'])->name('pembayaran-piutang-cash.update');
    Route::get('pembayaran-piutang-cash/show', [PembayaranPiutangCashController::class, 'show'])->name('pembayaran-piutang-cash.show');
    Route::post('pembayaran-piutang-cash', [PembayaranPiutangCashController::class, 'store'])->name('pembayaran-piutang-cash.store');
    Route::delete('pembayaran-piutang-cash/{id}', [PembayaranPiutangCashController::class, 'destroy'])->name('pembayaran-piutang-cash.delete');

    // PEMBAYARAN PIUTANG RETUR
    Route::get('pembayaran-piutang-retur', [PembayaranPiutangReturController::class, 'index'])->name('pembayaran-piutang-retur.index');
    Route::post('pembayaran-piutang-retur/submit', [PembayaranPiutangReturController::class, 'store'])->name('pembayaran-piutang-retur.store');

    // PINDAH STOCK IN
    Route::get('stock-in', [PindahStockInController::class, 'index'])->name('stock-in.index');
    Route::post('stock-in/edit/{id}', [PindahStockInController::class, 'edit'])->name('stock-in.edit');
    Route::post('stock-in/update/{id}', [PindahStockInController::class, 'update'])->name('stock-in.update');
    Route::get('stock-in/show', [PindahStockInController::class, 'show'])->name('stock-in.show');
    Route::post('stock-in', [PindahStockInController::class, 'store'])->name('stock-in.store');
    Route::delete('stock-in/{id}', [PindahStockInController::class, 'destroy'])->name('stock-in.delete');


    // ------------------------------------------------------ OUT ------------------------------------------------------ //

    // PENJUALAN CASH
    Route::get('penjualan-cash', [PenjualanCashController::class, 'index'])->name('penjualan-cash.index');
    Route::post('penjualan-cash/submit', [PenjualanCashController::class, 'store'])->name('penjualan-cash.store');

    // PENJUALAN PIUTANG
    Route::get('penjualan-piutang', [PenjualanPiutangController::class, 'index'])->name('penjualan-piutang.index');
    Route::post('penjualan-piutang/submit', [PenjualanPiutangController::class, 'store'])->name('penjualan-piutang.store');

    // PENJUALAN TF
    Route::get('penjualan-tf', [PenjualanTFController::class, 'index'])->name('penjualan-tf.index');
    Route::post('penjualan-tf/submit', [PenjualanTFController::class, 'store'])->name('penjualan-tf.store');

    // ------------------------------------------------------ RETUR PEMBELIAN ----------------------------------------- //

    // RETUR PEMBELIAN NA
    Route::get('retur-pembelian-na', [ReturPembelianNaController::class, 'index'])->name('retur-pembelian-na.index');
    Route::get('retur-pembelian-cash', [ReturPembelianNaController::class, 'indexCash'])->name('retur-pembelian-na.index-cash');
    Route::get('retur-pembelian-hutang', [ReturPembelianNaController::class, 'indexHutang'])->name('retur-pembelian-na.index-hutang');
    Route::post('retur-pembelian-na/submit', [ReturPembelianNaController::class, 'store'])->name('retur-pembelian-na.store');

    // RETUR PEMBELIAN KE GUDANG
    Route::get('retur-pembelian-gudang', [ReturPembelianGudangController::class, 'index'])->name('retur-pembelian-gudang.index');
    Route::post('retur-pembelian-gudang/submit', [ReturPembelianGudangController::class, 'store'])->name('retur-pembelian-gudang.store');

    // PINDAH KAS TF
    Route::get('pindah-kas-tf', [PindahKasTfController::class, 'index'])->name('pindah-kas-tf.index');
    Route::post('pindah-kas-tf/edit/{id}', [PindahKasTfController::class, 'edit'])->name('pindah-kas-tf.edit');
    Route::post('pindah-kas-tf/update/{id}', [PindahKasTfController::class, 'update'])->name('pindah-kas-tf.update');
    Route::get('pindah-kas-tf/show', [PindahKasTfController::class, 'show'])->name('pindah-kas-tf.show');
    Route::post('pindah-kas-tf', [PindahKasTfController::class, 'store'])->name('pindah-kas-tf.store');
    Route::delete('pindah-kas-tf/{id}', [PindahKasTfController::class, 'destroy'])->name('pindah-kas-tf.delete');

    // PINDAH KAS CASH
    Route::get('pindah-kas-cash', [PindahKasCashController::class, 'index'])->name('pindah-kas-cash.index');
    Route::post('pindah-kas-cash/edit/{id}', [PindahKasCashController::class, 'edit'])->name('pindah-kas-cash.edit');
    Route::post('pindah-kas-cash/update/{id}', [PindahKasCashController::class, 'update'])->name('pindah-kas-cash.update');
    Route::get('pindah-kas-cash/show', [PindahKasCashController::class, 'show'])->name('pindah-kas-cash.show');
    Route::post('pindah-kas-cash', [PindahKasCashController::class, 'store'])->name('pindah-kas-cash.store');
    Route::delete('pindah-kas-cash/{id}', [PindahKasCashController::class, 'destroy'])->name('pindah-kas-cash.delete');

    // KAS KELUAR OPERASIONAL
    Route::get('kas-keluar-operasional', [KasKeluarOperasionalController::class, 'index'])->name('kas-keluar-operasional.index');
    Route::post('kas-keluar-operasional/edit/{id}', [KasKeluarOperasionalController::class, 'edit'])->name('kas-keluar-operasional.edit');
    Route::post('kas-keluar-operasional/update/{id}', [KasKeluarOperasionalController::class, 'update'])->name('kas-keluar-operasional.update');
    Route::get('kas-keluar-operasional/show', [KasKeluarOperasionalController::class, 'show'])->name('kas-keluar-operasional.show');
    Route::post('kas-keluar-operasional', [KasKeluarOperasionalController::class, 'store'])->name('kas-keluar-operasional.store');
    Route::delete('kas-keluar-operasional/{id}', [KasKeluarOperasionalController::class, 'destroy'])->name('kas-keluar-operasional.delete');

    // PINDAH STOCK OUT
    Route::get('stock-out', [PindahStockOutController::class, 'index'])->name('stock-out.index');
    Route::post('stock-out/edit/{id}', [PindahStockOutController::class, 'edit'])->name('stock-out.edit');
    Route::post('stock-out/update/{id}', [PindahStockOutController::class, 'update'])->name('stock-out.update');
    Route::get('stock-out/show', [PindahStockOutController::class, 'show'])->name('stock-out.show');
    Route::post('stock-out', [PindahStockOutController::class, 'store'])->name('stock-out.store');
    Route::delete('stock-out/{id}', [PindahStockOutController::class, 'destroy'])->name('stock-out.delete');


    // ------------------------------------------------------ REPORT ------------------------------------------------------ //

    // REPORT PENJUALAN CASH
    Route::get('report-penjualan-cash', [PenjualanCashController::class, 'report'])->name('report-penjualan-cash.index');
    Route::post('report-penjualan-cash/reprint/{id}', [HomeController::class, 'reprint_cash'])->name('report-penjualan-cash.reprint');
    Route::get('report-penjualan-cash/show', [PenjualanCashController::class, 'show'])->name('report-penjualan-cash.show');
    Route::post('report-penjualan-cash/table/{id}', [PenjualanCashController::class, 'table'])->name('report-penjualan-cash.table');
    Route::get('report-penjualan-cash/edit/{id}', [PenjualanCashController::class, 'edit'])->name('report-penjualan-cash.edit');
    Route::post('report-penjualan-cash/update/{id}', [PenjualanCashController::class, 'update'])->name('report-penjualan-cash.update');
    Route::delete('report-penjualan-cash/delete/{id}', [PenjualanCashController::class, 'delete'])->name('report-penjualan-cash.delete');
    Route::put('penjualan-cash/update/{id}', [PenjualanCashController::class, 'updateInduk'])->name('penjualan-cash.update-induk');

    // REPORT PENJUALAN PIUTANG
    Route::get('report-penjualan-piutang', [PenjualanPiutangController::class, 'report'])->name('report-penjualan-piutang.index');
    Route::post('report-penjualan-piutang/reprint/{id}', [HomeController::class, 'reprint_piutang'])->name('report-penjualan-piutang.reprint');
    Route::get('report-penjualan-piutang/show', [PenjualanPiutangController::class, 'show'])->name('report-penjualan-piutang.show');
    Route::post('report-penjualan-piutang/table/{id}', [PenjualanPiutangController::class, 'table'])->name('report-penjualan-piutang.table');
    Route::get('report-penjualan-piutang/edit/{id}', [PenjualanPiutangController::class, 'edit'])->name('report-penjualan-piutang.edit');
    Route::post('report-penjualan-piutang/update/{id}', [PenjualanPiutangController::class, 'update'])->name('report-penjualan-piutang.update');
    Route::delete('report-penjualan-piutang/delete/{id}', [PenjualanPiutangController::class, 'delete'])->name('report-penjualan-piutang.delete');
    Route::put('penjualan-piutang/update/{id}', [PenjualanPiutangController::class, 'updateInduk'])->name('penjualan-piutang.update-induk');

    // REPORT PENJUALAN TF
    Route::get('report-penjualan-tf', [PenjualanTFController::class, 'report'])->name('report-penjualan-tf.index');
    Route::post('report-penjualan-tf/reprint/{id}', [HomeController::class, 'reprint_tf'])->name('report-penjualan-tf.reprint');
    Route::get('report-penjualan-tf/show', [PenjualanTFController::class, 'show'])->name('report-penjualan-tf.show');
    Route::post('report-penjualan-tf/table/{id}', [PenjualanTFController::class, 'table'])->name('report-penjualan-tf.table');
    Route::get('report-penjualan-tf/edit/{id}', [PenjualanTFController::class, 'edit'])->name('report-penjualan-tf.edit');
    Route::post('report-penjualan-tf/update/{id}', [PenjualanTFController::class, 'update'])->name('report-penjualan-tf.update');
    Route::delete('report-penjualan-tf/delete/{id}', [PenjualanTFController::class, 'delete'])->name('report-penjualan-tf.delete');
    Route::put('penjualan-tf/update/{id}', [PenjualanTFController::class, 'updateInduk'])->name('penjualan-tf.update-induk');


    // REPORT RETUR PEMBELIAN NA
    Route::get('report-retur-pembelian-na', [ReturPembelianNaController::class, 'report'])->name('report-retur-pembelian-na.index');
    Route::post('report-retur-pembelian-na/reprint/{id}', [HomeController::class, 'reprint_retur_pembelian_na'])->name('report-retur-pembelian-na.reprint');
    Route::get('report-retur-pembelian-na/show', [ReturPembelianNaController::class, 'show'])->name('report-retur-pembelian-na.show');
    Route::post('report-retur-pembelian-na/table/{id}', [ReturPembelianNaController::class, 'table'])->name('report-retur-pembelian-na.table');
    Route::get('report-retur-pembelian-na/edit/{id}', [ReturPembelianNaController::class, 'edit'])->name('report-retur-pembelian-na.edit');
    Route::post('report-retur-pembelian-na/update/{id}', [ReturPembelianNaController::class, 'update'])->name('report-retur-pembelian-na.update');
    Route::delete('report-retur-pembelian-na/delete/{id}', [ReturPembelianNaController::class, 'delete'])->name('report-retur-pembelian-na.delete');

    // REPORT RETUR PEMBELIAN GUDANG
    Route::get('report-retur-pembelian-gudang', [ReturPembelianGudangController::class, 'report'])->name('report-retur-pembelian-gudang.index');
    Route::post('report-retur-pembelian-gudang/reprint/{id}', [HomeController::class, 'reprint_retur_pembelian_gudang'])->name('report-retur-pembelian-gudang.reprint');
    Route::get('report-retur-pembelian-gudang/show', [ReturPembelianGudangController::class, 'show'])->name('report-retur-pembelian-gudang.show');
    Route::post('report-retur-pembelian-gudang/table/{id}', [ReturPembelianGudangController::class, 'table'])->name('report-retur-pembelian-gudang.table');
    Route::get('report-retur-pembelian-gudang/edit/{id}', [ReturPembelianGudangController::class, 'edit'])->name('report-retur-pembelian-gudang.edit');
    Route::post('report-retur-pembelian-gudang/update/{id}', [ReturPembelianGudangController::class, 'update'])->name('report-retur-pembelian-gudang.update');
    Route::delete('report-retur-pembelian-gudang/delete/{id}', [ReturPembelianGudangController::class, 'delete'])->name('report-retur-pembelian-gudang.delete');

    // REPORT RETUR PENJUALAN
    Route::get('report-retur-penjualan', [ReturPenjualanController::class, 'report'])->name('report-retur-penjualan.index');
    Route::post('report-retur-penjualan/reprint/{id}', [HomeController::class, 'reprint_retur_penjualan'])->name('report-retur-penjualan.reprint');
    Route::get('report-retur-penjualan/show', [ReturPenjualanController::class, 'show'])->name('report-retur-penjualan.show');
    Route::post('report-retur-penjualan/table/{id}', [ReturPenjualanController::class, 'table'])->name('report-retur-penjualan.table');
    Route::get('report-retur-penjualan/edit/{id}', [ReturPenjualanController::class, 'edit'])->name('report-retur-penjualan.edit');
    Route::post('report-retur-penjualan/update/{id}', [ReturPenjualanController::class, 'update'])->name('report-retur-penjualan.update');
    Route::delete('report-retur-penjualan/delete/{id}', [ReturPenjualanController::class, 'delete'])->name('report-retur-penjualan.delete');
    Route::put('retur-penjualan/update/{id}', [ReturPenjualanController::class, 'updateInduk'])->name('retur-penjualan.update-induk');

    // REPORT PEMBAYARAN PIUTANG RETUR
    Route::get('report-pembayaran-piutang', [PembayaranPiutangReturController::class, 'report'])->name('report-pembayaran-piutang.index');
    Route::post('report-pembayaran-piutang/reprint/{id}', [HomeController::class, 'reprint_pembayaran_piutang_na'])->name('report-pembayaran-piutang.reprint');
    Route::get('report-pembayaran-piutang/show', [PembayaranPiutangReturController::class, 'show'])->name('report-pembayaran-piutang.show');
    Route::post('report-pembayaran-piutang/table/{id}', [PembayaranPiutangReturController::class, 'table'])->name('report-pembayaran-piutang.table');
    Route::get('report-pembayaran-piutang/edit/{id}', [PembayaranPiutangReturController::class, 'edit'])->name('report-pembayaran-piutang.edit');
    Route::post('report-pembayaran-piutang/update/{id}', [PembayaranPiutangReturController::class, 'update'])->name('report-pembayaran-piutang.update');
    Route::delete('report-pembayaran-piutang/delete/{id}', [PembayaranPiutangReturController::class, 'delete'])->name('report-pembayaran-piutang.delete');

    // ------------------------------------------------------ PRINT ------------------------------------------------------ //
    Route::get('print/piutang-retur', [HomeController::class, 'print_pembayaran_piutang_retur'])->name('print.pembayaran.piutang.retur');
    Route::get('print/retur-penjualan', [HomeController::class, 'print_retur_penjualan'])->name('print.retur.penjualan');
    Route::get('print/cash', [HomeController::class, 'print_cash'])->name('print.penjualan.cash');
    Route::get('print/tf', [HomeController::class, 'print_tf'])->name('print.penjualan.tf');
    Route::get('print/piutang', [HomeController::class, 'print_piutang'])->name('print.penjualan.piutang');
    Route::get('print/pembelian-na', [HomeController::class, 'print_retur_pembelian_na'])->name('print.retur.pembelian.na');
    Route::get('print/pembelian-gudang', [HomeController::class, 'print_retur_pembelian_gudang'])->name('print.retur.pembelian.gudang');


    // ------------------------------------------------------ MANAJEMEN ------------------------------------------------------ //
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::post('user', [UserController::class, 'store'])->name('user.store');
        Route::get('barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('barang/update', [BarangController::class, 'update'])->name('barang.update');
        Route::get('konsumen', [KonsumenController::class, 'index'])->name('konsumen.index');
        Route::get('konsumen/update', [KonsumenController::class, 'update'])->name('konsumen.update');
        Route::get('piutang', [PiutangController::class, 'index'])->name('piutang.index');
        Route::get('piutang/update', [PiutangController::class, 'update'])->name('piutang.update');
        Route::get('persediaan-dagang', [PersediaanDagangController::class, 'index'])->name('persediaan.index');
        Route::get('persediaan-dagang/delete/{id}', [PersediaanDagangController::class, 'delete'])->name('persediaan.delete');
    });

    // ------------------------------------------------------ AMBIL UANG DI BANK ------------------------------------------ //

    // ALIANSYAH
    Route::get('ambil-uang-al', [AmbilUangAlController::class, 'index'])->name('ambil-uang-al.index');
    Route::post('ambil-uang-al', [AmbilUangAlController::class, 'store'])->name('ambil-uang-al.store');
    Route::put('ambil-uang-al/update/{ambil_uang_al}', [AmbilUangAlController::class, 'update'])->name('ambil-uang-al.update');
    Route::delete('ambil-uang-al/delete/{ambil_uang_al}', [AmbilUangAlController::class, 'destroy'])->name('ambil-uang-al.delete');

    // TTB
    Route::get('ambil-uang-ttb', [AmbilUangTtbController::class, 'index'])->name('ambil-uang-ttb.index');
    Route::post('ambil-uang-ttb', [AmbilUangTtbController::class, 'store'])->name('ambil-uang-ttb.store');
    Route::put('ambil-uang-ttb/update/{ambil_uang_ttb}', [AmbilUangTtbController::class, 'update'])->name('ambil-uang-ttb.update');
    Route::delete('ambil-uang-ttb/delete/{ambil_uang_ttb}', [AmbilUangTtbController::class, 'destroy'])->name('ambil-uang-ttb.delete');

    // ------------------------------------------------------ BARTER ------------------------------------------ //

    // BARANG
    Route::get('barter-barang', [BarterCashController::class, 'indexBarang'])->name('barter-barang.index');
    Route::post('barter-barang', [BarterCashController::class, 'storeBarang'])->name('barter-barang.store');
    Route::put('barter-barang/barang/{barter_barang}', [BarterCashController::class, 'updateBarang'])->name('barter-barang.update');
    Route::delete('barter-barang/delete/{barter_barang}', [BarterCashController::class, 'destroyBarang'])->name('barter-barang.delete');

    // CASH
    Route::get('barter-cash', [BarterCashController::class, 'index'])->name('barter-cash.index');
    Route::post('barter-cash', [BarterCashController::class, 'store'])->name('barter-cash.store');
    Route::put('barter-cash/update/{barter_cash}', [BarterCashController::class, 'update'])->name('barter-cash.update');
    Route::delete('barter-cash/delete/{barter_cash}', [BarterCashController::class, 'destroy'])->name('barter-cash.delete');

    // PIUTANG
    Route::get('barter-piutang', [BarterPiutangController::class, 'index'])->name('barter-piutang.index');
    Route::post('barter-piutang', [BarterPiutangController::class, 'store'])->name('barter-piutang.store');
    Route::put('barter-piutang/update/{barter_piutang}', [BarterPiutangController::class, 'update'])->name('barter-piutang.update');
    Route::delete('barter-piutang/delete/{barter_piutang}', [BarterPiutangController::class, 'destroy'])->name('barter-piutang.delete');

    // ------------------------------------------------------ OTHER ------------------------------------------------------ //

    // STOCK AWAL
    Route::get('stock-awal', [StockAwalController::class, 'index'])->name('stock-awal.index');
    Route::post('stock-awal', [StockAwalController::class, 'store'])->name('stock-awal.store');
    Route::put('stock-awal/update/{stock_awal}', [StockAwalController::class, 'update'])->name('stock-awal.update');
    Route::delete('stock-awal/delete/{stock_awal}', [StockAwalController::class, 'destroy'])->name('stock-awal.delete');

    // NOMINAL AWAL
    Route::get('nominal-awal', [NominalAwalController::class, 'index'])->name('nominal-awal.index');
    Route::post('nominal-awal', [NominalAwalController::class, 'store'])->name('nominal-awal.store');
    Route::put('nominal-awal/update/{nominal_awal}', [NominalAwalController::class, 'update'])->name('nominal-awal.update');
    Route::delete('nominal-awal/delete/{nominal_awal}', [NominalAwalController::class, 'destroy'])->name('nominal-awal.delete');

    // ------------------------------------------------------ OUTPUT ------------------------------------------------------ //

    // PERSEDIAAN DAGANG
    // Route::get('persediaan-dagang', [PersediaanDagangController::class, 'index'])->name('persediaan-dagang.index');

    // BUKU PIUTANG
    Route::get('buku-piutang', [BukuPiutangController::class, 'index'])->name('buku-piutang.index');

    // BUKU HUTANG
    Route::get('buku-hutang', [BukuHutangController::class, 'index'])->name('buku-hutang.index');
});

//Route Prefix Export Google Sheet
Route::prefix('export-google-sheet')->group(function () {
    //Pembelian tele
    Route::get('pembelian-tele/{startDate}/{endDate}', [GoogleSheetController::class, 'indexPembelianTele']);

    //Pembelian
    Route::get('pembelian-na/{startDate}/{endDate}', [GoogleSheetController::class, 'indexPembelianNa']);

    //Penjualan
    Route::get('penjualan/{startDate}/{endDate}', [GoogleSheetController::class, 'indexPenjualan'])->name('penjualan');
    
    //Retur Penjualan
    Route::get('retur-penjualan/{startDate}/{endDate}', [GoogleSheetController::class, 'indexReturPenjualan'])->name('retur-penjualan');

    //Retur Pembelian
    Route::get('retur-pembelian-na/{startDate}/{endDate}', [GoogleSheetController::class, 'indexReturPembelianNa'])->name('retur-pembelian-na');

    //Pindah Stock
    Route::get('pindah-stock-in/{startDate}/{endDate}', [GoogleSheetController::class, 'indexPindahStockIn'])->name('pindah-stock-in');
    Route::get('pindah-stock-out/{startDate}/{endDate}', [GoogleSheetController::class, 'indexPindahStockOut'])->name('pindah-stock-out');

    //Kas Keluar Operasional
    Route::get('kas-keluar-operasional/{startDate}/{endDate}', [GoogleSheetController::class, 'indexKasKeluarOperasional'])->name('kas-keluar-operasional');

    //Pindah Kas
    Route::get('pindah-kas-tf/{startDate}/{endDate}', [GoogleSheetController::class, 'indexPindahKasTf'])->name('pindah-kas-tf');

    //Pembayaran Piutang
    Route::get('pembayaran-piutang-cash/{startDate}/{endDate}', [GoogleSheetController::class, 'indexPembayaranPiutangCash'])->name('pembayaran-piutang-cash');

});
