<?php

namespace App\Console\Commands;

use App\Models\Core\CarMake;
use App\Models\Core\CarModel;
use App\Models\Core\CarTrim;
use App\Models\Core\CarYear;
use Illuminate\Console\Command;

class ImportCarInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:car';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import la liste des marque, detail voiture';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->info("IMPORT DE LA BASE VEHICULE");
        $marques = $this->importMarque();
        foreach ($marques as $marque) {
            $models = $this->importModels($marque);

            foreach ($models as $model) {
                $trims = $this->importTrims($model);

                foreach ($trims as $trim) {
                    $this->importYears($trim);
                }
            }
        }
        return 0;
    }

    private function importMarque()
    {
        $results = $makes = \Http::get('https://databases.one/api/?format=json&select=make&api_key=Your_Database_Api_Key')->object()->result;
        $bar = $this->output->createProgressBar(count($results));

        $bar->start();

        foreach ($results as $result) {
            CarMake::create([
                "make_id" => $result->make_id,
                "name" => $result->make
            ]);
            $bar->advance();
        }

        $bar->finish();

        return CarMake::all();
    }

    private function importModels($make)
    {
        $results = \Http::get('https://databases.one/api/?format=json&select=model&make_id='.$make->make_id.'&api_key=Your_Database_Api_Key')->object()->result;
        $bar = $this->output->createProgressBar(count($results));

        $bar->start();

        foreach ($results as $result) {
            CarModel::create([
                "model_id" => $result->model_id,
                "name" => $result->model,
                "car_make_id" => $make->id,
            ]);

            $bar->advance();
        }

        $bar->finish();

        return CarModel::all();
    }

    private function importTrims($model)
    {
        $results = \Http::get('https://databases.one/api/?format=json&select=trim&&model_id='.$model->model_id.'&api_key=Your_Database_Api_Key')->object()->result;
        $bar = $this->output->createProgressBar(count($results));

        $bar->start();

        foreach ($results as $result) {
            CarTrim::create([
                "trim_id" => $result->trim_id,
                "name" => $result->trim,
                "car_model_id" => $model->id,
            ]);

            $bar->advance();
        }

        $bar->finish();

        return CarTrim::all();
    }

    private function importYears($trim)
    {
        $results = \Http::get('https://databases.one/api/?format=json&select=year&trim_id='.$trim->trim_id.'&api_key=Your_Database_Api_Key')->object()->result;
        $bar = $this->output->createProgressBar(count($results));

        $bar->start();

        foreach ($results as $result) {
            CarYear::create([
                "year" => $result->year,
                "car_trim_id" => $trim->id,
            ]);

            $bar->advance();
        }

        $bar->finish();

        return CarYear::all();
    }


}
