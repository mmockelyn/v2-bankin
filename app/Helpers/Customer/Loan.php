<?php


namespace App\Helpers\Customer;


use App\Models\Core\LoanPlan;
use App\Models\Customer\CustomerLoan;
use PDF;

class Loan
{
    public function simulate($amount, $duration, $insurance)
    {
        $amount_n = $amount / $duration;

        $facelia_interest = LoanPlan::with('interests')->find(1);
        //dd($facelia_interest->interests[0]->percent_interest);
        if($duration <= 3) {
            $interest_amount = $amount * ($facelia_interest->interests[0]->percent_interest / 100) / $duration;
            $taux = $facelia_interest->interests[0]->percent_interest;
        } elseif ($duration > 3 && $duration <= 5) {
            $interest_amount = $amount * ($facelia_interest->interests[1]->percent_interest / 100) / $duration;
            $taux = $facelia_interest->interests[1]->percent_interest;
        } elseif ($duration > 5 && $duration <= 10) {
            $interest_amount = $amount * ($facelia_interest->interests[2]->percent_interest / 100) / $duration;
            $taux = $facelia_interest->interests[2]->percent_interest;
        } elseif ($duration > 10 && $duration <= 20) {
            $interest_amount = $amount * ($facelia_interest->interests[3]->percent_interest / 100) / $duration;
            $taux = $facelia_interest->interests[3]->percent_interest;
        } else {
            $interest_amount = $amount * ($facelia_interest->interests[4]->percent_interest / 100) / $duration;
            $taux = $facelia_interest->interests[4]->percent_interest;
        }

        $mensuality = $amount_n + $interest_amount;

        if($insurance != null) {
            switch ($insurance) {
                case 'D':
                    $assurance = $mensuality * (3.90 / 100);
                    $mensuality = $mensuality + $assurance;
                    break;

                case 'DIM':
                    $assurance = $mensuality * (6.90 / 100);
                    $mensuality = $mensuality + $assurance;
                    break;

                case 'DIMC':
                    $assurance = $mensuality * (9.79 / 100);
                    $mensuality = $mensuality + $assurance;
                    break;

                default:
                    $assurance = 0;
                    $mensuality = $mensuality + $assurance;

            }
        } else {
            $assurance = 0;
            $mensuality = $mensuality + $assurance;
        }

        return collect([
            "amount" => $amount,
            "interest" => $interest_amount * $duration,
            "du" => $amount + ($interest_amount * $duration),
            "mensuality" => $duration,
            "amount_mensuality" => $mensuality,
            "taux" => $taux,
            "type_assurance" => $insurance != null ? $insurance : "Aucune",
            "assurance" => $insurance != null ? $assurance : 0
        ]);
    }

    public function create()
    {
        $loan = CustomerLoan::create([
            "uuid" => \Str::uuid(),
            "reference" => \Str::upper(\Str::random(8)),
            "amount_loan" => $amount_loan,
            "amount_interest" => $amount_interest,
            "amount_du" => $amount_du,
            "mensuality" => $mensuality,
            "duration" => $duration,
            "assurance_type" => $assurance,
            "loan_plan_id" => $loan_plan,
            "customer_wallet_id" => $wallet_id
        ]);



    }

    public function generatePdfDialogue($customer, $refContract)
    {
        $agence = $customer->user->agence;

        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $customer)
            ->render();

        $file = new DocumentFile();

        $name = "Fiche Dialogue ".$refContract." - ".now()->format("Ymd");

        $document = $file->createDocument($name, $customer, 3, $refContract, true, false, false, null);

        $pdf = PDF::loadView('agence.pdf.contract.loan.facelia.dialog', compact('agence', 'customer', 'document'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size','1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right','[page]/[topage]');
        $pdf->setOption('footer-font-size',8);
        $pdf->setOption('margin-left',0);
        $pdf->setOption('margin-right',0);
        $pdf->save(public_path('/storage/gdd/'.$customer->id.'/contract/'.\Str::slug($name).'.pdf'), true);

        return $pdf->inline('PDf.pdf');
    }
}
