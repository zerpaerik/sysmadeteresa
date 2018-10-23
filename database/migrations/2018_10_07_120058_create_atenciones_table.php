<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atenciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_paciente')->index()->unsigned();
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->string('origen');
            $table->integer('origen_usuario')->index()->unsigned();
            $table->foreign('origen_usuario')->references('id')->on('users');
            $table->integer('id_servicio')->index()->unsigned();
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->integer('id_laboratorio')->index()->unsigned();
            $table->foreign('id_laboratorio')->references('id')->on('analises');
            $table->boolean('es_servicio')->nullable(true);
            $table->boolean('es_laboratorio')->nullable(true);
            $table->boolean('es_paquete')->nullable(true);
            $table->string('monto');
            $table->string('pendiente');
            $table->string('porcentaje')->nullable(true);
            $table->string('tipopago');
            $table->string('abono');
            $table->boolean('pagado_lab')->nullable(true);
            $table->boolean('pagado_com')->nullable(true);
            $table->boolean('resultado')->nullable(true);
            $table->date('fecha_pago_lab')->nullable(true);
            $table->date('fecha_pago_comision')->nullable(true);
            $table->integer('id_sede');
            $table->integer('estatus');
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
        Schema::dropIfExists('atenciones');
    }
}
