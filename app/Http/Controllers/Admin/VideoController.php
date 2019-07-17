<?php

namespace App\Http\Controllers\Admin;

use DB;
use Config;
use Session;
use Validator;
use App\Video;
use App\Company;
use App\Setting;
use App\Channel;
use Carbon\Carbon;
use App\Subscriber;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\NewPostNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AuthorPostApproved;
use Illuminate\Support\Facades\Notification;


class VideoController extends Controller{

    protected $paginationCount = null;

    public function  __construct(){
        $this->paginationCount = 6;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos  = Video::latest()->get();
        $title   = 'Videos';
        $company = Company::first()->get();
        return view('pages.backend.admin.tv.home',compact('videos','title','company'));
    }

    public function create(){
        $title  = 'Add New Video';
        $items  = Channel::get(array('name', 'id'));
        $company = Company::first()->get();
        return view('pages.backend.admin.tv.create', compact('title','company'))
               ->withChannels($items);
    }

    public function edit($id){
        $video  = Video::findOrFail($id);
        $title = 'Edit Videos' . $video->video_title;
        $items  = Channel::get(array('name', 'id'));
        $company = Company::first()->get();
        return view('pages.backend.admin.tv.update',compact('video','title','company'))
             ->with('video', $video)
             ->withChannels($items);
    }

    public function store(Request $request){

        $niceNames = array(
            'video_title' => 'Video Title',
            'video_desc' => 'Video Description',
            'video_details' => 'Video Details',
            'video_category' => 'Video Category',
            'video_tags' => 'Video Tags',
            'video_duration' => 'Video Duration',
            'video_image' => 'Video Image',
        );

        $this->validate($request, [
            'video_title' => 'required|min:3',
            'video_desc' => 'required|max:255',
            'video_details' => 'required|min:7',
            'video_category' => 'required',
            'video_tags' => 'required',
            'video_image' => 'required|mimes:jpg,jpeg,bmp,png|between:1,7000',
            'embed_code' => 'required_if:video_location,',
            'video_duration' => ['required', 'regex:/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/'],
        ], [], $niceNames);

        $slug = str_slug($request->input('video_title'));

        $videoImage = Input::file('video_image');
        $videoCoverUrl = $this->uploadVideoCover($videoImage);
        $duration = $this->computeDuration($request->input('video_duration'));
        
        // $videoImagename = $slug.'.'.$videoImage->getClientOriginalExtension();
        // $slug = str_slug($request->input('video_title'));

        $video = new Video;
        $video->video_title = $request->input('video_title');
        $video->video_slug  = $slug;
        $video->video_cover_location = $videoCoverUrl;
        $video->video_details = $request->input('video_details');
        $video->video_desc = $request->input('video_desc');
        $video->video_channel = $request->input('video_category[]');
        $video->video_tags = $request->input('video_tags');
        $video->video_duration = $duration;
        $video->video_access = $request->input('video_access');
        $video->video_type = $request->input('video_type');
        $video->video_source = $this->getVideoSource($request->input('video_location'), $request->input('embed_code'));
        $video->featured = $request->input('featured');
        $video->active = $request->input('active');
        $video->created_by = Auth::user()->id;
        if(isset($request->status))
        {
            $video->status = true;
        }else {
            $video->status = false;
        }
        $video->is_approved = true;
        $video->save();

        $video->channels()->attach($request->video_category);
        // $video->vtags()->attach($request->video_tags);

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber)
        {
            Notification::route('mail',$subscriber->email)
                ->notify(new NewVideoNotify($video));
        }
        // $video->save();

