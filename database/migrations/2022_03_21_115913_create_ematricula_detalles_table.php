<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmatriculaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ematricula_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->unsignedBigInteger('udidactica_id');
            $table->unsignedBigInteger('ematricula_id');
            $table->foreign('udidactica_id')->references('id')->on('udidacticas');
            $table->foreign('ematricula_id')->references('id')->on('ematriculas');
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
        Schema::dropIfExists('ematricula_detalles');
    }
}
