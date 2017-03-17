<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResguardosTable extends Migration
{
    public function up()
    {
        Schema::create('resguardos', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('observaciones')->nullable();
            $table->boolean('status')->default(false); // open

            $table->integer('responsable_id')->nullable();
            $table->foreign('responsable_id')->references('id')->on('responsables');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('resguardos');
    }
}
