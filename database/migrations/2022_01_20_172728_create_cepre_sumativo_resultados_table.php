<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCepreSumativoResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cepre_sumativo_resultados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cepre_sumativo_id');
            $table->string('dni');
            $table->string('apellido');
            $table->string('nombre');
            $table->string('carrera');
            $table->integer('correctas');
            $table->integer('incorrectas');
            $table->integer('blancas');
            $table->decimal('puntaje',12,2);
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
        Schema::dropIfExists('cepre_sumativo_resultados');
    }
}
