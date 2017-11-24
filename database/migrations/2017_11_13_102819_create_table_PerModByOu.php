<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePerModByOu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('per_mod_by_ou', function (Blueprint $table) {
            $table->increments('iPerID');
            $table->string('vOU');
            $table->integer('iModID');
            $table->integer('iCheckPerFeat');
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
        Schema::dropIfExists('per_mod_by_ou');
    }
}
