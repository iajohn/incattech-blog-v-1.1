<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($post)
    {
        $user = Auth::user();
        $isFavorite = $user->favorite_posts()->where('post_id',$post)->count();

        if ($isFavorite == 0)
        {
            $user->favorite_posts()->attach($post);
            Toastr::success('Post successfully added to your heart list','Success');
            return redirect()->back();
        } else {
            $user->favorite_posts()->detach($post);
            Toastr::success('Post successfully removed form your heart list','Success');
            return redirect()->back();
        }
    }

    public function add_tv($video)
    {
        $user = Auth::user();
        $isFavorite = $user->favorite_videos()->where('id',$video)->count();

        if ($isFavorite == 0)
        {
            $user->favorite_videos()->attach($video);
            Toastr::success('Video successfully added to your heart list','Success');
            return redirect()->back();
        } else {
            $user->favorite_videos()->detach($video);
            Toastr::success('Video successfully removed form your heart list','Success');
            return redirect()->back();
        }
    }
}
