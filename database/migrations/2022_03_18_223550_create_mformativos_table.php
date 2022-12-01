<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMformativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mformativos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('horas',12,2);
            $table->decimal('creditos',12,2);
            $table->unsignedBigInteger('iformativo_id');
            $table->unsignedInteger('carrera_id');
            $table->unique(['nombre','iformativo_id','carrera_id']);
            $table->foreign('iformativo_id')->references('id')->on('iformativos');
            $table->foreign('carrera_id')->references('idCarrera')->on('ccarreras');
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
        Schema::dropIfExists('mformativos');
    }
}
