<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaqueteLaboratorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paquete_laboratorios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paquete_id');
            $table->unsignedInteger('laboratorio_id');
                  
            $table->foreign('paquete_id')
                  ->references('id')
                  ->on('paquetes')
                  ->onDelete('cascade');

            $table->foreign('laboratorio_id')
                  ->references('id')
                  ->on('analises')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquete_laboratorios');
    }
}
