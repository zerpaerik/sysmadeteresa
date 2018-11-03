<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServicioMateriales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicio_materiales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('servicio_id')->references('id')->on('servicios');
            $table->integer('material_id')->references('id')->on('productos');
            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('servicio_materiales');
    }
}
