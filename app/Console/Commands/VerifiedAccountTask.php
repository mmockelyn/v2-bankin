<?php

namespace App\Console\Commands;

use App\Helpers\Customer\Customer;
use Illuminate\Console\Command;

class VerifiedAccountTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:verified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifie les comptes en cours de création';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Customer::verified_account();
        return 0;
    }
}
