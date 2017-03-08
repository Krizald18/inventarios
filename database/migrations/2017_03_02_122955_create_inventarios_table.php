<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
  public function up()
  {
    Schema::create('inventarios', function (Blueprint $table) {
        
      $table->increments('id');
      $table->integer('numero_inventario')->nullable()->unique();
      $table->string('numero_serie')->nullable()->unique();
      $table->integer('cantidad');
      $table->date('fecha_baja')->nullable();
      $table->boolean('status')->default(true);

      $table->integer('subgrupo_id')->nullable();
      //$table->integer('marca_id')->nullable(); // no se ocupa guardar la marca, el modelo ya tiene marca
      $table->integer('modelo_id')->nullable(); 
      //$table->integer('municipio_id')->nullable(); // no se ocupa guardar por que la oficialia ya tiene municipio
      $table->string('oficialia_id')->nullable();

      //$table->integer('grupo_id')->nullable(); // no se ocupa guardar por que el subgrupo ya trae grupo
      $table->integer('area_id')->nullable();
      $table->integer('responsable_id')->nullable();
      //$table->integer('caracteristica_id')->nullable(); // no se ocupa guardar por que el modelo ya tiene caracteristicas

      $table->foreign('area_id')
            ->references('id')->on('areas')
            ->onDelete('cascade');

      $table->foreign('responsable_id')
            ->references('id')->on('responsables')
            ->onDelete('cascade');

/*
      $table->foreign('grupo_id')
            ->references('id')->on('grupos')
            ->onDelete('cascade');
*/

      $table->foreign('subgrupo_id')
            ->references('id')->on('subgrupos')
            ->onDelete('cascade');

      /*
      $table->foreign('caracteristica_id')
            ->references('id')->on('caracteristicas')
            ->onDelete('cascade');

      $table->foreign('marca_id')
            ->references('id')->on('marcas')
            ->onDelete('cascade');
      */

      $table->foreign('modelo_id')
            ->references('id')->on('modelos')
            ->onDelete('cascade');
      /*
      $table->foreign('municipio_id')
            ->references('id')->on('municipios')
            ->onDelete('cascade');
      */
      $table->foreign('oficialia_id')
            ->references('id')->on('oficialias')
            ->onDelete('cascade');

      $table->timestamps();
    });
  }
  public function down()
  {
    Schema::dropIfExists('inventarios');
  }
}