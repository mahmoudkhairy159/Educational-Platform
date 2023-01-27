<!doctype html>
<html lang="en">

<head>
    @include('includes.headLinks')

</head>

<body>
<div class="wrapper">
    @include('includes.trainer.trainerSidebar')

    <div class="main-panel" id="app">

        @include('includes.trainer.trainerNavbar')
            @yield('content')


        @include('includes.trainer.trainerFooter')


    </div>
</div>


</body>
@include('includes.Javascripts')


</html>
