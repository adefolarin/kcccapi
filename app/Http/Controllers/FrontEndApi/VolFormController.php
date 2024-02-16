<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\VolForm;
use App\Models\VolCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VolFormController extends Controller
{
            /**
     * Display a listing of the volform.
     */
    public function index()
    {

        //$volcategories = VolFormCategory::query()->get();

        //$volforms = VolForm::get();

        $now = date("Y-m-d H:i");

        $volformsnumrw = DB::table('volcategories')->join('volforms','volcategories.volcategories_id','=', 'volforms.volcategoriesid')->select('volforms.*','volcategories.volcategories_name')->count();

           
          if($volformsnumrw > 0) {
            $volforms = DB::table('volcategories')->join('volforms','volcategories.volcategories_id','=', 'volforms.volcategoriesid')->select('volforms.*','volcategories.volcategories_name')->get();
            foreach($volforms as $volform) {
   
                $data [] = array(
                 'volforms_time' => $volform->voldatetime,
                );
            }
          } else {
            $data [] = array(
                'volforms_time' => ''
            );
          }
              
            return response()->json(['volforms'=>$data]);
            


    }




}
