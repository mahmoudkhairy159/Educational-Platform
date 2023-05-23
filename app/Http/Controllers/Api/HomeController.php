<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\User;
use App\trainer;
use App\Course;



class HomeController extends Controller
{
    use GeneralTrait;


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $studentsCount = User::count();
        $coursesCount = Course::count();
        $trainersCount = Trainer::count();
        $courses = Course::with('trainer')->select('id', 'name_' . app()->getLocale() . ' as name', 'description_' . app()->getLocale() . ' as description', 'photo', 'trainer_id')->take(3)->get();
        $trainers = Trainer::with('trainerProfile')->select('id', 'name')->take(3)->get();

        $data = [
            'studentsCount' => $studentsCount,
            'coursesCount' => $coursesCount,
            'trainersCount' => $trainersCount,
            'courses' => $courses,
            'trainers' => $trainers
        ];
        return $this->returnData('data', $data);
    }
}
