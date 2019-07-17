<?php

namespace App\Http\Controllers;

use Mail;
use App\Tag;
use App\Post;
use App\Video;
use App\Channel;
use App\Setting;
use App\Company;
use App\Category;
use Spatie\Sitemap\SitemapGenerator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   
        $title                 =   'Home';
        $categories            =   Category::all();
        $categories_pick       =   Category::inRandomOrder()->take(3)->get();
        $categories_pick_right =   Category::skip(3)->take(3)->get();
        $posts                 =   Post::latest()->approved()->published()->get();
        $trendng_posts         =   Post::approved()->published()->withCount('favorite_to_users')
                                     ->orderBy('view_count','desc')
                                     ->orderBy('favorite_to_users_count','desc')->take(4)
                                     ->get();
        $randomPosts           =   Post::latest()->approved()->published()->take(6)->inRandomOrder('view_count', 'desc')->get();
        $editors_pick          =   Post::where('editors_pick', 1)->latest()->approved()->published()->orderBy('created_at', 'desc')->get();
        $tags                  =   Tag::all();
        $recomended            =   Post::approved()->published()->take(1)->where('editors_pick', 1)->orderBy('view_count', 'desc')->get();
        $moreRecomended        =   Post::where('editors_pick', 1)->approved()->published()->skip(3)->take(3)->orderBy('view_count', 'desc')->get();
        $mostRead              =   Post::approved()->published()->take(1)->orderBy('view_count', 'desc')->get();
        $lessMostRead          =   Post::approved()->published()->skip(1)->take(3)->orderBy('view_count', 'desc')->get();

        $latest_first          =   Post::latest()->approved()->published()->take(1)->orderBy('created_at', 'desc')->get();
        $latest_second         =   Post::latest()->approved()->published()->skip(1)->take(1)->orderBy('created_at', 'desc')->get();
        $latest_third          =   Post::latest()->approved()->published()->skip(2)->take(1)->orderBy('created_at', 'desc')->get();
        $latest_top            =   Post::latest()->approved()->published()->take(4)->orderBy('created_at', 'desc')->get();
        $latest_bottom         =   Post::latest()->approved()->published()->skip(1)->take(6)->orderBy('created_at', 'desc')->get();
        
        $featuredVideo         =   $this->getFeaturedVideos();
        $vidcategories         =   $this->getCategories();
        $count                 =   $this->getTotalVideos();
        // $video                 =   $this->getRecentWithPagination();

        $_1post                =   Category::find(1);
        $_2post                =   Category::find(2);
        $_3post                =   Category::find(3);
        $_4post                =   Category::find(4);
        $_5post                =   Category::find(5);
        $_6post                =   Category::find(6);
        $_7post                =   Category::find(7);
        $_8post                =   Category::find(8);
        // $_9post                =   Category::find(9);
        // $_10post               =   Category::find(10);
        // $_11post               =   Category::find(11);
        $category_posts        =   Post::latest()->approved()->published()->get();
        $settings              =   Setting::getAllSettings();
        $company               =   Company::first()->get();

        return view('pages.frontend.index', compact('title','category_posts', 'title','categories','categories_pick','categories_pick_right',
                    'posts','trendng_posts','randomPosts', 'mostRead', 'recomended', 'moreRecomended','editors_pick', 'lessMostRead',
                    'latest_first','latest_second','latest_third','latest_top','latest_bottom', 'first_post', 'second_post', 'third_post', 
                    'tags', 'after_second_post','_1post', '_2post', '_3post', '_4post', '_5post', '_6post', '_7post', '_8post', '_9post', 
                    '_10post', '_11post','category', 'settings', 'company'))
               ->with('featured', $featuredVideo)
               ->withChannel($categories)->withCount($count);
    }

    public function about()
    {

        $title         = 'About';
        $desc          =  'We are Incattech.com, the publishing arm of Incattech. Incattech is a Fashion Tech & Fashion Media Company based in Lagos Nigeria.';
        $categories    = Category::all();
        $randomPosts   = Post::inRandomOrder('view_count', 'desc')->take(3)->get();
        $editors_pick  = Post::where('editors_pick', 1)->orderBy('created_at', 'desc')->get();
        $tags          = Tag::all();
        $settings      =   Setting::getAllSettings();
        $company       =   Company::first()->get();

        return view('pages.frontend.company.about', compact('title', 'desc', 'settings', 'categories', 'randomPosts', 'tags', 'mostRead', 'recomended', 'moreRecomended', 
                    'editors_pick', 'lessMostRead', 'settings', 'company'));
    }

    public function contact()
    {

        $title           = 'Contact';
        $desci           =  'We are Incattech.com, the publishing arm of Incattech. You can contact us on this page.';
        $categories      = Category::all();
        $categories_pick = Category::inRandomOrder()->take(3)->get();
        $randomPosts     = Post::inRandomOrder('view_count', 'desc')->take(3)->get();
        $editors_pick    = Post::where('editors_pick', 1)->orderBy('created_at', 'desc')->get();
        $tags            = Tag::all();
        $settings        =   Setting::getAllSettings();
        $company         =   Company::first()->get();

        return view('pages.frontend.company.contact', compact('title', 'desci', 'settings', 'categories','categories_pick', 'randomPosts', 'tags', 
                    'mostRead', 'recomended', 'moreRecomended', 'editors_pick', 'lessMostRead', 'settings','company'));
    }

    public function policy()
    {

        $title         = 'Privacy Policy';
        $categories    = Category::all();
        $randomPosts   = Post::inRandomOrder('view_count', 'desc')->take(3)->get();
        $editors_pick  = Post::where('editors_pick', 1)->orderBy('created_at', 'desc')->get();
        $tags          = Tag::all();
        $settings      =    Setting::getAllSettings();
        $company       =   Company::first()->get();

        return view('pages.frontend.company.policy', compact('title', 'settings', 'desc', 'categories', 
                    'randomPosts', 'tags', 'mostRead', 'recomended', 'moreRecomended', 
                    'editors_pick', 'lessMostRead', 'settings','company'));
    }

    public function terms()
    {

        $title         = 'Terms Of Use';
        $categories    = Category::all();
        $randomPosts   = Post::inRandomOrder('view_count', 'desc')->take(3)->get();
        $editors_pick  = Post::where('editors_pick', 1)->orderBy('created_at', 'desc')->get();
        $tags          = Tag::all();
        $settings      =    Setting::getAllSettings();
        $company       =    Company::first()->get();

        return view('pages.frontend.company.terms', compact('title', 'settings', 'desc', 'categories', 
                    'randomPosts', 'tags', 'mostRead', 'recomended', 'moreRecomended', 
                    'editors_pick', 'lessMostRead', 'settings','company'));
    }

    public function archives()
    {
        $posts = Post::latest()
                     ->approved()
                     ->published()
                     ->filter(request(['month', 'year']))
                     ->get();


        $title          = 'Archives';
        $categories     = Category::all();
        $tags           = Tag::all();
        $randomPosts    = Post::inRandomOrder('view_count', 'desc')->take(3)->get();
        $editors_pick   = Post::where('editors_pick', 1)->orderBy('created_at', 'desc')->get();
        $settings       = Setting::getAllSettings();
        $company        = Company::first()->get();
        $archives       = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
                           ->groupBy('year', 'month')
                           ->orderByRaw('min(created_at) desc')
                           ->get()
                           ->toArray();
        $top            =   Post::approved()->published()->take(5)->orderBy('view_count', 'desc')->get();

        return view('pages.frontend.archives.index', compact('title', 'settings', 'desc', 'categories', 
                    'randomPosts', 'tags', 'mostRead', 'recomended', 'moreRecomended', 
                    'editors_pick', 'lessMostRead', 'settings','company','archives','top'));
    }

    public function postContact(Request $request) {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required|email',
            'subject' => 'min:10',
            'message' => 'min:40'
        ]);


        Mail::send('pages.frontend.emails.message',[
            'bodyMessage'   => $request->message,
            'email' => $request->email,
            'name' => $request->name
        ], function($mail) use ($request){
            $mail->from($request->email, $request->name);
            $mail->to('info@incattech.com')->subject($request['subject'] );
        });
        
        // Session::flash();
        Toastr::success('success', 'Your Email was Sent!');
        return redirect()->back();
    }

    // public function store(Request $request)
    // {  
    //     request()->validate([
    //     'name'    => 'required',
    //     'email'   => 'required|email|unique:users',
    //     'subject' => 'required|min:10|unique:users',
    //     'message' => 'required|min:40|unique:users'
    //     ]);
         
    //     $data = $request->all();
    //     $check = Contact::insert($data);
    //     $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
    //     if($check){ 
    //     $arr = array('msg' => 'Successfully submit form using ajax', 'status' => true);
    //     }
    //     return Response()->json($arr);
       
    // }

    private function getTotalVideos(){
        return Video::latest()->approved()->published()->count();
    }

    private function getFeaturedVideos(){
        return Video::latest()->approved()->published()
                    ->whereFeatured(1)
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
                    ->get();
    }

    private function getCategories(){
        $categories = [];
        $items  = Channel::get();
        foreach($items as $item){
            $categories[$item->id] =  $item->name;
        }
        return $categories;
    }

}
