<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDebitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('debitos', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_gasto');
            $table->string('origen');
            $table->string('descripcion');
            $table->string('monto');
            $table->integer('id_sede');
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
      Schema::dropIfExists('debitos');

    }
}
