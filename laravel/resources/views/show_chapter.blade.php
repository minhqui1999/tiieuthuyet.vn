@extends('layouts.app')
@section('title', $story->name . ' - ' . $chapter->subname . ' :' . $chapter->name)
@section('seo')
    <meta name="description" content="{{$chapter->subname}}: {{$chapter->name}}. Nội dung: {!! substr(tanvo($chapter->content),0,230) !!}" />
    <meta name="keywords" content="{{\App\Option::getvalue('keyword')}}" />
    <meta name='ROBOTS' content='INDEX, FOLLOW' />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://tieuthuyet.vn/{{$story->alias}}/{{$chapter->alias}}" />
    <meta property="og:site_name" content="{{$chapter->subname}}: {{$chapter->name}}" />
    <meta property="og:title" content="{{$chapter->subname}}: {{$chapter->name}}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:image" content="{{ url($story->image) }}" />
    <meta property="og:description" content="{{$chapter->subname}}: {{$chapter->name}}. Nội dung: {!! substr(tanvo($chapter->content),0,230) !!}..." />
    <link rel="canonical" href="https://tieuthuyet.vn/{{$story->alias}}/{{$chapter->alias}}" />
    <link href="https://tieuthuyet.vn/{{$story->alias}}/{{$chapter->alias}}" hreflang="vi-vn" rel="alternate" />
    <link data-page-subject="true" href="{{ url($story->image) }}" rel="image_src" />
    <script type="application/ld+json"> 
    { 
        "@context":"https://schema.org", 
        "@type":"WebSite", 
        "name": "{{$chapter->subname}}: {{$chapter->name}}", 
        "alternateName": "{{$story->name}} - {{$chapter->subname}} :{{$chapter->name}}", 
        "url":"https://tieuthuyet.vn/{{$story->alias}}/{{$chapter->alias}}",
        "image" : "{{ url($story->image) }}",
        "description":"{{$chapter->subname}}: {{$chapter->name}}. Nội dung: {!! substr(tanvo($chapter->content),0,230) !!}..."
    } 
    </script>
@endsection
@section('breadcrumb', showBreadcrumb($breadcrumb))
@section('content')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=764582287768925&autoLogAppEvents=1" nonce="exk2P4NV"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if( sessionStorage.getItem("maunen") == 2)
        {
            $("body").css('background','#f1e5c5');
            $(".mau-nen").css('background','#F4F4F4');
        }
        $('#noi_dung').keypress(function(event) {
            if (event.keyCode == 13 || event.which == 13) {
                event.preventDefault();
                if(document.getElementById("noi_dung").value != '')
                {
                    binhLuan(document.getElementById("noi_dung").value);
                }
            }
        });
        function binhLuan($nd){
            $.ajax({
                type:'POST',
                url:'{{ route("xu-ly-binh-luan-chapter") }}',
                data:
                {
                _token : '<?php echo csrf_token() ?>',
                chapter_id: {{$chapter->id}},
                noi_dung: $nd
                },
                success:function(data) {
                    $(".list-comment").html(data);
                    $('#noi_dung').val("");
                },
                error:function(){
                    alert("Đăng nhập để bình luận")
                }
            });
        }

        function laydl(page)
        {
            $.ajax({
                url: '/get-comment-story-chapter?page='+page,
                method:"GET",
                data:{
                    chapter_id: {{$chapter->id}},
                    _token : '<?php echo csrf_token() ?>'
                },
                success:function(data){
                    $(".list-comment").html(data);
                }
            });
        }

        $(document).on('click','.pagination a', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            laydl(page);
        });

        $("#binhluan").click(function (){
            if(document.getElementById("noi_dung").value != '')
            {
                binhLuan(document.getElementById("noi_dung").value);
            }
        });
        $(".mau-nen").click(function (){
            if(sessionStorage.getItem("maunen") == 1)
            {
                sessionStorage.setItem("maunen", 2);
                $("body").css('background','#f1e5c5');
                $(".mau-nen").css('background','#F4F4F4');
            }
            else
            {
                $("body").css('background','#F4F4F4');
                $(".mau-nen").css('background','#f1e5c5');
                sessionStorage.setItem("maunen", 1);
            }
        });
    });
    function showfb(fb,tt) {
        var srcElement = document.getElementById(fb);
        var tieuthuyet = document.getElementById(tt);
        
        if (srcElement != null) {
            if (srcElement.style.display == "block") {
                srcElement.style.display = 'none';
                
            }
            else {
                srcElement.style.display = 'block';
                tieuthuyet.style.display = 'none';
            }
            return false;
        }
    }

    function showtt(fb,tt) {
        var srcElement = document.getElementById(fb);
        var tieuthuyet = document.getElementById(tt);
        if (tieuthuyet != null) {
            if (tieuthuyet.style.display == "block") {
                tieuthuyet.style.display = 'none';
            }
            else {
                tieuthuyet.style.display = 'block';
                srcElement.style.display = 'none';
            }
            return false;
        }
    }
