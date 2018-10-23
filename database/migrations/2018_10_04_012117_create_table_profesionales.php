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
        $table->integer('centro');
        $table->string('codigo');
        $table->integer('especialidad');
        $table->date('nacimiento')->nullable(true);
        $table->integer('tipo');
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
