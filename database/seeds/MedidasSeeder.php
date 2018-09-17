<?php

use Illuminate\Database\Seeder;
use App\Models\Config\Medida;

class MedidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medida::create(["nombre" => "Caja(s)"]);
        Medida::create(["nombre" => "Litro(s)"]);
    }
}
