<?php

use Illuminate\Database\Seeder;
use App\Models\Pacientes\Paciente;
use Carbon\Carbon;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$pacientes = [
				[
					"dni" => "24237704",
					"nombres" => "Maria",
					"apellidos" => "Mendez",
					"direccion" => "Calle 123",
					"provincia" => 1,
					"telefono" => "+58789456122",
					"fechanac" => '1996-01-01',
					"gradoinstruccion" => "Universitario",
					"ocupacion" => "Profesora",
					"edocivil" => 1,
					"estatus" => 1,
					"historia" => 1,
					"distrito" => 1
				]
			];
			foreach ($pacientes as $paciente) {
				Paciente::create($paciente);
			}
    }
}
