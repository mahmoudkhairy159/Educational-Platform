<?php

namespace App\Http\Controllers;

use App\Admin;
use App\trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function show($id)
    {
        $trainer = Trainer::find($id);
        $trainerProfile=$trainer->trainerProfile;
        if (!$trainer) {
            return redirect()->back()->with('error', 'Trainer Does not Exist');

        }
        return view('trainer.profile')->with(['trainer'=> $trainer,'trainerProfile'=>$trainerProfile]);
    }


    public function update(Request $request, $id)
    {
        $trainer = Trainer::find($id);
        $trainerProfile = $trainer->trainerProfile;
        if (!$trainer) {
            return redirect()->back()->with('error', 'trainer Does not Exist');
        }
        if($request->has('gender')){
            $trainerProfile->update([
                'gender'=>$request->gender,
            ]);
        }
        if($request->has('governorate')){
            $trainerProfile->update([
                'governorate'=>$request->governorate,
            ]);
        }
        if($request->has('city')){
            $trainerProfile->update([
                'city'=>$request->city,
            ]);
        }
        if($request->has('job')){
            $trainerProfile->update([
                'job'=>$request->job,
            ]);
        }
        if($request->has('description_ar')){
            $trainerProfile->update([
                'description_ar'=>$request->description_ar,
            ]);
        }
        if($request->has('description_en')){
            $trainerProfile->update([
                'description_en'=>$request->description_en,
            ]);
        }
        if($request->hasFile('photo')){
            if($trainerProfile){
                Storage::disk('trainers')->delete($trainerProfile->photo);
                sleep(1);
                Storage::disk('trainers')->deleteDirectory($trainer->name.'_'.$trainer->id);
            }
            $trainerProfile->update([
                'photo'=>$request->photo->store($trainer->name.'_'.$trainer->id,'trainers'),
            ]);
        }

        $trainer->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect()->route('trainers.show',$id)->with('success', 'Profile is updated successfully');
    }

    public function changePassword(Request $request,$id)
    {
       $trainer=Trainer::find($id);

        if (! Hash::check($request->currentPassword,$trainer->password) ) {
            return redirect()->back()->with('error', 'current password is wrong');
        }
        if($request->newPassword !==$request->renewPassword){
            return redirect()->back()->with('error', 'Re-enter New Password Correctly');

        }
        $trainer->update([
            'password' => Hash::make($request->newPassword),
        ]);

        //logout after update password
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }


}
