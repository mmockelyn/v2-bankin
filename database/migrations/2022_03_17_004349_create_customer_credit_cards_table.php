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
        Schema::create('customer_credit_cards', function (Blueprint $table) {
            $table->id();
            $table->string('currency', 3)->default('EUR');
            $table->string('exp_month', 2);
            $table->string('exp_year', 4);
            $table->string('number');
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'CANCELED'])->default('INACTIVE');
            $table->enum('type', ['PHYSICAL', 'VIRTUAL'])->default('PHYSICAL');
            $table->enum('brand', ['VISA', 'MASTERCARD'])->default('VISA');
            $table->enum('support', ['ELECTRON', 'CLASSIC', 'PREMIUM', 'INFINITE'])->default('CLASSIC');
            $table->enum('debit', ['DIFFERED', 'IMMEDIATE'])->default('IMMEDIATE');
            $table->string('cvc', 4);
            $table->boolean('external_payment')->default(true);
            $table->boolean('abroad_payment')->default(true);
            $table->string('code');
            $table->float('withdraw_limit');
            $table->float('payment_limit');
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
        Schema::dropIfExists('customer_credit_cards');
    }
};
