<?php


namespace App\Helpers;


class Iban
{
    public function generator($customer)
    {
        $codePays = "FR";
        $keyC = "";
        $code_banque = $customer->user->agence->code_banque;
        $code_guichet = $customer->user->agence->code_guichet;
        $num_cpt = "";
        $bban = "";

        $key = $this->keyC($bban);
        $iban = "";
    }

    private function keyC($bban)
    {
        return "98" - bcmod($bban, 97);
    }

    private function generateNumberAccount

}
