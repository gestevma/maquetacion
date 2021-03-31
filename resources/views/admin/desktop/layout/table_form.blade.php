@extends('admin.desktop.layout.master')

@section('content')

    <div class="table" id="table">
        @yield('table')
    </div>

    <div class="form" id="form">
        @yield('form')
    </div>
   

@endsection