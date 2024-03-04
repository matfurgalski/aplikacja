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
        Schema::create('ogloszenia_zdjecia', function (Blueprint $table) {
            $table->foreignId('ogloszenia_id')->constrained('ogloszenia')->onDelete('cascade');
            $table->foreignId('zdjecia_id')->constrained('zdjecia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ogloszenia_zdjecia');
    }
};
