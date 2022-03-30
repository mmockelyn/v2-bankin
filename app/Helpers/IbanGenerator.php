<?php


namespace App\Helpers;


use App\Helpers\Customer\DocumentFile;
use PDF;

class IbanGenerator
{
    protected $pays = ["Andorre","Autriche","Belgique","Bosnie-Herz�govine","Croatie","Chypre","R�publique Tch�que","Danemark","Estonie","Finlande","France","Allemagne","Gibraltar","Gr�ce","Hongrie","Islande","Irlande","Italie","Lettonie","Liechtenstein","Lituanie","Luxembourg","Mac�doine","Malte","Maurice","Mont�n�gro","Pays-Bas","Norv�ge","Pologne","Portugal","Roumanie","Serbie","Slovaquie","Slov�nie","Espagne","Su�de","Suisse","Tunisie","Turquie","Royaume-Uni","�les F�ro�","Guyane","Polyn�sie fran�aise","Terres australes et antarctiques fran�aises","Guadeloupe","Guernesey","�le de Man","Jersey","Martinique","Mayotte","Monaco","Nouvelle-Cal�donie","R�union","Saint-Pierre-et-Miquelon","Saint-Marin","Wallis-et-Futuna"];
    protected $codePays = ["AD","AT","BE","BA","HR","CY","CZ","DK","EE","FI","FR","DE","GI","GR","HU","IS","IE","IT","LV","LI","LT","LU","MK","MT","MU","ME","NL","NO","PL","PT","RO","RS","SK","SI","ES","SE","CH","TN","TR","GB","FO","GF","PF","TF","GP","GG","IM","JE","MQ","YT","MC","NC","RE","PM","SM","WF"];
    protected $verifIban = ['2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2','2'];
    protected $codeBanque = ['4','5','3','3','7','3','4','2','2','6','5','8','4','3','3','4','4','6','4','5','5','3','3','4','6','3','4','0','8','4','4','3','4','5','4','3','5','2','5','4','4','5','5','5','5','4','4','5','5','5','5','5','5','5','6','5'];
    protected $codeBranche = ['4','','','3','','5','6','2','','','5','','','4','5','2','6','5','','','','','','5','2','','','4','','4','','','','','4','','','3','1','6','0','5','5','5','5','6','6','5','5','5','5','5','5','5','5','5'];
    protected $numeroCompte = ['12','11','7','8','10','16','10','9','14','7','11','10','15','16','15','16','8','12','13','12','11','13','10','18','12','13','10','6','16','11','16','13','16','8','12','16','12','13','16','8','9','11','11','11','11','8','8','11','11','11','11','11','11','11','12','11'];
    protected $verifBBAN = ['','','2','2','','','','1','','1','2','','','','1','','','','','','','','2','','6','2','','1','','2','','2','','2','','1','','2','','','1','2','2','2','2','','','2','2','2','2','2','2','2','','2'];
    protected $lenghIban = ['24','20','16','20','21','28','24','18','20','18','27','22','23','27','28','26','22','27','21','21','20','20','19','31','30','22','18','15','28','25','24','22','24','19','24','24','21','24','26','22','18','27','27','27','27','22','22','27','27','27','27','27','27','27','27','27'];
    protected $totalPaysECBS;

    public function __construct()
    {
        $this->totalPaysECBS = sizeof($this->pays)-1;
    }

    public function generate($num_pays, $customer)
    {
        $code_branche = $customer->user->agence->code_guichet;
        $numero_cpt = $this->numero_cpt($num_pays);
        $key = $this->keyBBAN($num_pays);
        $pays = $this->codePays[$num_pays];
        $bban = "".$customer->user->agence->code_banque.$code_branche.$numero_cpt.$key.base_convert(substr($pays, 0, 1), 36, 10).base_convert(substr($pays, 1, 1), 36, 10)."00";
        $cleIban = '98' - bcmod($bban, 97);

        $rib = "".$customer->user->agence->code_banque.$code_branche.$numero_cpt.$key."";
        $iban = "".$pays.$cleIban.$rib."";

        return $iban;

    }

    public function control($iban)
    {
        $iban = str_replace(" ", "", $iban);
        $iban = str_replace("-", "", $iban);
        $taille = strlen($iban);

        $ibanverif = substr($iban, 4, $taille-4)."".substr($iban, 0, 4);

        for($cpt='0';$cpt<=$taille-1;$cpt++)
        {
            if (ereg ("[A-Z]", $ibanverif[$cpt])){ //Trouve la lettre
                $ibanverif = substr($ibanverif, 0, $cpt).base_convert($ibanverif[$cpt], 36, 10).
                    substr($ibanverif, $cpt+1, $taille); //R�assemblage
                $taille = $taille + 1 ; //La lettre est cod� sur 2 chiffres
            }
        }

        if(bcmod($ibanverif, '97') == '1'){
            $valid = true;
        }else{
            $valid = false;
        }

        return $valid;
    }

    public static function info($iban)
    {
        return \Http::get('https://api.ibanapi.com/v1/validate/'.$iban.'?api_key=ba53a7cb8493ce3e03c3968e81c799d33ee04e4f')->object();
    }

    protected function code_banque($numPays)
    {
        $code_b = null;
        for ($n = 0; $n <= $this->codeBanque[$numPays]; $n++) {
            $code_b = $code_b.mt_rand(1,9);
        }

        return $code_b;
    }

    protected function code_branche($numPays)
    {
        $code_b = null;
        for ($n = 0; $n <= $this->codeBranche[$numPays]; $n++) {
            $code_b = $code_b.mt_rand(1,9);
        }

        return $code_b;
    }

    protected function numero_cpt($numPays)
    {
        $code_b = null;
        for ($n = 0; $n <= $this->numeroCompte[$numPays]; $n++) {
            $code_b = $code_b.mt_rand(1,9);
        }

        return $code_b;
    }

    protected function keyBBAN($numPays)
    {
        if($this->verifBBAN[$numPays] != '') {
            $cleBBAN = 97 - (int) fmod(89 * $this->code_banque($numPays) + 15 * $this->code_branche($numPays) + 3 * $this->numero_cpt($numPays), 97);
        } else {
            $cleBBAN = null;
        }

        if($this->verifBBAN[$numPays] == 2) {
            if($cleBBAN < 10) {
                $cleBBAN = '0'.$cleBBAN;
            }
        }

        return $cleBBAN;
    }

    public function generatePdf($wallet)
    {
        $customer = $wallet->customer;
        $agence = $wallet->agency;
        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $wallet->customer)
            ->render();

        $file = new DocumentFile();
        $reference = \Str::upper(\Str::random(10));

        $name = "rib";

        $document = $file->createDocument($name, $wallet->customer, 4, $reference);

        $pdf = $pdf = PDF::loadView('agence.pdf.account.rib', compact('agence', 'customer', 'document', 'name', 'wallet'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size', '1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right', '[page]/[topage]');
        $pdf->setOption('footer-font-size', 8);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->save(public_path('/storage/gdd/'.$customer->id.'/courriers/'.\Str::slug($name).'.pdf'), true);

    }

}
