<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Models\AAMUser;
use Dotenv\Validator as DotenvValidator;
use Intervention\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AamUserController extends Controller
{ 
    //
    public function dashboard() {
         Session::put('page', 'dashboard');
        //echo "<prev>"; print_r(Auth::guard('aamusers')->user()); die;
        return view('aamuser.dashboard');

    }

    public function store(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            $message = "Registration Succussful";

            $rules = [
              'aamusers_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'aamusers_email' => 'required|email|max:255',
              'aamusers_password' => 'required|max:30'
            ];

            $customMessages = [
              'aamusers_name.required' => 'Name is required',
              'aamusers_name.regex' => 'Valid Name is required',
              'aamusers_email.required' => 'Email is required',
              'aamusers_email.email' => 'Valid Email is required',
              'aamusers_password.required' => 'Password is required',
            ];

            $store = [
                [
                   'aamusers_name' => $data['aamusers_name'],
                   'aamusers_email' => $data['aamusers_email'],
                   'aamusers_password' => bcrypt($data['aamusers_password']),
                ]
            ];

            $validator = Validator::make($data,$rules,$customMessages);

            if($validator->fails()) {
                return response()->json([$validator->errors(),422]);
            }


            if($data['aamusers_password'] != $data['aamusersconfirm_password']) {
                return response()->json(['status' => false, 'message' => 'Passwords Must Match']);
            }
            else if($data['aamusers_name'] == "" || $data['aamusers_email'] == "" || $data['aamusers_password'] == "") {
                return response()->json(['status' => false, 'message' => 'All Fields Are Required']);
            }
            else {

                DB::table("aamusers")->insert($store);
                return response()->json(['status' => true, 'message' => $message], 201);
            }



        }
    }

    public function login(Request $request ) {
        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;


            $rules = [
              'aamusers_email' => 'required|email|exists:aamusers',
              'aamusers_password' => 'required',
            ];

            $customMessages = [
              'aamusers_email.required' => 'Email is required',
              'aamusers_email.email' => 'Valid Email is required',
              'aamusers_email.exists' => 'Email does not exist',
              'aamusers_password.required' => 'Password is required',
            ];

            $validator = Validator::make($data,$rules,$customMessages);

            if($validator->fails()) {
                return response()->json([$validator->errors(),422]);
            }

            $usercount = DB::table("aamusers")->where("aamusers_email",$data['aamusers_email'])->count();


            if($usercount > 0) {
            $userdetails = DB::table("aamusers")->where("aamusers_email",$data['aamusers_email'])->first();
            if(password_verify($data['aamusers_password'],$userdetails->aamusers_password)) {
              //Session::regenerate();
              return response()->json(['status' => true, 'message' => 'Login Successful'], 201);
            } else {
              return response()->json(['status' => false, 'error_message' => 'Invalid Email or Password']);
            }
            } else {
              return response()->json(['status' => false, 'error_message' => 'Invalid Email']);
            }
        }
        return view('aamuser.login');
    }

    public function logout() {
      //Session::flush();
      //Session::regenerateToken();
      //Session::forget();
      Auth::guard('aamuser')->logout();
      return response()->json(['status' => true, 'message' => 'You have logged out successfully']);
    }

    public function updatePassword(Request $request) {
      Session::put('page', 'update-aamuser-password');
      if($request->isMethod('post')) {
        $data = $request->all();
        // check if current aamusers_password is correct
        if(Hash::check($data['current_pwd'],Auth::guard('aamuser')->user()->aamusers_password)) {
          // Check if new aamusers_password and confirm aamusers_password match
          if($data['new_pwd'] == $data['confirm_pwd']) {
            // Update New Password
            AAMUser::where('aamusers_id',Auth::guard('aamuser')->user()->id)->update(['aamusers_password' => bcrypt($data['new_pwd'])]);
            return response()->json(['status' => true, 'message' => 'Password Updated Succesfully']);
          } else {
            return response()->json(['status' => false, 'message' => 'New Password and Confirm Password Do Not Match']);
          }

        } else {
           return response()->json(['status' => false, 'message' => 'Your current aamusers_password is Incorrect!']);
        }
      }

    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('aamuser')->user()->aamusers_password)) {
          return response()->json(['status' => true, 'message' => 'true']);
        } else {
          return response()->json(['status' => false, 'message' => 'false']);
        }
    }

    public function updateAAMUserDetails(Request $request) {
      Session::put('page', 'update-aamusers-details');

      if($request->isMethod('post')) {
        $data = $request->all();
        //echo "<prev>"; print_r($data); die;

        $rules = [
          'aamusers_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
          'aamusers_mobile' => 'required|numeric|min:10',
        ];

        $customMessages = [
          'aamusers_name.required' => 'Name is required',
          'aamusers_name.regex' => 'AAMUser Name is not valid',
          'aamusers_mobile.required' => 'Valid Mobile is r equired',
          'aamusers_mobile.numeric' => 'Valid Phone Number is required',
          'aamusers_mobile.max' => 'Valid Mobile is required',
          'aamusers_mobile.min' => 'Valid Mobile is required',
        ];

        $this->validate($request,$rules,$customMessages);


        // Update AAMUser Details

        AAMUser::where('aamusers_email',Auth::guard('aamusers')->user()->aamusers_email)->update(['aamusers_name' => $data['aamusers_name'], 'mobile' => $data['aamusers_mobile']]);

        return redirect()->back()->with('success_message', 'AAMUser Details Updated Succesfully');
    }

      return view('aamuser.update-aamusers-details');
    }

  

}

