<?php

namespace App\Http\Controllers\Api;

use App\Events\AskToEnrollCourse;
use App\Course;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CourseController extends Controller
{
    use GeneralTrait;

    // return courses view for student (user)
    public function index()
    {
        $courses = Course::with('trainer')->select('id', 'name_' . app()->getLocale() . ' as name', 'description_' . app()->getLocale() . ' as description', 'photo', 'trainer_id')->paginate(paginationCount);
        return $this->returnData('courses', $courses);
    }

    // return Courses's student view for student (user)
    public function indexStudentCourses()
    {
        $user = Auth::user();
        $courses = $user->courses()->select('name_' .  app()->getLocale() . ' as name', 'description_' . app()->getLocale() . ' as description', 'photo', 'trainer_id')->paginate(paginationCount);

        return $this->returnData('courses', $courses);
    }

    // return courses view for Trainer
    public function indexTrainer()
    {
        $courses = Course::select('id', 'name_' . app()->getLocale() . ' as name', 'description_' . app()->getLocale() . ' as description', 'photo')->paginate(paginationCount);
        return $this->returnData('courses', $courses);
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
        return $this->returnSuccessMessage('Product created successfully!');
    }

    // return course view for student (user)
    public function show($id)
    {
        $course = Course::with('trainer')->with('lessons')->where('id', $id)->select('id', 'name_' . app()->getLocale() . ' as name', 'description_' . app()->getLocale() . ' as description', 'photo', 'trainer_id')->first();
        if (!$course) {
            return $this->returnError('404', 'The Course Does not Exist');
        }
        $userId = Auth::id();
        $status = DB::table('course_user')->where('user_id', $userId)->where('course_id', $course->id)->exists();
        if (!$status) {
            $status = '0';
        } else {
            $status = DB::table('course_user')->where('user_id', $userId)->where('course_id', $course->id)->value('status');
        }
        $course->status = $status;
        return $this->returnData('course', $course);
    }

    // return course view for Trainer
    public function showTrainer($id)
    {

        $course = Course::where('id', $id)->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'photo')->first();
        if (!$course) {
            return $this->returnError('404', 'The Course Does not Exist');
        }
        return $this->returnData('course', $course);
    }


    public function edit($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return $this->returnError('404', 'The Course Does not Exist');
        }
        return $this->returnData('course', $course);
    }


    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return $this->returnError('404', 'The Course Does not Exist');
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

        return $this->returnSuccessMessage('course updated successfully!');
    }


    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return $this->returnError('404', 'The Course Does not Exist');
        }

        Storage::disk('courses')->delete($course->photo);
        Storage::disk('courses')->deleteDirectory($course->name_en);
        $course->delete();
        return $this->returnSuccessMessage('course deleted successfully!');
    }
    public function askToEnrollCourse(Request $request)
    {
        $course_id = $request->course_id;
        $user = Auth::user();
        event(new AskToEnrollCourse($user, $course_id));
        return $this->returnSuccessMessage('Request of course enrollment sent  successfully');
    }



    public function showCourseStudents($courseId)
    {
        $course = Course::find($courseId);
        $users = $course->users()->with(['UserProfile' => function ($q) {
            $q->select('nationalId', 'photo', 'user_id');
        }])->select('name', 'email', 'address', 'phone')->paginate(paginationCount);
        $course->users = $users;
        return $this->returnData('course', $course);
    }

    public function showCourseEnrollmentRequests($courseId)
    {
        $usersIds = DB::select('SELECT user_id FROM course_user WHERE status  IS NULL AND course_id= ' . $courseId);
        if (!$usersIds) {
            session()->flash('error', 'There Is Not New Requests');
            return $this->returnError('404', 'There Is Not New Requests');
        }
        $arr = array();
        foreach ($usersIds as $value) {
            array_push($arr, $value->user_id);
        }
        $course = Course::find($courseId);
        $users = User::with('userProfile')->whereIn('id', $arr)->get();

        $course->users = $users;
        return $this->returnData('course', $course);
    }

    public function acceptCourseEnrollmentRequests($courseId, $userId)
    {
        DB::update('UPDATE course_user SET status ="1" WHERE user_id=' . $userId . ' AND course_id= ' . $courseId);
        return redirect()->route('courses.showCourseEnrollmentRequests', $courseId);
        return $this->returnSuccessMessage('Request is accepted');
    }
    public function refuseCourseEnrollmentRequests($courseId, $userId)
    {
        DB::update('UPDATE course_user SET status ="0" WHERE user_id=' . $userId . ' AND course_id= ' . $courseId);
        return $this->returnSuccessMessage('Request is refused');
    }
}
