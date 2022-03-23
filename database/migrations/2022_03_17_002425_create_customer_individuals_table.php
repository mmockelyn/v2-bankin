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
        Schema::create('customer_individuals', function (Blueprint $table) {
            $table->id();
            $table->enum('civility', ['M', 'MME']);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->string('address');
            $table->string('addressbis')->nullable();
            $table->string('postal');
            $table->string('city');
            $table->string('country', 2);
            $table->timestamp('datebirth');
            $table->string('phone');
            $table->boolean('identityVerify')->default(false);
            $table->json('metadata')->nullable();
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
        Schema::dropIfExists('customer_individuals');
    }
};
