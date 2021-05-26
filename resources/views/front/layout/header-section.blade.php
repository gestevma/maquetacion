@extends('front.layout.master')

@section('main')

    @include('front.layout.partials.header')
    @include('front.layout.partials.sidebar')

    <div class="content">
        @yield('section')
    </div>
@endsection