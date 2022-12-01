<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmisioneVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admisione_vacantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('carrera_id');
            $table->unsignedBigInteger('admisione_id');
            $table->integer('cantidad');
            $table->foreign('carrera_id')->references('idCarrera')->on('ccarreras');
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
        Schema::dropIfExists('admisione_vacantes');
    }
}
