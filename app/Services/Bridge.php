<?php


namespace App\Services;


class Bridge
{
    public function getListBanks()
    {
        return \Http::withHeaders([
            "Bridge-Version" => "2021-06-01",
            "Client-Id" =>  config("services.bridge.client_id"),
            "Client-Secret" => config("services.bridge.client_secret")
        ])->get('https://api.bridgeapi.io/v2/banks?countries=fr&limit=500')->object();
    }
}
