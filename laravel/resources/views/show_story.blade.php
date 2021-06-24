@extends('layouts.app')
@section('title', $story->name . ' | TieuThuyet.VN')
@section('seo')
    <meta name="keywords" content="{{\App\Option::getvalue('keyword')}}" />
    <meta name="description" content="{!! substr(tanvo($story->content),0,250) !!}" />
    <meta name='ROBOTS' content='INDEX, FOLLOW' />
    <meta property="og:type" content="book" />
    <meta property="og:url" content="https://tieuthuyet.vn/{{$story->alias}}" />
    <meta property="og:site_name" content="{{$story->name}}" />
    <meta property="og:title" content="{{$story->name}} | TieuThuyet.VN" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:image" content="{{ url($story->image) }}" />
    <meta property="og:description" content="{!! substr(tanvo($story->content),0,325) !!}" />
    <link rel="canonical" href="https://tieuthuyet.vn/{{$story->alias}}" />
    <link href="https://tieuthuyet.vn/{{$story->alias}}" hreflang="vi-vn" rel="alternate" />
    <link data-page-subject="true" href="{{ url($story->image) }}" rel="image_src" />
    <script type="application/ld+json"> 
    { 
        "@context":"https://schema.org", 
        "@type":"Book", 
        "name": "{{$story->name}}", 
        "alternateName": "{{$story->name}}", 
        "url":"https://tieuthuyet.vn/{{$story->alias}}",
        "image" : "{{ url($story->image) }}",
        "author": [{!! get_author($story->authors) !!}],
        "publisher": {
            "@type": "Person",
            "name": "{{$story->user->name}}"
        },
        "description": "{!! substr(tanvo($story->content),0,250) !!}",
        "about": [{!!  get_catory($story->categories) !!}]
    } 
    </script>
@endsection
@section('breadcrumb', showBreadcrumb($breadcrumb))

@section('content')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=764582287768925&autoLogAppEvents=1" nonce="QKJ7SiB8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
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
                    url:'{{ route("xu-ly-binh-luan") }}',
                    data:
                    {
                    _token : '<?php echo csrf_token() ?>',
                    story_id: {{$story->id}},
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
                    url: '/get-comment-story?page='+page,
                    method:"GET",
                    data:{
                        story_id: {{$story->id}},
                        _token : '<?php echo csrf_token() ?>'
                    },
                    success:function(data){
                        $(".list-comment").html(data);
                    }
                });
            }

            $(document).on('click','.comment-paga .pagination a', function(e){
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
    <div class="container" id="truyen">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="col-xs-12 col-info-desc" itemscope="" itemtype="http://schema.org/Book">
                <div class="title-list"><h2>Thông tin truyện</h2></div>
                <div class="col-xs-12 col-sm-4 col-md-4 info-holder">
                    <div class="books">
                        <div class="book">
                            <img src="{{ url($story->image) }}" alt="{{ $story->name }}" itemprop="image">
                        </div>
                    </div>
                    <div class="info">
                        <div>
                            <h3>Tác giả:</h3>
                            {!!  the_author($story->authors) !!}
                        </div>
                        <div>
                            <h3>Thể loại:</h3>
                            {!!  the_category($story->categories) !!}
                        </div>
                        <div>
                            <h3>Lượt xem:</h3>
                            {!!  number_format($story->view) !!}
                        </div>
                        <div>
                            <h3>Người đăng:</h3> {{$story->user->name}}
                        </div>
                        <div>
                            <h3>Trạng thái:</h3> {!! dqhStatusStoryShow($story->status) !!}
                        </div>
                        @if($story->source)
                        <div>
                            <h3>Nguồn Truyện:</h3> {!! $story->source !!}
                        </div>
                        @endif
                        <div>
                        <div class="navbar-social pull-left">
                                <div class="navbar-social pull-left">
                                    <div class="fb-like" data-href="{{ route('story.show', $story->alias) }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 desc">
                    <h3 class="title" itemprop="name">{{ $story->name }}</h3>
                    <div class="desc-text desc-text-full" itemprop="description">
                        {!!  nl2p($story->content, false) !!}
                    </div>
                    <div class="showmore">
            					<a class="btn btn-default btn-xs" href="javascript:void(0)" title="Xem thêm">Xem thêm »</a>
            				</div>

                    <?php
                    $chapters = $story->chapters()->orderBy("id", "desc")->take(5)->get();
                    if ($chapters) {
                      echo '<div class="l-chapter"><div class="l-title"><h3>Các chương mới nhất</h3></div><ul class="l-chapters">';
                      foreach($chapters as $chapter):
                      ?>
                      <li>
                        <span class="glyphicon glyphicon-certificate"></span>
                        <a href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" title="{{ $story->name }} - {{ $chapter->subname }}: {{ $chapter->name }}">
                            <span class="chapter-text">{{ $chapter->subname }}</span>: {{ $chapter->name }}
                        </a>
                      <?php
                          endforeach;

                          echo '</ul></div>';
                    }
                    ?>
                </div>
            </div>

            <div class="ads container">
                {!! \App\Option::getvalue('ads_story') !!}
            </div>

            <div class="col-xs-12" id="list-chapter">
                <div class="title-list"><h2>Danh sách chương</h2></div>
                <div class="row">
                    <?php
                    $t = 1; $c = 1;
                    $chapters = $story->chapters()->orderBy("id", "asc")->paginate(50);
                    foreach($chapters as $chapter):
                        $count = count($chapters);
                        if($t == 1) echo ' <div class="col-xs-12 col-sm-6 col-md-6"><ul class="list-chapter">';
                    ?>
                            <li>
                                <span class="glyphicon glyphicon-certificate"></span>
                                <a href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" title="{{ $story->name }} - {{ $chapter->subname }}: {{ $chapter->name }}">
                                    <span class="chapter-text">{{ $chapter->subname }}</span>: {{ $chapter->name }}
                                </a>
                            </li>
                    <?php
                        if($t == 25 || $count == $c){
                            $t = 0;
                            echo '</ul></div>';
                        }
                            $t++; $c++;
                        endforeach;
                        ?>
                </div>

                {{ $chapters->fragment('list-chapter')->links() }}

                </div>
            <div>
                <div class="col-xs-12">
                    <div class="title-list"><h2>Bình luận truyện</h2></div>
                    <div class="">
                        <button type="button" class="btn btn-info" onclick="showtt('fb','tt')" id="chapter_comment"><span class="glyphicon glyphicon-comment"></span> Tieuthuyet.vn({{$story->comment_story->count()}})</button>
                        <button type="button" class="btn btn-info" onclick="showfb('fb','tt')" id="chapter_comment"><span class="glyphicon glyphicon-comment"></span> Facebook</button>
                        <!-- <div id="fb" class="fb-comments"  data-href="http://tieuthuyet.vn" data-width="" data-numposts="5" style="display:none !important"></div> -->
                        <div id="fb" class="fb-comments" data-href="{{ route('story.show', $story->alias) }}" data-width="100%" data-numposts="5" data-colorscheme="light" fb-xfbml-state="rendered" style="display:none !important"></div>
                        <div id="tt" class="form-group " style="margin: 7px;display:none !important">
                            <input style="height: 53px" class="form-control" id="noi_dung" name="noi_dung" required placeholder="Nhập bình luận...">
                            <button id="binhluan" type="button" class="btn btn-primary">
                                Bình luận
                            </button>
                            <div class="list-comment">
                                @include('widgets.comment')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            @include('widgets.storiesByAuthor')
            @include('widgets.hotstory')
            {{--@include('widgets.ads')--}}
        </div>
    </div>

@endsection
