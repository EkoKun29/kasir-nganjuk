<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait FromApi
{
    // public function _getBarang()
    // {
    //     $client = new Client();

    //     $url = "https://script.googleusercontent.com/macros/echo?user_content_key=HCGqLblUrYeeT0SQhpqxT-I6GuLkZX2FpWKzX_JQPp9JvGq0vRBbnFtl5eZLDucP_fgACui9Wt1Ihckr6eYPDMvsyImNUkS9OJmA1Yb3SEsKFZqtv3DaNYcMrmhZHmUMWojr9NvTBuBLhyHCd5hHa6488C7qmTKbG4ODZJ4--D3TYNQCKEvvgU9BeDtPGsmFskZUjPgmmGPfN3EXny_LtemYztkHFE1o8GVeYQq3G-PgGSzsEM_55gtBHn44AOQPc_GLANACQ2HnFXfA8BT9tw&lib=MwrS5UL2suXhr7r5eut16IRQ628Yks6X1";

    //     $response = $client->request('GET', $url, [
    //         'verify'  => false,
    //     ]);

    //     $data = json_decode($response->getBody());
    //     $barang = collect($data); // Change to collection
    //     return $barang;
    // }

    // public function _getSales()
    // {
    //     $client = new Client();

    //     $url = "https://script.googleusercontent.com/macros/echo?user_content_key=OCO4vmOC3V4DC-tYYX0DvJKYSdeO9yqFl3vk_RRKZ0k968oHJOVcx_Raoc1WIYrR8SOwW2nNmKzCuscyv186v_0eCvXcHLEam5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnJj6_DJIux6VWAQjraEbvJB9UOMPIgwaBPvHP2WywrccrAEWrsz0cZgM2Rg9Gw8dSGBFuif0m4wspAkltopcJwuHP2s3nj1mmWIxwG7Ym21xjCwVM9Qgl_Q&lib=MwrS5UL2suXhr7r5eut16IRQ628Yks6X1";

    //     $response = $client->request('GET', $url, [
    //         'verify'  => false,
    //     ]);

    //     $data = json_decode($response->getBody());
    //     $sales = collect($data); // Change to collection
    //     return $sales;
    // }
}
