<?php

namespace App\Http\Controllers;

use App\Video;
use App\Category;
use App\Channel;
use App\Company;
use App\Setting;
use Auth;
use Config;
use DB;
use Carbon\Carbon;
use Validator;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller{

    protected $paginationCount = null;

    public function  __construct(){
        $this->paginationCount = 6;
    }

    public function details(Request $request, $slug){
        $video = Video::where('video_slug',$slug)->approved()->published()->first();
        $dt = Carbon::now();
        $hasSubscribe = false;
        if (Auth::check()) {
            $loggedInUser = Auth::user()->id;
            $VIEW_VIDEO = Config::get('constants.VIEW_VIDEO');
            $FAVORITE_VIDEO = Config::get('constants.FAVORITE_VIDEO');
            $exists = $video->users()->where('user_id','=', $loggedInUser)
                ->where('video_id','=', $video->id)->where('operation_type','=', $VIEW_VIDEO)->count();
            if($exists < 1){
                $video->users()->attach($loggedInUser, ['operation_type' => $VIEW_VIDEO]);
                $blogKey = 'blog_' . $video->id;
                if (!Session::has($blogKey)) {
                    $video->increment('video_views');
                    Session::put($blogKey,1);
                }
                // $video->video_views = intval($video->video_views + 1);
                $video->save();
            }
            $video->isFavourite = $video->users()->where('user_id','=', $loggedInUser)
                ->where('video_id','=', $video->id)->where('operation_type','=', $FAVORITE_VIDEO)->count() > 0;

            //check if user has subscribed
            $hasSubscribe = (DB::table("users")
                ->join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
                ->where('subscriptions.user_id', '=', Auth::user()->id)
                ->where('subscriptions.started_time','<=',$dt)
                ->where('subscriptions.end_time','>=',$dt)
                ->count() != 0) ? true : false;
        }

        $next_post    = Video::where('id', '>', $video->id)->min('id');
        $prev_post    = Video::where('id', '<', $video->id)->max('id');

        return view('pages.frontend.tv.show')->with('video', $video)->withTags(explode(',', $video->video_tags))
            ->with("systemTags", self::getTags())->with("mostViewVideos", self::getMostViewVideo())
            ->with("mostRecentVideos", self::getRecentVideos())
            ->with("subscription_status", $hasSubscribe)
            ->with('next', Video::find($next_post))
            ->with('prev', Video::find($prev_post));
    }

    public function favoriteVideo($id){
        $video = Video::find($id);
        if (Auth::check()) {
            $loggedInUser = Auth::user()->id;
            $FAVORITE_VIDEO = Config::get('constants.FAVORITE_VIDEO');
            $exists = $video->users()->where('user_id','=', $loggedInUser)
                ->where('video_id','=', $id)->where('operation_type','=', $FAVORITE_VIDEO)->count();
            if($exists < 1){
                $video->users()->attach($loggedInUser, ['operation_type' => $FAVORITE_VIDEO]);
                $video->video_favorites = intval($video->video_favorites + 1);
            } else {
                DB::table('user_video')->where('user_id', '=', $loggedInUser)
                    ->where('video_id', '=', $id)->where('operation_type', '=', $FAVORITE_VIDEO)->delete();
                $video->video_favorites = intval($video->video_favorites - 1);
            }
            $video->save();
            return response()->json(['message' => 'done', "favorite" => $video->video_favorites]);
        }
    }

    public function getOperationVideo(Request $request, $operation, $value){
        if($operation == "channel"){
            $category = Channel::where('slug',$value)->first();
            $videos   = $category->videos()->approved()->published()
                      ->orderBy('created_at', 'desc')
                      ->paginate($this->paginationCount);

            if($videos->isEmpty()) {
                $category = Channel::where("slug", "=", $value)->limit(1)->get();
                $title = "Tv Channel - " .$category[0]->name;
            } else
                $title = "Tv Channel - " . $category->name;

            return view('pages.frontend.tv.operations')->withVideos($videos)
                ->with("operationTitle", $title);
        } else if($operation == "tag"){
            $videos = DB::table('videos')->where('video_tags','LIKE',"%{$value}%")
                ->paginate($this->paginationCount);
            return view('pages.frontend.tv.operations')->withVideos($videos)
                ->with("operationTitle", "Videos tagged with \"{$value}\"");
        } else if($operation == "search"){
            $value = $request->input('search');
            $videos = DB::table('videos')->where('video_details','LIKE',"%{$value}%")
                ->orWhere('video_desc','LIKE',"%{$value}%")
                ->orWhere('video_title','LIKE',"%{$value}%")
                ->paginate($this->paginationCount);
            return view('pages.frontend.tv.operations')->withVideos($videos)
                ->with("operationTitle", "Search Video: \"{$value}\"");
        }
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

    // private function getMostViewVideo(int $limit = 2){
    //     return Video::orderBy('video_views', 'desc')->limit($limit)->get();
    // }

    // private function getRecentVideos(int $limit = 3){
    //     return Video::orderBy('created_at', 'desc')->limit($limit)->get();
    // }
}
