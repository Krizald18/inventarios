<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalidadesTable extends Migration
{
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('localidad');

            $table->integer('municipio_id')->nullable();
            $table->foreign('municipio_id')
                  ->references('id')->on('municipios')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('localidades');
    }
}