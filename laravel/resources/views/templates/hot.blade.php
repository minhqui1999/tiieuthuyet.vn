@if($stories)
    <?php $count = 1;?>
    @foreach($stories as $story)
        <div class="item top-{{$count}}" itemscope="" itemtype="http://schema.org/Book">
            <a href="{{route('story.show', $story->alias)}}" itemprop="url">
                @if($story->status == 1)
                <span class="full-label"></span>
                @endif
                <img src="{{url($story->image)}}" alt="{{$story->name}}" class="img-responsive" itemprop="image">
                @if($story->view >= 1000)
                <span class="icon icon-hot"></span>
                @endif
                <div class="title">
                    <h3 itemprop="name">{{$story->name}}</h3>
                </div>
                <div class="title view-hot-story">
                    <h3 style="margin-left: 6%;"><span class="glyphicon glyphicon-eye-open"> </span> {{number_format($story->view)}} </h3>
                </div>
            </a>
        </div>
        <?php $count++;?>
    @endforeach
@else
    <p>Không có bài viết nào ở đây !</p>
@endif