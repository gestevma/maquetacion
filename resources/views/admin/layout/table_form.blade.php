@extends('admin.layout.master')

@section('content')

    @include('admin.layout.partials.components.header')

    @include('admin.layout.partials.components.sidebar')

    @if($agent->isMobile())
        @include('admin.layout.partials.components.alert')
    @endif

    @include('admin.layout.partials.components.message')

    @include('admin.layout.partials.components.spinner')

    <div class="content" id="content">

        <div class="title">
            @include('admin.layout.partials.components.title')    
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
        @include('admin.layout.partials.components.bottombar')
    @endif
@endsection