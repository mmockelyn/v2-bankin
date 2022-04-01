<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_insurance_home_houses', function (Blueprint $table) {
            $table->id();
            $table->enum("status", ["locataire", "proprietaire"]);
            $table->enum('type', ["principal", "secondaire"]);
            $table->string('address');
            $table->integer("pieces");
            $table->integer('surface');
            $table->enum("type_logement", ["maison", "appart", "autre"]);
            $table->enum("year_construction", ["t1", "t2", "t3", "t4", "t5"])->comment("T1: Antérieur à 1900 / T2: Entre 1900 et 1950 / T3: Entre 1950 et 1982 / T4: Entre 1982 et 1996 / T5: Supérieur à 1996");

            $table->foreignId('customer_insurance_home_id')
                            ->constrained()
                            ->cascadeOnUpdate()
                            ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_insurance_home_houses');
    }
};
