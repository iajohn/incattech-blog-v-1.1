<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Category;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $paginationCount = null;

    public function  __construct(){
        $this->paginationCount = 5;
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title','LIKE',"%{$query}%")
                     ->approved()->published()
                     ->orderBy('created_at', 'desc')->get()
                     // ->paginate(5)
                     ;

        $authors         =   User::all();
        $categories      =   Category::all();
        $categories_pick =   Category::inRandomOrder()->take(3)->get();
        $recomended      =   Post::approved()->published()->take(1)->where('editors_pick', 1)->orderBy('view_count', 'desc')->get();
        $moreRecomended  =   Post::where('editors_pick', 1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead        =   Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead    =   Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();
        
        return view('pages.frontend.search.search',compact('posts','authors','query',
        			'categories','categories_pick','mostRead','lessMostRead','recomended','moreRecomended'));
    }
}
