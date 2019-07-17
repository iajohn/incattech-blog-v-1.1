<?php

namespace App\Http\Controllers;

use App\Category;
use App\Channel;
use App\Post;
use App\Tag;
use App\Video;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
    	$posts 		= Post::all()->first();
    	$categories = Category::all()->first();
    	$tags 		= Tag::all()->first();
    	$videos 	= Video::all()->first();
    	$channels 	= Channel::all()->first();

    	return response()->view('sitemap.index',[
    		'articles' 		=> $posts,
    		'categories' 	=> $categories,
    		'tags'			=> $tags,
    		'videos'		=> $videos,
    		'channels'		=> $channels,
    	])->header('Content-Type', 'text/xml');
    }

    public function posts()
    {
        $posts = Post::latest()->approved()->published()->get();
        return response()->view('sitemap.articles', [
            'articles' => $posts,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function tags()
    {
        $tags = Tag::all();
        return response()->view('sitemap.tags', [
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }

    public function videos()
    {
        $videos = Video::latest()->approved()->published()->get();
        return response()->view('sitemap.videos', [
            'videos' => $videos,
        ])->header('Content-Type', 'text/xml');
    }

    public function videoTags()
    {
        $tags = [];
        $items  = Video::get(['video_tags']);
        foreach($items as $item){
            array_push($tags, $item->video_tags);
        }
        $tagsString = implode(',', $tags);
        $taging = explode(',', $tagsString);
        return response()->view('sitemap.videotags', [
            'videotags' => $taging,
        ])->header('Content-Type', 'text/xml');
    }

    public function channels()
    {
        $channels = Channel::all();
        return response()->view('sitemap.channels', [
            'channels' => $channels,
        ])->header('Content-Type', 'text/xml');
    }
}
