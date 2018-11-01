<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaqueteServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paquete_servicios', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('paquete_id')->index()->unsigned();
            $table->foreign('paquete_id')->references('id')->on('paquetes');
            $table->integer('servicio_id')->index()->unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios');
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
        Schema::dropIfExists('paquete_servicios');
    }
}
