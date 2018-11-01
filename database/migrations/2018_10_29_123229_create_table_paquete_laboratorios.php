<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaqueteLaboratorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paquete_laboratorios', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('paquete_id')->index()->unsigned();
            $table->foreign('paquete_id')->references('id')->on('paquetes');
            $table->integer('laboratorio_id')->index()->unsigned();
            $table->foreign('laboratorio_id')->references('id')->on('analises');
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
        Schema::dropIfExists('paquete_laboratorios');
    }
}
