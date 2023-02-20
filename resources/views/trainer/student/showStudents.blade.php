@extends('layouts.trainerApp')


@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/trainer/home">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('users.index')}}">{{__('messages.Students')}}</a>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('includes.flashmessage')


    <section class="section">
        <div class="row">

            <div class="col-lg-12">


                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-outline-primary m-2" href="{{--route('users.create'--}}">{{__('messages.New
                            Student')}} <i class="fa-sharp fa-solid fa-plus"></i> </a>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{__('messages.ID')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Picture')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.phone')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.nationalId')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Actions')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <div class="container row justify-content-center ">
                                    <h1 class=" col-auto"> {{ $course->name_en}}</h1>
                                </div>
                                @foreach($course->users as $user)


                                <tr>
                                    <th scope="row" class="text-center align-middle">{{$user->id}}</th>
                                    <td class="text-center align-middle"><img
                                            src="{{$user->userProfile->photo?asset('storage/images/users/'.$user->userProfile->photo):asset('storage/images/defaultProfileImage.png')}}"
                                            style="width:100px; height:100px;" alt="..." class="rounded "></td>
                                    <td class="text-center align-middle">{{$user->name}}</td>
                                    <td class="text-center align-middle">{{$user->phone}}</td>
                                    <td class="text-center align-middle">
                                        {{$user->userProfile->nationalId?$user->userProfile->nationalId:'______'}}</td>

                                    <td class="text-center align-middle">
                                        <a class="btn btn-success "
                                            href="{{route('users.showUserForTrainer',['courseId'=>$course->id,'userId'=>$user->id])}}"><i
                                                class="fa-solid fa-eye"></i> </a>
                                        <a class="btn btn-success " href="{{-- route('users.edit',[$user->id]) --}}"> <i
                                                class="fa-solid fa-pen-to-square"></i> </a>
                                        <form action="{{route('users.removeUserFromCourse',[ 'courseId'=>$course->id,'userId'=>$user->id]) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger "> <i
                                                    class="fa-solid fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                    </div>
                </div>

            </div>

        </div>
    </section>

</main><!-- End #main -->

@endsection