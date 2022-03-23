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
        Schema::create('customer_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('notif_com_sms')->default(true);
            $table->boolean('notif_com_apps')->default(true);
            $table->boolean('notif_com_mail')->default(true);
            $table->integer("nb_carte_physique")->default(1);
            $table->integer("nb_carte_virtuel")->default(1);
            $table->integer("cheque")->default(0);

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
        Schema::dropIfExists('customer_settings');
    }
};
