@extends('layouts.app')
@section('title', $data['title'] . ' | TieuThuyet.VN')
@section('seo')
    <meta name="description" content="{{$data['description']}}">
    <meta name="keywords" content="{{$data['keyword']}}">
    <meta name='ROBOTS' content='INDEX, FOLLOW'/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{$data['alias']}}">
    <meta property="og:site_name" content="{{$data['title']}}">
    <meta property="og:title" content="{{$data['title']}}">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:description" content="{{$data['description']}}">
    <link href="{{$data['alias']}}" hreflang="vi-vn" rel="alternate" />
    <link rel="canonical" href="{{$data['alias']}}"/>
    <script type="application/ld+json"> 
    { 
        "@context":"https://schema.org", 
        "@type":"WebSite", 
        "name":"{{$data['title']}}", 
        "alternateName":"{{$data['title']}}", 
        "url":"{{$data['alias']}}",
        "description":"{{$data['description']}}",
        "sameAs": [
            "https://www.facebook.com/www.phimtruyen.vn",
            "https://www.instagram.com/tanvo1999/",
            "https://www.linkedin.com/in/minh-tan-vo-a402ba196/",
            "https://twitter.com/TanVo1999"
        ]
    } 
    </script>
@endsection

@section('breadcrumb', showBreadcrumb($breadcrumb))
@section('content')
{{--@include('widgets.asd_ngang')--}}
    <div class="container" id="list-page">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="list list-truyen col-xs-12">
                <div class="title-list">
                    <h2>{{ $data['title']  }}</h2>

                    @if($data['alias'] != route('danhsach.truyenfull'))
                        <div class="filter"><a href="?filter=full">Chỉ hiện truyện đã hoàn (full)</a></div>
                    @endif
                </div>
                @foreach( $data['stories'] as $story)
                    <div class="row" itemscope="" itemtype="http://schema.org/Book">
                        <div class="col-xs-3">
                            <div>
                                <img itemprop="image" class="visible-sm-block visible-md-block visible-lg-block" src="{{ url(dqhImageThumb($story->image, true)) }}" alt="{{ $story->name  }}">
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div>
                                <span class="glyphicon glyphicon-book"></span>
                                <h3 class="truyen-title" itemprop="name">
                                    <a href="{{ route('story.show', $story->alias) }}" itemprop="url" title="{{ $story->name  }}">{{ $story->name  }}</a>
                                </h3>
                                @if($story->status == 1)
                                    <span class="label-title label-full"></span>
                                @endif
                                @if((strtotime('now') - strtotime($story->created_at)) < 86400*2)
                                    <span class="label-title label-new"></span>
                                @endif
                                @if($story->view >=1000)
                                    <span class="label-title label-hot"></span>
                                @endif
                                @foreach ($story->authors as $author)
                                    <span class="author" itemprop="author">
                                        <span class="glyphicon glyphicon-pencil"></span><a itemprop="url" href="{{route('author.list.index', $author->alias)}}">{{ $author->name  }}</a>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <?php $chapter = $story->chapters()->orderBy('id', 'DESC')->first(); ?>
                        @if($chapter)
                        <div class="col-xs-2 text-info">
                            <div>
                                <a href="{{  route('chapter.show', [$story->alias, $chapter->alias])}}" title="{{ $chapter->name  }}"><span class="chapter-text">{{ $chapter->subname  }}</span></a>
                            </div>
                        </div>
                        @else
                        ......
                        @endif
                    </div>
                @endforeach

            </div>
            <div class="container text-center pagination-container">
                <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                    {{ $data['stories']->links() }}
                </div>
            </div>
        </div>

        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            @if(isset($data['description']))
                <div class="panel cat-desc text-left visible-lg">
                    <div class="panel-body">
                       {!! nl2br($data['description']) !!}
                    </div>
                </div>
            @endif
            @include('widgets.categories')
            @include('widgets.hotstory')
           {{-- @include('widgets.ads')--}}
        </div>
    </div>
@endsection
