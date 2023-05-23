<?php

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Controller;
use App\User;
use App\UserProfile;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use GeneralTrait;
    public function register(Request $request)
    {
        //validate
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'phone' => 'required|numeric|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        //store user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);
        UserProfile::create([
            'user_id' => $user->id
        ]);

        //return success message
        return $this->returnSuccessMessage('User Registered Successfully');
    }

    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $user = Auth::guard('api')->user();
            $user->auth_token = $token;
            $profile = $user->userProfile;
            //return token
            return $this->returnData('user', $user);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function user(Request $request)
    {
        $token = $request->header('auth_token');
        if ($token) {
            try {
                $user = auth()->user();
                return $this->returnData('user', $user);
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return  $this->returnError('', 'some thing went wrongs');
            }
        } else {
            $this->returnError('', 'some thing went wrongs');
        }
    }

    public function logout(Request $request)
    {
        $token = $request->header('auth_token');
        if ($token) {
            try {

                JWTAuth::setToken($token)->invalidate(); //logout
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return  $this->returnError('', 'some thing went wrongs');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        } else {
            $this->returnError('', 'some thing went wrongs');
        }
    }
}
