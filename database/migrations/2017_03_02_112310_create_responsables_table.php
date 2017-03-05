<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsablesTable extends Migration
{
    public function up()
    {
        Schema::create('responsables', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('responsable');

            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('responsables');
    }
}