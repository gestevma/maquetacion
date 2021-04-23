@extends('admin.layout.master')

@section('content')

    @include('admin.layout.partials.header')

    @include('admin.layout.partials.sidebar')

    @if($agent->isMobile())
        @include('admin.layout.partials.alert')
    @endif

    <div class="content" id="content">

        <div class="title">
            @include('admin.layout.partials.title')    
        </div>

        <div class="content-section">

            <div class="table" id="table">
                @yield('table')
            </div>

            <div class="form" id="form">
                @yield('form')
            </div>   
        </div>
    </div>

    @if($agent->isMobile())
        @include('admin.layout.partials.bottombar')
    @endif
@endsection