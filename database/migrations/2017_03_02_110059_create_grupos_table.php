<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('grupo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}