<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmisioneAlternativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admisione_alternativas', function (Blueprint $table) {
            $table->id();
            $table->integer('numPregunta');
            $table->string('respuesta');
            $table->unsignedBigInteger('admisione_id');
            $table->foreign('admisione_id')->references('id')->on('admisiones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admisione_alternativas');
    }
}
