<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransferencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transferencias', function (Blueprint $table) {
        $table->increments('id');
        $table->string("code");
        $table->integer('producto')->index()->unsigned();
        $table->foreign('producto')->references('id')->on('productos');
        $table->string('cantidad');            
        $table->integer('origen');
        $table->integer('destino');
        $table->integer('proveedor')->index()->unsigned();
        $table->foreign('proveedor')->references('id')->on('proveedors');
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
