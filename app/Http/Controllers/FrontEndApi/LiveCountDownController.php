<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\LiveCountDown;
use App\Models\LiveCountDownGallery;
use App\Models\LiveCountDownCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class LiveCountDownController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($livecountdownsid = null)
    {

        $now = date("Y-m-d H:i");

        $livecountdownsnumrw = DB::table('livecountdowns')->count();

        if($livecountdownsid == null) {
           
          if($livecountdownsnumrw > 0) {
            $livecountdowns = DB::table('livecountdowns')->get();
            foreach($livecountdowns as $livecountdown) {
               
                $livecountdown_countdown = strtotime($livecountdown->livecountdowns_datetime);

                $data [] = array(
                'livecountdowns_id' => $livecountdown->livecountdowns_id,
                'livecountdowns_datetime' => $livecountdown_countdown,
       
                );
            }
          } else {
            $data [] = array(
                'livecountdowns_id' => ''
            );
          }
              
            return response()->json(['livecountdowns'=>$data]);

             
        }


    }




}
