<?php

use Illuminate\Database\Seeder;
use App\Models\Events\RangoConsulta;

class RangoCosultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rangos = [
        	["start_time" => "7:00:00", "end_time" => "7:59:59"],
        	["start_time" => "8:00:00", "end_time" => "8:59:59"],
        	["start_time" => "9:00:00", "end_time" => "9:59:59"],
        	["start_time" => "10:00:00", "end_time" => "10:59:59"],
        	["start_time" => "11:00:00", "end_time" => "11:59:59"],
        	["start_time" => "12:00:00", "end_time" => "12:59:59"],
        	["start_time" => "13:00:00", "end_time" => "13:59:59"],
        	["start_time" => "14:00:00", "end_time" => "14:59:59"],
        	["start_time" => "15:00:00", "end_time" => "15:59:59"],
        	["start_time" => "16:00:00", "end_time" => "16:59:59"],
        	["start_time" => "17:00:00", "end_time" => "17:59:59"],
        	["start_time" => "18:00:00", "end_time" => "18:59:59"]
        ];

        foreach ($rangos as $rango) {
        	RangoConsulta::create($rango);
        }
    }
}
