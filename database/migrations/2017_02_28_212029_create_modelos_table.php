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
            $table->string('modelo')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modelos');
    }
}
