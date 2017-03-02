<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipiosTable extends Migration
{
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('municipio');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}