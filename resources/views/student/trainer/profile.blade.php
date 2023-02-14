@extends('layouts.app')


@section('content')

        <section class="section profile">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">


                            <img
                                src="{{$trainerProfile->photo?asset('storage/images/trainers/'.$trainerProfile->photo) : asset('storage/images/defaultProfileImage.png')}}"
                                alt="Profile" class="rounded-circle">
                            <h2>{{$trainer->name}}</h2>
                            <h3> {{$trainerProfile->job?$trainerProfile->job:null}}</h3>
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
                                        <div class="col-lg-9 col-md-8">{{$trainer->name}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.E-Mail')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$trainer->email}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.Phone')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$trainer->phone}}</div>
                                    </div>



                                    @if($trainerProfile->governorate)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{__('messages.Governorate')}}</div>
                                            <div class="col-lg-9 col-md-8">{{$trainerProfile->governorate}}</div>
                                        </div>
                                    @endif
                                    @if($trainerProfile->city)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{__('messages.City')}}</div>
                                            <div class="col-lg-9 col-md-8">{{$trainerProfile->city}}</div>
                                        </div>
                                    @endif

                                    @if($trainerProfile->description_ar)
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-4 label">{{__('messages.Arabic Description')}}</div>
                                            <div class="col-lg-9 col-md-8">{{$trainerProfile->description_ar}}</div>
                                        </div>
                                    @endif
                                    @if($trainerProfile->description_en)
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-4 label">{{__('messages.English Description')}}</div>
                                            <div class="col-lg-9 col-md-8">{{$trainerProfile->description_en}}</div>
                                        </div>
                                    @endif
                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
