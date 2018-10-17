<?php

use Illuminate\Database\Seeder;
use App\Models\Distritos;
class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$distritos = [["nombre" => "Lima", "provincia" => 1]];
    	foreach ($distritos as $distrito) {
    		Distritos::create($distrito);
    	}
    }
}
