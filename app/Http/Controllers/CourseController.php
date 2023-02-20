<?php

namespace App\Http\Controllers;
use App\Events\AskToEnrollCourse;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpParser\Node\Stmt\Foreach_;

define('paginationCount', 5);

class CourseController extends Controller
{
    // return courses view for student (user)
    public function index()
    {
        $courses = Course::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description', 'photo', 'trainer_id')->paginate(paginationCount);
        return view('student.course.showCourses')->with('courses', $courses);
    }

    // return Courses's student view for student (user)
    public function indexStudentCourses()
    {
        $user = Auth::user();
        $courses = $user->courses()->select('name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description', 'photo', 'trainer_id')->paginate(paginationCount);
        return view('student.course.showMyCourses')->with('courses', $courses);
    }

    // return courses view for Trainer
    public function indexTrainer()
    {
        $courses = Course::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description', 'photo')->paginate(paginationCount);
        return view('trainer.course.showCourses')->with('courses', $courses);
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
            'photo' => $request->photo->store($request->name_en, 'courses'),
            'trainer_id' => $request->trainer_id,
        ]);
        return redirect()->route('courses.indexTrainer')->with('success', 'Product created successfully!');

    }

    // return course view for student (user)
    public function show($id)
    {
        $course = Course::where('id', $id)->select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description', 'photo', 'trainer_id')->first();
        if (!$course) {
            return redirect()->back()->with('error', 'The Course Does not Exist');
        }
        return view('student.course.showCourse')->with('course', $course);
    }

    // return course view for Trainer
    public function showTrainer($id)
    {

        $course = Course::where('id', $id)->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'photo')->first();
        if (!$course) {
            return redirect()->back()->with('error', 'The Course Does not Exist');
        }
        return view('trainer.course.showCourse')->with('course', $course);
    }


    public function edit($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'The Course Does not Exist');
        }
        return view('trainer.course.editCourse')->with('course', $course);
    }


    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'The Course Does not Exist');
        }


        if ($request->hasFile('photo')) {
            Storage::disk('courses')->delete($course->photo);
            $course->update([
                'photo' => $request->photo->store($request->name_en, 'courses'),
            ]);
        }

        if ($course->name_en !== $request->name_en) {
            Storage::disk('courses')->deleteDirectory($course->name_en);
        }

        $course->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'trainer_id' => $request->trainer_id,
        ]);

        session()->flash('success', 'course updated successfully!');
        return redirect()->route('courses.indexTrainer');
    }


    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'The Course Does not Exist');
        }

        Storage::disk('courses')->delete($course->photo);
        Storage::disk('courses')->deleteDirectory($course->name_en);
        $course->delete();
        session()->flash('success', 'course deleted successfully!');
        return redirect()->route('courses.indexTrainer');

    }
    public function askToEnrollCourse($courseId)
    {
        $user=Auth::user();
        event(new AskToEnrollCourse($user,$courseId));
        return redirect()->route('courses.show',$courseId)->with('success', 'Request of course enrollment sent  successfully');
    }

  /*  public function enrollCourse($courseId)
    {
        $user=Auth::user();
        $user->courses()->syncWithoutDetaching($courseId);
        return redirect()->route('courses.show',$courseId)->with('success', 'course enrolled successfully');
    }*/

    public function showCourseStudents($courseId)
    {
        $course=Course::find($courseId);
        $users=$course->users()->with(['UserProfile'=>function($q){
            $q->select('nationalId','photo','user_id');
        }])->select( 'name','email','address','phone')->paginate(paginationCount);
        return view('trainer.course.showCourseStudents')->with(['users'=>$users,'course'=>$course]);
    }

    public function showCourseEnrollmentRequests($courseId)
    {
        $usersIds=DB::select('SELECT user_id FROM course_user WHERE status  IS NULL AND course_id= '.$courseId );
        if(!$usersIds){
            session()->flash('error','There Is Not New Requests');
            return redirect()->route('courses.showTrainer',$courseId);


        }
        $arr=array();
       foreach($usersIds as $value){
        array_push($arr,$value->user_id);

       }
        $course=Course::find($courseId);
        $users=User::with('userProfile')->whereIn('id',$arr)->get();
        return view('trainer.course.showCourseEnrollmentRequests')->with(['course'=>$course,'users'=>$users]);
    }

    public function acceptCourseEnrollmentRequests($courseId,$userId)
    {
        DB::update('UPDATE course_user SET status ="1" WHERE user_id='.$userId.' AND course_id= '.$courseId );
        return redirect()->route('courses.showCourseEnrollmentRequests',$courseId);



    }
    public function refuseCourseEnrollmentRequests($courseId,$userId)
    {
        DB::update('UPDATE course_user SET status ="0" WHERE user_id='.$userId.' AND course_id= '.$courseId );
        return redirect()->route('courses.showCourseEnrollmentRequests',$courseId);

    }




}
