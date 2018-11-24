<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controls', function (Blueprint $table) {
            $table->increments('id');
            $table->string("id_paciente");
            $table->string("id_ficha_prenatal");
            $table->string("fecha_cont");
            $table->string("gesta_semanas");
            $table->string("peso_madre");
            $table->string("temp");
            $table->string("tension");
            $table->string("altura_uterina");
            $table->string("presentacion");
            $table->string("fcf");
            $table->string("movimiento_fetal");
            $table->string("edema");
            $table->string("pulso_materno");
            $table->string("consejeria");
            $table->string("sulfato");
            $table->string("perfil_biofisico");
            $table->string("visita_domicilio");
            $table->string("establecimiento_atencion");
            $table->string("responsable_control");
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
        Schema::dropIfExists('controls');
    }
}
