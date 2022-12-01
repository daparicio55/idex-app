<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCepreSumativoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cepre_sumativo_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('correctas');
            $table->integer('incorrectas');
            $table->unsignedBigInteger('admisione_postulante_id');
            $table->unsignedBigInteger('cepre_sumativo_id');
            $table->foreign('admisione_postulante_id')->references('id')->on('admisione_postulantes');
            $table->foreign('cepre_sumativo_id')->references('id')->on('cepre_sumativos');
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
        Schema::dropIfExists('cepre_sumativo_detalles');
    }
}
