<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositorios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('asunto');
            $table->string('numero');
            $table->string('url');
            $table->unsignedBigInteger('documentotipo_id');
            $table->unsignedInteger('user_id');
            $table->integer('idCliente');
            $table->foreign('idCliente')->references('idCliente')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('documentotipo_id')->references('id')->on('documentotipos');
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
        Schema::dropIfExists('repositorios');
    }
}
