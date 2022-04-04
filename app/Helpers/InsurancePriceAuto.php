<?php


namespace App\Helpers;


use Carbon\Carbon;

class InsurancePriceAuto
{
    public function simulate($type_vehicule, $date_achat, $type_abo, $puissance, $alim, $first_circ)
    {
        switch ($type_vehicule) {
            case 'auto':
                return $this->auto($type_abo, $puissance, $alim, $first_circ, $date_achat);

            case 'moto':
                return $this->moto($type_abo, $puissance, $alim, $first_circ, $date_achat);

            case 'cyclo':
                return $this->cyclo($type_abo, $puissance, $alim, $first_circ, $date_achat);

            case 'velo':
                return $this->velo($type_abo, $first_circ, $date_achat);

            default:
                return $this->other($first_circ, $date_achat);
        }
    }

    private function auto($type_abo, $puissance, $alim, $first_circ, $date_achat)
    {
        switch ($type_abo) {
            case 'tiers':
                $base_price = 2.99;
                $calc = $this->getPuissance($puissance)
                * $this->getAlimentation($alim)
                * $this->getFirstCirculation($first_circ)
                * $this->getDateAchat($date_achat);

                return ($base_price * $calc) + $base_price;

            case 'plus':
                $base_price = 4.99;
                $calc = $this->getPuissance($puissance) * 1.156
                    * $this->getAlimentation($alim) * 1.156
                    * $this->getFirstCirculation($first_circ) * 1.156
                    * $this->getDateAchat($date_achat) * 1.156;

                return ($base_price * $calc) + $base_price;

            default:
                $base_price = 6.99;
                $calc = $this->getPuissance($puissance) * 1.890
                    * $this->getAlimentation($alim) * 1.890
                    * $this->getFirstCirculation($first_circ) * 1.890
                    * $this->getDateAchat($date_achat) * 1.890;

                return ($base_price * $calc) + $base_price;
        }
    }
    private function moto($type_abo, $puissance, $alim, $first_circ, $date_achat)
    {
        switch ($type_abo) {
            case 'tiers':
                $base_price = 2.99;
                $calc = $this->getPuissance($puissance)
                * $this->getAlimentation($alim)
                * $this->getFirstCirculation($first_circ)
                * $this->getDateAchat($date_achat);

                return ($base_price * $calc) + $base_price;

            case 'plus':
                $base_price = 4.99;
                $calc = $this->getPuissance($puissance) * 1.080
                    * $this->getAlimentation($alim) * 1.080
                    * $this->getFirstCirculation($first_circ) * 1.080
                    * $this->getDateAchat($date_achat) * 1.080;

                return ($base_price * $calc) + $base_price;

            default:
                $base_price = 6.99;
                $calc = $this->getPuissance($puissance) * 1.352
                    * $this->getAlimentation($alim) * 1.352
                    * $this->getFirstCirculation($first_circ) * 1.352
                    * $this->getDateAchat($date_achat) * 1.352;

                return ($base_price * $calc) + $base_price;
        }
    }
    private function cyclo($type_abo, $puissance, $alim, $first_circ, $date_achat)
    {
        switch ($type_abo) {
            case 'tiers':
                $base_price = 0.99;
                $calc = $this->getPuissance($puissance)
                * $this->getAlimentation($alim)
                * $this->getFirstCirculation($first_circ)
                * $this->getDateAchat($date_achat);

                return ($base_price * $calc) + $base_price;

            default:
                $base_price = 3.99;
                $calc = $this->getPuissance($puissance) * 1.352
                    * $this->getAlimentation($alim) * 1.352
                    * $this->getFirstCirculation($first_circ) * 1.352
                    * $this->getDateAchat($date_achat) * 1.352;

                return ($base_price * $calc) + $base_price;
        }
    }
    private function velo($type_abo, $first_circ, $date_achat)
    {
        switch ($type_abo) {
            case 'tiers':
                $base_price = 0.30;
                $calc = $this->getFirstCirculation($first_circ)
                * $this->getDateAchat($date_achat);

                return ($base_price * $calc) + $base_price;

            default:
                $base_price = 1.99;
                $calc = $this->getFirstCirculation($first_circ) * 1.352
                    * $this->getDateAchat($date_achat) * 1.352;

                return ($base_price * $calc) + $base_price;
        }
    }
    private function other($first_circ, $date_achat)
    {
        $base_price = 0.50;
        $calc = $this->getFirstCirculation($first_circ)
            * $this->getDateAchat($date_achat);

        return ($base_price * $calc) + $base_price;
    }



    private function getPuissance($puissance)
    {
        switch ($puissance) {
            case $puissance <= 4:
                return 1.030;

            case $puissance > 4 && $puissance <= 5:
                return 1.080;

            default:
                return 1.1;
        }
    }

    private function getAlimentation($alim)
    {
        switch ($alim) {
            case 'essence':
                return 1.830;

            case 'gazoil':
                return 1.650;

            case 'gpl':
                return 1.730;

            case 'electrique':
                return 1.230;

            default:
                return 1.3;
        }
    }

    private function getFirstCirculation($date)
    {
        //dd($date->diffInYears(now()));
        if($date->diffInYears(now()) >= 7) {
            return 1.750;
        } elseif($date->diffInYears(now()) < 7 && $date->diffInYears(now()) >= 3) {
            return 1.530;
        } else {
            return 1.200;
        }
    }

    private function getDateAchat($date)
    {
        $days = $date->diffInDays(now());
        return ($days / 1000) + 1;
    }


}
