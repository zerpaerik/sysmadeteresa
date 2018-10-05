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
        	"nombre" => "soltero(a)",
        	"nombre" => "casado(a)"
        ]];

        foreach ($civils as $civil) {
        	EdoCivil::create($civil);
        }
    }
}
