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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            
            
        const listAudio = {
    storyId: {{ $story->id }},
    chapters: [
    <?php
                    $chapters = $story->chapters()->orderBy("id", "asc")->paginate(50);
                    foreach($chapters as $chapter):
                    ?>
        { chapterId:{{ $chapter->id }}, code: `{{$chapter->content}}`, audioName:`{{$chapter->subname}}{!!  nl2p($chapter->name, false) !!}`, thumbnail: `{{ $story->image }}` },
    <?php endforeach;?>]                 
};
class AudioForm {
    constructor(audios) {
        this.chapterLength = audios.chapters.length;
        // create new map
        const audioMaps = new Map(); 
        audioMaps.set(audios.storyId,audios.chapters.map((value, index, array) => {
            value.index = index;
            return value;
        }));        
        let that = this;
        this.config();
        // get list audio localStoge
        const audioLocalStoges = localStorage.getItem("item");
        const modeLocalStoge = localStorage.getItem("mode");
        // convert audiolocalstoge and modelocalstoge to json
        let jsonAudioLocalStoges = JSON.parse(audioLocalStoges);
        if (!jsonAudioLocalStoges || jsonAudioLocalStoges.storyId != audios.storyId) {
            jsonAudioLocalStoges = {};
        };
        // chapter map
        const jsonModelLocalStoges = JSON.parse(modeLocalStoge) || {};
        let chapterMap={};
        if(typeof audioMaps.get(jsonAudioLocalStoges.storyId) != "undefined"){
            chapterMap=audioMaps.get(jsonAudioLocalStoges.storyId)[jsonAudioLocalStoges.index] || {};
        };
        // create element
        const audioDom = document.createElement("audio");
        // audioDom.controls=true;
        // get bar status
        const barStatus = document.querySelector(".bar .status");
        // get bar
        const bar = document.querySelector(".bar");
        // get btn Play
        const btnPlay = document.querySelector(".btn-play");
        // setText 
        const audioName = document.querySelector(".story-name");
        // get box thumbnail
        const cdRom = document.querySelector(".cd-rom");
        // hadling next()
        const btnNext = document.querySelector(".btn-next");
        // handle preve
        const btnPrev = document.querySelector(".btn-prev");
        // get dom timenow
        const timeNow = document.querySelector(".time-now");
        // get time all
        const timeAll = document.querySelector(".time-all");
        // get btnSpeaker
        const btnSpeaker = document.querySelector(".btn-speaker");
        // get btnRepeate
        const btnRepeate = document.querySelector(".btn-repeat");
        //get btnChuong
        const btnPlayChuong=document.querySelectorAll(".btn_play_chuong");
        
       
        // get thumbnail
        const thumbnail = cdRom.children[0];
        this.thumbnail = chapterMap.thumbnail || audios.chapters[0].thumbnail;
        thumbnail.src = this.thumbnail;
        // create position
        this.positionAudio = chapterMap.index || 0;
        // set play begin
        setPostionAudio(this.positionAudio, false);
        // render dom
        document.getElementById("wrapper-audio").after(audioDom);
        // set title
        this.audioName = chapterMap.audioName || audios.chapters[this.positionAudio].audioName;
        audioName.innerHTML = this.audioName;
        // set time
        this.currentTime = jsonAudioLocalStoges.currentTime || 0;
        audioDom.currentTime = this.currentTime;
        // repeat 0:none,1:lặp 1 bài duy nhất, 2 lặp lại toàn bài
        this.mode = { repeat: jsonModelLocalStoges.repeat || 0 };
        // set mode default
        const optionRepeat = [{ class: "none", text: "repeat" }, { class: "repeat_one", text: "repeat_one" }, { class: "repeat", text: "repeat" }];
        btnRepeate.classList.add(optionRepeat[this.mode.repeat].class);
        btnRepeate.textContent = optionRepeat[this.mode.repeat].text;
        // set play
        btnPlay.onclick = function() {
            cdRom.classList.toggle("active");
            if (this.classList.contains("play")) {
                this.textContent = that.optionStauts[0];
                this.classList.remove("play");
                audioDom.pause();
                return;
            };
            audioDom.play();
            this.classList.add("play");
            this.textContent = that.optionStauts[1];
        }
        btnNext.onclick = nextAudio;
        btnPrev.onclick = prevAudio;
        //chương
      
        // on update time
        audioDom.addEventListener("timeupdate", function(e) {
            that.currentTime = e.target.currentTime;
            timeNow.textContent = that.formatTime(that.currentTime);
            barStatus.style.width = `${(that.currentTime/e.target.duration)*100}%`;
            timeAll.textContent = that.formatTime(e.target.duration || 0);
            // kiểm tra mod
        });
        // update localstoge
        setInterval(setlocalStoge, 50000);
        function setPostionAudio(positionAudio) {
            // only autoplay when user click play
            audioDom.autoplay = btnPlay.classList.contains("play");
            // render audio new
            that.positionAudio = positionAudio;
            that.audioSrc = that.convertCodeToUrl(audios.chapters[positionAudio].code);
            audioDom.src = that.audioSrc;
            that.thumbnail = audios.chapters[positionAudio].thumbnail;
            thumbnail.src = that.thumbnail;
            that.audioName = audios.chapters[positionAudio].audioName;
            audioName.innerHTML = that.audioName;
            // check disable prev
            btnNext.classList.remove("disable");
            btnPrev.classList.remove("disable");
            if (positionAudio == 0) {
                btnPrev.classList.add("disable");
            }
            if (positionAudio == that.chapterLength - 1) {
                btnNext.classList.add("disable");
            }
        }

    
    btnPlayChuong.forEach(e=>{
        e.addEventListener("click",function(){
            // setplay postion
            setPostionAudio(this.getAttribute("data-index"));
        })
    })
        function nextAudio() {
            let positionAudio = that.positionAudio + 1;
            if (positionAudio >= that.chapterLength) {
                return;
            }
            setPostionAudio(positionAudio);
        }
        function prevAudio() {
            let positionAudio = that.positionAudio - 1;
            if (positionAudio < 0) {
                return;
            }
            setPostionAudio(positionAudio);
        };
        // set time click
        bar.addEventListener("click", function(e) {
            let timeSet = (e.offsetX * audioDom.duration) / bar.offsetWidth;
            audioDom.currentTime = timeSet;
        });
        // set speaker
        btnSpeaker.onclick = function() {
            let option = !audioDom.muted,
                className = ["volume_up", "volume_off"];
            audioDom.muted = option;
            btnSpeaker.textContent = className[Number(option)];
        };
        // set repeat
        btnRepeate.onclick = function() {
            this.classList.remove("none", "repeat_one", "repeat");
            that.mode.repeat++;
            if (that.mode.repeat > 2) {
                that.mode.repeat = 0;
            }
            this.textContent = optionRepeat[that.mode.repeat].text;
            this.classList.add(optionRepeat[that.mode.repeat].class);
            // setlocalStoge
            localStorage.setItem("mode", JSON.stringify({ repeat: that.mode.repeat }));
        };
        // bar.addEventListener("drag", function(e) {
        //     if (e.offsetX >= bar.offsetWidth) {
        //         return barStatus.style.width = "100%";
        //     }
        //     if (e.offsetX <= 0) {
        //         return barStatus.style.width = "0%"
        //     }
        //     barStatus.style.width = (e.offsetX / bar.offsetWidth) * 100 + "%";
        //     timeNow.textContent = that.formatTime((e.offsetX * audioDom.duration) / bar.offsetWidth);
        //     audioDom.pause();
        // })

        // bar.addEventListener("dragend", function(e) {
        //     let x = e.offsetX;
        //     if (e.offsetX >= bar.offsetWidth) {
        //         x = bar.offsetWidth;
        //     }
        //     let timeSet = (x * audioDom.duration) / bar.offsetWidth;
        //     audioDom.currentTime = timeSet;
        //     audioDom.play();
        // });
        audioDom.onended = function() {
            switch (that.mode.repeat) {
                // phát lại bài
                case 1:
                    setPostionAudio(that.positionAudio);
                    break;
                    // lặp all
                case 2:
                    if (that.positionAudio == that.chapterLength - 1) {
                        return setPostionAudio(0);
                    }
                    nextAudio();
                    break;
                default:
                    nextAudio();
            }
        }

        function setlocalStoge() {
            if (!audioDom.played) {
                return;
            }
            localStorage.setItem("item", JSON.stringify({
                src: that.audioSrc,
                name: that.audioName,
                thumbnail: that.thumbnail,
                currentTime: that.currentTime,
                index: that.positionAudio,
                storyId: audios.storyId
            }))
        }
    }
    config() {
        this.optionStauts = [
            "play_circle",
            "pause_circle"
        ];
    }
    convertCodeToUrl(code) {
        return `http://docs.google.com/uc?export=open&id=${code}`
    }
    formatTime($time) {
        let time = new Date($time * 1000);
        // vì Việt Nam múi giờ 7
        time.setHours(time.getHours() - 7);
        return time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds()
    };
    
}

