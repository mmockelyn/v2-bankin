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
        if ($duration <= 3) {
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

        if ($insurance != null) {
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

    public function create($amount_loan, $amount_interest, $amount_du, $mensuality, $duration, $assurance, $loan_plan, $wallet_id, $customer_id, $status)
    {
        $reference = \Str::upper(\Str::random(8));
        $loan = CustomerLoan::create([
            "uuid" => \Str::uuid(),
            "reference" => $reference,
            "amount_loan" => $amount_loan,
            "amount_interest" => $amount_interest,
            "amount_du" => $amount_du,
            "mensuality" => $mensuality,
            "duration" => $duration,
            "assurance_type" => $assurance,
            "loan_plan_id" => $loan_plan,
            "customer_wallet_id" => $wallet_id,
            "customer_id" => $customer_id,
            "status" => $status
        ]);

        $this->generatePdfInfoPrecontract($loan->customer, $reference, $loan);
        $this->generatePdfFicheExplicative($loan->customer, $reference, $loan);
        $this->generatePdfDialogue($loan->customer, $reference);



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

        $name = "Fiche Dialogue " . $refContract . " - " . now()->format("Ymd");

        $document = $file->createDocument($name, $customer, 3, $refContract, true, false, false, null);
        $budget = [
            "credit" => [
                "pro_income" => $customer->situation->pro_incoming,
                "patrimoine" => $customer->situation->patrimoine,
                "total" => $customer->situation->pro_incoming + $customer->situation->patrimoine,
            ],
            "debit" => [
                "loyer" => $customer->situation->rent,
                "credit" => $customer->situation->credit,
                "divers" => $customer->situation->divers,
                "total" => $customer->situation->rent + $customer->situation->credit + $customer->situation->divers
            ]
        ];

        $pdf = PDF::loadView('agence.pdf.contract.loan.facelia.dialog', compact('agence', 'customer', 'document', 'budget'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size', '1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right', '[page]/[topage]');
        $pdf->setOption('footer-font-size', 8);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->save(public_path('/storage/gdd/' . $customer->id . '/contract/' . \Str::slug($name) . '.pdf'), true);

        return $document;
    }

    public function generatePdfInfoPrecontract($customer, $refContract, $loan)
    {
        $agence = $customer->user->agence;

        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $customer)
            ->render();

        $file = new DocumentFile();

        $name = "Information Précontractuel " . $refContract . " - " . now()->format("Ymd");

        $document = $file->createDocument($name, $customer, 3, $refContract, true, false, false, null);


        $pdf = PDF::loadView('agence.pdf.contract.loan.facelia.info_precontractuel', compact('agence', 'customer', 'document', 'loan'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size', '1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right', '[page]/[topage]');
        $pdf->setOption('footer-font-size', 8);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->save(public_path('/storage/gdd/' . $customer->id . '/contract/' . \Str::slug($name) . '.pdf'), true);

        return $document;
    }

    public function generatePdfFicheExplicative($customer, $refContract, $loan)
    {
        $agence = $customer->user->agence;

        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $customer)
            ->render();

        $file = new DocumentFile();

        $name = "Fiche Explicative " . $refContract . " - " . now()->format("Ymd");

        $document = $file->createDocument($name, $customer, 3, $refContract, true, false, false, null);


        $pdf = PDF::loadView('agence.pdf.contract.loan.facelia.fiche_explicative', compact('agence', 'customer', 'document', 'loan'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size', '1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right', '[page]/[topage]');
        $pdf->setOption('footer-font-size', 8);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->save(public_path('/storage/gdd/' . $customer->id . '/contract/' . \Str::slug($name) . '.pdf'), true);

        return $document;
    }

    public static function getTypeContract($loan)
    {
        return $loan->plan->name;
    }

    public static function restIn($loan, $customer)
    {
        return $customer->situation->pro_incoming - $loan->mensuality;
    }

    public function checkAvailibilityContract($simulate, $customer)
    {
        $r = 0;

        // Vérification de la cotation client
        $r = $this->verifCotation($customer, $r);

        // Vérification du solde client sur l'ensemble de ces comptes
        $r = $this->verifSoldeAllWallets($customer, $r);

        // Calcul et vérification du surrendettement
        $r = $this->verifSurren($customer, $simulate['amount_mensuality'], $r);

        // Calcul du reste à vivre
        $r = $this->verifRestIn($customer, $simulate['amount_mensuality'], $r);

        // Verification du budget du client
        $r = $this->verifBudgetClient($customer, $simulate['amount_mensuality'], $r);

        // Vérification du nombre de crédit en cours dans la banque
        $r = $this->verifNbLoanContract($customer, $r);


        if ($r <= 2) {
            return "DECLINED";
        } elseif ($r > 2 && $r <= 4) {
            return "WAITING";
        } else {
            return "ACCEPTED";
        }
    }

    private function verifCotation($customer, $r)
    {
        if ($customer->cot <= 3) {
            $r--;
        } elseif ($customer->cot > 3 && $customer->cot <= 7) {
            $r += 0;
        } else {
            $r++;
        }

        return $r;
    }

    private function verifSoldeAllWallets($customer, $r)
    {
        $sum = $customer->wallets()->where('type', 'account')->where('status', "ACTIVE")->sum('balance');

        if ($sum < 0) {
            $r--;
        } else {
            $r++;
        }

        return $r;
    }

    private function verifSurren($customer, $mensuality, $r)
    {
        $calc = $mensuality * 100 / $customer->situation->pro_incoming;

        if ($calc <= 15) {
            $r++;
        } elseif ($calc > 15 && $calc <= 25) {
            $r += 0;
        } else {
            $r--;
        }

        return $r;
    }

    private function verifRestIn($customer, $mensuality, $r)
    {
        $calc = $customer->situation->pro_incoming - $mensuality;

        if ($calc <= 500) {
            $r--;
        } else {
            $r++;
        }

        return $r;
    }

    private function verifBudgetClient($customer, $mensuality, $r)
    {
        $calc_credit = $customer->situation->pro_incoming + $customer->situation->patrimoine;
        $calc_debit = $customer->situation->rent + $customer->situation->credit + $customer->situation->divers + $mensuality;
        $total = $calc_credit - $calc_debit;

        if ($total <= 0) {
            $r--;
        } else {
            $r++;
        }

        return $r;
    }

    private function verifNbLoanContract($customer, $r)
    {
        if ($customer->loans()->count() == 0) {
            $r++;
        } elseif ($customer->loans()->count() > 0 && $customer->loans()->count() <= 2) {
            $r += 0;
        } else {
            $r--;
        }

        return $r;
    }
}
