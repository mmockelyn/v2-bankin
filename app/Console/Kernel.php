<?php

namespace App\Console;

use App\Helpers\Customer\Customer;
use App\Helpers\Customer\Transfers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call([Customer::class, 'verified_account'])->hourly();
        $schedule->call([Transfers::class, 'recurringTransfer'])->dailyAt("10:00:00")->dailyAt("14:00:00")->dailyAt("16:00:00");
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
