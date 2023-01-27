@extends('layouts.trainerApp')


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/trainer/home">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('messages.Profile')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @include('includes.flashmessage')

        <section class="section profile">
            <div class="row">
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

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">{{__('messages.Overview')}}</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">{{__('messages.Edit Profile')}}</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">{{__('messages.Change Password')}}</button>
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

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">{{__('messages.Address')}}</div>
                                        <div class="col-lg-9 col-md-8">{{$trainer->address}}</div>
                                    </div>
                                    @if($trainerProfile->gender)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{__('messages.Gender')}}</div>
                                            <div class="col-lg-9 col-md-8">{{$trainerProfile->gender}}</div>
                                        </div>
                                    @endif
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
                                    @if($trainerProfile->nationalId)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{__('messages.National Id')}}</div>
                                            <div class="col-lg-9 col-md-8">{{$trainerProfile->nationalId}}</div>
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

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="{{route('trainers.update',Auth::id())}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="fullName"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.Name')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="fullName"
                                                       value="{{$trainer->name}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.Address')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address"
                                                       value="{{$trainer->address}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.Phone')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="company"
                                                       value="{{$trainer->phone}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="company"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.National Id')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nationalId" type="text" class="form-control"
                                                       value="{{$trainerProfile->nationalId?$trainerProfile->nationalId:null}}"
                                                       placeholder="{{__('messages.Enter your National Id')}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="company"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.Job')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control"
                                                       value="{{$trainerProfile->job?$trainerProfile->job:null}}"
                                                       placeholder="{{__('messages.Enter Your Job ')}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="company"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.Profile Picture')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="file" id="myFile" name="photo">
                                            </div>
                                        </div>


                                        <div class="row mb-3 g-3">
                                            <label class="-form-label col-sm-4 pt-0">{{__('messages.gender')}}</label>
                                            <div class="col-sm-8">
                                                <div class="d-inline p-5">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                           id="gridRadios1" value="0" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="d-inline py-5">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                           id="gridRadios2" value="1">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 g-3">
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" id="inputCity"
                                                       value="{{$trainerProfile->city?$trainerProfile->city:null}}"
                                                       placeholder="{{__('mesaages.Enter Your City')}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputState" class="form-label">governorate</label>
                                                <select id="inputState" name="governorate" class="form-select">
                                                    <option value="Al Qahirah" selected>Al Qahirah</option>
                                                    <option value="Ad Daqahliyah">Ad Daqahliyah</option>
                                                    <option value="Al Bahr al Ahmar">Al Bahr al Ahmar</option>
                                                    <option value="Al Buhayrah">Al Buhayrah</option>
                                                    <option value="Al Fayyum">Al Fayyum</option>
                                                    <option value="Al Gharbiyah">Al Gharbiyah</option>
                                                    <option value="Al Iskandariyah">Al Iskandariyah</option>
                                                    <option value="Al Isma'iliyah">Al Isma'iliyah</option>
                                                    <option value="Al Jizah">Al Jizah</option>
                                                    <option value="Al Minufiyah">Al Minufiyah</option>
                                                    <option value="Al Minya">Al Minya</option>
                                                    <option value="Al Qalyubiyah">Al Qalyubiyah</option>
                                                    <option value="Al Wadi al Jadid">Al Wadi al Jadid</option>
                                                    <option value="Ash Sharqiyah">Ash Sharqiyah</option>
                                                    <option value="As Suways">As Suways</option>
                                                    <option value="Aswan">Aswan</option>
                                                    <option value="Asyut">Asyut</option>
                                                    <option value="Bani Suwayf">Bani Suwayf</option>
                                                    <option value="Bur Sa'id">Bur Sa'id</option>
                                                    <option value="Dumyat">Dumyat</option>
                                                    <option value="Janub Sina'">Janub Sina'</option>
                                                    <option value="Kafr ash Shaykh">Kafr ash Shaykh</option>
                                                    <option value="Matruh">Matruh</option>
                                                    <option value="Qina">Qina</option>
                                                    <option value="Shamal Sina'">Shamal Sina'</option>
                                                    <option value="Suhaj">Suhaj</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3 g-3">
                                            <label for="inputPassword"
                                                   class="col-sm-5 col-form-label">{{__('messages.Arabic Description')}}</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" name="description_ar"
                                                          style="height: 100px"
                                                          placeholder="{{__('messages.Enter Your Arabic Description')}}">{{$trainerProfile->description_ar?$trainerProfile->description_ar:null}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3 g-3">
                                            <label for="inputPassword"
                                                   class="col-sm-5 col-form-label">{{__('messages.English Description')}}</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" name="description_en"
                                                          style="height: 100px"
                                                          placeholder="{{__('messages.Enter Your English Description')}}">{{$trainerProfile->description_en?$trainerProfile->description_en:null}}</textarea>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-primary">{{__('messages.Save Changes')}}</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>


                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{route('trainers.changePassword',Auth::id())}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.Current Password')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="currentPassword" type="password" class="form-control"
                                                       id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.New Password')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newPassword" type="password" class="form-control"
                                                       id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword"
                                                   class="col-md-4 col-lg-3 col-form-label">{{__('messages.Re-enter New Password')}}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewPassword" type="password" class="form-control"
                                                       id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-primary">{{__('messages.Change Password')}}</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
