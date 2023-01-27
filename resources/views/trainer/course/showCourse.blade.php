@extends('layouts.trainerapp')

@section('content')
    <main id="main" class="main pb-1 mb-1">

        <div class="pagetitle ">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/trainer/home">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item">{{__('messages.Courses')}}</li>
                    <li class="breadcrumb-item "><a href="{{route('courses.indexTrainer')}}">{{__('messages.Courses')}}</a>
                    </li>
                    <li class="breadcrumb-item active"><a
                            href="{{route('courses.showTrainer',[$course->id])}}">{{__('messages.View Course')}}</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @include('includes.flashmessage')

        <section class="section course">
            <div class="row card-group">

                <div class=" col-xl-5 card">
                    <div class="card-body course-card pt-4 d-flex flex-column align-items-center ">
                        <div class="main_image">
                            <img src="{{asset('storage/images/courses/'.$course->photo)}}"
                                 id="main_course_image" width="350">
                        </div>
                        <div class="thumbnail_images">
                            <ul id="thumbnail">
                                <li>
                                    <img onclick="changeImage(this)"
                                         src="{{asset('storage/images/courses/'.$course->photo)}}" width="70">
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div class=" col-xl-7 card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#course-overview">
                                    {{__('messages.Overview')}}
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-edit">
                                    {{__('messages.Edit Course')}}
                                </button>
                            </li>

                            <li class="nav-item  ">
                                <form action="{{route('courses.destroy',[$course->id])}}" method="post"
                                      class=" d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger ">
                                        {{__('messages.Delete Course')}} <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active course-overview" id="course-overview">
                                <div class="row">
                                    <div class="col-5 "><h6> {{__('messages.ID')}}</h6></div>
                                    <div class="col-7"><p>{{$course->id}}</p></div>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="row">
                                    <div class="col-5 "><h6>{{__('messages.Arabic Name')}}</h6></div>
                                    <div class="col-7"><p>{{$course->name_ar}}</p></div>
                                </div>
                                <hr class="dropdown-divider">
                                <div class="row">
                                    <div class="col-5 "><h6>{{__('messages.English Name')}}</h6></div>
                                    <div class="col-7"><p>{{$course->name_en}}</p></div>
                                </div>
                                <hr class="dropdown-divider">

                                @if($course->description_ar)
                                    <div class="row">
                                        <div class="col-5 label ">
                                            <h6>{{__('messages.Arabic Description')}}</h6>
                                        </div>
                                        <div class="col-7"><p>{{$course->description_ar}}</p></div>
                                    </div>
                                    <hr class="dropdown-divider">
                                @endif
                                @if($course->description_en)
                                    <div class="row">
                                        <div class="col-5  label ">
                                            <h6>{{__('messages.English Description')}}</h6>
                                        </div>
                                        <div class="col-7"><p>{{$course->description_en}}</p></div>
                                    </div>
                                @endif
                                <hr class="dropdown-divider">
                            </div>

                            <div class="tab-pane fade course-edit pt-3" id="course-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{route('courses.update',[$course->id])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input hidden type="text" name="trainer_id" value=" {{ Auth::guard('trainer')->id()}} ">

                                    <div class="row mb-3">
                                        <label for="inputText"
                                               class="col-sm-4 col-form-label">{{__('messages.Arabic Name')}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name_ar"
                                                   value="{{$course->name_ar}}">
                                        </div>
                                        <label for="inputText"
                                               class="col-sm-4 col-form-label">{{__('messages.English Name')}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name_en"
                                                   value="{{$course->name_en}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword"
                                               class="col-sm-4 col-form-label">{{__('messages.Arabic Description')}}</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" style="height: 100px" name="description_ar"
                                                      placeholder="{{__('messages.Here can be your course description in Arabic')}}">{{($course->description_ar)?$course->description_ar:null}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputPassword"
                                               class="col-sm-4 col-form-label">{{__('messages.English Description')}}</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" style="height: 100px" name="description_en"
                                                      placeholder="{{__('messages.Here can be your course description in English')}}">{{($course->description_en)?$course->description_en:null}}</textarea>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="inputNumber"
                                               class="col-sm-4 col-form-label">{{__('messages.Picture')}}</label>
                                        <div class="col-sm-8 ">
                                            <input class="form-control" type="file" name="photo" id="formFile">
                                            <img src="{{asset('storage/images/courses/'.$course->photo)}}"
                                                 style="width:100px; height:100px;" alt="..." class="rounded ">
                                        </div>
                                    </div>



                                    <div class="row mb-3 justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success col-4">{{__('messages.Edit Course')}} <i
                                                class="fa-solid fa-pen-to-square"></i></button>
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
