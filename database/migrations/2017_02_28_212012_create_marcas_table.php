<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcasTable extends Migration
{
    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('marca');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marcas');
    }
}
