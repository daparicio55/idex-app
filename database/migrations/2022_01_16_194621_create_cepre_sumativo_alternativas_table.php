<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCepreSumativoAlternativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cepre_sumativo_alternativas', function (Blueprint $table) {
            $table->id();
            $table->integer('pregunta');
            $table->string('respuesta');
            $table->unsignedBigInteger('cepre_sumativo_id');
            $table->foreign('cepre_sumativo_id')->references('id')->on('cepre_sumativos')->onDelete('cascade');
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
        Schema::dropIfExists('cepre_sumativo_alternativas');
    }
}
