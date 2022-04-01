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
        Schema::create('customer_insurance_home_equips', function (Blueprint $table) {
            $table->id();
            $table->boolean('jardin')->default(false);
            $table->boolean('piscine')->default(false);
            $table->boolean('jacuzzi')->default(false);
            $table->boolean('veranda')->default(false);
            $table->boolean('chemine')->default(false);

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
        Schema::dropIfExists('customer_insurance_home_equips');
    }
};
