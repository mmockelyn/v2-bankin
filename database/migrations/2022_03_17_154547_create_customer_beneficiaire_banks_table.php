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
        Schema::create('customer_beneficiaire_banks', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('currency')->default('EUR');
            $table->string('bankname');
            $table->string('iban');
            $table->string('bic')->nullable();
            $table->boolean('titulaire')->default(false);

            $table->foreignId('customer_beneficiaire_id')
                            ->constrained()
                            ->cascadeOnUpdate()
                            ->cascadeOnDelete();

            $table->foreignId('bank_id')
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
        Schema::dropIfExists('customer_beneficiaire_banks');
    }
};
