<?php

namespace App\Http\Controllers;


use App\Helpers\InsurancePriceAuto;
use App\Helpers\InsurancePriceHome;
use App\Helpers\InsurancePriceSecuryHigh;
use Carbon\Carbon;

class TestController extends Controller
{
    public function test()
    {
        $simulate = new InsurancePriceSecuryHigh();

        $materials = [
            [
                "type" => "computeur",
                "value" => 1390,
                "occaz" => true,
                "date_achat" => Carbon::createFromDate(2021,9,25)
            ],
            [
                "type" => "video",
                "value" => 660,
                "occaz" => false,
                "date_achat" => Carbon::createFromDate(2020,6,30)
            ],
        ];

        $total = 0;

        foreach ($materials as $material) {
            $total += $simulate->simulate($material['type'], $material['value'], $material['occaz'], $material['date_achat']);
        }

        $montly = $total / 12;

        dd(eur($total), eur($montly));
    }
}
