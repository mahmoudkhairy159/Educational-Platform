<?php

namespace App\Http\Controllers;

use App\trainer;
use App\User;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
define('paginationCount',5);

class UserController extends Controller

{

    //show all students in all courses of the trainer
    public function index()
    {
        $trainer=Auth::user();
        $courses=$trainer->courses;     
        return view('trainer.student.showStudents')->with('courses', $courses);
    }

    //show Student profile
    public function show($id)
    {
        $user = User::find($id);
        $userProfile=$user->userProfile;
        if(!$user){
            return redirect()->back()->with('error','User Does not Exist');

        }
        return view('student.profile')->with(['user'=>$user,'userProfile'=>$userProfile]);
    }

    public function showUserForTrainer($courseId,$userId)
    {
        $user = User::find($userId);
        $course = User::find($courseId);
        if(!$user){
            return redirect()->back()->with('error','User Does not Exist');
        }
        $userProfile=$user->userProfile;   
        return view('trainer.student.showStudent')->with(['user'=>$user,'userProfile'=>$userProfile,'course'=>$course]);
     
    }

     




    


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $userProfile = $user->userProfile;
        if (!$user) {
            return redirect()->back()->with('error', 'user Does not Exist');
        }
        if($request->has('gender')){
            $userProfile->update([
                'gender'=>$request->gender,
            ]);
        }
        if($request->has('governorate')){
            $userProfile->update([
                'governorate'=>$request->governorate,
            ]);
        }
        if($request->has('city')){
            $userProfile->update([
                'city'=>$request->city,
            ]);
        }
        if($request->has('nationalId')){
            $userProfile->update([
                'nationalId'=>$request->nationalId,
            ]);
        }

        if($request->hasFile('photo')){
            if($userProfile){
                Storage::disk('users')->delete($userProfile->photo);
                sleep(1);
                Storage::disk('users')->deleteDirectory($user->name.'_'.$user->id);
            }
            $userProfile->update([
                'photo'=>$request->photo->store($user->name.'_'.$user->id,'users'),
            ]);
        }

        $user->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect()->route('users.show',$id)->with('success', 'Profile is updated successfully');
    }



    public function changePassword(Request $request,$id)
    {
        $user=User::find($id);

        if (! Hash::check($request->currentPassword, $user->password) ) {
            return redirect()->back()->with('error', 'current password is wrong');
        }
        if($request->newPassword !==$request->renewPassword){
            return redirect()->back()->with('error', 'Re-enter New Password Correctly');

        }
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        //logout after update password
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


   //remove user from course
    public function destroy($courseId,$userId)
    {
        $course=Course::find($courseId);
        $course->users()->detach($userId);    
        session()->flash('success', 'Student Is Removed From Course Successfully');   
        return redirect()->route('courses.showCourseStudents',$courseId);

    }
}
