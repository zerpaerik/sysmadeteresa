<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('events', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->integer('profesional')->index()->unsigned();
        $table->foreign('profesional')->references('id')->on('profesionales');
        $table->integer('paciente')->index()->unsigned();
        $table->foreign('paciente')->references('id')->on('pacientes');
        $table->date('date');
        $table->integer('time')->index()->unsigned();
        $table->foreign('time')->references('id')->on('rangoconsultas');
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
        Schema::dropIfExists('events');
    }
}
