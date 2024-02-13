<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\SermonGallery;
use App\Models\SermonCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SermonController extends Controller
{
            /**
     * Display a listing of the sermon.
     */
    public function index($sermonsid = null)
    {

        //$sermoncategories = SermonCategory::query()->get();

        //$sermons = Sermon::get();

        $now = date("Y-m-d H:i");

        $sermonsnumrw = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->count();

        if($sermonsid == null) {
           
          if($sermonsnumrw > 0) {
            $sermons = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->get();
            foreach($sermons as $sermon) {
   
                $data [] = array(
                'sermons_id' => $sermon->sermons_id,
                'sermons_title' => $sermon->sermons_title,
                'sermons_file' => $sermon->sermons_file,
                );
            }
          } else {
            $data [] = array(
                'sermons_id' => ''
            );
          }
              
            return response()->json(['sermons'=>$data]);

        } else {

            
            $sermon = new Sermon;
            //$sermoncategory = new SermonCategory;
            $sermononenumrw = $sermon->where('sermons_id', $sermonsid)->count();

            if($sermononenumrw > 0) {
              $sermonone = $sermon->where('sermons_id', $sermonsid)->first();

              $data = array(
                'sermons_id' => $sermonone->sermons_id,
                'sermons_name' => $sermonone->sermons_name,
            );
            } else {
              $data = array(
                 'sermons_title' => ''
              );
            }
  
    
            return response()->json(['sermonone'=>$data]);
            
             
        }


    }




}
