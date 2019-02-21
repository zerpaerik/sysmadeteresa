<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoriosPagadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorios_pagados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('laboratorio'); 
            $table->integer('analisis'); 
            $table->string('monto'); 
            $table->integer('sede'); 
            $table->integer('paciente');
            $table->integer('usuario'); 
            $table->integer('gasto');  
            $table->integer('atencion');   
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
        Schema::dropIfExists('laboratorios_pagados');
    }
}
