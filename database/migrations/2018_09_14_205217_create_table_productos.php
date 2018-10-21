<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nombre');
        $table->integer('categoria')->index()->unsigned();
        $table->foreign('categoria')->references('id')->on('categorias');
        $table->integer('medida')->index()->unsigned();
        $table->foreign('medida')->references('id')->on('medidas');
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
