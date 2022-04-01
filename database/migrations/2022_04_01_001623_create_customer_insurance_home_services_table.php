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
        Schema::create('customer_insurance_home_services', function (Blueprint $table) {
            $table->id();
            $table->boolean('breakdown')->default(false);
            $table->boolean('construction')->default(false);
            $table->boolean('relocation')->default(false);

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
        Schema::dropIfExists('customer_insurance_home_services');
    }
};
