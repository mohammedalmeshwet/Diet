<?php

namespace App\Http\Controllers\Api\AdminAndUser;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Gate;


class AuthController extends Controller
{
    use GeneralTrait;


public function login(Request $request){

    try {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request -> all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return  $code;
            return $this->returnValidationError($code,$validator);
        }
        //login
        $credentials = $request -> only(['email','password']);
        $token = Auth::guard('user-api') -> attempt($credentials);

        if(!$token)
            return null;
            //return Token
            $user = Auth::guard('user-api')->user();
            $user -> api_Token = $token;
        return $user;
    } catch (\Exception $ex) {
        return $this -> returnError($ex -> getCode(),$ex -> getMessage());
    }
}





    public function loginUser(Request $request){
        $user = $this->login($request);
        if($user){
            if($user->level  === 0)
            {
                return  $this->returnData("User",$user);
            }else{
                return $this->returnError('E000','You must be an user.');
            }
        }else{
           return  $this->returnError('E001','بيانات الدخول غير صحيحة');
        }
    }

    public function loginAdmin(Request $request){
        $user = $this->login($request);
        if($user){
            if($user->level  === 1)
            {
                return  $this->returnData("User",$user);
            }else{
                return $this->returnError('E000','You must be an admin.');
            }
        }else{
          return  $this->returnError('E001','بيانات الدخول غير صحيحة');
        }
    }

    public function logout(Request $request){
        $token = $request -> header('auth-token');
        if($token){
            try {
                JWTAuth::setToken($token)->invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return $this -> returnError('E000','some thing went wrongs');
            }

            return $this -> returnSuccessMessage('Logged out successfully');
        }else{
            return $this -> returnError('E000','some thing went wrongs');
        }
    }
}
