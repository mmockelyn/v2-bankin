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
        Schema::create('customer_levies', function (Blueprint $table) {
            $table->id();
            $table->string('creditor');
            $table->uuid()->unique();
            $table->string('mandat');
            $table->decimal('amount', 64, 0);
            $table->enum('status', ['waiting', 'processed', 'rejected', 'return', 'refunded']);
            $table->timestamps();

            $table->foreignId('customer_wallet_id')
                            ->constrained()
                            ->cascadeOnUpdate()
                            ->cascadeOnDelete();

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
        Schema::dropIfExists('customer_levies');
    }
};
