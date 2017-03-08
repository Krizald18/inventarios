<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubgruposTable extends Migration
{
    public function up()
    {
        Schema::create('subgrupos', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('subgrupo')->unique();
            $table->timestamps();
           
            $table->integer('grupo_id')->nullable();
            $table->foreign('grupo_id')
                  ->references('id')->on('grupos')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subgrupos');
    }
}
