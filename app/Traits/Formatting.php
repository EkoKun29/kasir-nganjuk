<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait Formatting
{
    public function _Money($params)
    {
        return number_format($params, 0, ',', '.');
    }
}
