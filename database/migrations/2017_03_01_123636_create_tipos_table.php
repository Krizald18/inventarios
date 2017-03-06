<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposTable extends Migration
{
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('tipo')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos');
    }
}