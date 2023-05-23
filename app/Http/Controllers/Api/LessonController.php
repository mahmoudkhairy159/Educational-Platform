<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\Course;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class LessonController extends Controller
{
    use GeneralTrait;
    // return lessons view for student (user)
    public function index()
    {
        $lessons = Lesson::select('id', 'name_' . app()->getLocale() . ' as name', 'material', 'course_id')->paginate(paginationCount);
        return $this->returnData('lessons', $lessons);
    }

    // return lessons view for Trainer
    public function indexTrainer()
    {
        $lessons = lesson::select('id', 'name_' . app()->getLocale() . ' as name', 'material', 'course_id')->paginate(paginationCount);
        return $this->returnData('lessons', $lessons);
    }


    public function create($courseId)
    {
        return view('trainer.lesson.createLesson')->with('courseId', $courseId);
    }


    public function store(Request $request)
    {
        $courseName = Course::where('id', $request->course_id)->value('name_en');
        $lesson = Lesson::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'video' => $request->video->storeAs($courseName . '_' . $request->name_en, 'video.' . $request->video->getClientOriginalExtension(), 'lessons'),
            'material' => $request->material->storeAs($courseName . '_' . $request->name_en, 'material.' . $request->material->getClientOriginalExtension(), 'lessons'),
            'course_id' => $request->course_id,
        ]);
        //assignment
        if ($request->hasFile('assignment')) {
            $lesson->update([
                'assignment' => $request->assignment->storeAs($courseName . '_' . $request->name_en, 'assignment.' . $request->assignment->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->hasFile('assignmentCorrectAnswer')) {
            $lesson->update([
                'assignmentCorrectAnswer' => $request->assignmentCorrectAnswer->storeAs($courseName . '_' . $request->name_en, 'assignmentCorrectAnswer.' . $request->assignmentCorrectAnswer->getClientOriginalExtension(), 'lessons'),
            ]);
        }

        //exam
        if ($request->hasFile('exam')) {
            $lesson->update([
                'exam' => $request->exam->storeAs($courseName . '_' . 'exam.' . $request->exam->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->hasFile('examCorrectAnswer')) {
            $lesson->update([
                'examCorrectAnswer' => $request->examCorrectAnswer->storeAs($courseName . '_' . $request->name_en, 'examCorrectAnswer.' . $request->examCorrectAnswer->getClientOriginalExtension(), 'lessons'),
            ]);
            if ($request->has('examTotalMark')) {
                $lesson->update([
                    'examTotalMark' => $request->examTotalMark,
                ]);
            }
        }

        return $this->returnSuccessMessage('Lesson created successfully!');
    }

    // return lesson view for student (user)
    public function show($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->returnError('404', 'The lesson Does not Exist');
        }
        return $this->returnData('lesson', $lesson);
    }

    // return lesson view for Trainer
    public function showTrainer($id)
    {

        $lesson = Lesson::where('id', $id)->first();
        $course = $lesson->course;
        if (!$lesson) {
            return $this->returnError('404', 'The lesson Does not Exist');
        }
        $data = [
            'lesson' => $lesson,
            'course' => $course
        ];
        return $this->returnData('data', $data);
    }


    public function edit($id)
    {
        $lesson = lesson::find($id);
        if (!$lesson) {
            return $this->returnError('404', 'The lesson Does not Exist');
        }
        return $this->returnData('lesson', $lesson);
    }


    public function update(Request $request, $id)
    {
        $lesson = lesson::find($id);
        if (!$lesson) {
            return $this->returnError('404', 'The lesson Does not Exist');
        }
        $courseName = $lesson->course->name_en;
        $courseId = $lesson->course->id;

        if ($request->hasFile('video')) {
            Storage::disk('lessons')->delete($lesson->video);
            $lesson->update([
                'video' => $request->video->storeAs($courseName . '_' . $request->name_en, 'video.' . $request->video->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->hasFile('material')) {
            Storage::disk('lessons')->delete($lesson->material);
            $lesson->update([
                'material' => $request->material->storeAs($courseName . '_' . $request->name_en, 'material.' . $request->material->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->hasFile('assignment')) {
            Storage::disk('lessons')->delete($lesson->assignment);
            $lesson->update([
                'assignment' => $request->assignment->storeAs($courseName . '_' . $request->name_en, 'assignment.' . $request->assignment->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->hasFile('assignmentCorrectAnswer')) {
            Storage::disk('lessons')->delete($lesson->assignmentCorrectAnswer);
            $lesson->update([
                'assignmentCorrectAnswer' => $request->assignmentCorrectAnswer->storeAs($courseName . '_' . $request->name_en, 'assignmentCorrectAnswer.' . $request->assignmentCorrectAnswer->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->hasFile('exam')) {
            Storage::disk('lessons')->delete($lesson->exam);
            $lesson->update([
                'exam' => $request->exam->storeAs($courseName . '_' . $request->name_en, 'exam.' . $request->exam->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->hasFile('examCorrectAnswer')) {
            Storage::disk('lessons')->delete($lesson->examCorrectAnswer);
            $lesson->update([
                'examCorrectAnswer' => $request->examCorrectAnswer->storeAs($courseName . '_' . $request->name_en, 'examCorrectAnswer.' . $request->examCorrectAnswer->getClientOriginalExtension(), 'lessons'),
            ]);
        }
        if ($request->has('examTotalMark')) {
            $lesson->update([
                'examTotalMark' => $request->examTotalMark,
            ]);
        }


        if ($lesson->name_en !== $request->name_en) {
            Storage::disk('lessons')->move($courseName . '_' . $lesson->name_en, $courseName . '_' . $request->name_en);
            Storage::disk('lessons')->deleteDirectory($courseName . '_' . $lesson->name_en);
        }

        $lesson->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'course_id' => $request->course_id,
        ]);

        return $this->returnSuccessMessage('lesson updated successfully!');
    }


    public function destroy($id)
    {
        $lesson = lesson::find($id);
        if (!$lesson) {
            return $this->returnError('404', 'The lesson Does not Exist');
        }
        $courseName = $lesson->course->name_en;
        $courseId = $lesson->course->id;

        //Storage::disk('lessons')->delete($lesson->photo);
        Storage::disk('lessons')->deleteDirectory($courseName . '_' . $lesson->name_en, true);
        sleep(1);
        Storage::disk('lessons')->deleteDirectory($courseName . '_' . $lesson->name_en);

        $lesson->delete();
        return $this->returnSuccessMessage('lesson deleted successfully!');
    }
}
