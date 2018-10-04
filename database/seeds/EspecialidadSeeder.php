<?php

use Illuminate\Database\Seeder;
use App\Models\Profesionales\Especialidad;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades = [["nombre" => "pediatria"]];
        foreach ($especialidades as $especialidad) {
        	Especialidad::create($especialidad);
        }
    }
}
