<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insidencias', function (Blueprint $table) {
            $table->id();
            $table->integer('idCliente');
            $table->unsignedBigInteger('equipo_id');
            $table->date('fechaIngreso');
            $table->time('horaIngreso');
            $table->text('desCliente');
            $table->text('desRecepcion');
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
        Schema::dropIfExists('insidencias');
    }
}
