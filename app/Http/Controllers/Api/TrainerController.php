<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use App\Course;
use App\trainer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;



class TrainerController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $trainers = Trainer::with('trainerProfile')->select('id', 'name')->paginate(paginationCount);
        return $this->returnData('trainers', $trainers);
    }

    //show trainer profile for user(student)  guard
    public function showTrainerProfileToUser($id)
    {
        $trainer = Trainer::with('trainerProfile')->find($id);
        if (!$trainer) {
            return $this->returnError('404', 'Trainer Does not Exist');
        }
        return $this->returnData('trainer', $trainer);
    }


    //show trainer profile for trainer guard
    public function show($id)
    {
        $trainer = Trainer::with('trainerProfile')->find($id);

        if (!$trainer) {
            return $this->returnError('404', 'Trainer Does not Exist');
        }
        return $this->returnData('trainer', $trainer);
    }


    public function update(Request $request, $id)
    {
        $trainer = Trainer::find($id);
        $trainerProfile = $trainer->trainerProfile;
        if (!$trainer) {
            return $this->returnError('404', 'Trainer Does not Exist');
        }
        if ($request->has('gender')) {
            $trainerProfile->update([
                'gender' => $request->gender,
            ]);
        }
        if ($request->has('governorate')) {
            $trainerProfile->update([
                'governorate' => $request->governorate,
            ]);
        }
        if ($request->has('city')) {
            $trainerProfile->update([
                'city' => $request->city,
            ]);
        }
        if ($request->has('job')) {
            $trainerProfile->update([
                'job' => $request->job,
            ]);
        }
        if ($request->has('description_ar')) {
            $trainerProfile->update([
                'description_ar' => $request->description_ar,
            ]);
        }
        if ($request->has('description_en')) {
            $trainerProfile->update([
                'description_en' => $request->description_en,
            ]);
        }
        if ($request->hasFile('photo')) {
            if ($trainerProfile) {
                Storage::disk('trainers')->delete($trainerProfile->photo);
                sleep(1);
                Storage::disk('trainers')->deleteDirectory($trainer->name . '_' . $trainer->id);
            }
            $trainerProfile->update([
                'photo' => $request->photo->store($trainer->name . '_' . $trainer->id, 'trainers'),
            ]);
        }

        $trainer->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return $this->returnSuccessMessage('Profile is updated successfully');
    }

    public function changePassword(Request $request, $id)
    {
        $trainer = Trainer::find($id);

        if (!Hash::check($request->currentPassword, $trainer->password)) {
            return $this->returnError('404', 'current password is wrong');
        }
        if ($request->newPassword !== $request->renewPassword) {

            return $this->returnError('404', 'Re-enter New Password Correctly');
        }
        $trainer->update([
            'password' => Hash::make($request->newPassword),
        ]);

        //logout after update password
        /*Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();*/
        $token = $request->header('auth-token');
        JWTAuth::setToken($token)->invalidate(); //logout
        return $this->returnSuccessMessage('Password is changed succsessfully');
    }
}
