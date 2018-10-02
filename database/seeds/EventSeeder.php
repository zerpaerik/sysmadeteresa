<?php

use Illuminate\Database\Seeder;
use App\Models\Events\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = [
      	['title'=>'Cita 1', 'start_date'=>'2018-10-11', 'end_date'=>'2018-10-12'],
      	['title'=>'Cita 2', 'start_date'=>'2018-10-11', 'end_date'=>'2018-10-13'],
      	['title'=>'Cita 3', 'start_date'=>'2018-10-14', 'end_date'=>'2018-10-14'],
      	['title'=>'Cita 3', 'start_date'=>'2018-10-17', 'end_date'=>'2018-10-17'],
      ];
      foreach ($data as $key => $value) {
      	Event::create($value);
      }        
    }
}
