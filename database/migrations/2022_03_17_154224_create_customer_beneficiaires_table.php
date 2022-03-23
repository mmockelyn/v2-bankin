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
        Schema::create('customer_beneficiaires', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->enum("type", ["corporate", "retail"])->default('retail');
            $table->string('company')->nullable();
            $table->enum("civility", ["M", "MME"])->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();

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
        Schema::dropIfExists('customer_beneficiaires');
    }
};
