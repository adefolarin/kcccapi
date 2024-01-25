<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventReg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($eventcategoriesid)
    {
        //$eventcategoryone = EventRegCategory::find($eventcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.eventcategory')->with(compact('eventcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
 
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
