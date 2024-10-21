<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Konsumen::all();

        return view('manajemen.konsumen.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        // HIT API
        try {
            $client = new Client();

            $url = "https://script.googleusercontent.com/macros/echo?user_content_key=v5kte28S3-2-hqHhi2He17sXm-xUmrfOuk66mHmJEcfd1Mlsw5QkOtkRHBoxczk29PgBLWSUqONIng03cj6Uvxr2sp3Tr0koOJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHa564jwpwenYaH0_rJumFM_Q-m9dfQQAk0wLUrnF6UAY4OGs9VMbjm_S6aVZ0T39wAkz2mDscCkIu7s5fI3OLrw-Pc0VBDVKKUAtBHn44AOQPxp1xZnN4QLjmXoQasVXBig&lib=MwrS5UL2suXhr7r5eut16IRQ628Yks6X1";

            $response = $client->request('GET', $url, [
                'verify'  => false,
            ]);

            $data = json_decode($response->getBody());
            $konsumens = collect($data); // Change to collection
        } catch (\Throwable $th) {
            return redirect()->back()->with('delete', 'Data Konsumen Gagal di Syncronize!');
        }

        // INSERT KE DATABASE
        foreach ($konsumens as $konsumen) {

            // CEK APAKAH DATA TELAH ADA
            $InKonsumen = Konsumen::where('nama', $konsumen->konsumen)->first();
            if (!$InKonsumen && $konsumen->konsumen != '') {
                Konsumen::create([
                    'nama' => $konsumen->konsumen
                ]);
            }
        }
        return redirect()->back()->with('success', 'Data Konsumen Berhasil di Syncronize!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
