

    <main id="main" class="main pt-1 mt-1">



        <section class="section">
            <div class="pagetitle pb-3">
                <h1>Lessons</h1>
            </div><!-- End Page Title -->
            <div class="row">

                <div class="col-lg-12">


                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-outline-primary m-2" href="{{route('lessons.create',$course->id)}}">{{__('messages.New Lesson')}} <i class="fa-sharp fa-solid fa-plus"></i> </a>
                            <!-- Table with hoverable rows -->
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">{{__('messages.ID')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.English Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Arabic Name')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Material')}}</th>
                                    <th scope="col" class="text-center">{{__('messages.Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($course->lessons as $lesson)
                                    <tr >
                                        <th scope="row" class="text-center align-middle">{{$lesson->id}}</th>
                                        <td class="text-center align-middle">{{$lesson->name_en}}</td>
                                        <td class="text-center align-middle">{{$lesson->name_ar}}</td>
                                        <td  class="text-center align-middle"><a href="{{asset('storage/images/lessons/'.$lesson->material)}}"  class="rounded " download>Download <i class="fa-solid fa-download"></i></a></td>
                                        <td class="text-center align-middle">
                                            <a class="btn btn-success " href="{{route('lessons.showTrainer',[$lesson->id])}}"><i class="fa-solid fa-eye"></i> </a>
                                            <a class="btn btn-success " href="{{route('lessons.edit',[$lesson->id])}}"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                            <form action="{{route('lessons.destroy',[$lesson->id])}}" method="post" class="d-inline">
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






              {{--  <ul class="pagination justify-content-center">{{$course->lessons->links()}}</ul> --}}
            </div>
        </section>

    </main><!-- End #main -->

