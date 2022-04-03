<?php

namespace App\Http\Controllers;


use App\Helpers\InsurancePriceHome;

class TestController extends Controller
{
    public function test()
    {
        $simulate = new InsurancePriceHome();

        dd(
            eur($simulate->simulate(
                'essentiel', 'locataire', 'principal', 2, 50, 'maison', 't3', false, false, false, false, false,0)),
            eur($simulate->simulate(
                'essentiel', 'locataire', 'principal', 2, 50, 'maison', 't3', false, false, false, false, false,0) / 12)
        );
    }
}
