<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Story;
use App\Chapter;
use App\Category;
use App\Author;
use App\Comment_story;
use App\Replay_comment;
use App\Replay_comment_chapter;
use App\Comment_chapter;
use Auth;

class StoryController extends Controller
{
    public function index(Request $r)
    {
        if(Auth::user()->isAdmin())
        {
            if($r->has('user_id'))
                $data = Story::where([['user_id', $r->get('user_id')],['show',1]])->orderBy('updated_at', 'DESC')->paginate(20);
            else
                $data = Story::where('show',1)->orderBy('updated_at', 'DESC')->paginate(20);
        }
        else
            $data = Auth::user()->stories()->where('show',1)->orderBy('updated_at', 'DESC')->paginate(20);
        $title = 'Đã phê duyệt';
        return view('admin.story.index', compact('data','title'));
    }

    public function checkStory(Request $r)
    {
        if(Auth::user()->isAdmin())
        {
            if($r->has('user_id'))
                $data = Story::where([['user_id', $r->get('user_id')],['show',0]])->orderBy('updated_at', 'DESC')->paginate(20);
            else
                $data = Story::where('show',0)->orderBy('updated_at', 'DESC')->paginate(20);
        }
        else
            $data = Auth::user()->stories()->where('show',0)->orderBy('updated_at', 'DESC')->paginate(20);
        $title = 'Chưa phê duyệt';
        return view('admin.story.index', compact('data','title'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        $authors = Author::select('id', 'name')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.story.create', compact('categories', 'authors'));
    }

    public function store(StoryRequest $request)
    {
        $story = new Story;
        $story->name      = $request->txtName;
        $story->alias     = changeTitle($request->txtName);
        $story->content   = $request->txtContent;
        $story->source    = $request->txtSource;
        if($request->hasFile('fImages'))
        {
            $story->image = dqhUploadURI( $story->alias );
            $imageName = $story->alias . '.jpeg';
            $request->file('fImages')->move(dqhUploadPath(), $imageName);
            $fullPath    = public_path($story->image);
            DQHAddWatermark($fullPath);
            $pathResize1 = dqhUploadURI( $story->alias . '-thumb' );
            //$pathResize2 = dqhUploadURI( $story->alias . '-thumbw' );
            DQHResizeImage($fullPath, $pathResize1, 180, 80, 1);
            //DQHResizeImage($fullPath, $pathResize2, 60, 85);
        }
        $story->view      = 0;
        $story->keyword   = $request->txtKeyword;
        $story->description = $request->txtDescription;
        $story->status    = $request->selStatus;
        $story->user_id = Auth::user()->id;
        if(!Auth::user()->isAdmin())
        {
            $story->show = 0;
        }
        $story->save();
        $story->categories()->attach($request->intCategory);
        $story->authors()->attach($request->intAuthor);


        return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Thêm truyện mới thành công !', 'flash_level'=> 'success']);
    }

    public function destroy(Request $request,\App\Story $story)
    {
        if($request->submitF == 'HT')
        {
            $str = Story::find($story->id);
            $str->show = 1;
            $str->save();
            return redirect()->back();
        }
        else
        {
            $user_id = $story->user_id;
            if(!Auth::user()->isAdmin() && $user_id != Auth::user()->id)
                return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Bài viết này không phải của bạn !', 'flash_level'=> 'danger']);;

            if(!empty($story->image))
            {
                @unlink(public_path() . '/' . $story->image);
                @unlink(public_path() . '/' . dqhImageThumb($story->image));
                @unlink(public_path() . '/' . dqhImageThumb($story->image, true));
            }
            $chapter = $story->chapters();
            foreach ($chapter as $c)
            {
                $c->comment_chapter()->delete();
            }
            $story->chapters()->delete();
            $story->comment_story()->delete();
            $story->delete();
            return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Xóa truyện thành công !', 'flash_level'=> 'success']);
        }
    }

    public function edit(\App\Story $story)
    {
        if(!Auth::user()->isAdmin() && Auth::user()->id != $story->user_id)
            return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Bài viết này không phải của bạn !', 'flash_level'=> 'danger']);
        $categories = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        $authors = Author::select('id', 'name')->orderBy('id', 'DESC')->get()->toArray();
        $data   = $story;
        return view('admin.story.edit', compact('data', 'categories', 'authors'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function update(Request $request)
    {

        $this->validate($request,
            ['txtName' => 'required',
            'intCategory' => 'required',
            'intAuthor'   => 'required'],
            ['txtName.required'    => 'Bạn phải nhập tên truyện !',
            'intCategory.required'=> 'Bạn phải chọn chuyên mục !',
            'intAuthor.required'  => 'Bạn phải chọn tác giả !']
            );

        $story = Story::find($request->id);
        $story->name      = $request->txtName;
        $story->alias     = changeTitle($request->txtName);
        $story->content   = $request->txtContent;
        $story->source    = $request->txtSource;
        $story->categories()->sync($request->intCategory);
        $story->authors()->sync($request->intAuthor);
        $story->keyword   = $request->txtKeyword;
        $story->description = $request->txtDescription;
        $story->status    = $request->selStatus;
        if(($request->hasFile('fImages')))
        {
            @unlink(public_path() . '/' . $story->image);
            @unlink(public_path() . '/' . dqhImageThumb($story->image));
            @unlink(public_path() . '/' . dqhImageThumb($story->image, true));
            $story->image = dqhUploadURI( $story->alias );
            $imageName = $story->alias . '.jpeg';
            $request->file('fImages')->move(dqhUploadPath(), $imageName);
            $fullPath    = public_path($story->image);
            DQHAddWatermark($fullPath);
            $pathResize1 = dqhUploadURI( $story->alias . '-thumb' );
            //$pathResize2 = dqhUploadURI( $story->alias . '-thumbw' );
            DQHResizeImage($fullPath, $pathResize1, 180, 80, true);
            //DQHResizeImage($fullPath, $pathResize2, 60, 85);
        }
        if(!Auth::user()->isAdmin())
        {
            $story->show = 0;
        }
        $story->save();
        return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Truyện này đã lưu thành công !', 'flash_level'=> 'success']);
    }

    public static function dashboardSearch($keyword, $show)
    {
        if(Auth::user()->isAdmin())
        {
            if($show == 2)
            {
                $data = Story::select('*')->where([['name', 'like', '%'. $keyword .'%']])->orderBy('updated_at', 'DESC')->paginate(20);
            }
            else
            {
                $data = Story::select('*')->where([['name', 'like', '%'. $keyword .'%'],['show',$show]])->orderBy('updated_at', 'DESC')->paginate(20);
            }
        }
        else
        {
            if($show == 2)
            {
                $data = Story::select('*')->where([['name', 'like', '%'. $keyword .'%'],['user_id',Auth::user()->id]])->orderBy('updated_at', 'DESC')->paginate(20);
            }
            else
            {
                $data = Story::select('*')->where([['name', 'like', '%'. $keyword .'%'],['user_id',Auth::user()->id],['show',$show]])->orderBy('updated_at', 'DESC')->paginate(20);
            }
        }
        $title = 'Tìm kiếm theo từ khóa: '.$keyword;
        return view('admin.story.index', compact('data','title'));
    }

    /**
     * Index List
     */
    // Truyện mới
    public function getListNewStory(Request $r)
    {
        $stories = ($r->get('filter') == 'full') ? Story::where([['status', 1],['show',1]])->orderBy('updated_at', 'DESC')->paginate(25) : Story::where([['status', 1],['show',1]])->orderBy('updated_at', 'DESC')->paginate(25);
        if(!$stories) abort(404);
        $data     = [
            'title'  => 'Truyện mới cập nhật',
            'description' => 'Danh sách truyện chữ được cập nhật (vừa ra mắt, thêm chương mới, sửa nội dung,..) gần đây.',
            'keyword' => 'truyen hot, truyen moi cap nhat, truyện mới cập nhật, truyen moi, truyện mới',
            'alias'  => route('danhsach.truyenmoi'),
            'stories' => $stories,
        ];
        $breadcrumb = [[route('danhsach.truyenmoi'), 'Truyện mới cập nhật']];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện Hot
    public function getListHotStory(Request $r  )
    {
        $stories = ($r->get('filter') == 'full') ? Story::where([['status', 1],['show',1],['view','>=',1000]])->orderBy('view', 'DESC')->paginate(25) : Story::where([['status', 1],['show',1],['view','>=',1000]])->orderBy('view', 'DESC')->paginate(25);
        if(!$stories) abort(404);
        $data     = [
            'title'  => 'Truyện Hot',
            'description' => 'Danh sách những truyện đang hot, có nhiều người đọc và quan tâm nhất trong tháng này.',
            'keyword' => 'truyen hot, truyện hot, truyen hay',
            'alias'  => route('danhsach.truyenhot'),
            'stories' => $stories,
        ];
        $breadcrumb = [[route('danhsach.truyenhot'), 'Truyện Hot']];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện full
    public function getListFullStory()
    {
        $stories = Story::where([['status', 1],['show',1]])->orderBy('updated_at', 'DESC')->paginate(25);
        if(!$stories) abort(404);
         $data     = [
            'title'  => 'Danh sách truyện full',
             'description' => 'Danh sách những truyện đã hoàn thành, ra đủ chương.',
             'keyword' => 'truyen full, full, truyện full, truyen hoan thanh, hoàn thành, hoan thanh',
            'alias'  => route('danhsach.truyenfull'),
            'stories' => $stories,
        ];
        $breadcrumb = [[route('danhsach.truyenfull'), 'Danh sách truyện full']];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện theo the loại
    public function getListByCategory($alias, Request $r)
    {

        $category = Category::where('alias', $alias)->first();
        if(!$category) abort(404);
        $story    = ($r->get('filter') == 'full') ? $category->stories()->where([['status', 1],['show',1]])->orderBy('updated_at', 'DESC')->paginate(25) : $category->stories()->where([['status', 1],['show',1]])->orderBy('updated_at', 'DESC')->paginate(25);
        $data     = [
            'title'  => $category->name,
            'alias'  => 'https://tieuthuyet.vn/the-loai/'.$category->alias,
            'keyword'=> $category->keyword,
            'description' => $category->description,
            'stories' => $story,
        ];

        $breadcrumb = [[route('category.list.index', $category->alias), $category->name]];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện theo tac gia
    public function getListByAuthor($alias, Request $r)
    {
        $author = Author::where('alias', $alias)->first();
        if(!$author) abort(404);
        $story    = ($r->get('filter') == 'full') ? $author->stories()->where([['status', 1],['show',1]])->paginate(25) : $author->stories()->where([['status', 1],['show',1]])->paginate(25);
        $data     = [
            'title'  => $author->name,
            'alias'  => 'https://tieuthuyet.vn/tac-gia/'.$author->alias,
            'keyword'=> $author->keyword,
            'description' => 'Danh sách truyện của tác giả '.$author->name.'. '.   $author->description,
            'stories' => $story,
        ];
        $breadcrumb = [[route('author.list.index', $author->alias), $author->name]];
        return view('list_story', compact('data', 'breadcrumb'));
    }
    // tìm kiếm
    public function getListBySearch(Request $r)
    {
        $q = '%' . $r->get('q') . '%';

        $story    = Story::where([['name', 'like', $q],['show','=',1]])->orderBy('updated_at', 'DESC')->paginate(25);
        $data     = [
            'title'  => 'Tìm kiếm: '. $r->get('q') . ' ('. $story->count() .')',
            'alias'  => null,
            'keyword'=> '',
            'description' => '',
            'stories' => $story,
        ];

        $breadcrumb = [[route('danhsach.search'), 'Tìm kiếm: '. $r->get('q')]];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Hiển thị truyện
    public function showInfoStory($alias, Request $r)
    {
        $story = Story::where('alias', $alias)->first();
        if(!$story) abort(404);
        if(Auth::user() && !Auth::user()->isAdmin() && $story->user_id != Auth::user()->id)
        {
            $story = Story::where([['alias', $alias],['show','=',1]])->first();
        }
        if(!$story) abort(404);
        $breadcrumb = [[route('story.show', $story->alias), $story->name]];
        if(!$r->session()->has('viewStory' . $story->id)) {
            $story->view = $story->view + 1;
            $story->timestamps = false;
            $story->save();
            $r->session()->put('viewStory' . $story->id, true);
        }
        $comments = Comment_story::where('story_id','=',$story->id)->orderBy('id','desc')->paginate(4);
        return view('show_story', compact('story','breadcrumb','comments'));
    }

    // Hiển thị chương truyện
    public function showInfoChapter($alias, $aliasChapter, Request $r)
    {

        $story = Story::where('alias', $alias)->first();
        if(!$story) abort(404);
        if(Auth::user() && !Auth::user()->isAdmin() && $story->user_id != Auth::user()->id)
        {
            $story = Story::where([['alias', $alias],['show','=',1]])->first();
        }
        if(!$story) abort(404);
        $chapter = $story->chapters()->where('alias', $aliasChapter)->first();
        $totalChapters = $story->chapters()->count();
        $currentChapter = (int) str_replace('chuong-', '', $aliasChapter);
        if(!$chapter) abort(404);

        $viewed = new \App\Viewed();
        $viewed->addToListReading($story->id, $chapter->id);

        if(!$r->session()->has('viewChapter' . $chapter->id))
        {
            $story->view = $story->view+1;
            $story->timestamps = false;
            $story->save();
            $chapter->view = $chapter->view+1;
            $chapter->timestamps = false;
            $chapter->save();
            $r->session()->put('viewChapter' . $chapter->id, true);
        }

        $chapterNav = [
            'nextChapter' => ($currentChapter != $totalChapters) ? $story
                ->chapters()
                ->select('subname','alias')
                ->where('alias', 'chuong-' . ($currentChapter + 1))
                ->first() : false,
            'previousChapter' => ($currentChapter > 1) ? $story
                ->chapters()
                ->select('subname','alias')
                ->where('alias', 'chuong-' . ($currentChapter - 1))
                ->first() : false,
        ];
        $breadcrumb = [[route('story.show', $story->alias), $story->name], [route('chapter.show', [$story->alias, $chapter->alias]), $chapter->subname]];
        $comments = Comment_chapter::where('chapter_id','=',$chapter->id)->orderBy('id','desc')->paginate(4);
        return view('show_chapter', compact('story', 'chapter', 'chapterNav', 'breadcrumb','comments'));
    }

    // AJAX
    public function getAjaxListNewStories(Request $r)
    {
        $categoryID = $r->get('categoryID');
        return Story::getListNewStories($categoryID);
    }
    public function getAjaxListHotStories(Request $r)
    {
        $categoryID = $r->get('categoryID');
        return Story::getListHotStories($categoryID);
    }

    public function xuLyBinhLuan(Request $request)
    {
        $user_id=auth()->user()->id;
        $comment= new Comment_story();
        $comment->user_id=$user_id;
        $comment->content=$request->noi_dung;
        $comment->story_id=$request->story_id;
        $comment->save();
        $comments = Comment_story::where('story_id','=',$request->story_id)->orderBy('id','desc')->paginate(4);
        return view('widgets.comment', compact('comments'));
    }

    public function layBinhLuan(Request $request)
    {
        $comments = Comment_story::where('story_id','=',$request->story_id)->orderBy('id','desc')->paginate(4);
        return view('widgets.comment', compact('comments'))->render();
    }

    public function getRepCMT(Request $request)
    {
        $r_comments = Replay_comment::where('comment_story_id','=',$request->comment_story_id)->orderBy('id','desc')->skip($request->skip)->take(4)->get();
        return view('widgets.rep_comment', compact('r_comments'));
    }

    public function xuLyRepBinhLuan(Request $request)
    {
        $user_id=auth()->user()->id;
        $rcomment= new Replay_comment();
        $rcomment->user_id=$user_id;
        $rcomment->content=$request->noi_dung;
        $rcomment->comment_story_id=$request->comment_story_id;
        $rcomment->save();
        $r_comments = Replay_comment::where('comment_story_id','=',$request->comment_story_id)->orderBy('id','desc')->skip(0)->take(5)->get();
        return view('widgets.rep_comment', compact('r_comments'));
    }

    public function xuLyBinhLuanChapter(Request $request)
    {
        $user_id=auth()->user()->id;
        $comment= new Comment_chapter();
        $comment->user_id=$user_id;
        $comment->content=$request->noi_dung;
        $comment->chapter_id=$request->chapter_id;
        $comment->save();
        $comments = Comment_chapter::where('chapter_id','=',$request->chapter_id)->orderBy('id','desc')->paginate(4);
        return view('widgets.comment-chapter', compact('comments'));
    }

    public function layBinhLuanChapter(Request $request)
    {
        $comments = Comment_chapter::where('chapter_id','=',$request->chapter_id)->orderBy('id','desc')->paginate(4);
        return view('widgets.comment-chapter', compact('comments'))->render();
    }

    public function getRepCMTChapter(Request $request)
    {
        $r_comments = Replay_comment_chapter::where('comment_chapter_id','=',$request->comment_chapter_id)->orderBy('id','desc')->skip($request->skip)->take(4)->get();
        return view('widgets.rep_comment', compact('r_comments'));
    }

    public function xuLyRepBinhLuanChapter(Request $request)
    {
        $user_id=auth()->user()->id;
        $rcomment= new Replay_comment_chapter();
        $rcomment->user_id=$user_id;
        $rcomment->content=$request->noi_dung;
        $rcomment->comment_chapter_id=$request->comment_chapter_id;
        $rcomment->save();
        $r_comments = Replay_comment_chapter::where('comment_chapter_id','=',$request->comment_chapter_id)->orderBy('id','desc')->skip(0)->take(5)->get();
        return view('widgets.rep_comment', compact('r_comments'));
    }
}
