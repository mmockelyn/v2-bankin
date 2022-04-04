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
        Schema::create('customer_insurance_securi_highs', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->float('cotisation');
            $table->enum('cot_interval', ["mensual", "trim", "annual"])->default("mensual");
            $table->integer('cot_day_payment')->default(15);
            $table->timestamp('date_effective');
            $table->enum("status", ["open", "progress", "cancel"])->default('open');
            $table->timestamps();

            $table->foreignId('customer_id')
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
        Schema::dropIfExists('customer_insurance_securi_highs');
    }
};
