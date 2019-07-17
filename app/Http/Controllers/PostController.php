<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Tag;
use App\User;
use App\Post;
use App\Setting;
use App\Company;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index()
    {
        $title           =   'Posts';
        $posts           =   Post::latest()->approved()->published()->paginate(14);
        $admin           =   User::where('role_id',1)->get();
        $author          =   User::where('role_id',2)->get();
        $categories      =   Category::all();
        $categories_pick =   Category::inRandomOrder()->take(3)->get();
        $recomended      =   Post::approved()->published()->take(1)->where('editors_pick', 1)->orderBy('view_count', 'desc')->get();
        $moreRecomended  =   Post::where('editors_pick', 1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead        =   Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead    =   Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();
        $settings        =   Setting::getAllSettings();
        $company         =   Company::first();

        return view('pages.frontend.posts.allposts',compact('title','posts','admin','author', 'categories','categories_pick',
                    'mostRead','lessMostRead','recomended','moreRecomended','settings','company'));
    }
    
    public function details($slug)
    {
        $post = Post::where('slug',$slug)->approved()->published()->first();

        $blogKey = 'blog_' . $post->id;

        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey,1);
        }

        $title           = $post->title;
        $tags            = Tag::all();
        $categories      = Category::all();
        $categories_pick = Category::inRandomOrder()->take(3)->get();
        $editors_pick    = Post::where('editors_pick',1)->orderBy('created_at', 'desc')->get();
        $recomended      = Post::approved()->published()->take(1)->where('editors_pick', 1)->orderBy('view_count', 'desc')->get();
        $moreRecomended  = Post::where('editors_pick', 1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead        = Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead    = Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();
        $settings        = Setting::getAllSettings();    

        $next_post       = Post::where('id', '>', $post->id)->min('id');
        $prev_post       = Post::where('id', '<', $post->id)->max('id');

        $also_read       = Post::approved()->published()->take(6)->where('editors_pick',1)->orderBy('created_at', 'desc')->get();
        $randomposts     = Post::approved()->published()->take(3)->inRandomOrder()->get();
        return view('pages.frontend.posts.post',compact('post','title','tags','categories','categories_pick','editors_pick',
                                                        'recomended','moreRecomended','mostRead','lessMostRead',
                                                        'randomposts', 'also_read', 'settings'))
                                                ->with('next', Post::find($next_post))
                                                ->with('prev', Post::find($prev_post));

    }
    

    public function postByCategory($slug)
    {
        $category        =   Category::where('slug',$slug)->first();
        $title           =   $category->name;
        $categories      =   Category::all();
        $categories_pick =   Category::inRandomOrder()->get();
        $posts           =   $category->posts()->approved()->published()->orderBy('created_at', 'desc')->get();
        $editors_pick    =   $category->posts()->where('editors_pick',1)->orderBy('created_at', 'desc')->get();
        $recomended      =   Post::approved()->published()->take(1)->where('editors_pick', 1)->orderBy('view_count', 'desc')->get();
        $moreRecomended  =   Post::where('editors_pick', 1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead        =   Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead    =   Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();
        $settings        =   Setting::getAllSettings();
        $company         =   Company::first();

        return view('pages.frontend.categories.category',compact('category','title',
                    'categories','categories_pick','posts','editors_pick','recomended','moreRecomended',
                    'mostRead','lessMostRead','settings', 'company'));
    }

    public function postByTag($slug)
    {
        $tag       = Tag::where('slug',$slug)->first();
        $title     = $tag->name;
        $tags      = Tag::all();
        $tags_pick = Tag::inRandomOrder()->get();
        $posts           =  $tag->posts()->approved()->published()->orderBy('created_at', 'desc')->get();
        $tag_latest      =  $tag->posts()->approved()->published()->orderBy('created_at', 'desc')->get()->first();
        $categories      =   Category::all();
        $editors_pick    =   $tag->posts()->where('editors_pick',1)->orderBy('created_at', 'desc')->get();
        $recomended      =   Post::approved()->published()->take(1)->where('editors_pick', 1)->orderBy('view_count', 'desc')->get();
        $moreRecomended  =   Post::where('editors_pick', 1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead        =   Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead    =   Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();
        $settings        =   Setting::getAllSettings();
        $company         =   Company::first();

        return view('pages.frontend.tags.tag',compact('tag','title','tags','tags_pick', 'posts','tag_latest',
                    'categories','editors_pick','mostRead','lessMostRead','recomended','moreRecomended','settings', 'company'));
    }

    public function getTags(){
        $tags = [];
        $items  = Tag::get(['name']);
        foreach($items as $item){
            array_push($tags, $item->name);
        }
        $tagsString = implode(',', $tags);
        return array_unique(explode(',', $tagsString));
    }

    private function getMostRead(int $limit = 1){
        return Post::approved()->published()->orderBy('view_count', 'desc')->limit($limit)->get();
    }

    private function getRecentPosts(int $limit = 3){
        return Post::latest()->approved()->published()->limit($limit)->orderBy('created_at', 'desc')->get();
    }

    private function getRandomPosts(int $limit = 6){
        return Post::latest()->approved()->published()->limit($limit)->inRandomOrder('created_at', 'desc')->get();
         
    }

    private function getRecentBlog(){
        return Post::orderBy('created_at', 'desc');
    }

    private function getRecentBlogWithPagination(){
        return $this->getRecentBlog()->paginate($this->paginationCount);
    }
    
    public function blogIndex(){
        $posts = $this->getRecentBlogWithPagination();
        return view('post.index')->withPosts($posts)->with("systemTags", self::getTags())
            ->with("mostViewVideos", self::getMostViewVideo())
            ->with("mostRecentVideos", self::getRecentVideos())
            ->withCategory(self::getBlogCategories());
    }

    public function getBlogByCategories($value){
        $posts = DB::table('posts')
            ->join('post_category', 'posts.post_category', '=', 'post_category.pc_id')
            ->where("pc_category_slug", '=', $value)
            ->paginate($this->paginationCount);

        return view('post.index')->withPosts($posts)->with("systemTags", self::getTags())
            ->with("mostViewVideos", self::getMostViewVideo())
            ->with("mostRecentVideos", self::getRecentVideos())
            ->withCategory(self::getBlogCategories())->withTitle($posts[0]->pc_category_name);
    }

    public function blogShow($blogSlug){
        $post = Post::where('post_slug', '=', $blogSlug)->get();
        return view('post.show')->with("systemTags", self::getTags())
            ->with("mostViewVideos", self::getMostViewVideo())
            ->with("mostRecentVideos", self::getRecentVideos())
            ->withCategory(self::getBlogCategories())->withPost($post[0]);
    }
}
