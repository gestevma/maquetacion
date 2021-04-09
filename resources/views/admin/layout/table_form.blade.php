@extends('admin.layout.master')

@section('content')

    @include('admin.layout.partials.header')

    @include('admin.layout.partials.slider')

    <div class="content" id="content">

        <div class="title">
            @yield('title')    
        </div>

        <div class="section-content">

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