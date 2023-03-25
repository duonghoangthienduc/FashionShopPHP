@extends('admin.index')
@section('content')
    <div class="wrapper">
        @include('admin.adside.adside')
        @include('admin.navbar.navbar')
        <div class="content-wrapper">
            <x-alert></x-alert>
            <x-contentHeader></x-contentHeader>
            <section class="content">
                <div class="container-fluid">
                    @yield('job')
                </div>
            </section>
        </div>
    </div>
@endsection
