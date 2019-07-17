<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

use Auth;
use App\Video;
use App\Channel;
use App\Setting;
use App\Company;
use Carbon\Carbon;
use DB;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VidHomeController extends Controller{

    protected $paginationCount = null;
    protected $videoSide = null;

    public function  __construct(){
        $this->paginationCount = 6;
        $this->videoSide = $this->getRecentVideosWithLimit(4);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $featuredVideo = $this->getFeaturedVideos();
        $categories    = $this->getCategories();
        $count         = $this->getTotalVideos();
        $video         = $this->getRecentWithPagination();

        return view('pages.frontend.tv.home')
               ->with('featured', $featuredVideo)
               ->withChannel($categories)->withCount($count)
               ->withVideos($video);
    }

    private function getTotalVideos(){
        return Video::latest()->approved()->published()->count();
    }

    private function getRecentWithPagination(){
        return $this->getRecent()->paginate($this->paginationCount);
    }

    private function getRecent(){
        return Video::latest()->approved()->published()->orderBy('created_at', 'desc');
    }

    private function getRecentVideosWithLimit($limit = 4){
        return $this->getRecent()->limit($limit)->get();
    }

    private function getFeaturedVideos(){
        return Video::latest()->approved()->published()
                    ->whereFeatured(1)
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
                    ->get();
    }

    private function getCategories(){
        $categories = [];
        $items  = Channel::get();
        foreach($items as $item){
            $categories[$item->id] =  $item->name;
        }
        return $categories;
    }

    public function getTags(){
        $tags = [];
        $items  = Video::get(['video_tags']);
        foreach($items as $item){
            array_push($tags, $item->video_tags);
        }
        $tagsString = implode(',', $tags);
        return array_unique(explode(',', $tagsString));
    }

    private function getMostViewVideo(){
        return Video::approved()->published()
                    ->orderBy('video_views', 'desc')
                    ->take(3)
                    ->get();
    }

    private function getRecentVideos(){
        return Video::latest()->approved()->published()
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
    }

    // 
    // 
    // 

    private function getMostViewBlog(){
        return  Post::approved()->published()
                    ->orderBy('view_count', 'desc')
                    ->take(3)
                    ->get();
    }

    private function getRecentBlog(){
        return Post::latest()->approved()->published()
                   ->orderBy('created_at', 'desc')
                   ->take(3)
                   ->get();
    }

    // private function getRecentBlogWithPagination(){
    //     return $this->getRecentBlog()->paginate($this->paginationCount);
    // }

    // private function getBlogCategories(){
    //     return  PostCategory::orderBy('pc_display_order')->get();
    // }

    // public function blogIndex(){
    //     $posts = $this->getRecentBlogWithPagination();
    //     return view('post.index')->withPosts($posts)->with("systemTags", self::getTags())
    //         ->with("mostViewVideos", self::getMostViewVideo())
    //         ->with("mostRecentVideos", self::getRecentVideos())
    //         ->withCategory(self::getBlogCategories());
    // }

    // public function getBlogByCategories($value){
    //     $posts = DB::table('posts_tbl')
    //         ->join('post_category_tbl', 'posts_tbl.post_category', '=', 'post_category_tbl.pc_id')
    //         ->where("pc_category_slug", '=', $value)
    //         ->paginate($this->paginationCount);

    //     return view('post.index')->withPosts($posts)->with("systemTags", self::getTags())
    //         ->with("mostViewVideos", self::getMostViewVideo())
    //         ->with("mostRecentVideos", self::getRecentVideos())
    //         ->withCategory(self::getBlogCategories())->withTitle($posts[0]->pc_category_name);
    // }

    // public function blogShow($blogSlug){
    //     $post = Post::where('post_slug', '=', $blogSlug)->get();
    //     return view('post.show')->with("systemTags", self::getTags())
    //         ->with("mostViewVideos", self::getMostViewVideo())
    //         ->with("mostRecentVideos", self::getRecentVideos())
    //         ->withCategory(self::getBlogCategories())->withPost($post[0]);
    // }
}
