<?php


namespace App\Helpers;


class InsurancePriceSecuryHigh
{
    public function simulate($type_material, $value, $occaz, $date_achat)
    {
        switch ($type_material) {
            case 'computeur':
                $base_price = 4.99;
                $calc = $this->getValue($value)
                    * $this->getOccaz($occaz)
                    * $this->getAchat($date_achat);

                return ($base_price * $calc) + $base_price;

            case 'handheld':
                $base_price = 1.05;
                $calc = $this->getValue($value)
                    * $this->getOccaz($occaz)
                    * $this->getAchat($date_achat);

                return ($base_price * $calc) + $base_price;

            case 'video':
                $base_price = 1.30;
                $calc = $this->getValue($value)
                    * $this->getOccaz($occaz)
                    * $this->getAchat($date_achat);

                return ($base_price * $calc) + $base_price;

            default:
                $base_price = 0.50;
                $calc = $this->getValue($value)
                    * $this->getOccaz($occaz)
                    * $this->getAchat($date_achat);

                return ($base_price * $calc) + $base_price;
        }
    }

    private function getValue($value)
    {
        if ($value <= 300) {
            return 1.125;
        } elseif ($value > 300 && $value <= 600) {
            return 1.345;
        } elseif ($value > 600 && $value <= 900) {
            return 1.650;
        } elseif ($value > 900 && $value <= 1500) {
            return 1.960;
        } else {
            return 2.150;
        }
    }

    private function getOccaz($occaz)
    {
        return $occaz == true ? 1.930 : 1;
    }

    private function getAchat($date_achat)
    {
        $days = $date_achat->diffInDays(now());
        return ($days / 1000) + 1;
    }


}
