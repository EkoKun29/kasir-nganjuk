<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Barang;
use App\Traits\FromApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    use FromApi;

    public function index()
    {
        $data = Barang::query()->get();

        return view('manajemen.barang.index', compact('data'));
    }

    public function update()
    {

        //Remove All Data
        $barangs = Barang::get();
        foreach ($barangs as $b) {
            $b->delete();
        }

        // HIT API
        try {
            $client = new Client();

            $url = "https://script.googleusercontent.com/macros/echo?user_content_key=DmISZ8TQlARcDs_--mGe1lWvpmbvQeXFyDhT2wnFk1lY3GqNtHUyddohEsfblz2-80OqKyIrfSFIlyrP3ZQAMq_WXffWlkbmOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHa4-6gVc5rsA8nHnGiFumywynWTW_Z5wJqz0JnJbPZOLiOJ5L5LQkNSBqXa_4s8DRIOFaseEovVwQPxeu3YEqm0BhXmrRV6XxjwtBHn44AOQPc_GLANACQ2HnFXfA8BT9tw&lib=MwrS5UL2suXhr7r5eut16IRQ628Yks6X1";

            $response = $client->request('GET', $url, [
                'verify'  => false,
            ]);

            $data = json_decode($response->getBody());
            $barang = collect($data); // Change to collection
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Data Barang Gagal di Update');
        }

        // INSERT KE DATABASE
        foreach ($barang as $item) {
            // CEK APAKAH DATA TELAH ADA
            $item_in_barang = Barang::where('nama', $item->barang)->first();
            if (!$item_in_barang && $item->barang != '') {
                $isi = ($item->isi != '') ? $item->isi : null;
                Barang::create([
                    'nama' => $item->barang,
                    'isi' => $isi
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data Barang Berhasil di Update');
    }
}
