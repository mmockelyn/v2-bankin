<?php


namespace App\Helpers\Customer;


class Beneficiaire
{
    public static function getNameForSelected($beneficiaire)
    {
        if($beneficiaire->type == 'corporate') {
            return $beneficiaire->company;
        } else {
            return $beneficiaire->civility.'. '.$beneficiaire->firstname.' '.$beneficiaire->lastname;
        }
    }
}
