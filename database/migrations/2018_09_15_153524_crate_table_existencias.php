<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTableExistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('existencias', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('producto')->index()->unsigned();
        $table->foreign('producto')->references('id')->on('productos');
        $table->integer('sede_id')->index()->unsigned();
        $table->foreign('sede_id')->references('id')->on('sedes');
        $table->string('cantidad');            
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
