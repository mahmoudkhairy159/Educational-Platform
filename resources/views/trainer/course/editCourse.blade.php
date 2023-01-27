@extends('layouts.trainerApp')
@section('content')



    < class="content">
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('messages.Edit Course')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item">{{__('messages.Courses')}}</li>
                    <li class="breadcrumb-item "><a href="{{route('courses.indexTrainer')}}">{{__('messages.Courses')}}</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('courses.edit',[$course->id])}}">{{__('messages.Edit Course')}}</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('messages.The Course Will Be Edited By')}} {{ Auth::guard('trainer')->user()->name}}</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{route('courses.update',[$course->id])}}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input hidden type="text" name="trainer_id" value=" {{ Auth::guard('trainer')->id()}} ">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.Arabic Name')}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="name_ar" value="{{$course->name_ar}}">
                                    </div>
                                    <label for="inputText" class="col-sm-2 col-form-label">{{__('messages.English Name')}}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="name_en" value="{{$course->name_en}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.English Description')}}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px"  name="description_en" placeholder="{{__('messages.Here can be your course description in English')}}" >{{($course->description_en)?$course->description_en:null}}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.Arabic Description')}}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px"  name="description_ar" placeholder="{{__('messages.Here can be your course description in Arabic')}}" >{{($course->description_ar)?$course->description_ar:null}}</textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Main Picture')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="photo"  id="formFile">
                                        <img src="{{asset('storage/images/courses/'.$course->photo)}}" style="width:100px; height:100px;" alt="..." class="rounded ">
                                    </div>
                                </div>



                                <div class="row mb-3 justify-content-center">
                                    <button type="submit" class="btn btn-success col-4">{{__('messages.Edit Course')}} <i class="fa-solid fa-pen-to-square"></i></button>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main>
@endsection
