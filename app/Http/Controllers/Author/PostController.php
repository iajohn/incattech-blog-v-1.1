<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Notifications\NewAuthorPost;
use App\Tag;
use App\Post;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
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
        $posts = Auth::user()->posts()->latest()->get();
        return view('pages.backend.author.post.index',compact('posts'));
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
        return view('pages.backend.author.post.create',compact('categories','tags'));
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
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $ifeaturedImg = $request->file('image');
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

        }   else {
                $featuredImgname = "default.jpg";
            }
            
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->featuredImg = $featuredImgname;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorPost($post));
        Toastr::success('Post Successfully Saved :)','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }
        return view('pages.backend.author.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.backend.author.post.edit',compact('post','categories','tags'));
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
        if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
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

        }   else {
                $featuredImgname = $post->featuredImg;
            }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->featuredImg = $featuredImgname;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated :)','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }
        if (Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
