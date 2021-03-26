@extends('admin.layout.master')

@section('content')

    <div class="table" id="table">
        @yield('table')
    </div>

    <div class="form">
        @yield('form')
    </div>
   

@endsection