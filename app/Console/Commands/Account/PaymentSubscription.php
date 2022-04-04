<?php

namespace App\Console\Commands\Account;

use App\Helpers\Customer\Transaction;
use App\Models\User\User;
use Illuminate\Console\Command;

class PaymentSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:payment {--sub}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commande de paiement des frais bancaire et assimilé';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('agent', 0)->get();
        $transaction = new Transaction();
        if($this->option('sub')) {
            foreach ($users as $user) {
                if($user->customer->status_open_account == 'terminated') {
                    sleep(1);
                    $transaction->create('debit',
                        'subscription',
                        'Cotisation forfait '.$user->customer->package->name,
                        $user->customer->package->price,
                        $user->customer->wallets()->first()->id,
                        2,
                        8,
                        null,
                        true,
                        null,
                        now(),
                        $user->customer->setting->notif_com_mail == true ? true : false);
                }
            }
        }
        return 0;
    }
}
