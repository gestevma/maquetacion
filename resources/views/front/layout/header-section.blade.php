@extends('front.layout.master')

@section('main')

    <div class="top">
        @include("front.layout.partials.top-bar")
        @include('front.layout.partials.header')
    </div>
    @include('front.layout.partials.sidebar')

    <div class="content" id = "content">
        @yield('content')
    </div>

    @include("front.layout.partials.footer")
    @include("front.layout.partials.bottom-bar")
@endsection