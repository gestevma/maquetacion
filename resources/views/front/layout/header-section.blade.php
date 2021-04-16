@extends('front.layout.master')

@section('main')

    @include('front.layout.partials.header')
    @include('front.layout.partials.sidebar')

    <div class="content">
        @include('front.layout.partials.title')
        @yield('section')
    </div>
@endsection