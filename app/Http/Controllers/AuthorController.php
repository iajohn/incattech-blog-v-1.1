<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use App\Category;
use App\Setting;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $title           =   Auth::user()->username;
        $authors         =   User::whereRole_id(2)
                                 ->orWhere('role_id', 1)->get();
        $posts           =   Post::latest()->approved()->published()->orderBy('created_at', 'desc')->get();
        $categories      =   Category::all();
        $categories_pick =   Category::inRandomOrder()->take(3)->get();
        $recomended      =   Post::approved()->published()->take(1)->whereEditors_pick(1)->orderBy('view_count', 'desc')->get();
        $moreRecomended  =   Post::whereEditors_pick(1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead        =   Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead    =   Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();
        $settings        =   Setting::getAllSettings();
        
        return view('pages.frontend.profile.index',compact('title','authors','posts','fav_posts','categories','categories_pick',
                    'mostRead','lessMostRead','recomended','moreRecomended','settings'));
    }

    public function profile($username)
    {
        $title           =   Auth::user()->username;
        $author  = User::where('username',$username)->get()->first();
        $authors         =   User::whereRole_id(2)
                                 ->orWhere('role_id', 1)->get();
        $users   = User::where('role_id', 3)->get();
        $posts   = $author->posts()->approved()->published()->orderBy('created_at', 'desc')->get();
        $fav_posts  = $author->favorite_posts()->approved()->published()->get();
        $categories      = Category::all();
        $categories_pick = Category::inRandomOrder()->take(3)->get();
        $recomended      =   Post::approved()->published()->take(1)->where('editors_pick', 1)->orderBy('view_count', 'desc')->get();
        $moreRecomended  =   Post::where('editors_pick', 1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead        =   Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead    =   Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();
        $settings        =   Setting::getAllSettings();
        
        return view('pages.frontend.profile.profile',compact('title','author','authors','users','posts','fav_posts',
        	        'categories','categories_pick','mostRead','lessMostRead','recomended','moreRecomended','settings'));
    }
}
