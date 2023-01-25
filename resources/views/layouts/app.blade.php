<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.headLinks')

</head>
<body data-preloader="1">
@include('includes.student.header')
@include('includes.flashmessage')
<div class="main py-3 my-5">
@yield('content')
</div>
@include('includes.student.footer')
@include('includes.javascripts')
</body>
</html>
