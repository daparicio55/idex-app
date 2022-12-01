<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmoves', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->integer('folios');
            $table->text('observacion');
            $table->string('revisado')->default('NO');
            $table->date('rfecha')->nullable();
            $table->time('rhora')->nullable();
            $table->unsignedInteger('envia_id');
            $table->unsignedInteger('recive_id');
            $table->unsignedBigInteger('tmove_id');
            $table->unsignedBigInteger('document_id');
            $table->foreign('envia_id')->references('id')->on('users');
            $table->foreign('recive_id')->references('id')->on('users');
            $table->foreign('tmove_id')->references('id')->on('tmoves');
            $table->foreign('document_id')->references('id')->on('documents');
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
        Schema::dropIfExists('dmoves');
    }
}
