<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Active;
use App\Tag;
use App\Post;
use App\User;
use App\Video;
use App\Channel;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $all_posts = Post::all();
        $posts = $user->posts;
        $popular_posts = Post::withCount('comments')
                            ->withCount('favorite_to_users')
                            ->orderBy('view_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favorite_to_users_count','desc')
                            ->take(5)->get();
        $total_pending_posts = Post::where('is_approved',false)->count();
        $total_editors_pick  = Post::where('editors_pick',true)->count();
        $all_views           = Post::sum('view_count');
        $author_count        = User::where('role_id',2)->count();
        $new_authors_today   = User::where('role_id',2)
                                ->whereDate('created_at',Carbon::today())->count();
        $active_authors      = User::where('role_id',2)
                                ->withCount('posts')
                                ->withCount('comments')
                                ->withCount('favorite_posts')
                                ->orderBy('posts_count','desc')
                                ->orderBy('comments_count','desc')
                                ->orderBy('favorite_posts_count','desc')
                                ->take(10)->get();
        $category_count      = Category::all()->count();
        $tag_count           = Tag::all()->count();

        // Guests
        $active_guests  = Active::guestsWithinHours(24)->get();
        $numberOfGuests = Active::guestsWithinHours(24)->count();

        // videos
        $all_videos =  Video::all();
        $all_video_views = Video::sum('video_views');
        $videos     =  $user->videos;
        $featuredVideo_count  = $this->getFeaturedVideosCount();
        $channel_count      = Channel::all()->count();
        // $vidtag_count       = Tag::all()->count();
        // $video_count    = $this->getTotalVideos();
        $popular_videos  = $this->getMostViewVideo();
        $total_pending_videos = Video::where('is_approved',false)->count();

        return view('pages.backend.admin.dashboard.dashboard',compact('all_posts','posts','popular_posts','total_pending_posts',
                    'total_editors_pick','all_views','author_count','new_authors_today','active_authors', 'category_count',
                    'tag_count','active_guests','numberOfGuests','all_videos','videos','featuredVideo_count','video_count','popular_videos','all_video_views',
                    'total_pending_videos','channel_count'));
    }

    private function getTotalVideos(){
        return Video::latest()->approved()->published()->count();
    }

    private function getFeaturedVideosCount(){
        return Video::latest()->approved()->published()
                    ->whereFeatured(1)->count();
    }

    private function getMostViewVideo(){
        return  Video::latest()->approved()->published()
                    ->orderBy('video_views','desc')
                    ->orderBy('video_favorites','desc')
                    ->take(5)->get();
    }
}

