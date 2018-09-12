<?php

use Illuminate\Database\Seeder;
use App\Models\Config\Sede;

class SedeSeeder extends Seeder
{
    
	public $sedes = array(
		'a' => ["name" => "Sede a", "address" => "Dir sede a"],
		'b' => ["name" => "Sede b", "address" => "Dir sede b"],
		'c' => ["name" => "Sede c", "address" => "Dir sede c"]);

    public function run()
    {
        foreach ($this->sedes as $sede) {
        	Sede::create($sede);
        }
    }
}
