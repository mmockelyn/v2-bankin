<?php

namespace App\Console\Commands\Account;

use App\Helpers\Customer\Customer;
use App\Mail\Account\Alert\DebitSolde;
use App\Mail\Account\Alert\OutdateDebitSolde;
use App\Mail\Account\Alert\ReactiveAccount;
use App\Mail\Account\Alert\SuspendedAccount;
use App\Models\Customer\CustomerWallet;
use Illuminate\Console\Command;

class VerifySoldeAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:solde';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifie le soldes des comptes et envoie une alerte au client et à l\'agent stipulant sont compte débiteur';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Vérificateur de solde débiteur 1ere relance
        foreach (CustomerWallet::where('type', 'account')->where('status', 'ACTIVE')->get() as $wallet) {
            sleep(1);
            $solde = $wallet->balance + $wallet->outstanding;
            if($solde <= 0 && $wallet->alert_debit != true) {
                // Notification
                $this->error(Customer::getName($wallet->customer).': Solde:'.eur($solde));

                $wallet->alert_debit = true;
                $wallet->date_alert_debit = now();
                $wallet->save();

                \Mail::to($wallet->customer->user)->send(new DebitSolde($wallet->customer, $solde, $wallet));
            }
        }

        //Vérificateur de solde débiteur 2eme relance
        foreach (CustomerWallet::where('type', 'account')->where('status', 'ACTIVE')->where('alert_debit', 1)->get() as $wallet) {
            sleep(1);
            $solde = $wallet->balance + $wallet->outstanding;
            if($wallet->date_alert_debit->diffInDays(now()) == 15) {
                $this->error(Customer::getName($wallet->customer).': Compte en souffrance frais supplémentaire');

                $wallet->fee_alert = true;
                $wallet->save();

                \Mail::to($wallet->customer->user)->send(new OutdateDebitSolde($wallet->customer, $solde, $wallet));
            }
        }

        //Vérificateur de solde débiteur 3eme relance, suspension du compte
        foreach (CustomerWallet::where('type', 'account')->where('status', 'ACTIVE')->where('alert_debit', 1)->get() as $wallet) {
            sleep(1);
            $solde = $wallet->balance + $wallet->outstanding;

            if($wallet->date_alert_debit->diffInDays(now()) == 30) {
                $this->error(Customer::getName($wallet->customer).': Compte suspendu !');

                $wallet->status = "SUSPENDED";
                $wallet->save();

                \Mail::to($wallet->customer->user)->send(new SuspendedAccount($wallet, $solde));
            }
        }

        //Vérificateur de solde créditeur après régularisation
        foreach (CustomerWallet::where('type', 'account')->where('status', 'ACTIVE')->where('alert_debit', 1)->orWhere('status', 'SUSPENDED')->get() as $wallet) {
            sleep(1);
            $solde = $wallet->balance + $wallet->outstanding;

            if($solde >= 0) {
                $this->info(Customer::getName($wallet->customer).': Irrégularité réglé !');

                $wallet->status = "ACTIVE";
                $wallet->fee_alert = false;
                $wallet->alert_debit = false;
                $wallet->date_alert_debit = null;
                $wallet->save();

                \Mail::to($wallet->customer->user)->send(new ReactiveAccount($wallet, $solde));
            }
        }

        return 0;
    }
}
