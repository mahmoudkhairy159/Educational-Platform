@extends('layouts.trainerApp')
@section('content')



    < class="content">
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('messages.Add New Lesson')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item "><a href="">{{__('messages.Courses')}}</a></li>
                    <li class="breadcrumb-item"><a href="">{{__('messages.Course')}}</a></li>
                    <li class="breadcrumb-item active">{{__('messages.New Lesson')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{__('messages.The lesson will be added by: ')}} {{ Auth::guard('trainer')->user()->name}}</h3>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{route('lessons.store')}}" enctype="multipart/form-data">
                                @csrf
                                <input hidden type="text" name="course_id" value=" {{ $courseId}} ">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.Arabic Name')}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.Enter Arabic Name')}}">
                                    </div>
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.English Name')}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.Enter English Name')}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Video')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="video" id="formFile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Material')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="material" id="formFile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <h4>{{__('messages.Assignment')}} <span style="color:red"  class="fs-5">*optional</span></h4>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Assignment')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="assignment" >
                                    </div>
                                </div>  <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Correct Answer')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="assignmentCorrectAnswer" >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <h4>{{__('messages.Exam')}} <span style="color:red " class="fs-5">*optional</span></h4>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Exam')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="exam" >
                                    </div>
                                </div>  <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Correct Answer')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="examCorrectAnswer" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.Total Mark')}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="examTotalMark" placeholder="{{__('messages.Enter The Total Mark Of Exam ')}}">
                                    </div>
                                </div>









                                <div class="row mb-3 justify-content-center">
                                    <button type="submit" class="btn btn-primary col-4">{{__('messages.Add Lesson')}} <i class="fa-sharp fa-solid fa-plus"></i></button>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main>
@endsection