new AudioForm(listAudio);



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
    <script >

     
</script>
 <style>
     * {
    font-size: 16px;
    font-weight: 400;
    line-height: 1.3;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

a {
    text-decoration: none;
}

body {
    background-repeat: no-repeat;
    font-family: 'Open Sans', sans-serif;
}

#wrapper-audio {
    width: 400px;
    margin: 50px auto;
    text-align: center;
    background: linear-gradient(90deg, rgba(158, 97, 179, 1) 32%, rgba(13, 145, 172, 1) 97%);
    padding: 20px;
    border-radius: 5px;
}

#wrapper-audio .box-thumbnail {
    display: inline-block;
    width: 250px;
    height: 250px;
    overflow: hidden;
    border-radius: 50%;
    box-shadow: 0px 0px 10px #00000073;
    animation: rolate 10s linear infinite;
    animation-play-state: paused;
}

#wrapper-audio .box-thumbnail.active {
    animation-play-state: running;
}

@keyframes rolate {
    100% {
        transform: rotate(360deg);
    }
}

#wrapper-audio .box-thumbnail .thumbnail {
    width: 100%;
    height: auto;
}

#wrapper-audio .story-desc .story-name {
    font-size: 25px;
    color: #fff;
    padding: 10px 0px;
    display: block;
}

