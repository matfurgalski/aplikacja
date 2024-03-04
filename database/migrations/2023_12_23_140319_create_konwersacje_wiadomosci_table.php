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
        Schema::create('konwersacje_wiadomosci', function (Blueprint $table) {
            $table->foreignId('konwersacje_id')->constrained('konwersacje')->onDelete('cascade');
            $table->foreignId('wiadomosci_id')->constrained('wiadomosci')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konwersacje_wiadomosci');
    }
};
