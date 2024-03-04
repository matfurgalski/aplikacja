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
        Schema::create('ulubione', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');  
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('ogloszenia_id');  
            $table->foreign('ogloszenia_id')->references('id')->on('ogloszenia')->cascadeOnDelete();
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
        Schema::dropIfExists('ulubione');
    }
};
