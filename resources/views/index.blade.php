<!DOCTYPE html>
<html lang="en">

<head>
    @include('head')
</head>

<body>
    @include('header')
    @include('public.navbarView.navbar')
    <x-alert></x-alert>
    @yield('content')
    @include('footer')
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    @include('foot')
</body>

</html>
