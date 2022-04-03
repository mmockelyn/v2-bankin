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
        Schema::create('customer_insurance_home_assures', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->timestamp('date_birth');
            $table->string("type_habitant")->default('Souscripteur');
            $table->unsignedBigInteger('insurance_home_id');

            $table->foreign('insurance_home_id')->references('id')->on('customer_insurance_homes')
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
        Schema::dropIfExists('customer_insurance_home_assures');
    }
};
