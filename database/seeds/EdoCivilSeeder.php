<?php

use Illuminate\Database\Seeder;
use App\Models\EdoCivil;

class EdoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $civils = [[
        	"nombre" => "Soltero(a)",
        	"nombre" => "Casado(a)"
        ]];

        foreach ($civils as $civil) {
        	EdoCivil::create($civil);
        }
    }
}
