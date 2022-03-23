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
        Schema::create('customer_wallets', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('number_account');
            $table->enum('type', ["account", "loan", "investment"])->default('account');
            $table->enum('status', ['PENDING', 'ACTIVE', 'FAILED', 'SUSPENDED', 'CLOSED'])->default('PENDING');
            $table->float('balance')->default(0);
            $table->float('balance_coming')->default(0);
            $table->string('currency', 3)->default('EUR');
            $table->string('iban');
            $table->float('outstanding')->default(0);

            $table->foreignId('customer_id')
                            ->constrained()
                            ->cascadeOnUpdate()
                            ->cascadeOnDelete();

            $table->foreignId('agency_id')
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
        Schema::dropIfExists('customer_wallets');
    }
};
