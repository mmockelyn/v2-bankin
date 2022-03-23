<?php

namespace App\Console\Commands;

use App\Helpers\BicSwiftCode;
use App\Services\Bridge;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = Carbon::createFromDate('2022', '03', '22');
        $end = Carbon::createFromDate('2025', '03', '22');

        $diff = $start->diffInMonths($end);
        dd($diff);
        return 0;
    }
}
