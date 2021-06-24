<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LeechController extends Controller
{
    public function index()
    {
        $categories = \App\Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        $authors = \App\Author::select('id', 'name')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.leech', compact('categories', 'authors'));
    }

    public function getListChapters(Request $request)
    {
        $data = [];
        $curl = new \App\Dinhquochan\Curl();

        $strr1 = 'https://';
        $strr2 = 'http://';
        $b = str_replace($strr1, '', $request->url);
        $a = str_replace($strr2, '', $b);
        $type = substr($a,0,9);
        switch($type)
        {
            case 'santruyen':
                $txt     = $curl->get($request->url);
                $content = $txt->body;
                preg_match("#<h1 class=\"p-l-20 p-r-20 storyTitle\">(.*?)</h1>#is", $content, $title);
                $data['title'] = isset($title[1]) ? str_replace('<i class="fa fa-book"></i> ', '', $title[1]) : false;
                
                preg_match("#<div class=\"coverThumbnail\">(.*?)</div>#is", $content, $images);
                if(isset($images[0]))
                    preg_match("#src=\"(.*?)\"#is", $images[0], $img);
                $data['image'] = isset($img[1]) ? $img[1] : null;
                
                preg_match("#<div class=\"storyContent\"(.*?)>(.*?)</div>#is", $content, $info);
                $data['content'] = isset($info[2]) ? $info[2] : false;
                $data['content'] = preg_replace("/<div(.*?)>/is", '', $data['content']);
                $data['content'] = str_replace("</div>", '', $data['content']);
                
                preg_match("#<div class=\"chapterListBox\">(.*?)</div>#is", $content, $result);
                if(isset($result[0]))
                    preg_match_all("#href=\"(.*?)\"#is", $result[0], $list);
                if(isset($list[1]))
                    $chaptersR = isset($list[1]) ? $list[1] : false;
                if(isset($data['title']) && $data['title'] != '')
                    $data['allow'] = true;
                if($data['allow']){

                    $data['categories'] = $request->categoriesID;
                    $data['authors']   = $request->authorID;
                    $data['source']   = $request->type;
                    $id = $this->_saveStory($data);
                    //$id = 1;
                    return ['story_id' => $id, 'chapters' =>  array_reverse($chaptersR)];
                }
                break;
            case 'thichtruy':
                $urltt = str_replace("https", 'http', $request->url);
                $txt     = $curl->get($urltt);
                $content = $txt->body;
                
                preg_match("#<h1 class=\"story-intro-title\">(.*?)>(.*?)</a>#is", $content, $title);
                $data['title'] = isset($title[2]) ? $title[2] : null;

                preg_match("#<div class=\"pull-left story-intro-image\">(.*?)</div>#is", $content, $images);
                if(isset($images[1]))
                {
                    preg_match("#src=\"(.*?)\"#is", $images[1], $image);
                }
                $data['image'] = isset($image[1]) ? $image[1] : null;
                $data['image'] = str_replace("https", 'http', $data['image']);
                preg_match("#<div class=\"tab-text text-justify\"(.*?)>(.*?)</p>#is", $content, $info);
                $data['content'] = isset($info[2]) ? $info[2] : false;
                $data['content'] = preg_replace("/<div(.*?)>/is", '', $data['content']);
                $data['content'] = str_replace("</div>", '', $data['content']);
                preg_match("#<div id=\"tab-chapper\"(.*?)>(.*?)<\/div>#is", $content, $result);
                if(isset($result[0]))
                    preg_match_all("#href=\"(.*?)\"#is", $result[0], $list);
                if(isset($list[1])){
                    $chapters = isset($list[1]) ? $list[1] : false;
                    foreach($chapters as $chapter)
                        $chaptersR[] = 'http://thichtruyen.vn' . $chapter;
                }
                
                if(isset($data['title']) && $data['title'] != '')
                    $data['allow'] = true;
                if($data['allow']){

                    $data['categories'] = $request->categoriesID;
                    $data['authors']   = $request->authorID;
                    $data['source']   = $request->type;
                    $id = $this->_saveStory($data);
                    //$id = 1;
                    return ['story_id' => $id, 'chapters' =>  $chaptersR];
                }
                break;
        }

        return $data;
    }

    public function getContentChapter(Request $request)
    {
        $data = [];
        $curl = new \App\Dinhquochan\Curl();
        
        $strr1 = 'https://';
        $strr2 = 'http://';
        $b = str_replace($strr1, '', $request->url);
        $a = str_replace($strr2, '', $b);
        $type = substr($a,0,9);
        switch($type)
        {
            case 'santruyen':
                $txt     = $curl->get($request->url);
                $content = $txt->body;

                preg_match("#<h1 class=\"chapterTitle\">(.*?)</h1>#is", $content, $title);
                $data['title'] = isset($title[1]) ? preg_replace("#Chương(.*?)\: #is", "", $title[1]) : false;
                preg_match("#<div class=\"chapterContent\"(.*?)>(.*?)</div>#is", $content, $con);
                if(isset($con[2])){
                    
                    $data['content'] = $con[2];
                    $data['content'] = str_replace('<div>', '', $data['content']);
                    $data['content'] = str_replace('</div>', '', $data['content']);
                    $data['content'] = preg_replace("#<center>.*?<\/center>#is", "", $data['content']); 
                }
                if(isset($data['title']) && $data['title'] != '')
                    $data['allow'] = true;
                break;
            case 'thichtruy':
                $txt     = $curl->get($request->url);
                $content = $txt->body;

                preg_match("#<h1(.*?)>(.*?)</h1>#is", $content, $text);
                if(isset($text[2]))
                {
                    $text[2] = str_replace(' - ', '', $text[2]);
                    $text[2] = preg_replace("#Chương(.*)#is", "", $text[2]);
                }
                $data['title'] = isset($text[2]) ? $text[2] : false;
                preg_match("#<div class=\"story-detail-content\">(.*?)<div class=\"hidden-lg\">#is", $content, $con);
                if(isset($con[1])){
                    $data['content'] = preg_replace("#<div(.*?)>(.*?)</div>#is", "", $con[1]);
                    $data['content'] = str_replace('<div>', '', $data['content']);
                    $data['content'] = str_replace('</div>', '', $data['content']);
                    $data['content'] = preg_replace("#<center>.*?<\/center>#is", "", $data['content']); 
                }

                if(isset($data['title']) && $data['title'] != '')
                    $data['allow'] = true;
                break;
        }

        if(isset($data['allow'])){
            $data['story_id'] = $request->story_id;
            $this->_saveChapter($data);
            $data['status'] = 'OK';
            return $data;
        }
        return "Không tồn tại";
    }

    // leech
    protected function _saveStory($data)
    {
        $title = $data['title'];
        $content = $data['content'];
        $category = $data['categories'];
        $author  = $data['authors'];
        $image  = $data['image'];
        $source = $data['source'];
        $story = new \App\Story;
        $story->name      = $title;
        $story->alias     = changeTitle($title);
        $story->content   = $content;
        $story->source    = $source;
        $story->image = dqhUploadURI( $story->alias );
        $fullPath    = dqhUploadPath() . '/' . $story->alias . '.jpeg';
        $this->_saveImage($data['image'], $fullPath);
        DQHAddWatermark($fullPath);
        $pathResize1 = dqhUploadURI( $story->alias . '-thumb' );
        //$pathResize2 = dqhUploadURI( $story->alias . '-thumbw' );
        DQHResizeImage($fullPath, $pathResize1, 180, 80, 1);
        //DQHResizeImage($fullPath, $pathResize2, 60, 85);
        $story->view      = 0;
        $story->status    = 1;
        $story->user_id = \Auth::user()->id;
        $story->save();
        $story->categories()->attach($category);
        $story->authors()->attach($author);
        return $story->id;
    }

    protected function _saveChapter($data)
    {
        $title = $data['title'];
        $content = $data['content'];
        $story_id = $data['story_id'];

        $chapter = new \App\Chapter;
        $chapter->name      = $title;
        $chapter->subname   = $chapter->theNextSubname($story_id);
        $chapter->alias     = changeTitle($chapter->subname);
        $chapter->content   = $content;
        $chapter->story_id  = $story_id;
        $chapter->view      = 0;
        $chapter->save();
        return $chapter->id;
    }

    protected function _saveImage($url, $name)
    {
        $curl = new \App\Dinhquochan\Curl();
        $image = $curl->get($url);
        file_put_contents($name, file_get_contents($url));
    }
}
