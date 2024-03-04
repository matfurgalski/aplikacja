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
        Schema::create('ogloszenia', function (Blueprint $table) {
            $table->id();
            $table->string('tytul');
            $table->unsignedBigInteger('nieruchomosci_id');  
            $table->foreign('nieruchomosci_id')->references('id')->on('nieruchomosci')->cascadeOnDelete(); 
            $table->unsignedBigInteger('wlasciciel_id');  
            $table->foreign('wlasciciel_id')->references('id')->on('users'); 
            $table->string('opis', 1500);
            $table->decimal('cena');
            $table->unsignedBigInteger('rezerwacja_id')->nullable(); 
            $table->foreign('rezerwacja_id')->references('id')->on('users'); 
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
        Schema::dropIfExists('ogloszenia');
    }
};
