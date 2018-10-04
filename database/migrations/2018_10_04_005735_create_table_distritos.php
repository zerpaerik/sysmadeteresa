<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDistritos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('distritos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nombre');
        $table->integer('provincia')->index()->unsigned();
        $table->foreign('provincia')->references('id')->on('provincias');
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
