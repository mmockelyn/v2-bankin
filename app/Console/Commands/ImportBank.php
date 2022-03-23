<?php

namespace App\Console\Commands;

use App\Helpers\BicSwiftCode;
use App\Models\Core\Bank;
use App\Services\Bridge;
use Illuminate\Console\Command;

class ImportBank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bridge:import';

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
        $bridge = new Bridge();
        $banks = $bridge->getListBanks();
        $bic = new BicSwiftCode();
        $bar = $this->output->createProgressBar(count((array)$banks->resources));

        $bar->start();

        foreach ($banks->resources as $bank) {
            if(Bank::where('bridge_id', $bank->id)->get()->count() == 0) {
                $in = collect($bic->getBankInformationsByBankName(\Str::upper($bank->name)))->first();
                Bank::create([
                    "bridge_id" => $bank->id,
                    "name" => $bank->name,
                    "logo" => $bank->logo_url,
                    "primary_color" => $bank->primary_color,
                    "country" => $bank->country_code,
                    "bic" => isset($in['swift_code']) ? $in['swift_code'] : null
                ]);
            } else {
                $in = collect($bic->getBankInformationsByBankName(\Str::upper($bank->name)))->first();
                Bank::where('bridge_id', $bank->id)->first()->update([
                    "name" => $bank->name,
                    "logo" => $bank->logo_url,
                    "primary_color" => $bank->primary_color,
                    "country" => $bank->country_code,
                    "bic" => isset($in['swift_code']) ? $in['swift_code'] : null
                ]);
            }
            $bar->advance();
        }
        $bar->finish();

        return 0;
    }
}
