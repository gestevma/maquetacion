@extends('front.layout.master')

@section('main')

    @include('front.layout.partials.header')
    @include('front.layout.partials.sidebar')

    <div class="content">
        <div class="title">
            @include('front.layout.partials.title')
        </div>
        
        @yield('section')
    </div>
@endsection