@extends('layouts.app')
@section('title', 'Tiểu Thuyết - ' . \App\Option::getvalue('sitename'))
@section('seo')
    <meta name="description" content="{{\App\Option::getvalue('description')}}" />
    <meta name="keywords" content="{{\App\Option::getvalue('keyword')}}" />
    <meta name='ROBOTS' content='INDEX, FOLLOW' />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://tieuthuyet.vn/" />
    <meta property="og:site_name" content="Trang Chủ" />
    <meta property="og:title" content="Tiểu Thuyết -  {{\App\Option::getvalue('sitename')}}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:description" content="{{\App\Option::getvalue('description')}}" />
    <meta property="og:image" content="https://tieuthuyet.vn/assets/css/img/logo200x200.png" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@TanVo1999" />
    <meta name="twitter:title" content="Tiểu Thuyết -  {{\App\Option::getvalue('sitename')}}" />
    <meta name="twitter:description" content="{{\App\Option::getvalue('description')}}" />
    <meta name="twitter:image" content="https://tieuthuyet.vn/assets/css/img/logo200x200.png" />
    <link rel="canonical" href="https://tieuthuyet.vn/" />
    <link href="https://tieuthuyet.vn/" hreflang="vi-vn" rel="alternate" />
    <link data-page-subject="true" href="https://tieuthuyet.vn/assets/css/img/logo200x200.png" rel="image_src" />
    <script type="application/ld+json"> 
    { 
        "@context":"https://schema.org", 
        "@type":"WebSite", 
        "name":"Tiểu Thuyết - {{\App\Option::getvalue('sitename')}}", 
        "alternateName":"Tiểu Thuyết - {{\App\Option::getvalue('sitename')}}", 
        "url":"https://tieuthuyet.vn/",
        "description" : "{{\App\Option::getvalue('description')}}",
        "sameAs": [
            "https://www.facebook.com/www.phimtruyen.vn",
            "https://www.instagram.com/tanvo1999/",
            "https://www.linkedin.com/in/minh-tan-vo-a402ba196/",
            "https://twitter.com/TanVo1999"
        ]
    } 
    </script>
    <!-- <script>    (function(c,l,a,r,i,t,y){        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);    })(window, document, "clarity", "script", "5wakjtiaor");</script> -->
@endsection
@section('breadcrumb', showBreadcrumb())
@section('content')
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=764582287768925&autoLogAppEvents=1" nonce="GTeFt4c7"></script> -->
    <div class="container visible-md-block visible-lg-block" id="intro-index">
        <div class="title-list">
            <h2><a href="{{route('danhsach.truyenhot')}}" title="Truyện hot">Truyện hot <span class="glyphicon glyphicon-fire"></span></a></h2>
            <select id="hot-select" class="form-control new-select">
                <option value="all">Tất cả</option>
                {{ category_parent(\App\Category::get()) }}
            </select>
        </div>
        <div class="index-intro">
            {!! \App\Story::getListHotStories() !!}
        </div>
        {!! \App\Story::getListAudioStories() !!}
    </div>
    <div class="ads container">
        @include('widgets.asd_ngang')
    </div>
    <div class="container" id="list-index">
      @include('partials.reading')
        <div class="list list-truyen list-new col-xs-12 col-sm-12 col-md-8 col-truyen-main">
            <div class="title-list">
                <h2><a href="{{route('danhsach.truyenmoi')}}" title="Truyện mới">Truyện mới cập nhật <span class="glyphicon glyphicon-menu-right"></span></a></h2>
                <select id="new-select" class="form-control new-select">
                    <option value="all">Tất cả</option>
                    {{ category_parent(\App\Category::get()) }}
                </select>
            </div>
                {!!  \App\Story::getListNewStories()  !!}
        </div>

        {{--Sidebar--}}
        <div class="visible-md-block visible-lg-block col-md-4 text-center col-truyen-side">
            @include('widgets.categories')
            {{--@include('widgets.facebook')--}}
            <div class="list-truyen list-cat col-xs-12">
                @include('widgets.ads')
            </div>
        </div>
    </div>

    {!!  \App\Story::getListDoneStories()  !!}
@endsection
