<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResguardosTable extends Migration
{
    public function up()
    {
        Schema::create('resguardos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('observaciones')->nullable();
            $table->string('folio')->nullable()->unique();
            $table->boolean('status')->default(false); // open
            $table->boolean('pdf_generado')->default(false);
            $table->boolean('pdf_firmado')->default(false);

            $table->integer('responsable_id')->nullable();
            $table->foreign('responsable_id')->references('id')->on('responsables');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('resguardos');
    }
}