<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristicasTable extends Migration
{
    public function up()
    {
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('caracteristica')->unique();

            $table->integer('subgrupo_id')->nullable();
            $table->foreign('subgrupo_id')
                  ->references('id')->on('subgrupos')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('caracteristicas');
    }
}