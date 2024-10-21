<?php

use App\Http\Controllers\API\ExportDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Pembelian tele
Route::get('pembelian-tele/{startDate}/{endDate}', [ExportDataController::class, 'indexPembelianTele']);

//Pembelian
Route::get('pembelian-na/{startDate}/{endDate}', [ExportDataController::class, 'indexPembelianNa']);

//Penjualan
Route::get('penjualan/{startDate}/{endDate}', [ExportDataController::class, 'indexPenjualan']);

//Retur Penjualan
Route::get('retur-penjualan/{startDate}/{endDate}', [ExportDataController::class, 'indexReturPenjualan']);

//Retur Pembelian
Route::get('retur-pembelian-na/{startDate}/{endDate}', [ExportDataController::class, 'indexReturPembelianNa']);

//Pindah Stock
Route::get('pindah-stock-in/{startDate}/{endDate}', [ExportDataController::class, 'indexPindahStockIn']);
Route::get('pindah-stock-out/{startDate}/{endDate}', [ExportDataController::class, 'indexPindahStockOut']);

//Kas Keluar Operasional
Route::get('kas-keluar-operasional/{startDate}/{endDate}', [ExportDataController::class, 'indexKasKeluarOperasional']);

//Pindah Kas
Route::get('pindah-kas-tf/{startDate}/{endDate}', [ExportDataController::class, 'indexPindahKasTf']);

//Pembayaran Piutang
Route::get('pembayaran-piutang-cash/{startDate}/{endDate}', [ExportDataController::class, 'indexPembayaranPiutangCash']);
