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
            $table->string('numero_inventario')->nullable()->unique();
            $table->string('numero_serie')->nullable()->unique();
            $table->integer('cantidad');

            $table->integer('descripcion_id')->nullable();
            $table->integer('caracteristica_id')->nullable();
            $table->integer('tipo_id')->nullable();
            $table->integer('modelo_id')->nullable();
            $table->integer('marca_id')->nullable();
            $table->string('oficialia_id')->nullable();
            $table->integer('municipio_id')->nullable();
            $table->integer('municipio_fisico_id')->nullable();
            $table->integer('localidad_fisica_id')->nullable();

            $table->foreign('descripcion_id')
                  ->references('id')->on('descripciones')
                  ->onDelete('cascade');
            
            $table->foreign('caracteristica_id')
                  ->references('id')->on('caracteristicas')
                  ->onDelete('cascade');
            
            $table->foreign('tipo_id')
                  ->references('id')->on('tipos')
                  ->onDelete('cascade');
            
            $table->foreign('modelo_id')
                  ->references('id')->on('modelos')
                  ->onDelete('cascade');
            
            $table->foreign('marca_id')
                  ->references('id')->on('marcas')
                  ->onDelete('cascade');
            
            $table->foreign('oficialia_id')
                  ->references('id')->on('oficialias')
                  ->onDelete('cascade');
            
            $table->foreign('municipio_id')
                  ->references('id')->on('municipios')
                  ->onDelete('cascade');
            
            $table->foreign('municipio_fisico_id')
                  ->references('id')->on('municipios')
                  ->onDelete('cascade');
            
            $table->foreign('localidad_fisica_id')
                  ->references('id')->on('localidades')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}