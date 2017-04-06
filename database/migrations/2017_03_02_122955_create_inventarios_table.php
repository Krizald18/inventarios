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
      $table->string('folio_resguardo')->nullable();
      $table->integer('numero_inventario')->nullable()->unique();
      $table->string('numero_serie')->nullable()->unique();
      $table->string('comentario_baja')->nullable();
      $table->date('fecha_baja')->nullable();
      $table->boolean('status')->default(true);

      //$table->integer('subgrupo_id')->nullable(); // no es requerido, el modelo dice subgrupo
      //$table->integer('marca_id')->nullable(); // no se ocupa guardar la marca, el modelo ya tiene marca
      //$table->integer('municipio_id')->nullable(); // no se ocupa guardar por que la oficialia ya tiene municipio
      //$table->integer('grupo_id')->nullable(); // no se ocupa guardar por que el subgrupo ya trae grupo
      //$table->integer('caracteristica_id')->nullable(); // no se ocupa guardar por que el modelo ya tiene caracteristicas

      $table->integer('modelo_id')->nullable(); 
      $table->string('oficialia_id')->nullable();
      $table->integer('area_id')->nullable();
      $table->integer('responsable_id')->nullable();
      $table->integer('resguardo_id')->unsigned()->nullable();
      $table->foreign('area_id')
            ->references('id')->on('areas');


      $table->foreign('modelo_id')
            ->references('id')->on('modelos');

      $table->foreign('oficialia_id')
            ->references('id')->on('oficialias');

      $table->foreign('responsable_id')
            ->references('id')->on('responsables');

      $table->foreign('resguardo_id')
            ->references('id')->on('resguardos');

      $table->timestamps();
      $table->softDeletes();
/*
      $table->foreign('grupo_id')
            ->references('id')->on('grupos')
            ->onDelete('cascade');
*/
/*
      $table->foreign('subgrupo_id')
            ->references('id')->on('subgrupos')
            ->onDelete('cascade');
*/
      /*
      $table->foreign('caracteristica_id')
            ->references('id')->on('caracteristicas')
            ->onDelete('cascade');

      $table->foreign('marca_id')
            ->references('id')->on('marcas')
            ->onDelete('cascade');
      */

      /*
      $table->foreign('municipio_id')
            ->references('id')->on('municipios')
            ->onDelete('cascade');
      */
    });
  }
  public function down()
  {
    Schema::dropIfExists('inventarios');
  }
}