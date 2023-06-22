<?php

namespace App\Services;

abstract class NBRBAPI
{
    /**
     * @return mixed
     *
     * @link https://www.nbrb.by/apihelp/exrates
     */
    public static function rateUSD()
    {
        $response = file_get_contents('https://api.nbrb.by/exrates/rates/USD?parammode=2');
        $std = json_decode($response);

        return $std->Cur_OfficialRate;
    }
}