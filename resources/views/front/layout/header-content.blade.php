@extends('front.layout.master')

@section('content')

    @include('front.layout.partials.header')

    <div class="login">
        @yield('login')
    </div>
@endsection