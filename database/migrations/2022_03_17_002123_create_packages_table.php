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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price')->default(0);
            $table->enum('type_prlv', ['PONCTUAL', 'MENSUAL', 'TRIM', 'DEC', 'ANNUAL'])->default('MENSUAL');
            $table->enum('type', ['pack', 'service'])->default('service');
            $table->boolean('visa_classic')->default(true);
            $table->boolean('check_deposit')->default(true);
            $table->boolean('payment_withdraw')->default(true);
            $table->boolean('overdraft')->default(false);
            $table->boolean('cash_deposit')->default(false);
            $table->boolean('withdraw_international')->default(false);
            $table->boolean('payment_international')->default(false);
            $table->boolean('payment_insurance')->default(false);
            $table->boolean('check')->default(false);
            $table->integer("nb_carte_physique")->default(1);
            $table->integer("nb_carte_virtuel")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
