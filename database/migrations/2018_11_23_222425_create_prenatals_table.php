<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrenatalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paciente');
            $table->string('gesta');
            $table->string('aborto');
            $table->string('vaginales');
            $table->string('vivos');
            $table->string('viven');
            $table->string('semana1');
            $table->string('semana2');
            $table->string('cesaria');
            $table->string('parto');
            $table->string('num');
            $table->string('gr');
            $table->string('gemelar');
            $table->string('37m');
            $table->string('fecha_terminacion');
            $table->string('peso_gestacion');
            $table->string('ninguno_af')->nullable();
            $table->string('alergias_af')->nullable();
            $table->string('anomalias_af')->nullable();
            $table->string('epilepsia_af')->nullable();
            $table->string('diabetes_af')->nullable();
            $table->string('enfermedades_af')->nullable();
            $table->string('gemelares_af')->nullable();
            $table->string('tension_af')->nullable();
            $table->string('neoplasia_af')->nullable();
            $table->string('pulmon_af')->nullable();
            $table->string('otro_af')->nullable();
            $table->string('ninguno_ap')->nullable();
            $table->string('aborto_ap')->nullable();
            $table->string('aborto2_ap')->nullable();
            $table->string('alcohol_ap')->nullable();
            $table->string('alermedicamentos_ap')->nullable();
            $table->string('asmabron_ap')->nullable();
            $table->string('pesonacimiento_ap')->nullable();
            $table->string('cardiopatia_ap')->nullable();
            $table->string('cirugiauterina_ap')->nullable();
            $table->string('diabetes_ap')->nullable();
            $table->string('congenitas_ap')->nullable();
            $table->string('infeccion_ap')->nullable();
            $table->string('epilepsia_ap')->nullable();
            $table->string('hemorragiapost_ap')->nullable();
            $table->string('htarterial_ap')->nullable();
            $table->string('coca_ap')->nullable();
            $table->string('infertilidad_ap')->nullable();
            $table->string('neoplasias_ap')->nullable();
            $table->string('drogas_ap')->nullable();
            $table->string('partoprolongado_ap')->nullable();
            $table->string('eclampsia_ap')->nullable();
            $table->string('prematuro_ap')->nullable();
            $table->string('placenta_ap')->nullable();
            $table->string('tabaco_ap')->nullable();
            $table->string('pulmonar_ap')->nullable();
            $table->string('sida_ap')->nullable();
            $table->string('otro_ap')->nullable();
            $table->string('peso_pregestacional');
            $table->string('talla_pregestacional');
            $table->string('dosis_previa');
            $table->string('primera_dosis');
            $table->string('segunda_dosis');
            $table->string('sesion_sangre');
            $table->string('ultima_menstruacion');
            $table->string('parto_probable');
            $table->string('eco_eg');
            $table->string('serologia_1era');
            $table->string('serologia_2da');
            $table->string('hemoglobina');
            $table->string('hemoglobina_fecha');
            $table->string('patologia_1');
            $table->string('patologia_1_date');
            $table->string('patologia_1_otro');
            $table->string('patologia_2');
            $table->string('patologia_2_date');
            $table->string('patologia_2_otro');
            $table->string('patologia_3');
            $table->string('patologia_3_date');
            $table->string('patologia_3_otro');
            $table->string('talla_nacido');
            $table->string('peso_nacido');
            $table->string('cef_nacido');
            $table->string('temp_nacido');
            $table->string('no_rn');
            $table->string('nombre_rn');
            $table->string('edad_semanas');
            $table->string('apgar_1');
            $table->string('apgar_2');
            $table->string('patologia_recien_1');
            $table->string('patologia_recien_1_date');
            $table->string('patologia_recien_2');
            $table->string('patologia_recien_2_date');
            $table->string('patologia_recien_3');
            $table->string('patologia_recien_3_date');
            $table->string('otros_cie1_10');
            $table->string('otros_cie2_10');
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
        Schema::dropIfExists('prenatals');
    }
}
