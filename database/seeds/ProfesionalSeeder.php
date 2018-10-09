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
    			"codigo" => "111111", 
    			"especialidad" => 1],
                ["name" => "Juan", 
                "apellidos" => "Rodriguez", 
                "dni" => "012345678", 
                "cmp" => "00001", 
                "codigo" => "111112", 
                "especialidad" => 1],
    		];
    		foreach ($profesionales as $profesional) {
    			Profesional::create($profesional);
    		}
    }
}
