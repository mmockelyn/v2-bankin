<?php


namespace App\Helpers;


class InsurancePriceHome
{
    public function config()
    {
        return (object)collect([
            0 => [
                "type" => "essentiel",
                "base_price" => 6.90,
                "house" => [
                    "coef_status" => [
                        "locataire" => 0,
                        "proprietaire" => 0.1966,
                    ],
                    "coef_type" => [
                        "principal" => 0,
                        "secondaire" => 0.1450,
                    ],
                    "coef_piece" => [
                        1 => 0.015,
                        2 => 0.030,
                        3 => 0.045,
                        4 => 0.060,
                        5 => 0.075,
                        6 => 0.090,
                        7 => 0.105
                    ],
                    "coef_surface" => [
                        30 => 0.030,
                        50 => 0.050,
                        100 => 0.100,
                        150 => 0.150,
                        300 => 0.300,
                        500 => 0.500,
                        1000 => 1,
                        1500 => 1.5
                    ],
                    "coef_type_logement" => [
                        "maison" => 0.2505,
                        "appart" => 0.2508,
                        "autre" => 0.2950
                    ],
                    "coef_year" => [
                        "t1" => 0.9650,
                        "t2" => 0.7860,
                        "t3" => 0.6325,
                        "t4" => 0.4750,
                        "t5" => 0.2450
                    ]
                ],
                "equip" => [
                    "jardin" => 0.025,
                    "piscine" => 0.156,
                    "jacuzzi" => 0.378,
                    "veranda" => 0.278,
                    "chemine" => 0.498,
                ],
                "assurplus" => 1.459
            ],
            1 => [
                "type" => "confort",
                "base_price" => 9.90,
                "house" => [
                    "coef_status" => [
                        "locataire" => 0,
                        "proprietaire" => 0.1966 * 0.196,
                    ],
                    "coef_type" => [
                        "principal" => 0,
                        "secondaire" => 0.1450 * 0.196,
                    ],
                    "coef_piece" => [
                        1 => 0.015 * 0.196,
                        2 => 0.030 * 0.196,
                        3 => 0.045 * 0.196,
                        4 => 0.060 * 0.196,
                        5 => 0.075 * 0.196,
                        6 => 0.090 * 0.196,
                        7 => 0.105 * 0.196
                    ],
                    "coef_surface" => [
                        30 => 0.030 * 0.196,
                        50 => 0.050 * 0.196,
                        100 => 0.100 * 0.196,
                        150 => 0.150 * 0.196,
                        300 => 0.300 * 0.196,
                        500 => 0.500 * 0.196,
                        1000 => 1 * 0.196,
                        1500 => 1.5 * 0.196
                    ],
                    "coef_type_logement" => [
                        "maison" => 0.2505 * 0.196,
                        "appart" => 0.2508 * 0.196,
                        "autre" => 0.2950 * 0.196
                    ],
                    "coef_year" => [
                        "t1" => 0.9650 * 0.196,
                        "t2" => 0.7860 * 0.196,
                        "t3" => 0.6325 * 0.196,
                        "t4" => 0.4750 * 0.196,
                        "t5" => 0.2450 * 0.196
                    ]
                ],
                "equip" => [
                    "jardin" => 0.025 * 0.196,
                    "piscine" => 0.156 * 0.196,
                    "jacuzzi" => 0.378 * 0.196,
                    "veranda" => 0.278 * 0.196,
                    "chemine" => 0.498 * 0.196,
                ],
                "assurplus" => 1.459 * 0.196
            ],
            2 => [
                "type" => "premium",
                "base_price" => 19.90,
                "house" => [
                    "coef_status" => [
                        "locataire" => 0,
                        "proprietaire" => 0.1966 * 0.398,
                    ],
                    "coef_type" => [
                        "principal" => 0,
                        "secondaire" => 0.1450 * 0.398,
                    ],
                    "coef_piece" => [
                        1 => 0.015 * 0.398,
                        2 => 0.030 * 0.398,
                        3 => 0.045 * 0.398,
                        4 => 0.060 * 0.398,
                        5 => 0.075 * 0.398,
                        6 => 0.090 * 0.398,
                        7 => 0.105 * 0.398
                    ],
                    "coef_surface" => [
                        30 => 0.030 * 0.398,
                        50 => 0.050 * 0.398,
                        100 => 0.100 * 0.398,
                        150 => 0.150 * 0.398,
                        300 => 0.300 * 0.398,
                        500 => 0.500 * 0.398,
                        1000 => 1 * 0.398,
                        1500 => 1.5 * 0.398
                    ],
                    "coef_type_logement" => [
                        "maison" => 0.2505 * 0.398,
                        "appart" => 0.2508 * 0.398,
                        "autre" => 0.2950 * 0.398
                    ],
                    "coef_year" => [
                        "t1" => 0.9650 * 0.398,
                        "t2" => 0.7860 * 0.398,
                        "t3" => 0.6325 * 0.398,
                        "t4" => 0.4750 * 0.398,
                        "t5" => 0.2450 * 0.398
                    ]
                ],
                "equip" => [
                    "jardin" => 0.025 * 0.398,
                    "piscine" => 0.156 * 0.398,
                    "jacuzzi" => 0.378 * 0.398,
                    "veranda" => 0.278 * 0.398,
                    "chemine" => 0.498 * 0.398,
                ],
                "assurplus" => 1.459 * 0.398
            ]
        ]);
    }

