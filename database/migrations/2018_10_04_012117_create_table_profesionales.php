<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProfesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('profesionales', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('apellidos');
        $table->string('dni');
        $table->string('cmp');
        $table->string('codigo');
        $table->integer('centro');
        $table->integer('especialidad');
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
