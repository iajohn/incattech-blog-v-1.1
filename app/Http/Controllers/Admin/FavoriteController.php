<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->favorite_posts;
        return view('pages.backend.admin.impressions.favorite',compact('posts'));
    }

    public function indexVideo()
    {
        $posts = Auth::user()->favorite_videos;
        return view('pages.backend.admin.impressions.favorite_tv',compact('posts'));
    }
}
