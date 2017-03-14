<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcaSubgrupoTable extends Migration
{
    public function up()
    {
        Schema::create('marca_subgrupo', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('marca_id');
            $table->foreign('marca_id')->references('id')->on('marcas');

            $table->integer('subgrupo_id');
            $table->foreign('subgrupo_id')->references('id')->on('subgrupos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marca_subgrupo');
    }
}