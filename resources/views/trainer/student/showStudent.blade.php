@extends('layouts.trainerApp')


@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/trainer/home">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item "><a href="{{route('courses.indexTrainer')}}">{{__('messages.Courses')}}</a>
                </li>
                <li class="breadcrumb-item active"><a
                        href="{{route('courses.showTrainer',$course->id)}}">{{__('messages.View Course')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('courses.showCourseStudents',$course->id) }}">{{__('messages.Students')}}</a>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('includes.flashmessage')


    <section class="section profile ">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">


                        <img
                            src="{{$userProfile->photo?asset('storage/images/users/'.$userProfile->photo) : asset('storage/images/defaultProfileImage.png')}}"
                            alt="Profile" class="rounded-circle">
                        <h2>{{$user->name}}</h2>
                        {{--<h3> {{$userProfile->job?$userProfile->job:null}}</h3>--}}
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-7">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">{{__('messages.Overview')}}</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">{{__('messages.Profile Information')}}</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{__('messages.Name')}}</div>
                                    <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('messages.E-Mail')}}</div>
                                    <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('messages.Phone')}}</div>
                                    <div class="col-lg-9 col-md-8">{{$user->phone}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('messages.Address')}}</div>
                                    <div class="col-lg-9 col-md-8">{{$user->address}}</div>
                                </div>

                                @if($userProfile->gender)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.Gender')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$userProfile->gender}}</div>
                                    </div>
                                @endif
                                @if($userProfile->governorate)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.Governorate')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$userProfile->governorate}}</div>
                                    </div>
                                @endif
                                @if($userProfile->city)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.City')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$userProfile->city}}</div>
                                    </div>
                                @endif

                            </div>

                           

                          

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

@endsection
