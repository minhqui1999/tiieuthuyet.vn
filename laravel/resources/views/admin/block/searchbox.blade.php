<div class="pull-right">
    <form class="form-inline" action="{{ URL::route('dashboard.search') }}" method="GET">
        <div class="form-group">
            <label class="sr-only" for="q">Tìm kiếm </label>
            <input type="text" class="form-control" name="q" id="txtSearchBox" placeholder="Nhập từ khóa" value="{{old('q', Request::get('q'))}}">
        </div>
        <div class="form-group">
            <select class="form-control" name="type" id="txtSearchType">
                <option value="all">Tất cả truyện</option>
                <option value="story">Truyện đã duyệt</option>
                <option value="story_check">Truyện chưa duyệt</option>
                <option value="chapter" {{ (Request::get('type') == 'story') ? ''  : 'selected' }}>Chương</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Tìm Kiếm</button>
    </form>
</div>
<div class="clearfix"></div>