</script>

    <div class="container chapter" id="chapterBody" style="margin-top: 0px;">
        <div style="float:right" class="fb-like" data-href="https://tieuthuyet.vn/" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
        <div class="row">
            <div class="col-xs-12">
                <div>
                    <button type="button" class="btn btn-responsive btn-success toggle-nav-open">
                        <span class="glyphicon glyphicon-menu-up"></span>
                    </button>
                    <button type="button" class="btn mau-nen" style="float: right;background:#f1e5c5">
                        <span class="	glyphicon glyphicon-refresh"></span><span> Màu nền</span>
                    </button>   
                </div>
                <br><br>
                <a class="truyen-title" href="{{ route('story.show', $story->alias)  }}" title="{{ $story->name }}">{{ $story->name }}</a>
                <h2>
                    <a class="chapter-title" href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" title="{{ $story->name }} - {{ $chapter->subname }}: {{ $chapter->name }}">
                        <span class="chapter-text">{{ $chapter->subname }}</span>: {{ $chapter->name }}
                    </a>
                </h2>
                <hr class="chapter-start">
                @include('partials.chapter')
                <hr class="chapter-end">
                {{--@include('widgets.asd_ngang')--}}
                <div class="chapter-content">
                    {!! ($chapter->content) !!}
                </div>

                <div class="ads container">
                    {!! \App\Option::getvalue('ads_chapter') !!}
                </div>

                <hr class="chapter-end">
                <div class="chapter-nav" id="chapter-nav-bot">
                    @include('partials.chapter')
                    <div class="text-center">
                        <button type="button" class="btn btn-warning" id="chapter_error" chapter-id="{{ $chapter->id }}"><span class="glyphicon glyphicon-exclamation-sign"></span> Báo lỗi chương</button>
                        <button type="button" class="btn btn-info" onclick="showtt('fb','tt')" id="chapter_comment" chapter-id="{{ $chapter->id }}"><span class="glyphicon glyphicon-comment"></span> Tieuthuyet.vn({{$chapter->comment_chapter->count()}})</button>
                        <button type="button" class="btn btn-info" onclick="showfb('fb','tt')" id="chapter_comment"chapter-id="{{ $chapter->id }}"><span class="glyphicon glyphicon-comment"></span> Facebook</button>
                <!--(<span class="fb-comments-count" data-href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}"></span>)-->
                    </div>
                    <div class="bg-info text-center visible-md visible-lg box-notice">Bình luận văn minh lịch sự là động lực cho tác giả. Nếu gặp chương bị lỗi hãy "Báo lỗi chương" để BQT xử lý!</div>
                    <div class="col-xs-12">
                       
                            <div id="fb" class="fb-comments" data-href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" data-width="100%" data-numposts="5" data-colorscheme="light" fb-xfbml-state="rendered" style="display:none !important"></div>
                            <div id="tt" class="form-group " style="display:none !important; text-align: left;">
                                <input style="height: 53px; width:100%" class="form-control" id="noi_dung" name="noi_dung" required placeholder="Nhập bình luận...">
                                <button id="binhluan" type="button" class="btn btn-primary">
                                    Bình luận
                                </button>
                                <div class="list-comment">
                                    @include('widgets.comment-chapter')
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
