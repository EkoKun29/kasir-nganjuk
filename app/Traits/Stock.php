<?php

namespace App\Traits;

use App\Models\PersediaanDagang;

trait Stock
{
    public function create($nama_barang, $no_lot, $qty)
    {
        PersediaanDagang::create([
            'nama_barang_dan_no_lot'    => $nama_barang . ' // ' . $no_lot,
            'nama_barang'               => $nama_barang,
            'no_lot'                    => $no_lot,
            'qty'                       => $qty
        ]);
    }

    public function _addStock($nama_barang, $no_lot, $qty)
    {
        $data = PersediaanDagang::where([
            ['nama_barang', $nama_barang],
            ['no_lot', $no_lot]
        ])->first();

        if ($data) {
            $data->update([
                'qty' => $data->qty + $qty
            ]);
        } else {
            $this->create($nama_barang, $no_lot, $qty);
        };
    }

    public function _deleteStock($params)
    {
        $data = PersediaanDagang::where([
            ['nama_barang', $params->nama_barang],
            ['no_lot', $params->no_lot]
        ])->first();

        if ($data) {
            $data->update([
                'qty' => $data->qty - $params->qty
            ]);
        }
    }

    public function _updateStock($nama_barang, $no_lot, $qty, $data_lama)
    {
        $data = PersediaanDagang::where([
            ['nama_barang', $data_lama->nama_barang],
            ['no_lot', $data_lama->no_lot]
        ])->first();

        if ($data_lama->nama_barang == $nama_barang && $data_lama->no_lot == $no_lot) {
            // JIKA DATA LAMA == DATA BARU
            // 1. QTY PERSEDIAAN - QTY LAMA + QTY BARU
            if ($data) {
                $data->update([
                    'qty' => $data->qty - $data_lama->qty + $qty
                ]);
            }
        } else {
            // JIKA DATA LAMA != DATA BARU
            // 2. KURANGI DATA LAMA YANG ADA DI PERSEDIAAN
            if ($data) {
                $data->update([
                    'qty' => $data->qty - $data_lama->qty
                ]);
            }

            // 3. CEK APAKAH DATA BARU YANG DIEDIT TELAH ADA DI PERSEDIAAN DAGANG
            $data_baru = PersediaanDagang::where([
                ['nama_barang', $nama_barang],
                ['no_lot', $no_lot]
            ])->first();

            if ($data_baru) {
                $data_baru->update([
                    'qty' => $data_baru->qty + $qty
                ]);
            } else {
                $this->create($nama_barang, $no_lot, $qty);
            }
        };
    }
}
