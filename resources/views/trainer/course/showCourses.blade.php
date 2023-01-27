@extends('layouts.trainerApp')


@section('content')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>courses</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/trainer/home">{{__('messages.Home')}}</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('courses.indexTrainer')}}">{{__('messages.Courses')}}</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @include('includes.flashmessage')


        <section class="section">
            <div class="row">

                <div class="col-lg-12">


                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-outline-primary m-2" href="{{route('courses.create')}}">{{__('messages.New Course')}} <i class="fa-sharp fa-solid fa-plus"></i> </a>
                            <!-- Table with hoverable rows -->
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{__('messages.ID')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Picture')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Description')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $course)
                                    <tr >
                                        <th scope="row" class="text-center align-middle">{{$course->id}}</th>
                                        <td  class="text-center align-middle"><img src="{{asset('storage/images/courses/'.$course->photo)}}" style="width:100px; height:100px;" alt="..." class="rounded "></td>
                                        <td class="text-center align-middle">{{$course->name}}</td>
                                        <td class="text-center align-middle">{{$course->description}}</td>
                                        <td class="text-center align-middle">
                                            <a class="btn btn-success " href="{{route('courses.showTrainer',[$course->id])}}"><i class="fa-solid fa-eye"></i> </a>
                                            <a class="btn btn-success " href="{{route('courses.edit',[$course->id])}}"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                            <form action="{{route('courses.destroy',[$course->id])}}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button  type="submit" class="btn btn-danger " > <i class="fa-solid fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>

                </div>

                <ul class="pagination justify-content-center">{{$courses->links()}}</ul>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
