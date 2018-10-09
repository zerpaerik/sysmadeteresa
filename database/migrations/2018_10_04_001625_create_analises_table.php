<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('preciopublico');
            $table->string('costlab');
            $table->string('porcentaje');
            $table->string('material');
            $table->string('tiempo');
            $table->integer('laboratorio')->index()->unsigned();
            $table->foreign('laboratorio')->references('id')->on('laboratorios');
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
        Schema::dropIfExists('analises');
    }
}
