<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\SampleMail;

class DonationController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($donationsid = null)
    {
        Session::put("page", "donations");

        if($donationsid == null) {
          $donations = Donation::query()->get()->toArray(); 
          return view('admin.donation')->with(compact('donations'));
        } else {
            $donationsone = Donation::find($donationsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = Donation::query()->get()->toArray(); 
           return view('admin.donation')->with(compact('donations','donationsone'));
    
        }

         
        //dd($CmsPages);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($donationsid)
    {
        Donation::where('donations_id',$donationsid)->delete();
        return redirect('admin/donation')->with('success_message', 'Donation deleted successfully');
    }
}
