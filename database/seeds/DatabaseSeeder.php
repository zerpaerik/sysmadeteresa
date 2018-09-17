<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SedeSeeder::class);
        $this->call(MedidasSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProveedorSeeder::class);
    }
}
