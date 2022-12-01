<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCepreSumativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cepre_sumativos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha');
            $table->integer('preguntas');
            $table->decimal('puntos',10,2);
            $table->decimal('encontra',10,2);
            $table->unsignedInteger('cepre_id');
            $table->foreign('cepre_id')->references('idCepre')->on('cepres');
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
        Schema::dropIfExists('cepre_sumativos');
    }
}