    public function simulate($type, $status, $type_logement, $nb_piece, $surface, $type_hab, $tranche, bool $jardin, bool $piscine, bool $jacuzzi, bool $veranda, bool $chemine, int $nb_beneficiaire)
    {
        switch ($type) {
            case 'essentiel':
                $base_price = 1.99;
                $home_calc =
                    ($status == 'locataire' ? 1.1 : 1.1966)
                    * ($type_logement == 'principal' ? 1.1 : 1.1450)
                    * $this->getCoefPiece($nb_piece)
                    * $this->getCoefSurface($surface)
                    * $this->getTypeHab($type_hab)
                    * $this->getYear($tranche)
                    * $this->equip_jardin($jardin)
                    * $this->equip_piscine($piscine)
                    * $this->equip_jacuzzi($jacuzzi)
                    * $this->equip_veranda($veranda)
                    * $this->equip_chemine($chemine)
                    * $this->assurplus($nb_beneficiaire);


                return ($base_price * $home_calc) + $base_price;

            case 'confort':
                $base_price = 2.99;
                $home_calc =
                    ($status == 'locataire' ? 1.1 : 1.1966) * 1.156
                    * ($type_logement == 'principal' ? 1.1 : 1.1450) * 1.156
                    * $this->getCoefPiece($nb_piece) * 1.156
                    * $this->getCoefSurface($surface) * 1.156
                    * $this->getTypeHab($type_hab) * 1.156
                    * $this->getYear($tranche) * 1.156
                    * $this->equip_jardin($jardin) * 1.156
                    * $this->equip_piscine($piscine) * 1.156
                    * $this->equip_jacuzzi($jacuzzi) * 1.156
                    * $this->equip_veranda($veranda) * 1.156
                    * $this->equip_chemine($chemine) * 1.156
                    * $this->assurplus($nb_beneficiaire) * 1.156;


                return ($base_price * $home_calc) + $base_price;

            case 'premium':
                $base_price = 4.99;
                $home_calc =
                    ($status == 'locataire' ? 1.1 : 1.1966) * 1.189
                    * ($type_logement == 'principal' ? 1.1 : 1.1450) * 1.189
                    * $this->getCoefPiece($nb_piece) * 1.189
                    * $this->getCoefSurface($surface) * 1.189
                    * $this->getTypeHab($type_hab) * 1.189
                    * $this->getYear($tranche) * 1.189
                    * $this->equip_jardin($jardin) * 1.189
                    * $this->equip_piscine($piscine) * 1.189
                    * $this->equip_jacuzzi($jacuzzi) * 1.189
                    * $this->equip_veranda($veranda) * 1.189
                    * $this->equip_chemine($chemine) * 1.189
                    * $this->assurplus($nb_beneficiaire) * 1.189;


                return ($base_price * $home_calc) + $base_price;


        }
    }

    private function getCoefPiece($nb_piece)
    {
        switch ($nb_piece) {
            case 1:
                return 1.015;
            case 2:
                return 1.030;
            case 3:
                return 1.045;
            case 4:
                return 1.060;
            case 5:
                return 1.075;
            case 6:
                return 1.090;
            case 7:
                return 1.105;
            default:
                return 1.120;
        }
    }

    private function getCoefSurface($surface)
    {
        switch ($surface) {
            case $surface <= 30:
                return 1.030;
            case $surface > 30 && $surface <= 50:
                return 1.050;
            case $surface > 50 && $surface <= 100:
                return 1.100;
            case $surface > 100 && $surface <= 150:
                return 1.150;
            case $surface > 150 && $surface <= 300:
                return 1.300;
            case $surface > 300 && $surface <= 500:
                return 1.500;
            case $surface > 500 && $surface <= 1000:
                return 2.000;
            default:
                return 2.500;
        }
    }

    private function getTypeHab($type)
    {
        switch ($type) {
            case 'maison':
                return 1.2505;
            case 'appart':
                return 1.2508;
            default:
                return 1.2950;
        }
    }

    private function getYear($tranche)
    {
        switch ($tranche) {
            case 't1':
                return 1.9650;
            case 't2':
                return 1.7860;
            case 't3':
                return 1.6325;
            case 't4':
                return 1.4750;
            default:
                return 1.2450;
        }
    }

    private function equip_jardin($jardin)
    {
        return $jardin == true ? 1.025 : 1;
    }

    private function equip_piscine($piscine)
    {
        return $piscine == true ? 1.156 : 1;
    }

    private function equip_jacuzzi($jacuzzi)
    {
        return $jacuzzi == true ? 1.378 : 1;
    }

    private function equip_veranda($veranda)
    {
        return $veranda == true ? 1.278 : 1;
    }

    private function equip_chemine($chemine)
    {
        return $chemine == true ? 1.459 : 1;
    }

    private function assurplus($nb_beneficiaire)
    {
        if ($nb_beneficiaire == 0) {
            return 1;
        } else {
            return $nb_beneficiaire * 1.459;
        }
    }

}
