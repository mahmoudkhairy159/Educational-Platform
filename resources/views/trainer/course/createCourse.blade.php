@extends('layouts.trainerApp')
@section('content')



    < class="content">
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('messages.Add New Course')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('messages.Courses')}}</li>
                    <li class="breadcrumb-item active">{{__('messages.New Course')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('messages.The Course will be added by: ')}} {{ Auth::guard('trainer')->user()->name}}</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{route('courses.store')}}" enctype="multipart/form-data">
                                @csrf
                                <input hidden type="text" name="trainer_id" value=" {{ Auth::guard('trainer')->id()}} ">

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
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.English Description')}}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px"  name="description_en" placeholder="{{__('messages.Here can be your Course description in English')}}"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.Arabic Description')}}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px"  name="description_ar" placeholder=" {{__('messages.Here can be your Course description in Arabic')}}"></textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label" >{{__('messages.Picture')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="photo" id="formFile">
                                    </div>
                                </div>




                                <div class="row mb-3 justify-content-center">
                                    <button type="submit" class="btn btn-primary col-4">{{__('messages.Add Course')}} <i class="fa-sharp fa-solid fa-plus"></i></button>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main>
@endsection
