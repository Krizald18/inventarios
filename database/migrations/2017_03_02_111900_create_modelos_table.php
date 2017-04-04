<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosTable extends Migration
{
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('modelo');

            $table->integer('marca_id')->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas');

            $table->integer('caracteristica_id')->nullable();
            $table->foreign('caracteristica_id')->references('id')->on('caracteristicas');

            $table->integer('subgrupo_id')->nullable();
            $table->foreign('subgrupo_id')->references('id')->on('subgrupos');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modelos');
    }
}
