<?php

use Illuminate\Database\Seeder;
use App\Models\Config\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Proveedor::create(["nombre" => "JM Proveedor", "codigo" => "J-74z3545"]);
		Proveedor::create(["nombre" => "medicinas", "codigo" => "J-78w2545"]);  
    }
}
