<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEspecialistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('especialistas', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nombre');
        $table->string('apellido');
        $table->integer('especialidad')->index()->unsigned();
        $table->foreign('especialidad')->references('id')->on('especialidades');
        $table->string('cmp');
        $table->string('dni');
        $table->string('codigo');
        $table->integer('sede')->index()->unsigned();
        $table->foreign('sede')->references('id')->on('sedes');
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
