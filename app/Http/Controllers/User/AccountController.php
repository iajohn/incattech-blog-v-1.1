<?php

namespace App\Http\Controllers\User;

use App\User;
use Carbon\Carbon;
use DB;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    protected $authUser;
    public function __construct(){
        $this->authUser = Auth::user();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user       = Auth::user();
        $title      = Auth::user()->username;
        $fav_posts  = $user->favorite_posts()->approved()->published()->get();

        return view('pages.frontend.account.index', compact('title','user','fav_posts'))
               ->withFavorites($this->getUserFavourites());
               // ->with('profile', $this->authUser)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(){
        $user   = Auth::user();
        $title  = 'Edit Profile';
        return view('pages.frontend.account.edit', compact('title','user'));
               // ->with('profile', $this->authUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $niceNames = array(
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'username' => 'Username',
            'avatar' => 'Avatar'
            // 'new_password' => 'New Password',
        );

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
        ], [], $niceNames);


        $user = User::findOrFail(Auth::user()->id);
        $userPics = $user->profile->profile_pics;

        if($request->hasFile('profile_pics')){
            $this->validate($request, [
                'profile_pics' => 'mimes:jpg,jpeg,bmp,png|between:1,7000',
            ], [], $niceNames);
            if(!str_contains($user->profile->profile_pics, 'facebook')){
                $this->deleteAvatar($user->profile->profile_pics);
            }

            $this->deleteAvatar($userPics);
            $avatar = Input::file('profile_pics');
            $profilePicsUrl = $this->uploadAvatar($avatar);
            
            $user->profile->profile_pics = $profilePicsUrl;
            // $user->profile->profile_pics = URL::asset($avatar);
        }

        $user->firstname = $request->input('firstname');
        $user->lastname  = $request->input('lastname');
        $user->username  = $request->input('username');
        
        $user->save();
        $user->profile->save();
        Toastr::success('Profile Successfully Updated','Success');
        return redirect()->route('user.account.edit')->with('info', 'Profile Updated successfully');

    }

    public function updatePassword(Request $request)
    {
        $niceNames = array(
            'old_password' => 'Old Password',
            'password' => 'Password',
        );

        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [], $niceNames);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed','Success');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }

    }

    private function deleteAvatar($coverLocation){
        if($coverLocation != "") {
            $coverLoc = explode(DIRECTORY_SEPARATOR, $coverLocation);
            unset($coverLoc[0], $coverLoc[1], $coverLoc[2]);
            $coverLocation = public_path(implode(DIRECTORY_SEPARATOR, $coverLoc));
            unset($coverLoc[5]);
            File::delete($coverLocation);
            File::deleteDirectory(public_path(implode(DIRECTORY_SEPARATOR, $coverLoc)));
        }
    }

    private function uploadAvatar($featuredImage){
        $currentDate = Carbon::now()->toDateString();
        $uploadPath = "assets".DIRECTORY_SEPARATOR."uploads" .DIRECTORY_SEPARATOR."profile".DIRECTORY_SEPARATOR."regular".DIRECTORY_SEPARATOR. $currentDate.'-'.uniqid().DIRECTORY_SEPARATOR;
        // $uploadPath = "assets" . '/' . "uploads" . '/' . "profile" .'/' . time() . DIRECTORY_SEPARATOR;
        $destinationPath = public_path(). '/' .$uploadPath;
        $filename = $featuredImage->getClientOriginalName();
        $featuredImage->move($destinationPath, $filename);
        return $uploadPath . $filename;
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

    private function getUserFavourites(){
        $user   = Auth::user();
        $FAVORITE_VIDEO = Config::get('constants.FAVORITE_VIDEO');
        return $user->seenVideos()->where('operation_type','=', $FAVORITE_VIDEO)->get();
    }
}
