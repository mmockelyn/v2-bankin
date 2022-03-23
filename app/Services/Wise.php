<?php


namespace App\Services;


use TransferWise\Client;

class Wise
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            "token" => config('service.wise.token'),
            "profile_id" => config('service.wise.profil_id'),
            "env" => config('service.wise.env', 'sandbox') // optional
        ]);
    }
}
