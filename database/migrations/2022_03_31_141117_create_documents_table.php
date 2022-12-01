<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('folios');
            $table->integer('anio');
            $table->longText('asunto');
            $table->string('dnumero');
            $table->longText('observacion');
            $table->integer('cliente_id');
            $table->unsignedBigInteger('tdocument_id');
            $table->unsignedInteger('user_id');
            $table->foreign('cliente_id')->references('idCliente')->on('clientes');
            $table->foreign('tdocument_id')->references('id')->on('tdocuments');
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
        Schema::dropIfExists('documents');
    }
}
