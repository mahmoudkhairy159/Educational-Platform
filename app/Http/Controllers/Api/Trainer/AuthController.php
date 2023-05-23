<?php

namespace App\Http\Controllers\Api\Trainer;


use App\Http\Controllers\Controller;
use App\Trainer;
use App\TrainerProfile;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:trainers'],
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'phone' => 'required|numeric|unique:trainers',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        //store user
        $trainer = Trainer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        TrainerProfile::create([
            'user_id' => $trainer->id
        ]);
        //return success message
        return $this->returnSuccessMessage('Trainer Registered Successfully');
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

            $token = Auth::guard('trainer-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $trainer = Auth::guard('trainer-api')->user();
            $trainer->auth_token = $token;
            //return token
            return $this->returnData('trainer', $trainer);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function trainer(Request $request)
    {
        $token = $request->header('auth_token');
        if ($token) {
            try {
                $trainer = auth()->user();
                return $this->returnData('trainer', $trainer);
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
