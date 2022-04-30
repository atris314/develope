@extends('front.index')
@section('meta')
    <meta content="" name="description">
    <meta content="" name="keywords">
    @endsection
@section('content')
    <div class="container-fluid macbook">
        <div class="row">
            <div class="col-lg-2 fixed">
                <div class="portfolio-logo-name"><a href="{{route('home')}}">{{$settings->sitename}}</a></div>
                <div class="portfolio-linehr"></div>
            </div>
            <div class="col-lg-2 fixed">
                <div class="vertical-content-portfolio">{{$headers->content}}</div>
                <div class="linehr-portfolio"></div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="header-portfolio"><img src="{{$portfolio->photos->pluck('path')->first()}}"></div>
                </div>
            </div>
            <div class="underline-portfolio-header"></div>
            <div class="back-home"><a href="{{route('home')}}"> Back</a> <div class="back-arrow"><div class="back-arrow-rotate"></div></div></div>
            <div class="row">
                <div class="portfolio-title-page">{{$portfolio->title}}</div>
                <div class="portfolio-body">{!! $portfolio->description !!}</div>
            </div>
            <div class="row">
                <div class="portfolio-gmail">{{$contacts->gmail}}</div>
                <div class="social-media">
                    <div class="portfolio-social-media-link"><a target="_blank" href="{{$contacts->linkedin}}">Linked in&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></div>
                    <div class="portfolio-social-media-link"><a target="_blank" href="{{$contacts->behance}}">Behance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></div>
                    <div class="portfolio-social-media-link"><a target="_blank" href="{{$contacts->instagram}}">Instagram</a></div>
                </div>
                <div class="portfolio-download-btn"><a href="{{$contacts->photo->path}}" target="_blank"><div class="download-btn-text">Download my CV <div class="contact-arrow"><div class="contact-arrow-rotate"></div></div></div></a></div>
            </div>
            <div class="portfolio-line-under-contact"></div>
            <div class="row">
                <div class="portfolio-copyright-text">{{$settings->copyright}}</div>
            </div>
        </div>
    </div>
@endsection
