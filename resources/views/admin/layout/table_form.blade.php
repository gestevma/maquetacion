@extends('admin.layout.master')

@section('content')

    @include('admin.layout.partials.header')

    @include('admin.layout.partials.sidebar')

    <div class="content" id="content">

        <div class="title">
            @include('admin.layout.partials.title')    
        </div>

        <div class="content-section">

            @if($agent->isDesktop())

                <div class="table" id="table">
                    @yield('table')
                </div>

                <div class="form" id="form">
                    @yield('form')
                </div>   
            @endif


            @if($agent->isMobile())
                <div class="form" id="form">
                    @yield('form')
                </div>

                <div class="table" id="table">
                    @yield('table')
                </div>
            @endif

        </div>
    </div>
@endsection