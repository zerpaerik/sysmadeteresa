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
        $table->integer('especialista')->index()->unsigned();
        $table->foreign('especialista')->references('id')->on('profesionales');
        $table->integer('paciente')->index()->unsigned();
        $table->foreign('paciente')->references('id')->on('pacientes');
        $table->date('start_date');
        $table->date('end_date');
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
