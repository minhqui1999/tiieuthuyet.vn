<div class="container" id="truyen-slide">
    <div class="list list-thumbnail col-xs-12">
        <div class="title-list"><h2><a href="{{route('danhsach.truyenfull')}}" title="Truyện full">Truyện Audio</a></h2><span class="glyphicon glyphicon-headphones"></span></a></div>
        <div class="row">
            @if($stories)
                @foreach($stories as $story)
                    <?php
                    $chapter = $story->chapters()->orderBy('created_at', 'DESC')->first();
                    ?>
                    <div class="col-xs-4 col-sm-3 col-md-2">
                        <a href="{{route('story.show', $story->alias)}}" title="{{$story->name}}">
                            <img src="{{url($story->image)}}" alt="{{$story->name}}">
                            @if($story->view >= 1000)
                            <span class="icon icon-hot" style="top:6px; right:8%;"></span>
                            @endif
                            <div class="caption">
                                <h3>{{$story->name}}</h3>
                                <small class="btn-xs label-primary">Hoàn thành - {{$story->chapters()->count()}} chương</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>Không có bài viết nào ở đây !</p>
            @endif
        </div>

    </div>
</div>