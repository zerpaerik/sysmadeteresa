<?php

use Illuminate\Database\Seeder;
use App\Models\Pacientes\Historia;

class HistoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$historias = [[
    		"nombres" => "historia 1",
    	]];
       foreach ($historias as $historia) {
       		Historia::create($historia);
       }
    }
}
