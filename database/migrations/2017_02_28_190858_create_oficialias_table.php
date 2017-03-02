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
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('oficialias');
    }
}