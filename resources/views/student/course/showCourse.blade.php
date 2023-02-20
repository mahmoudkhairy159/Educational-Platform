@extends('layouts.app')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Course Details</h2>
            <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit
                quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-8">
                    <img src="{{asset('storage/images/courses/'.$course->photo)}}" class="img-fluid" alt="">
                    <h3>{{$course->name}}</h3>
                    <p>{{$course->description}} </p>
                </div>
                <div class="col-lg-4">

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Trainer</h5>
                        <p><a href="#">{{$course->trainer->name}}</a></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Course Fee</h5>
                        <p>$165</p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Available Seats</h5>
                        <p>30</p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Schedule</h5>
                        <p>5.00 pm - 7.00 pm</p>
                    </div>
                    <div class="d-grid gap-2">
                      <a class="btn btn-success " href="{{route('courses.askToEnrollCourse',$course->id)}}">{{__('messages.Ask To Enroll')}}</a>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End Cource Details Section -->

    <!-- ======= Cource Details Tabs Section ======= -->
    <section id="cource-details-tabs" class="cource-details-tabs">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column text-center" >
                        @foreach($course->lessons as $lesson)
                            <li class="nav-item ">
                                <a class="nav-link active show" data-bs-toggle="tab"
                                   href="#{{$lesson->id}}">{{$lesson->name_en}}</a>
                            </li>
                        @endforeach


                    </ul>
                </div>
                <div class="col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content text-center border">
                        @foreach($course->lessons as $lesson)
                            <div class="tab-pane active show" id="{{$lesson->id}}">
                                <div class="row">
                                    <div class="col-lg-8 details order-2 order-lg-1 text-center">
                                        <h3>{{$lesson->name_en}}</h3>
                                        <p class="fst-italic">{{$lesson->name_ar}}</p>
                                        @if($lesson->material)
                                            <div class="row">
                                                <div class="col-6 "><h6>{{__('messages.Material')}}</h6></div>
                                                <div class="col-6 ">
                                                    <a href="{{asset('storage/images/lessons/'.$lesson->material)}}"
                                                       class="rounded " download>Download <i
                                                            class="fa-solid fa-download"></i></a>
                                                </div>
                                            </div>
                                            <hr class="dropdown-divider">
                                        @endif
                                        @if($lesson->assignment)

                                            <div class="row">
                                                <div class="col-6 "><h6>{{__('messages.Assignment')}}</h6></div>
                                                <div class="col-6">
                                                    <a href="{{asset('storage/images/lessons/'.$lesson->assignment)}}"
                                                       class="rounded " download>Download <i
                                                            class="fa-solid fa-download"></i></a>

                                                </div>
                                            </div>
                                            <hr class="dropdown-divider">
                                        @endif
                                        @if($lesson->assignmentCorrectAnswer)

                                            <div class="row">
                                                <div class="col-6 "><h6>{{__('messages.Assignment Correct Answer')}}</h6></div>
                                                <div class="col-6">
                                                    <a href="{{asset('storage/images/lessons/'.$lesson->assignmentCorrectAnswer)}}"
                                                       class="rounded " download>Download <i
                                                            class="fa-solid fa-download"></i></a>

                                                </div>
                                            </div>
                                            <hr class="dropdown-divider">
                                        @endif
                                        @if($lesson->exam)
                                            <div class="row">
                                                <div class="col-6 "><h6>{{__('messages.Exam')}}</h6></div>
                                                <div class="col-6">

                                                    <a href="{{asset('storage/images/lessons/'.$lesson->exam)}}"
                                                       class="rounded " download>Download <i
                                                            class="fa-solid fa-download"></i></a>
                                                </div>
                                            </div>
                                            <hr class="dropdown-divider">
                                        @endif
                                        @if($lesson->examCorrectAnswer)
                                            <div class="row">
                                                <div class="col-6 "><h6>{{__('messages.Exam Correct Answer')}}</h6>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{asset('storage/images/lessons/'.$lesson->examCorrectAnswer)}}"
                                                       class="rounded " download>Download <i
                                                            class="fa-solid fa-download"></i></a>

                                                </div>
                                            </div>
                                            <hr class="dropdown-divider">
                                        @endif
                                        @if($lesson->examTotalMark)
                                            <div class="row">
                                                <div class="col-6 "><h6>{{__('messages.Exam Total Mark')}}</h6></div>
                                                <div class="col-6">
                                                    <p>{{$lesson->examTotalMark}}</p>
                                                </div>
                                            </div>
                                            <hr class="dropdown-divider">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 text-center align-center order-1 order-lg-2">
                                        <video style="width: 100%; height:100%"
                                               poster="{{asset('storage/images/courses/'.$course->photo)}}" controls>
                                            <source src="{{asset('storage/images/lessons/'.$lesson->video)}}" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Cource Details Tabs Section -->

@endsection
