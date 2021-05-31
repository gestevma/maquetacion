@extends('front.layout.header-section')

@section('title')@lang('front/seo.web-name') | {{$seo->title}} @stop
@section('description'){{$seo->description}} @stop
@section('keywords'){{$seo->keywords}} @stop
@section('facebook-url'){{URL::asset('/' . $seo->url)}} @stop
@section('facebook-title'){{$seo->title}} @stop
@section('facebook-description'){{$seo->description}} @stop

@section("section")
    @if($agent->isDesktop())
        <div class="page-section">
            @include("front.books.desktop.books")
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section">
            @include("front.books.mobile.books")
        </div>
    @endif
@endsection