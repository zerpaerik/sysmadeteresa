<?php

use Illuminate\Database\Seeder;
use App\Models\Provincias;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = [[
        	"nombre" => "Lima"
        ]];
        foreach ($provincias as $provincia) {
        	Provincias::create($provincia);
        }
    }
}
