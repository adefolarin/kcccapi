<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventReg;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\SampleMail;

class EventRegController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventregsid = null)
    {
        Session::put("page", "eventregs");

        if($eventregsid == null) {
          $eventregs = EventReg::query()->get()->toArray(); 
          return view('admin.eventreg')->with(compact('eventregs'));
        } else {
            $eventregsone = EventReg::find($eventregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = EventReg::query()->get()->toArray(); 
           return view('admin.eventregs')->with(compact('eventregs','eventregsone'));
    
        }

         
        //dd($CmsPages);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($eventregsid)
    {
        EventReg::where('eventregs_id',$eventregsid)->delete();
        return redirect('admin/eventreg')->with('success_message', 'Event Participant deleted successfully');
    }
}
