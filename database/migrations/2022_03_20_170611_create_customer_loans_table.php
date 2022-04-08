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
        Schema::create('customer_loans', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('reference');
            $table->float('amount_loan')->comment('Montant du crédit demander');
            $table->float('amount_interest')->comment("Montant des interet du par le client");
            $table->float('amount_du')->comment("Total des sommes du par le client (Credit + Interet - mensualités payé)");
            $table->float('mensuality')->comment('Mensualité du par le client par mois');
            $table->integer('prlv_day')->default(5)->comment("Jours du prélèvement de la mensualité");
            $table->integer('duration')->comment("Durée total du contrat en année");
            $table->integer('status')->default(0)->comment("0: Brouillon /1: En Etude /2: Accepter /3: Refuser/4: En cours/5: Terminer/9: Erreur de Paiement");
            $table->boolean('signed_customer')->default(false);
            $table->boolean('signed_bank')->default(false);
            $table->boolean('alert')->default(false);
            $table->enum('assurance_type', ["D", "DIM", "DIMC"])->default('DIM');
            $table->timestamps();

            $table->foreignId('loan_plan_id')
                            ->constrained()
                            ->cascadeOnUpdate()
                            ->cascadeOnDelete();

            $table->foreignId('customer_id')
                            ->constrained()
                            ->cascadeOnUpdate()
                            ->cascadeOnDelete();


            $table->foreignId('customer_wallet_id')
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
        Schema::dropIfExists('customer_loans');
    }
};
