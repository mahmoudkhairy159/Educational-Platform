<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\trainer;
use App\User;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller

{
    use GeneralTrait;

    //show all students in all courses of the trainer
    public function index()
    {
        $trainer = Auth::user();
        $courses = $trainer->courses;
        return $this->returnData('courses', $courses);
    }

    //show Student profile
    public function show($id)
    {
        $student = User::with('userProfile')->find($id);
        if (!$student) {
            return $this->returnError('404', 'User Does not Exist');
        }
        return $this->returnData('student', $student);
    }

    public function showUserForTrainer($courseId, $userId)
    {
        $student = User::with('userProfile')->find($userId);
        $course = User::find($courseId);
        if (!$student) {
            return $this->returnError('404', 'User Does not Exist');
        }
        $data = [
            'student' => $student,
            'course' => $course
        ];
        return $this->returnData('data', $data);
    }









    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $userProfile = $user->userProfile;
        if (!$user) {
            return $this->returnError('404', 'User Does not Exist');
        }
        if ($request->has('gender')) {
            $userProfile->update([
                'gender' => $request->gender,
            ]);
        }
        if ($request->has('governorate')) {
            $userProfile->update([
                'governorate' => $request->governorate,
            ]);
        }
        if ($request->has('city')) {
            $userProfile->update([
                'city' => $request->city,
            ]);
        }
        if ($request->has('nationalId')) {
            $userProfile->update([
                'nationalId' => $request->nationalId,
            ]);
        }

        if ($request->hasFile('photo')) {
            if ($userProfile) {
                Storage::disk('users')->delete($userProfile->photo);
                sleep(1);
                Storage::disk('users')->deleteDirectory($user->name . '_' . $user->id);
            }
            $userProfile->update([
                'photo' => $request->photo->store($user->name . '_' . $user->id, 'users'),
            ]);
        }
        $user->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return $this->returnSuccessMessage('Profile is updated successfully');
    }



    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return $this->returnError('404', 'current password is wrong');
        }
        if ($request->newPassword !== $request->renewPassword) {

            return $this->returnError('404', 'Re-enter New Password Correctly');
        }
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        //logout after update password
        /*Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();*/
        $token = $request->header('auth-token');
        JWTAuth::setToken($token)->invalidate(); //logout
        return $this->returnSuccessMessage('Profile is changed successfully');
    }


    //remove user from course
    public function destroy($courseId, $userId)
    {
        $course = Course::find($courseId);
        $course->users()->detach($userId);
        return $this->returnSuccessMessage('Student Is Removed From Course Successfully');
    }
}
