<?php

namespace App\Console\Commands;

use App\Helpers\Customer\Transfers;
use Illuminate\Console\Command;

class RecurringTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:Transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifie les transfers bancaire actif';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Transfers::recurringTransfer();
        return 0;
    }
}
