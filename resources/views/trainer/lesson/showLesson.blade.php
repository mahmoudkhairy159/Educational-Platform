@extends('layouts.trainerapp')

@section('content')
    <main id="main" class="main pb-1 mb-1">

        <div class="pagetitle ">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/trainer/home">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item "><a
                            href="{{route('courses.indexTrainer')}}">{{__('messages.Courses')}}</a>
                    </li>
                    <li class="breadcrumb-item active"><a
                            href="{{route('courses.showTrainer',[$course->id])}}">{{__('messages.View Course')}}</a>
                    </li>
                    <li class="breadcrumb-item active"><a
                            href="{{route('lessons.showTrainer',[$lesson->id])}}">{{__('messages.View Lesson')}}</a>
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @include('includes.flashmessage')

        <section class="section lesson">
            <div class="row card-group">

                <div class=" col-xl-12 card">
                    <div class="card-body lesson-card pt-4 d-flex flex-column align-items-center ">
                        <div class="main_image">
                            <video style="width: 100%; height:80vh"
                                   poster="{{asset('storage/images/courses/'.$course->photo)}}" controls>
                                <source src="{{asset('storage/images/lessons/'.$lesson->video)}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row card-group">
                <div class=" col-xl-12 card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex justify-content-center align-items-center">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#lesson-overview">
                                    {{__('messages.Overview')}}
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lesson-edit">
                                    {{__('messages.Edit Lesson')}}
                                </button>
                            </li>

                            <li class="nav-item  ">
                                <form action="{{route('lessons.destroy',[$lesson->id])}}" method="post"
                                      class=" d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger ">
                                        {{__('messages.Delete Lesson')}} <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active lesson-overview " id="lesson-overview">
                                <div class="row  ">
                                    <div class="col-6 "><h6> {{__('messages.ID')}}</h6></div>
                                    <div class="col-6 "><p>{{$lesson->id}}</p></div>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="row">
                                    <div class="col-6 "><h6>{{__('messages.Arabic Name')}}</h6></div>
                                    <div class="col-6"><p>{{$lesson->name_ar}}</p></div>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="row">
                                    <div class="col-6 "><h6>{{__('messages.English Name')}}</h6></div>
                                    <div class="col-6"><p>{{$lesson->name_en}}</p></div>
                                </div>
                                <hr class="dropdown-divider">
                                @if($lesson->video)
                                    <div class="row">
                                        <div class="col-6 "><h6>{{__('messages.Video')}}</h6></div>
                                        <div class="col-6">
                                            <a href="{{asset('storage/images/lessons/'.$lesson->video)}}"
                                               class="rounded " download>Download <i
                                                    class="fa-solid fa-download"></i></a>
                                        </div>
                                    </div>
                                    <hr class="dropdown-divider">
                                @endif
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

                            <div class="tab-pane fade lesson-edit pt-3" id="lesson-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{route('lessons.update',$lesson->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input hidden type="text" name="course_id"
                                           value=" {{ $lesson->course_id}} ">

                                    <div class="row mb-3">
                                        <label for="inputText"
                                               class="col-sm-2 col-form-label">{{__('messages.Arabic Name')}}</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="name_ar"
                                                   value="{{$lesson->name_ar}}"
                                                   placeholder="{{__('messages.Enter Arabic Name')}} ">
                                        </div>
                                        <label for="inputText"
                                               class="col-sm-2 col-form-label">{{__('messages.English Name')}}</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="name_en"
                                                   value="{{$lesson->name_en}}"
                                                   placeholder="{{__('messages.Enter English Name')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-2 col-form-label">{{__('messages.Video')}}</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="video" id="formFile">
                                            @if($lesson->video)
                                                <a href="{{asset('storage/images/lessons/'.$lesson->video)}}"
                                                   class="rounded " download>Download <i
                                                        class="fa-solid fa-download"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-2 col-form-label">{{__('messages.Material')}}</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="material"
                                                   id="formFile">
                                            @if($lesson->material)
                                                <a href="{{asset('storage/images/lessons/'.$lesson->material)}}"
                                                   class="rounded " download>Download <i
                                                        class="fa-solid fa-download"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <h4>{{__('messages.Assignment')}} <span style="color:red"
                                                                                class="fs-5">*optional</span>
                                        </h4>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-2 col-form-label">{{__('messages.Assignment')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="assignment">
                                            @if($lesson->assignment)
                                                <a href="{{asset('storage/images/lessons/'.$lesson->assignment)}}"
                                                   class="rounded " download>Download <i
                                                        class="fa-solid fa-download"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-2 col-form-label">{{__('messages.Correct Answer')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file"
                                                   name="assignmentCorrectAnswer">
                                            @if($lesson->assignmentCorrectAnswer)
                                                <a href="{{asset('storage/images/lessons/'.$lesson->assignmentCorrectAnswer)}}"
                                                   class="rounded " download>Download <i
                                                        class="fa-solid fa-download"></i>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <h4>{{__('messages.Exam')}} <span style="color:red "
                                                                          class="fs-5">*optional</span>
                                        </h4>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-2 col-form-label">{{__('messages.Exam')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="exam">
                                            @if($lesson->exam)
                                                <a href="{{asset('storage/images/lessons/'.$lesson->exam)}}"
                                                   class="rounded " download>Download <i
                                                        class="fa-solid fa-download"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-2 col-form-label">{{__('messages.Correct Answer')}}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="examCorrectAnswer">
                                            @if($lesson->examCorrectAnswer)
                                                <a href="{{asset('storage/images/lessons/'.$lesson->examCorrectAnswer)}}"
                                                   class="rounded " download>Download <i
                                                        class="fa-solid fa-download"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                               class="col-sm-2 col-form-label">{{__('messages.Total Mark')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="examTotalMark"
                                                   value="{{($lesson->examTotalMark)?$lesson->examTotalMark:null}}"
                                                   placeholder="{{__('messages.Enter The Total Mark Of Exam ')}}">

                                        </div>
                                    </div>


                                    <div class="row mb-3 justify-content-center">
                                        <button type="submit"
                                                class="btn btn-primary col-4">{{__('messages.Edit Lesson')}} <i
                                                class="fa-sharp fa-solid fa-plus"></i></button>
                                    </div>

                                </form><!-- End General Form Elements -->


                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    @include('trainer.lesson.showLessons')
@endsection
