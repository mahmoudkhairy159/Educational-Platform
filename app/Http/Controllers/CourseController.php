<?php

namespace App\Http\Controllers;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
define('paginationCount',5);

class CourseController extends Controller
{
    // return courses view for student (user)
    public function index()
    {
        $courses = Course::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','description_'.LaravelLocalization::getCurrentLocale().' as description', 'photo')->paginate(paginationCount);
        return view('student.courses')->with('courses', $courses);
    }
    // return courses view for Trainer
    public function indexTrainer()
    {
        $courses= Course::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','description_'.LaravelLocalization::getCurrentLocale().' as description', 'photo')->paginate(paginationCount);
        return view('trainer.course.showCourses')->with('courses',  $courses);
    }


    public function create()
    {
        return view('trainer.course.createCourse');

    }


    public function store(Request $request)
    {
        Course::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'photo' => $request->photo->store($request->name_en ,'courses'),
            'trainer_id' => $request->trainer_id,
        ]);
        return redirect()->route('courses.indexTrainer')->with('success', 'Product created successfully!');

    }

    // return course view for student (user)
    public function show($id)
    {
        $course=Course::find($id);
        if(!$course){
            return redirect()->back()->with('error','The Course Does not Exist');
        }
        return view('student.course')->with('course',$course);
    }

    // return course view for Trainer
    public function showTrainer($id)
    {

        $course=Course::where('id',$id)->select('id','name_ar','name_en','description_ar', 'description_en', 'photo')->first();
        if(!$course){
            return redirect()->back()->with('error','The Course Does not Exist');
        }
        return view('trainer.course.showCourse')->with('course',$course);
    }



    public function edit($id)
    {
        $course=Course::find($id);
        if(!$course){
            return redirect()->back()->with('error','The Course Does not Exist');
        }
        return view('trainer.course.editCourse')->with('course',$course);
    }


    public function update(Request $request, $id)
    {
        $course=Course::find($id);
        if(!$course){
            return redirect()->back()->with('error','The Course Does not Exist');
        }


        if($request->hasFile('photo')){
            Storage::disk('courses')->delete($course->photo);
            $course->update([
                'photo' => $request->photo->store($request->name_en,'courses'),
            ]);
        }

        if($course->name_en !== $request->name_en){
            Storage::disk('courses')->deleteDirectory($course->name_en);
        }

        $course->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'trainer_id' => $request->trainer_id,
        ]);

        session()->flash('success','course updated successfully!');
        return redirect()->route('courses.indexTrainer');
    }


    public function destroy($id)
    {
        $course=Course::find($id);
        if(!$course){
            return redirect()->back()->with('error','The Course Does not Exist');
        }

        Storage::disk('courses')->delete($course->photo);
        Storage::disk('courses')->deleteDirectory($course->name_en);
        $course->delete();
        session()->flash('success','course deleted successfully!');
        return redirect()->route('courses.indexTrainer');

    }
}
