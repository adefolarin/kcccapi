<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGallery;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EventController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($eventsid = null)
    {

        //$eventcategories = EventCategory::query()->get();

        //$events = Event::get();

        $events = DB::table('eventcategories')->orderBy('events_startdate')->join('events','eventcategories.eventcategories_id','=', 'events.eventcategoriesid')->select('events.*','eventcategories.eventcategories_name')->get();

        if($eventsid == null) {
           
            foreach($events as $event) {
                $data [] = array(
                'events_id' => $event->events_id,
                'events_title' => $event->events_title,
                'events_file' => $event->events_file,
                'events_startdatemonth' => date("M j", strtotime($event->events_startdate)),
                'events_starttime' => date("g:i a", strtotime($event->events_startdate)),
                );
            }
              
            return response()->json(['events'=>$data]);

        } else {
            $event = new Event;
            //$eventcategory = new EventCategory;
            $eventone = $event->where('events_id', $eventsid)->first();

            $eventgalleries = DB::table('eventgalleries')->where("eventsid", $eventsid)->orderBy("eventsid")->get();

            foreach($eventgalleries as $eventgallery) {
                $gallerydata [] = array(
                'eventsid' => $eventgallery->eventsid,
                'eventgalleries_file' => $eventgallery->eventgalleries_file,
                );
            }

            //$eventcategoryone = $eventcategory->where('eventcategories_id', $eventone['eventcategoriesid'])->first();

            $event_startdatemonth =  date("M j, Y", strtotime($eventone->events_startdate));
            $event_enddatemonth =  date("M j, Y", strtotime($eventone->events_enddate));
            $event_starttime =  date("g:i a", strtotime($eventone->events_startdate));
    
            //date("F j, Y, g:i a", strtotime($page['created_at']))
    
            $data = array(
                'events_title' => $eventone->events_title,
                'events_desc' => $eventone->events_desc,
                'events_file' => $eventone->events_file,
                'events_address' => $eventone->events_address,
                'events_venue' => $eventone->events_venue,
                'events_organizer' => $eventone->events_organizer,
                'events_startdate' => $event_startdatemonth,
                'events_enddate' => $event_enddatemonth,
                'events_starttime' => $event_starttime,
            );
    
            //dd($event); die;
            //echo "<prev>"; print_r($data); die;
    
            return response()->json(['eventone'=>$data, 'eventgallery'=>$gallerydata]);

            //return with(compact('events','eventone','eventcategoryone','eventcategories'));
            
             
        }


    }

    public function getNextEvent() {
        $now = date("Y-m-d: h:i");

        $event = DB::table('events')->where("events_startdate", ">", $now)->orderBy("events_startdate")->first();

        $event_startdatemonth =  date("M j", strtotime($event->events_startdate));
        $event_starttime =  date("g:i a", strtotime($event->events_startdate));

        $event_countdown = strtotime($event->events_startdate);

        //date("F j, Y, g:i a", strtotime($page['created_at']))

        $data = array(
            'events_title' => $event->events_title,
            'events_startdatemonth' => $event_startdatemonth,
            'events_starttime' => $event_starttime,
            'events_countdown' => 1707750000,
        );

        //dd($event); die;
        //echo "<prev>"; print_r($data); die;

        return response()->json(['event'=>$data]);

        //return $event;
    }






}
