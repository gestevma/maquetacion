@extends('front.layout.header-section')

@section('title')@lang('front/seo.web-name') | {{$book->seo->title}} @stop
@section('description'){{$book->seo->description != null? $book->seo->description : $book->seo->locale_seo->description}} @stop
@section('keywords'){{$book->seo->keywords != null ? $book->seo->keywords : $book->seo->locale_seo->keywords}} @stop
@section('facebook-url'){{URL::asset('/books/' . $book->seo->slug)}} @stop
@section('facebook-title'){{$book->seo->title}} @stop
@section('facebook-description'){{$book->seo->description != null ? $book->seo->description : $book->seo->locale_seo->description}} @stop

@section("section")
    @if($agent->isDesktop())
        <div class="page-section">
            @include("front.books.desktop.book")
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section">
            @include("front.books.mobile.book")
        </div>
    @endif
@endsection
        