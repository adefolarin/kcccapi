<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventcategoriesid = null)
    {
        Session::put("page", "eventcategory");

        if($eventcategoriesid == null) {
          $eventcategories = EventCategory::query()->get()->toArray(); 
          return view('admin.eventcategory')->with(compact('eventcategories'));
        } else {
            $eventcategoryone = EventCategory::find($eventcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventcategories = EventCategory::query()->get()->toArray(); 
           return view('admin.eventcategory')->with(compact('eventcategories','eventcategoryone'));
    
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
        //$title = "Banner";
        $eventcategory = new EventCategory;
    
        $message = "Event Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Event Category Vallidations

                $rules = [
                    'eventcategories_name' => 'required',
                ];
                $customMessages = [
                    'eventcategories_name.required' => 'Name of Event Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'eventcategories_name' => $data['eventcategories_name'],
               ]
            ];

              //$eventcategoryone = EventCategory::find($data['eventcategories_name']);
              $eventcategoryone = $eventcategory->where('eventcategories_name', '=', $data['eventcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($eventcategoryone['eventcategories_name']); die;

              if($eventcategoryone['eventcategories_name'] == $data['eventcategories_name']) {
                return redirect('admin/eventcategory')->with('error_message', 'Event Category Name Already Exists'); 
              } else {
                $eventcategory->insert($store);
                return redirect('admin/eventcategory')->with('success_message', $message);
              }

          }
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
        //$eventcategoryone = EventCategory::find($eventcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.eventcategory')->with(compact('eventcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Event Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'eventcategories_name' => 'required',
                ];
            
            $customMessages = [
                'eventcategories_name.required' => 'Name of Event Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'eventcategories_name' => $data['eventcategories_name'],
               
            ];

              EventCategory::where('eventcategories_id',$data['eventcategories_id'])->update($store);
              return redirect('admin/eventcategory/'.$data['eventcategories_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        EventCategory::where('eventcategories_id',$evencategoriesid)->delete();
        return redirect('admin/eventcategory')->with('success_message', 'Event Category deleted successfully');
    }
}
