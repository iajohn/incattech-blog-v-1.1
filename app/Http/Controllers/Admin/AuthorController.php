<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Profile;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index()
    {
       $authors = User::authors()
           ->withCount('posts')
           ->withCount('comments')
           ->withCount('favorite_posts')
           ->get();
       return view('pages.backend.admin.users.authors.index',compact('authors'));
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
            'firstname'       =>  'required',
            'lastname'        =>  'required',
            'username'        =>  'required',
            'email'           =>  'required|email',
            
        ]);

        $user = User::create([
            'firstname'   => $request->firstname,
            'lastname'    => $request->lastname,
            'username'    => $request->username,
            'email'       => $request->email,
            'password'    => bcrypt('author')
        ]);

        $profile = Profile::create([
            'user_id'   => $user->id,
            'profile_pics'  => 'assets/uploads/authorpics/dp.png',
            'facebook'  => 'https://facebook.com/',
            'instagram' => 'https://instagram.com/',
            'twitter'   => 'https://twitter.com/',
            'youtube'   => 'https://youtube.com/',
            'whatsapp'  => 'https://api.whatsapp.com/send?phone=',
        ]);
        
        $user->save();
        $user->profile()->save($profile);
        
        Toastr::success('New Author Added Successfully.', 'Success');

        return redirect()->route('admin.author.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname'   =>  'required',
            'lastname'    =>  'required',
            'username'    =>  'required',
            'email'       =>  'required|email',
            // 'facebook'    =>  'required|url',
            // 'instagram'   =>  'required|url',
            // 'twitter'     =>  'required|url',
            // 'youtube'     =>  'required|url',
            // 'whatsapp'    =>  'required|url',
        ]);

        $user  = User::findorfail($id);

        if($user) {
            $user->firstname      = $request->firstname;
            $user->lastname       = $request->lastname;
            $user->username       = $request->username;
            $user->email          = $request->email;

        }
        if( $user->save() ) {
            $profile = Profile::where('user_id', $user->id)->first();

            if($request->hasFile('image'))
            {

                $image = $request->image;

                $image_new_name = time().'-'.$image->getClientOriginalName();

                $image->move('assets/uploads/authorpics', $image_new_name);

                $profile->profile_pics = 'assets/uploads/authorpics/' . $image_new_name;
                
            }
            
        }

        if($profile->save()) {
            Toastr::success('Author Profile Updated Successfully.','Success');
            return redirect()->route('admin.author.profile', ['id' => $user->id ]);

        } else {
            Toastr::error('Author Profile Failed To Update.','Error');
            return redirect()->back();
        }

    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $author  = User::findorfail($id);

        $hashedPassword = $author->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $author = User::findorfail($id);
                $author->password = Hash::make($request->password);
                $author->save();
                Toastr::success('Author Password Successfully Changed','Success');
                Auth::logout();
                return redirect()->route('admin.author.profile', ['id' => $author->id ]);
                
            } else {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }

    }

    public function profile($id)
    {
        $users     = Auth::user();
        $user      = User::find($id);
        $title     = 'Profile';
        // $settings = Setting::first();

        return view('pages.backend.admin.users.authors.profile', compact('user', 'title'));

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile_edit($id)
    {
        
        $users      = Auth::user();
        $user       = User::find($id);
        $user_count = User::where('role_id',2)->get();
        $title      = 'Update Profile';
        // $settings = Setting::first();

        return view('pages.backend.admin.users.authors.update-profile', compact('users', 'user', 'user_count', 'title'));
    }

    /**
     * Temporary Remove the specified resource from storage .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $author = User::find($id);

        foreach ($author->posts as $post) {
           $post->delete();
        }

        $author->delete();

        Toastr::success('Author was trashed successfully.','Success');

        return redirect()->route('admin.author.index');
    }

    /**
     * Remove the specified resource from storage .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $author  =    User::withTrashed()->where('id', $id)->first();

        foreach ($author->posts as $post) {
           $post->forceDelete();
        }

        $user->forceDelete();

        Toastr::success('Author deleted permanently.','Success');

        return redirect()->back();
    }

    /**
     * Display a listing of trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {

        $authors    = User::onlyTrashed()->get();
        $title    = 'Trashed Authors';
        // $settings = Setting::first();

        return view('pages.backend.admin.users.authors.trashed', compact('authors', 'title'));
    }

    /**
     * Restore deleted resource back into storage .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {

        $author = User::withTrashed()->where('id', $id)->first();
        foreach ($author->posts as $post) {
           $post->restore();
        }
        $author->restore();

        Toastr::success('Author restored successfully.','Success');

        return redirect()->route('admin.author.index');
    }

    // public function destroy($id)
    // {
    //     $author = User::findOrFail($id)->delete();
    //     Toastr::success('Author Successfully Deleted','Success');
    //     return redirect()->back();
    // }
}
