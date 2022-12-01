<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ematriculas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->date('fecha');
            $table->string('boleta')->nullable();
            $table->unsignedBigInteger('pmatricula_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedInteger('user_id');
            $table->foreign('pmatricula_id')->references('id')->on('pmatriculas');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ematriculas');
    }
}
