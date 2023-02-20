<!-- Header -->
<!-- ======= Header ======= -->
<header id="header" class="header row fixed-top d-flex align-items-center">

    <div class=" col-2 align-items-center ">
        <a href="/" class="logo d-flex align-items-center justify-content-center">
            <span class="d-none d-lg-block"><em>Online</em> School</span>
        </a>
    </div><!-- End Logo -->


    <nav class="header-nav col-10 ms-auto fs-6 fw-bolder ">
        <ul class="d-flex align-items-center justify-content-end">
            <li class="nav-item ">
                <a class="link-dark pe-4 " href="/home ">{{__('messages.Home')}}</a>
            </li>
            <li class="nav-item ">
                <a class="link-dark pe-4" href="{{ route('about') }} ">{{ __('messages.About')}}</a>
            </li>
            <li class="nav-item ">
                <a class="link-dark pe-4" href="{{route('courses.index')}}">{{__('messages.Courses')}}</a>
            </li>
           
            <li class="nav-item ">
                <a class="link-dark pe-4" href="{{route('courses.indexStudentCourses')}}">{{__('messages.My Courses')}}</a>
            </li>
            <li class="nav-item ">
                <a class="link-dark pe-4" href="{{route('trainers.index')}}">{{__('messages.Trainers')}}</a>
            </li>
            <li class="nav-item ">
                <a class="link-dark pe-4" href="/home ">{{__('messages.Events')}}</a>
            </li>
            <li class="nav-item ">
                <a class="link-dark pe-4" href="/home ">{{__('messages.Pricing')}}</a>
            </li>

            <li><a href="contact.html"  class="link-dark pe-4">{{__('messages.Contact')}}</a></li>





            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="nav-item">
                <a rel="alternate" class="nav-link pe-3" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
            @endforeach

            @if (Route::has('login'))
            @guest
            <li class="nav-item">

                <a href="{{ route('login') }}" class="nav-link">Login</a>
            </li>

            @if (Route::has('register'))
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            </li>
            @endif
            @endguest
            @endif


            @auth('web')
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::guard('web')->user()->name}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6> {{ Auth::guard('web')->user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('users.show',Auth::id())}}">
                            <i class="bi bi-person"></i>
                            <span>{{__('messages.Profile')}}</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('messages.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
            @endauth
        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->