<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficialiasTable extends Migration
{
    public function up()
    {
        Schema::create('oficialias', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('oficialia');

            $table->integer('municipio_id')->nullable();
            $table->foreign('municipio_id')
                  ->references('id')->on('municipios');

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('oficialias');
    }
}