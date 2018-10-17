<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCreditos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origen');
            $table->integer('id_atencion')->index()->unsigned();
            $table->foreign('id_atencion')->references('id')->on('atenciones');
            $table->string('descripcion');
            $table->string('monto');
            $table->string('tipo_ingreso');
            $table->integer('id_sede');
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
         Schema::dropIfExists('creditos');

    }
}
