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
        Schema::create('customer_insurance_securi_high_materials', function (Blueprint $table) {
            $table->id();
            $table->enum("type", ["computeur", "handheld", "video", "other"]);
            $table->string('marque');
            $table->float('value');
            $table->boolean('occaz')->default(false);
            $table->timestamp('date_achat');

            $table->unsignedBigInteger('high_id');

            $table->foreign('high_id')->references('id')->on('customer_insurance_securi_highs')
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
        Schema::dropIfExists('customer_insurance_securi_high_materials');
    }
};
