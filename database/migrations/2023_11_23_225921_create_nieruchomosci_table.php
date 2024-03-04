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
        Schema::create('nieruchomosci', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->string('opis', 1500);
            $table->integer('powierzchnia');
            $table->integer('liczba_pokoi');
            $table->string('ulica');
            $table->string('kod_pocztowy');
            $table->string('miasto');
            $table->timestamps();
            $table->unsignedBigInteger('users_id')->nullable();  
            $table->foreign('users_id')->references('id')->on('users'); 
            $table->unsignedBigInteger('wynajmujacy_id')->nullable();  
            $table->foreign('wynajmujacy_id')->references('id')->on('users'); 
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nieruchomosci', function (Blueprint $table) {
          
            $table->dropForeign('nieruchomosci_users_id_foreign');
            $table->dropColumn('users_id');
        });
        Schema::dropIfExists('nieruchomosci');
    }
};
