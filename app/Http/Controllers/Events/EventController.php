<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Calendar;
use App\Models\Events\Event;

class EventController extends Controller
{
  public function index()
  {
    $events = [];
    $data = Event::all();
    if($data->count()) {
      foreach ($data as $key => $value) {
        $events[] = Calendar::event(
          $value->title,
          true,
          new \DateTime($value->start_date),
          new \DateTime($value->end_date.' +1 day'),
          null,
          // Add color and link on event
          [
              'color' => '#f05050',
              'url' => 'event/'.$value->id,
          ]
        );
      }
    }
    $calendar = Calendar::addEvents($events)
    ->setOptions([
    	'locale' => 'es',
    	
    ]);
    return view('events.index', compact('calendar'));
  }
}
