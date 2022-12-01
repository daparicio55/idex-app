<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmisioneMarcadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admisione_marcadas', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->integer('pregunta');
            $table->string('marcada');
            $table->unsignedBigInteger('admisione_id');
            $table->foreign('admisione_id')->references('id')->on('admisiones')->onDelete('cascade');
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
        Schema::dropIfExists('admisione_marcadas');
    }
}
