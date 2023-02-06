<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    //
    public function check_user(Request $request){
        $check_number_user = User::all();

        return sizeof($check_number_user);
    }

    public function register(Request $request){

        try {
            // check number user
            $check_number_user = User::all();

            if(sizeof($check_number_user)==0){

                
                if($request->file('image')){
                    $upload_path = "img";
                    $generated_new_name = time().'.'.$request->image->getClientOriginalExtension();
                    $image = $request->file('image');
                    $img = Image::make($image->getRealpath());
                    $img->resize(800, null, function($constraint){
                        $constraint->aspectRatio();
                    });
    
                    $img->save($upload_path.'/'.$generated_new_name);

                    $user = new User();
                    $user->name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->gender = $request->gender;
                    $user->tel = $request->tel;
                    $user->image = $generated_new_name;
                    $user->password = Hash::make($request->password);
                    $user->birth_day = $request->birth_day;
                    $user->add_village = $request->add_village;
                    $user->add_city = $request->add_city;
                    $user->add_province = $request->add_province;
                    $user->add_detail = $request->add_detail;
                    $user->email = $request->email;
                    $user->web = $request->web;
                    $user->job = $request->job;
                    $user->job_type = $request->job_type;
                    $user->user_type = 'admin';
                    $user->save();
    
                } else {
                    $generated_new_name = "";

                    $user = new User();
                    $user->name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->gender = $request->gender;
                    $user->tel = $request->tel;
                    $user->image = $generated_new_name;
                    $user->password = Hash::make($request->password);
                    $user->birth_day = $request->birth_day;
                    $user->add_village = $request->add_village;
                    $user->add_city = $request->add_city;
                    $user->add_province = $request->add_province;
                    $user->add_detail = $request->add_detail;
                    $user->email = $request->email;
                    $user->web = $request->web;
                    $user->job = $request->job;
                    $user->job_type = $request->job_type;
                    $user->user_type = 'admin';
                    $user->save();
                }

            } else {
                // $userData = Auth::user();

                if($request->file('image')){
                    $upload_path = "img";
                    $generated_new_name = time().'.'.$request->image->getClientOriginalExtension();
                    $image = $request->file('image');
                    $img = Image::make($image->getRealpath());
                    $img->resize(800, null, function($constraint){
                        $constraint->aspectRatio();
                    });
    
                    $img->save($upload_path.'/'.$generated_new_name);

                    $user = new User();
                    $user->name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->gender = $request->gender;
                    $user->tel = $request->tel;
                    $user->image = $generated_new_name;
                    $user->password = Hash::make($request->password);
                    $user->birth_day = $request->birth_day;
                    $user->add_village = $request->add_village;
                    $user->add_city = $request->add_city;
                    $user->add_province = $request->add_province;
                    $user->add_detail = $request->add_detail;
                    $user->email = $request->email;
                    $user->web = $request->web;
                    $user->job = $request->job;
                    $user->job_type = $request->job_type;
                    $user->user_type = 'user';
                    $user->save();
    
                } else {
                    $generated_new_name = "";

                    $user = new User();
                    $user->name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->gender = $request->gender;
                    $user->tel = $request->tel;
                    $user->image = $generated_new_name;
                    $user->password = Hash::make($request->password);
                    $user->birth_day = $request->birth_day;
                    $user->add_village = $request->add_village;
                    $user->add_city = $request->add_city;
                    $user->add_province = $request->add_province;
                    $user->add_detail = $request->add_detail;
                    $user->email = $request->email;
                    $user->web = $request->web;
                    $user->job = $request->job;
                    $user->job_type = $request->job_type;
                    $user->user_type = 'user';
                    $user->save();
                }

                

            }

            $success = true;
            $message = "ລົງທະບຽນສຳເລັດ";
            
            } catch (\Illuminate\Database\QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
            }

            $response = [
                'success' => $success,
                'message' => $message,
            ];
            return response()->json($response);

    }

    public function update_user($id,Request $request){
        try {
            // check number user
            $User = User::find($id);

            if($request->password =='' || $request->password == null){

                if($request->file('image')){
                    $upload_path = "img";

                    if($User->image!='' && $User->image!=null){
                        if(file_exists('img/'.$User->image)){
                            unlink('img/'.$User->image);
                        }
                    }

                    $generated_new_name = time().'.'.$request->image->getClientOriginalExtension();
                    $image = $request->file('image');
                    $img = Image::make($image->getRealpath());
                    $img->resize(800, null, function($constraint){
                        $constraint->aspectRatio();
                    });
    
                    $img->save($upload_path.'/'.$generated_new_name);
                    $User->update([
                        'name' => $request->name,
                        'last_name' => $request->last_name,
                        'gender' => $request->gender,
                        // 'password' => Hash::make($request->password),
                        'image' => $generated_new_name,
                        'tel' => $request->tel,
                        'birth_day' => $request->birth_day,
                        'add_village' => $request->add_village,
                        'add_city' => $request->add_city,
                        'add_province' => $request->add_province,
                        'add_detail' => $request->add_detail,
                        'email' => $request->email,
                        'web' => $request->web,
                        'job' => $request->job,
                        'job_type' => $request->job_type,
                    ]);
                }
                else {
                    // $generated_new_name = '';

                    $User->update([
                        'name' => $request->name,
                        'last_name' => $request->last_name,
                        'gender' => $request->gender,
                        // 'password' => Hash::make($request->password),
                        // 'image' => $generated_new_name,
                        'tel' => $request->tel,
                        'birth_day' => $request->birth_day,
                        'add_village' => $request->add_village,
                        'add_city' => $request->add_city,
                        'add_province' => $request->add_province,
                        'add_detail' => $request->add_detail,
                        'email' => $request->email,
                        'web' => $request->web,
                        'job' => $request->job,
                        'job_type' => $request->job_type,
                    ]);
                }

               

            } else {
             
                if($request->file('image')){

                    $upload_path = "img";

                    if($User->image!='' && $User->image!=null){
                        if(file_exists('img/'.$User->image)){
                            unlink('img/'.$User->image);
                        }
                    }

                    $generated_new_name = time().'.'.$request->image->getClientOriginalExtension();
                    $image = $request->file('image');
                    $img = Image::make($image->getRealpath());
                    $img->resize(800, null, function($constraint){
                        $constraint->aspectRatio();
                    });
    
                    $img->save($upload_path.'/'.$generated_new_name);
                    $User->update([
                        'name' => $request->name,
                        'last_name' => $request->last_name,
                        'gender' => $request->gender,
                        'password' => Hash::make($request->password),
                        'image' => $generated_new_name,
                        'tel' => $request->tel,
                        'birth_day' => $request->birth_day,
                        'add_village' => $request->add_village,
                        'add_city' => $request->add_city,
                        'add_province' => $request->add_province,
                        'add_detail' => $request->add_detail,
                        'email' => $request->email,
                        'web' => $request->web,
                        'job' => $request->job,
                        'job_type' => $request->job_type,
                    ]);
                }
                else {
                    $generated_new_name = '';

                    $User->update([
                        'name' => $request->name,
                        'last_name' => $request->last_name,
                        'gender' => $request->gender,
                        'password' => Hash::make($request->password),
                        // 'image' => $generated_new_name,
                        'tel' => $request->tel,
                        'birth_day' => $request->birth_day,
                        'add_village' => $request->add_village,
                        'add_city' => $request->add_city,
                        'add_province' => $request->add_province,
                        'add_detail' => $request->add_detail,
                        'email' => $request->email,
                        'web' => $request->web,
                        'job' => $request->job,
                        'job_type' => $request->job_type,
                    ]);
                }

            }

            $success = true;
            $message = "ອັບເດດສຳເລັດ";
            
            } catch (\Illuminate\Database\QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
            }

            $response = [
                'success' => $success,
                'message' => $message,
            ];
            return response()->json($response);
    }

    public function mobile_login(Request $request){
        $request->validate([
            'tel' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);
     
        $user = User::where('tel', $request->tel)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => 'ລະຫັດຜ່ານຂອງທ່ານບໍ່ຖຶກຕ້ອງ! ກະລຸນາກວດຄືນ.....',
            ]);
        }
     
        return $user->createToken($request->device_name)->plainTextToken;
    }

    /// ລຶບ token ອອກຈາກລະບົບ
    public function revoke(Request $request){
        try {

            $user = $request->user();
            $user->tokens()->delete();

            $success = true;
            $message = "ອອກຈາກລະບົບສຳເລັດ!";
            
            } catch (\Illuminate\Database\QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
            }

            $response = [
                'success' => $success,
                'message' => $message,
            ];
            return response()->json($response);
        
    }

    public function get_user(Request $request){
        try {
            $user = $request->user(); // Auth::user()

            $success = true;
            $message = "ສຳເລັດ";
            
            } catch (\Illuminate\Database\QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
                $user = null;
            }

            $response = [
                'user'=> $user,
                'success' => $success,
                'message' => $message,
            ];
            return response()->json($response);
        
    }

    public function get_user_one($id){
        try {
            
            $user =  User::find($id);

            $success = true;
            $message = "ສຳເລັດ";
            
            } catch (\Illuminate\Database\QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
                $user = null;
            }

            $response = [
                'user'=> $user,
                'success' => $success,
                'message' => $message,
            ];
            return response()->json($response);
    }
  public function get_all_user(){
        try {

        $user = User::orderBy('id','desc')->get();
        $success = true;
        $message = "ສຳເລັດ";

    } catch (\Illuminate\Database\QueryException $ex) {
        $success = false;
        $message = $ex->getMessage();
        $user = null;
    }

    $response = [
        'user'=> $user,
        'success' => $success,
        'message' => $message,
    ];
    return response()->json($response);
    }

    public function delete($id){
        try {

        $user =  User::find($id);

        if($user->image!='' && $user->image!=null){
            if(file_exists('img/'.$user->image)){
                unlink('img/'.$user->image);
            }
        }

        $user->delete();



        $success = true;
        $message = "ສຳເລັດ";

    } catch (\Illuminate\Database\QueryException $ex) {
        $success = false;
        $message = $ex->getMessage();
        $user = null;
    }

    $response = [
        'user'=> $user,
        'success' => $success,
        'message' => $message,
    ];
    return response()->json($response);
    }
}
