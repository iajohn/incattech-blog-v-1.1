<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use App\Subscriber;
use App\Tag;
use App\Post;
use App\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('pages.backend.admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        if($categories->count() == 0 || $tags->count() == 0 ) 
        {
            Toastr::info('You must have categories and tags before creating a post. :)','info');
            return redirect()->back();
        }

        return view('pages.backend.admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'imgCredit' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $featuredImg = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($featuredImg))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$featuredImg->getClientOriginalExtension();
            
            // check category dir is exists
            $path = public_path('assets/uploads/post' );
            if(!File::exists($path)) {
                File::isDirectory($path);
            }

            // resize image for category and upload
            Image::make($featuredImg)->resize(1600,1066)->save('assets/uploads/post/' .$featuredImgname, 100);

            // check category slider dir is exists
            $sliderPath = public_path('assets/uploads/post/thumb' );
            if (!File::exists($path))
            {
                File::isDirectory($path);
            }

            // resize image for category slider and upload
            Image::make($featuredImg)->resize(964,898)->save('assets/uploads/post/thumb/' .$featuredImgname, 100);

        }else {
            $featuredImgname = "default.jpg";
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->featuredImg = $featuredImgname;
        $post->imgCredit = $request->imgCredit;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber)
        {
            Notification::route('mail',$subscriber->email)
                ->notify(new NewPostNotify($post));
        }

        Toastr::success('Post Successfully Saved','Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('pages.backend.admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.backend.admin.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' => 'required',
            'imgCredit' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $featuredImg = $request->file('image');
        $slug = str_slug($request->title);
        
        if (isset($featuredImg))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$featuredImg->getClientOriginalExtension();
            
            // check category dir is exists
            $path = public_path('assets/uploads/post' );
            if(!File::exists($path)) {
                File::isDirectory($path);
            }

            //  delete old image
            $oldImagepath = public_path('assets/uploads/post/'.$post->featuredImg);
            if(File::exists($oldImagepath)) {
                File::delete($oldImagepath);
            }

            // resize image for category and upload
            Image::make($featuredImg)->resize(1600,1066)->save('assets/uploads/post/' .$featuredImgname, 100);

            // check category slider dir is exists
            $sliderPath = public_path('assets/uploads/post/thumb' );
            if (!File::exists($path))
            {
                File::isDirectory($path);
            }

            // resize image for category slider and upload
            Image::make($featuredImg)->resize(964,898)->save('assets/uploads/post/thumb/' .$featuredImgname, 100);

        }else {
            $featuredImgname = $post->featuredImg;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->featuredImg = $featuredImgname;
        $post->imgCredit = $request->imgCredit;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        //$post->user()->attach($post->user_id);

        Toastr::success('Post Successfully Updated','Success');
        return redirect()->route('admin.post.index');
    }

    public function pending()
    {
        $posts = Post::where('is_approved',false)->get();
        return view('pages.backend.admin.post.pending',compact('posts'));
    }

    public function approval($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false)
        {
            $post->is_approved = true;
            $post->save();
            $post->user->notify(new AuthorPostApproved($post));

            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber)
            {
                Notification::route('mail',$subscriber->email)
                    ->notify(new NewPostNotify($post));
            }

            Toastr::success('Post Successfully Approved','Success');
        } else {
            Toastr::info('This Post is already approved','Info');
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
        $post = Post::find($id);

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
        $post = Post::find($id);

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

        $post   =   Post::find($id);

        $post->delete();

        Toastr::success('Post was trashed successfully.','Success');

        return redirect()->route('admin.post.index');
    }


    /**
     * Display a listing of trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {

        $posts    = Post::onlyTrashed()->get();
        $title    = 'Trashed Posts';
        $settings = Setting::first();

        return view('pages.backend.admin.post.trashed', compact('posts', 'title', 'settings'));
    }

    /**
     * Restore deleted resource back into storage .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {

        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();

        Toastr::success('Post restored successfully.','Success');

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $path = public_path('assets/uploads/post' );
        if(File::exists($path.$post->featuredImg)) {
            File::delete($path.$post->featuredImg);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
