<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenciasTable extends Migration
{
     public function up()
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uri'); // folder
            $table->string('file');

            $table->integer('resguardo_id')->nullable();
            $table->foreign('resguardo_id')->references('id')->on('resguardos');
            $table->timestamps();
        });
    }

    public function down()
    {
       Schema::dropIfExists('evidencias');
    }
}