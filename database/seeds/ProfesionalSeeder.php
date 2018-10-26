<?php

use Illuminate\Database\Seeder;
use App\Models\Profesionales\Profesional;

class ProfesionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    		$profesionales = [
    			["name" => "Jose", 
    			"apellidos" => "Perez", 
    			"dni" => "123456789", 
    			"cmp" => "00000", 
    			"especialidad" => 1,
                "centro" => 1,
                "nacimiento" => "1970-01-01 00:00:00",
                'tipo' => 1,
                ],
                ["name" => "Juan", 
                "apellidos" => "Rodriguez", 
                "dni" => "012345678", 
                "cmp" => "00001", 
                "especialidad" => 1,
                "centro" => 1,
                "nacimiento" => "1970-01-01 00:00:00",
                'tipo' => 1,
                ],
    		];
    		foreach ($profesionales as $profesional) {
    			Profesional::create($profesional);
    		}
    }
}
