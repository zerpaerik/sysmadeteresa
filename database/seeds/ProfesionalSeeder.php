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
    			["nombres" => "Jose", 
    			"apellidos" => "Perez", 
    			"dni" => "123456789", 
    			"cmp" => "00000", 
    			"codigo" => "111111", 
    			"especialidad" => 1]
    		];
    		foreach ($profesionales as $profesional) {
    			Profesional::create($profesional);
    		}
    }
}
