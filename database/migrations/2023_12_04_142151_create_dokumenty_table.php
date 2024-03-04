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
        Schema::create('dokumenty', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->string('file_path', 150);
            $table->timestamps();
            $table->unsignedBigInteger('users_id');  
            $table->foreign('users_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumenty', function (Blueprint $table) {
          
            $table->dropForeign('dokumenty_users_id_foreign');
            $table->dropColumn('users_id');
        });
        Schema::dropIfExists('dokumenty');
    }
};
