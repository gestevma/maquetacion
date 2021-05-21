@extends('admin.layout.master')

@section('content')

    @include('admin.components.header')

    @include('admin.components.sidebar')

    @if($agent->isMobile())
        @include('admin.components.alert')
    @endif

    @include('admin.components.message')

    {{-- @include('admin.components.wait') --}}

    <div class="content" id="content">

        <div class="title">
            @include('admin.components.title')    
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
        @include('admin.components.bottombar')
    @endif
@endsection