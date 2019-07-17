<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user   = Auth::user();
        $title  = Auth::user()->username;
        // $settings = Setting::first();

        return view('pages.backend.admin.profile.profile', compact('user', 'title'));

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
    public function edit()
    {
        
        $user     =  Auth::user();
        $title    =  Auth::user()->username;
        // $settings = Setting::first();

        return view('pages.backend.admin.profile.update-profile', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'required',
            'lastname'  => 'required',
            'username'  => 'required',
            'email' => 'required|email',
            // 'image' => 'required|image',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->username);
        $user = User::findOrFail(Auth::id());

        if (isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            
            // check profile_pics dir is exists
            $path = public_path('assets/uploads/profile' );
            if(!File::exists($path)) {
                File::isDirectory($path);
            }

            //  delete old image
            $oldImagepath = public_path('assets/uploads/profile/'.$user->profile->profile_pics);
            if(File::exists($oldImagepath)) {
                File::delete($oldImagepath);
            }

            // resize image for profile_pics and upload
            Image::make($image)->resize(500,333)->save('assets/uploads/profile/' .$imageName, 100);
        
            $user->profile->profile_pics = 'assets/uploads/profile/' .$imageName;
            
        }   else {
                $Imagename = $user->profile->profile_pics;
            }

            $user->username  = $request->username;
            $user->email = $request->email;
            // $user->profile->profile_pics = 'assets/uploads/profile/' .$imageName;
            $user->profile->occupation   = $request->occupation ;
            $user->profile->company   = $request->company;
            $user->profile->hobbies   = $request->skill;
            $user->profile->facebook  = $request->facebook;
            $user->profile->instagram = $request->instagram;
            $user->profile->twitter   = $request->twitter;
            $user->profile->youtube   = $request->youtube;
            $user->profile->whatsapp  = $request->whatsapp;
            $user->profile->about     = $request->about;

            $user->save();
            $user->profile->save();
            Toastr::success('Profile Successfully Updated','Success');
            return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

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