        Toastr::success('Post Successfully Saved','Success');
        return redirect()->back();

    }

    public function update(Request $request, $id){
        $niceNames = array(
            'video_title' => 'Video Title',
            'video_desc' => 'Video Description',
            'video_details' => 'Video Details',
            'video_category' => 'Video Category',
            'video_tags' => 'Video Tags',
            'video_duration' => 'Video Duration',
        );

        $this->validate($request, [
            'video_title' => 'required|min:3',
            'video_desc' => 'required|max:255',
            'video_details' => 'required|min:7',
            'video_category' => 'required',
            'video_tags' => 'required',
            'embed_code' => 'required_if:video_location,',
            'video_duration' => ['required', 'regex:/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/'],
        ], [], $niceNames);

        $slug = str_slug($request->input('video_title'));
        
        $video = Video::findOrFail($id);
        $videoCoverUrl = $video->video_cover_location;
        $duration = $this->computeDuration($request->input('video_duration'));

        if($request->hasFile('video_image')) {
            $this->deleteCoverImage($videoCoverUrl);
            $videoImage = Input::file('video_image');
            $videoCoverUrl = $this->uploadVideoCover($videoImage);
            // $videoImgname = $slug.'.'.$videoImage->getClientOriginalExtension();
        }

        if($video->video_type == "file" && $request->has('embed_code')){
            $this->deleteVideoSource($video->video_source);
        }

        if($video->video_type == "file" && ($video->video_source != $request->input('video_location'))){
            $this->deleteVideoSource($video->video_source);
        }


        $video->video_title = $request->input('video_title');
        $video->video_slug = $slug;
        $video->video_cover_location = $videoCoverUrl;
        $video->video_details = $request->input('video_details');
        $video->video_desc = $request->input('video_desc');
        // $video->video_channel = $request->input('video_category');
        $video->video_tags = $request->input('video_tags');
        $video->video_duration = $duration;
        $video->video_access = $request->input('video_access');
        $video->video_type = $request->input('video_type');
        $video->video_source = $this->getVideoSource($request->input('video_location'), $request->input('embed_code'));
        $video->featured = $request->input('featured');
        $video->active = $request->input('active');

        $video->save();
        $video->channels()->sync($request->video_category);

        Toastr::success('Video Successfully Updated','Success');
        return redirect()->route('admin.tv.index');
    }

    private function deleteVideoSource($video_source){
        $sourceLoc = explode('/', $video_source);
        Storage::disk('s3')->delete("/". $sourceLoc[4] . "/" . $sourceLoc[5]);
    }

    private function deleteCoverImage($coverLocation){
        $coverLoc = explode(DIRECTORY_SEPARATOR, $coverLocation);
        unset($coverLoc[3]);
        File::delete(public_path($coverLocation));
        File::deleteDirectory(public_path(implode(DIRECTORY_SEPARATOR, $coverLoc)));
    }

    private function getVideoSource($file, $embed){
        return trim($file) === "" ? $embed : $file;
    }
    private function computeDuration($duration){
        $duration_arr = explode(':', $duration);
        $duration_arr[0] = array_has($duration_arr, 0) ? $duration_arr[0] : '00';
        $duration_arr[1] = array_has($duration_arr, 1) ? $duration_arr[1] : '00';
        $duration_arr[2] = array_has($duration_arr, 2) ? $duration_arr[2] : '00';
        return implode(':', $duration_arr);
    }

    private function uploadVideoCover($videoImage){
        $currentDate = Carbon::now()->toDateString();
        $uploadPath = "assets" . '/' ."uploads" . '/'."tv" . '/' . $currentDate.'-'.uniqid() . '/';
        $destinationPath = public_path().'/'.$uploadPath;
        $filename = $videoImage->getClientOriginalName();
        $videoImage->move($destinationPath, $filename);
        return $uploadPath . $filename;
    }

    public function uploadFiles(Request $request){

        $validator = Validator::make($request->all(), [
            'file' => 'mimetypes:video/avi,video/mp4,video/ogg,video/webm,video/x-msvideo,video/x-flv|max:1048900'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Video File',
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }


        $file = $request->file('file');
        $fileName = time() . '/' . $request->file('file')->getClientOriginalName();
        $status = Storage::disk('s3')->put($fileName, file_get_contents($file));
        $fileUrl = "https://s3-" . env('S3_REGION') . ".amazonaws.com/" . env('S3_BUCKET') . "/" . $fileName;
        if ($status) {
            return response()->json([
                'success' => true,
                'message' => $fileUrl,
                'code' => 200
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Internal Error',
                'code' => 400
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('pages.backend.admin.tv.show',compact('post'));
    }

    public function pending()
    {
        $posts = Video::where('is_approved',false)->get();
        $company = Company::first()->get();
        return view('pages.backend.admin.tv.pending',compact('posts','company'));
    }

    public function approval($id)
    {
        $post = Video::find($id);
        if ($post->is_approved == false)
        {
            $post->is_approved = true;
            $post->save();
            $post->user->notify(new AuthorPostApproved($post));

            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber)
            {
                Notification::route('mail',$subscriber->email)
                    ->notify(new NewVideoNotify($post));
            }

            Toastr::success('Video Successfully Approved','Success');
        } else {
            Toastr::info('This Video is already approved','Info');
        }
        return redirect()->back();
    }

    /**
     * Change Posts Editors Pick.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editors($id)
    {
        $post = Video::find($id);

        $post->editors_pick = 1;

        $post->save();

        if ($post->save()) {
            Toastr::success('Successfully pick post.','Success');
        } else {
            Toastr::info('This Post can not be picked.','Info');
        }

        return redirect()->back();

    }

    public function not_editors($id)
    {
        $post = Video::find($id);

        $post->editors_pick = 0;

        $post->save();

        if ($post->save()) {
            Toastr::success('Successfully removed post.','Success');
        } else {
            Toastr::info('This Post can not be removed.','Info');
        }

        return redirect()->back();

    }

    /**
     * Temporary Remove the specified resource from storage .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $video   =   Video::find($id);

        $video->delete();

        Toastr::success('Video was trashed successfully.','Success');

        return redirect()->route('admin.tv.index');
    }

    /**
     * Display a listing of trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {

        $videos    = Video::onlyTrashed()->get();
        $title    = 'Trashed Videos';
        $settings = Setting::first();

        return view('pages.backend.admin.tv.trashed', compact('posts', 'title', 'settings'));
    }

    /**
     * Restore deleted resource back into storage .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {

        $video = Video::withTrashed()->where('id', $id)->first();

        $video->restore();

        Toastr::success('Video restored successfully.','Success');

        return redirect()->route('admin.video.index');
    }

    // public function destroy($id){
    //     $video = Video::findOrFail($id);
    //     $this->deleteCoverImage($video->video_cover_location);
    //     if($video->video_type == "file"){
    //         $this->deleteVideoSource($video->video_source);
    //     }
    //     $video->delete();

    //     return redirect()->back()->with('info', 'Video deleted successfully');
    // }

}
