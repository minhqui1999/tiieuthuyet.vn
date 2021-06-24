<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App;
use App\Chapter;
use Carbon\Carbon;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
        // add home pages mặc định
        $sitemap->add(\URL::to('/'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(\URL::to('/danh-sach/truyen-moi'), Carbon::now(), '0.80', 'daily');
        $sitemap->add(\URL::to('/danh-sach/truyen-hot'), Carbon::now(), '0.80', 'daily');
        $sitemap->add(\URL::to('/danh-sach/truyen-full'), Carbon::now(), '0.80', 'daily');
        $sitemap->add(\URL::to('/contact'), Carbon::now(), '0.80', 'daily');
        $sitemap->add(\URL::to('/tos'), Carbon::now(), '0.80', 'daily');
        $sitemap->add(\URL::to('/login'), Carbon::now(), '0.80', 'daily');
        $sitemap->add(\URL::to('/register'), Carbon::now(), '0.80', 'daily');
        // tác giả
        $authors = DB::table('authors')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($authors as $author) {
                $sitemap->add(route('author.list.index', [$author->alias]), $author->created_at, '0.8', 'daily');
        }

        //thể loại
        $categorys = DB::table('categories')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($categorys as $category) {
                $sitemap->add(route('category.list.index', [$category->alias]), $category->created_at, '0.8', 'daily');
        }

        //stories
        $stories = DB::table('stories')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($stories as $storie) {
                $sitemap->add(route('story.show', [$storie->alias]), $storie->created_at, '0.8', 'daily');
        }

        //chapters
        $chapters = Chapter::orderBy('created_at', 'desc')
                ->get();
        foreach ($chapters as $chapter) {
                $sitemap->add(route('chapter.show', [$chapter->story->alias, $chapter->alias]), $chapter->created_at, '0.61', 'daily');
        }

        // lưu file và phân quyền
        $sitemap->store('xml', 'sitemap');
        if (\File::exists(public_path() . '/sitemap.xml')) {
                chmod(public_path() . '/sitemap.xml', 0777);
        }
    }
}
