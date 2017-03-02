<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescripcionesTable extends Migration
{
    public function up()
    {
        Schema::create('descripciones', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('descripciones');
    }
}
