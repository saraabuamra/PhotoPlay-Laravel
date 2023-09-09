<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
        return View('admin.dashboard');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            $validated = $request->validate([
                'email' => 'required|email|max:255|exists:admins',
                'password' => 'required|min:8|max:100',
            ]);

            if(Auth::guard('admin')->attempt([
                'email'=>$data['email'],
                'password'=>$data['password'],
                'status'=>1])){
                    return redirect('admin/dashboard');
                }else{
                    return redirect()->back()->with('error_message','Invalid Email or Password');
                }          
        }
        return view('admin.auth.login');
    }


    public function updateAdminPassword(Request $request){
        Session::put('page','update-admin-password');
        if($request->isMethod('post')){
            $data = $request->all();
            $validated = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required',
            ]);
            //check if current  password entered by admin is correct
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            // Check if new password is matching with confirm password
            if($data['confirm_password']==$data['new_password']){
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>
                bcrypt($data['new_password'])]);
                return redirect()->back()->with('success_message','Password has been updated successfully!');
            }else{
                return redirect()->back()->with('error_message','New Password and Confirm Password does not match!');
            }
            }else{
                return redirect()->back()->with('error_message','Your current password is Incorrect!');
            }
        }
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
       return view('admin.admins.update-admin-password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    public function updateAdminDetails(Request $request){
        Session::put('page','update-admin-details');
        if($request->isMethod('post')){
            $data = $request->all();

            $validated = $request->validate([
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
            ]);
            //upload admin image
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    //Get Image Extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    //upload the image
                    Image::make($image_tmp)->save($imagePath);

                }
            }elseif(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];
            }else{
                $imageName = "";
            }
            Admin::where('id',Auth::guard('admin')->user()->id)
            ->update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
            return redirect()->back()->with('success_message','Admin details updated successfully!');
        }
      return view('admin.admins.update-admin-details');
     
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
