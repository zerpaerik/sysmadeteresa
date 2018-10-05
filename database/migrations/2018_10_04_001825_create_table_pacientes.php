<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pacientes', function (Blueprint $table) {
        $table->increments('id');
        $table->string('dni');
        $table->string('nombres');
        $table->string('apellidos');
        $table->string('direccion');
        $table->integer('provincia')->index()->unsigned();
        $table->foreign('provincia')->references('id')->on('provincias');
        $table->string('telefono');
        $table->date('fechanac');
        $table->string('gradoinstruccion');
        $table->string('ocupacion');
        $table->integer('edocivil')->index()->unsigned();
        $table->foreign('edocivil')->references('id')->on('edo_civils');
        $table->integer('estatus');
        $table->integer('historia')->index()->unsigned();
        $table->foreign('historia')->references('id')->on('historias');
        $table->string('distrito');
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
        //
    }
}
