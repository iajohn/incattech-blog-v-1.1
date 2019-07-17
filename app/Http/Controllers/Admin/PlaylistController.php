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
use App\Playlist;
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

class PlaylistController extends Controller
{
    /**
     * Display a listing of video playlists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Tv Playlist';
        $playlists  = Playlist::where('created_by', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $title      = 'Playlist';
        $company    = Company::first()->get();
        return view('pages.backend.admin.playlist.home',compact('title','playlists','title','company'));
    }


    /**
     * Show the form for creating a new video playlist.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $title   = 'Create Playlist';
        $items   = Channel::get(array('name', 'id'));
        $company = Company::first()->get();
        return view('pages.backend.admin.playlist.create', compact('title','company'))
               ->withChannels($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $niceNames = array(
            'name' => 'Name',
            'image' => 'Video Image',
            'description' => 'Description',
        );

        $this->validate($request, [
            'name' => 'required|min:5',
            'image' => 'required|mimes:jpg,jpeg,bmp,png,gif|between:1,7000',
            'description' => 'required|max:255',
        ], [], $niceNames);

        $slug = str_slug($request->input('name'));

        $Image = Input::file('image');
        if (isset($Image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$Image->getClientOriginalExtension();
            
            // check category dir is exists
            $uploadPath = "assets" . '/' ."uploads" . '/'."playlist".'/';
            // $path = public_path('assets/uploads/post' );
            if(!File::exists($uploadPath)) {
                File::isDirectory($uploadPath);
            }

            // resize image for category and upload
            Image::make($Image)->resize(465,298)->save($uploadPath.$featuredImgname, 100);

        }else {
            $featuredImgname = "default.jpg";
        }

        $playlist = new Playlist;
        $playlist->name        = $request->input('name');
        $playlist->slug        = $slug;
        $playlist->featuredImg = $uploadPath.$featuredImgname;
        $playlist->description = $request->description;
        // $video->featured = $request->input('featured');
        $playlist->created_by  = Auth::user()->id;
        $playlist->edited_by = Auth::user()->id;
        if(isset($request->status))
        {
            $playlist->is_private = true;
        }else {
            $playlist->is_private = false;
        }

        $playlist->save();

        Toastr::success('Video Playlist Successfully Created','Success');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $playlist = Playlist::findOrFail($id);
        $title    = 'Edit Playlist |' .' '. $playlist->name;
        $company  = Company::first()->get();
        return view('pages.backend.admin.playlist.update',compact('title','playlist','title','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlist $playlist)
    {

        $niceNames = array(
            'name' => 'Name',
            'image' => 'Image',
            'description' => 'Description',
        );

        $this->validate($request, [
            'name' => 'required|min:5',
            'image' => 'mimes:jpg,jpeg,bmp,png,gif|between:1,7000',
            'description' => 'required|max:255',
        ], [], $niceNames);

        $slug = str_slug($request->input('name'));
        $Image = Input::file('image');

        if (isset($Image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$Image->getClientOriginalExtension();
            
            // check category dir is exists
            $path = "assets" . '/' ."uploads" . '/'."playlist".'/';
            if(!File::exists($path)) {
                File::isDirectory($path);
            }

            //  delete old image
            $oldImagepath = public_path('assets/uploads/playlist/'.$playlist->featuredImg);
            if(File::exists($oldImagepath)) {
                File::delete($oldImagepath);
            }

            // resize image for category and upload
            Image::make($Image)->resize(465,298)->save($path.$featuredImgname, 100);

        } else {
            $featuredImgname = $playlist->featuredImg;
        }

        $playlist->name = $request->name;
        $playlist->slug = $slug;
        $playlist->featuredImg = $featuredImgname;
        $playlist->description = $request->description;
        // $video->featured = $request->input('featured');
        $playlist->created_by  = Auth::id();
        $playlist->edited_by = Auth::id();
        if(isset($request->status))
        {
            $playlist->is_private = true;
        }else {
            $playlist->is_private = false;
        }
        // $video->is_approved = true;

        $playlist->save();

        Toastr::success('Video Playlist Successfully Updated','Success');
        return redirect()->route('admin.playlist.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
