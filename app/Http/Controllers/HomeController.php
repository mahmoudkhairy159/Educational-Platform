<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\User;
use App\trainer;
use App\Course;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $courses = Course::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description', 'photo', 'trainer_id')->paginate(paginationCount);
        $trainers = Trainer::select('id', 'name')->paginate(paginationCount);
        return view('student/home')->with(['studentsCount' => $studentsCount, 'coursesCount' => $coursesCount, 'trainersCount' => $trainersCount, 'courses' => $courses, 'trainers' => $trainers]);
    }
}
