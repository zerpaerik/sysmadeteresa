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
        $this->call(RangoCosultasSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(ProfesionalSeeder::class);
        $this->call(HistoriaSeeder::class);
        $this->call(EdoCivilSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(DistritoSeeder::class);
        $this->call(PacienteSeeder::class);
        //$this->call(EventSeeder::class);
    }
}
