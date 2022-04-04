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
        Schema::create('customer_insurance_auto_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->string('reference')->nullable();
            $table->string('puissance')->nullable();
            $table->enum("alimentation", ["essence", "gazoil", "gpl", "electrique", "hybride"]);
            $table->timestamp('first_circ');
            $table->timestamp('date_achat');

            $table->unsignedBigInteger('insurance_auto_id');

            $table->foreign('insurance_auto_id')->references('id')->on('customer_insurance_autos')
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
        Schema::dropIfExists('customer_insurance_auto_vehicles');
    }
};
