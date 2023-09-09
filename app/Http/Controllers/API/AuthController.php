<?php

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
     /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|min:3|max:15',
            'lastname' => 'required|string|min:3|max:15',
            'email' => 'required|email|min:10|max:100|unique:users',
            'password' => 'required|min:8|max:100',
            'confirmed_password' => 'required|same:password',
        ],
        $messages = [
            'email.unique' => 'This email is already exists',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if(request()->hasfile('image_profile')){
            $profileName = time().'.'.request()->image_profile->getClientOriginalExtension();
            request()->image_profile->move(public_path('profiles'), $profileName);
        }
   
       $user =  User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'image_profile' => $profileName ?? NULL,
            'password' => Hash::make($request['password']),
        ]);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['firstname'] =  $user->firstname;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['firstname'] =  $user->firstname;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError(['error'=>'invalid password or email']);
        } 
    }


    public function ForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
 

         if($status === Password::RESET_LINK_SENT){
           return [
            'status' => __($status)
           ];
         }
        
         throw ValidationException::withMessages([
                'email' => [trans($status)],
         ]);

       
    }

    public function ResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8|max:100',
            'confirmed_password' => 'required|same:password',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
                 
                event(new PasswordReset($user));
              }
        );
     
        return $status === Password::PASSWORD_RESET
        ? redirect('/success')->with('status', 'Your password has been changed successfully!')
        : back()->withErrors(['email' => [__($status)]]);
}

public function ResetPasswordView($token){
    return view('reset-password',['token'=>$token]);
}


public function Success(){
    return view('success');
}
}
