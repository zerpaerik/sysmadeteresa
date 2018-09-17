<?php

use Illuminate\Database\Seeder;
use App\Models\Config\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Categoria::create(["nombre" => "materiales"]);
		Categoria::create(["nombre" => "medicinas"]);        
    }
}
