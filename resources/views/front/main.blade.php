@extends('front.index')
@section('meta')
    <meta content="" name="description">
    <meta content="" name="keywords">
    @endsection
@section('content')
    <div class="container-fluid macbook">
        <div class="row">
            <div class="col-lg-2 fixed">
                <div class="logo-name"><a href="{{route('home')}}">{{$settings->sitename}}</a></div>
                <div class="menu-item">
                    @foreach($lists as $list)
                    <div class="list-item" id="list-item-1">{{$list->title}}</div>
                    @endforeach
                    <div class="line-list-first-child"></div>
                </div>
                <div class="linehr"></div>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    @if($headers->photo_id)
                    <img class="col-lg-6 header-image" src="{{$headers->photo->path}}">
                    @endif
                    <div class="vertical-content">{{$headers->content}}</div>
                    <div class="kourosh-title" >
                        <div>{{$headers->titletop}}</div>
                        <div><span>{{$headers->title}}</span></div>
                        <div>{{$headers->titlebottom}}</div>
                    </div>

                    <div class="linehr-horizental"></div>
                </div>
                <div class="row">
                    <div class="col-lg-5 about-kourosh">
                        {!! $headers->description !!}
                    </div>
                </div>
            </div>
            <div class="line-under-header"></div>
            <div class="row">
                <div class="header-bottom-list">{!! $widgets->list !!} </div>
            </div>
            <div class="line-under-bottom-list"></div>
            <div class="row">
                <div class="works-title">
                    <div> {{$widgets->top}}</div>
                    <div><span>{{$widgets->bottom}}</span></div>
                </div>
            </div>
            <div class="row">
                @foreach($portfolios as $portfolio)
                <div class="project-works">
                    <div class="project-title">{{$portfolio->title}} <a href="{{route('portfolio-detail',$portfolio->id)}}"><div class="project-arrow"><div class="project-arrow-rotate"></div></div></a></div>
                    <div class="project-body">
                        {!! mb_substr($portfolio->description,0,100).'...'!!}
                    </div>
                    <div class="project-image-vertical">
                        @if($portfolio->photos->pluck('path')->first())
                            <img class="project-image-vertical" src="{{$portfolio->photos->pluck('path')->first()}}">
                        @endif
                    </div>
                    <div class="project-image">
                        @if($portfolio->photos->pluck('path')->last())
                        <img class="project-image" src="{{$portfolio->photos->pluck('path')->last()}}">
                        @endif
                    </div>
                    <div class="project-date-vertical">2022-1-25</div>
                </div>
                @endforeach
                </div>
            </div>
            <div class="row">
                <div class="contact-title">
                    {!! $contacts->title !!}
                </div>
                <div class="gmail">{{$contacts->gmail}}</div>
                <div class="social-media">
                    <div class="social-media-link"><a target="_blank" href="{{$contacts->linkedin}}">Linked in&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></div>
                    <div class="social-media-link"><a target="_blank" href="{{$contacts->behance}}">Behance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></div>
                    <div class="social-media-link"><a target="_blank" href="{{$contacts->instagram}}">Instagram</a></div>
                </div>
                <div class="download-btn"><a href="{{$contacts->photo->path}}" target="_blank"><div class="download-btn-text">Download my CV <div class="contact-arrow"><div class="contact-arrow-rotate"></div></div></div></a></div>
            </div>
            <div class="line-under-contact"></div>
            <div class="row">
                <div class="copyright-text">{{$settings->copyright}}</div>
            </div>
        </div>
    </div>
@endsection