#wrapper-audio .box-bar {
    position: relative;
    padding: 15px 0px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

#wrapper-audio .box-bar span {
    font-size: 10px;
    color: #fff;
}

#wrapper-audio .box-bar .bar {
    width: 265px;
    height: 5px;
    background: #c7b5bb;
    display: block;
    border-radius: 2px;
    cursor: pointer;
}

#wrapper-audio .box-bar .bar .status {
    width: 0%;
    height: 100%;
    background: #8e44ad;
    display: block;
    border-radius: 2px;
    position: relative;
}

#wrapper-audio .box-bar .bar .status::after {
    content: "";
    position: absolute;
    padding: 4px;
    right: 0px;
    z-index: 1000;
    background: #8e44ad;
    top: -2px;
    border-radius: 50%;
    display: none;
}

#wrapper-audio .box-bar .bar:hover .status::after {
    display: block;
}

#wrapper-audio .btn-function {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

#wrapper-audio .btn-function button {
    color: #fff;
    background: none;
    border: none;
    margin: 0px 15px;
    cursor: pointer;
    font-size: 25px;
    outline: none;
}

#wrapper-audio .btn-function .btn-play {
    font-size: 70px;
}

#wrapper-audio .btn-function .btn-repeat.none {
    color: #b3a8a8;
}

#wrapper-audio .btn-function button.disable {
    color: #b3a8a8;
    cursor: not-allowed;
}
 </style>


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

                            <!-- play audio -->
                            <div id="wrapper-audio">
        <a href="javascript:void(0)" class="cd-rom box-thumbnail thumbnail-chapter">
            <img src="{{ url($story->image) }}" class="thumbnail" alt="">
        </a>
        <div>
            <div class="story-desc">
                <p href="" class="story-name">{{ $story->name }}</p>
            </div>
        </div>
        <div class="box-bar">
            <span class="time-now">00:00</span>
            <span class="bar">
                <div class="status">

                </div>
            </span>
            <span class="time-all">00:00</span>
        </div>
        <div class="box-btn btn-function">
            <button class="btn-speaker material-icons">
                volume_up
            </button>
            <button class="btn-prev material-icons">
                    skip_previous
            </button>
            <!-- btn pause <i class="far fa-pause-circle"></i> -->
            <button  class="btn-play pause material-icons">
                    play_circle
            </button>
            <button class="btn-next material-icons">
                    skip_next
            </button>
            <button class="btn-repeat material-icons">
                    repeat
            </button>
        </div>
    </div>

  <!-- end play audio -->
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
                    foreach($chapters as $key => $chapter):
                        $count = count($chapters);
                        if($t == 1) echo ' <div class="col-xs-12 col-sm-6 col-md-6"><ul class="list-chapter">';
                    ?>
                            <li>
                                <span class="glyphicon glyphicon-certificate"></span>
                                <button class="btn_play_chuong"  data-index="{{ $key }}">{{ $chapter->subname }}</button>
                                <script>
                               
                                </script>
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

