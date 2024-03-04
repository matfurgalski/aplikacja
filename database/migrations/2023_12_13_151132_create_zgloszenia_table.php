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
        Schema::create('zgloszenia', function (Blueprint $table) {
            $table->id();
            $table->string('temat');
            $table->unsignedBigInteger('users_id');  
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('nieruchomosci_id');  
            $table->foreign('nieruchomosci_id')->references('id')->on('nieruchomosci')->cascadeOnDelete();
            $table->string('opis', 1500);
            $table->string('status');
            $table->string('typ_zgloszenia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zgloszenia');
    }
};
