<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\FoodBank;
use App\Models\FoodBankGallery;
use App\Models\FoodBankCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FoodBankController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($foodbanksid = null)
    {

        //$foodbankcategories = FoodBankCategory::query()->get();

        //$foodbanks = FoodBank::get();

        $foodbanksnumrw = DB::table('foodbankcategories')->join('foodbanks','foodbankcategories.foodbankcategories_id','=', 'foodbanks.foodbankcategoriesid')->select('foodbanks.*','foodbankcategories.foodbankcategories_name')->count();

        if($foodbanksid == null) {
           
          if($foodbanksnumrw > 0) {
            $foodbanks = DB::table('foodbankcategories')->join('foodbanks','foodbankcategories.foodbankcategories_id','=', 'foodbanks.foodbankcategoriesid')->select('foodbanks.*','foodbankcategories.foodbankcategories_name')->get();
            foreach($foodbanks as $foodbank) {
                $data [] = array(
                'foodbanks_id' => $foodbank->foodbanks_id,
                'foodbanks_name' => $foodbank->foodbanks_name,
                'foodbanks_videofile' => $foodbank->foodbanks_videofile,
                'foodbanks_imagefile' => $foodbank->foodbanks_imagefile,
                );
            }
          } else {
            $data [] = array(
                'foodbanks_id' => ''
            );
          }
              
            return response()->json(['foodbanks'=>$data]);

        } else {

            
            $foodbank = new FoodBank;
            //$foodbankcategory = new FoodBankCategory;
            $foodbankonenumrw = $foodbank->where('foodbanks_id', $foodbanksid)->count();

            if($foodbankonenumrw > 0) {
              $foodbankone = $foodbank->where('foodbanks_id', $foodbanksid)->first();

              $data = array(
                'foodbanks_id' => $foodbankone->foodbanks_id,
                'foodbanks_name' => $foodbankone->foodbanks_name,
                'foodbanks_videofile' => $foodbankone->foodbanks_videofile,
                'foodbanks_imagefile' => $foodbankone->foodbanks_imagefile,
            );
            } else {
              $data = array(
                 'foodbanks_name' => ''
              );
            }
        

            //$foodbankgallerynumrw = \App\Models\FoodBankCategory::count();
            $foodbankgallerynumrw = DB::table('foodbankgalleries')->where("foodbanksid", $foodbanksid)->orderBy("foodbanksid")->count();

            if($foodbankgallerynumrw > 0) {
            $foodbankgalleries = DB::table('foodbankgalleries')->where("foodbanksid", $foodbanksid)->orderBy("foodbanksid")->get();

            foreach($foodbankgalleries as $foodbankgallery) {
                $gallerydata [] = array(
                'foodbanksid' => $foodbankgallery->foodbanksid,
                'foodbankgalleries_file' => $foodbankgallery->foodbankgalleries_file,
                );
            }
           } else {
               $gallerydata [] = array(
                  'foodbankgalleries_file' => ''
               );
           }

            //$foodbankcategoryone = $foodbankcategory->where('foodbankcategories_id', $foodbankone['foodbankcategoriesid'])->first();

           
    
            //date("F j, Y, g:i a", strtotime($page['created_at']))
    

    
            //dd($foodbank); die;
            //echo "<prev>"; print_r($data); die;
    
            return response()->json(['foodbankone'=>$data, 'foodbankgallery'=>$gallerydata]);

            //return with(compact('foodbanks','foodbankone','foodbankcategoryone','foodbankcategories'));
            
             
        }


    }

   






}
