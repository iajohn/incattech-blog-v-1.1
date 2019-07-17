<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Channel;
use App\Company;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
class ChannelController extends Controller{

    public function index(){
        $title  = 'Video Channels';
        $items 	= Channel::orderBy('display_order')->get();
        $company = Company::first()->get();
        return view('pages.backend.admin.channel.index',compact('title','company'))
               ->withChannel($items);
    }

    /**
     * @param Request $request
     *
     */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            // 'image' => 'required|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        // get form image
        // $featuredImg = $request->file('image');
        $slug = str_slug($request->name);

        // if (isset($featuredImg))
        // {
        //     // make unique name for image
        //     $currentDate = Carbon::now()->toDateString();
        //     $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$featuredImg->getClientOriginalExtension();
            
        //     // check category dir is exists
        //     $path = public_path('assets/uploads/channel' );
        //     if(!File::exists($path)) {
        //         File::isDirectory($path);
        //     }

        //     // resize image for category and upload
        //     Image::make($featuredImg)->resize(1600,479)->save('assets/uploads/channel/' .$featuredImgname, 100);

        //     // check category slider dir is exists
        //     $sliderPath = public_path('assets/uploads/channel/slider' );
        //     if (!File::exists($path))
        //     {
        //         File::isDirectory($path);
        //     }

        //     // resize image for category slider and upload
        //     Image::make($featuredImg)->resize(465,298)->save('assets/uploads/channel/slider/' .$featuredImgname, 100);
        // }else {
        //     $featuredImgname = "default.png";
        // }

        $category_name = $request->input('name');
        Channel::create([
            'name' => $category_name,
            'slug' => $slug,
            // 'featuredImg' => $featuredImgname,
            'created_by' => Auth::User()->id,
            'edited_by' => Auth::User()->id,
            'parent_id' => 0,
            'display_order' => Channel::max('display_order') + 1
        ]);

        Toastr::success('TV Channel Successfully Saved' ,'Success');
        return redirect()->route('admin.tv-channel.index');
    }

    /**
     * Show the json for editing the specified category.
     *
     * @param  int  $id
     * @return JSON
     */
    public function edit($id){
        $category = Channel::find($id);
        $company = Company::first()->get();
        return json_encode(array('name' => $category->name, 'id' => $category->id, 'featuredImg' => $category->featuredImg));
    }

    // public function edit($id)
    // {
    //     $category = Channel::find($id);
    //     return view('pages.backend.admin.channel.edit',compact('category'));
    // }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $this->validate($request, [
            'category_name_edit' => 'required|max:255'

        ], [], array('category_name_edit' => 'Channel Name'));

        // get form image
        // $featuredImg = $request->file('image');
        $slug = str_slug($request->input('category_name_edit'));
        $category = Channel::findOrFail($request->input('category_id'));

        // if (isset($featuredImg))
        // {
        //     // make unique name for image
        //     $currentDate = Carbon::now()->toDateString();
        //     $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$featuredImg->getClientOriginalExtension();
            
        //     // check category dir is exists
        //     $path = public_path('assets/uploads/channel' );
        //     if(!File::exists($path)) {
        //         File::isDirectory($path);
        //     }

        //     //  delete old image
        //     $oldImagepath = public_path('assets/uploads/channel/'.$category->featuredImg);
        //     if(File::exists($oldImagepath)) {
        //         File::delete($oldImagepath);
        //     }

        //     // resize image for category and upload
        //     Image::make($featuredImg)->resize(1600,479)->save('assets/uploads/channel/' .$featuredImgname, 100);

        //     // check category slider dir is exists
        //     $sliderPath = public_path('assets/uploads/channel/slider' );
        //     if (!File::exists($path))
        //     {
        //         File::isDirectory($path);
        //     }

        //     //  delete old image
        //     $oldSliderpath = public_path('assets/uploads/channel/slider/'.$category->featuredImg);
        //     if(File::exists($oldSliderpath)) {
        //         File::delete($oldSliderpath);
        //     }

        //     // resize image for category slider and upload
        //     Image::make($featuredImg)->resize(465,298)->save('assets/uploads/channel/slider/' .$featuredImgname, 100);
        // }else {
        //     $featuredImgname = $category->featuredImg;
        // }

        $category->name = $request->input('category_name_edit');
        $category->slug = $slug;
        // $category->featuredImg = $featuredImgname;
        $category->edited_by = Auth::user()->id;
        $category->save();

        Toastr::success('TV Channel Successfully Updated' ,'Success');
        return redirect()->route('admin.tv-channel.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $category_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Channel::where('parent_id', $id)->get()->each(function($item) {
            $item->parent_id = 0;
            $item->save();
        });
        $category = Channel::findOrFail($id);
        // check category dir is exists
        // $path = public_path('assets/uploads/channel/'.$category->featuredImg );
        // if(!File::exists($path)) {
        //     File::delete($path);
        // }

        // check category slider dir is exists
        // $sliderPath = public_path('assets/uploads/channel/slider/'.$category->featuredImg );
        // if (File::exists($path))
        // {
        //     File::delete($path);
        // }

        $category->delete();
        Toastr::success('TV Channel Successfully Deleted :)','Success');
        return redirect()->back();

    }

    /**
     *  AJAX Reordering function
     * @param Request $request
     */
    public function order(Request $request){
        $order = $request->input('order');
        if(isset($order)){

            $categories = Channel::where('parent_id', '=', '0')->get(array('id', 'parent_id', 'display_order'));

            $to_db = $this->computeChangeApp($categories, $order);

            if (count($to_db) > 0){
                DB::update($this->queryBuilder($to_db));
            }
        }
    }
    
    /*
     * Function to create id =>[ order , parent] unnested array
     */
    private function run_array_parent_from_db($array,$parent){
        $post_db = array();
        foreach($array as $head => $body){
            if(isset($body['children'])){
                $head++;
                $post_db[$body['id']] = ['parent'=>$parent,'order'=>$head];
                $post_db = $post_db + $this->run_array_parent_from_db($body['children'],$body['id']);
            }else{
                $head++;
                $post_db[$body['id']] = ['parent'=>$parent,'order'=>$head];
            }
        }
        return $post_db;
    }


    /*
     * Function to create id =>[ order , parent] nested array
     */
    private function run_array_parent_from_app($categories){
        $from_db = array();

        foreach($categories as $category){
            $from_db[$category->id] = ['parent' => $category->parent_id,'order'=> $category->display_order];
        }

        return $from_db;
    }


    /*
     * Comparing the arrays and adding changed values to $to_db
     */
    private function computeChangeApp($categories, $order){

        $from_db = $this->run_array_parent_from_app($categories);
        $post_db = $this->run_array_parent_from_db(json_decode($order, true),'0');

        $to_db =array();
        foreach($post_db as $key => $value){
            if( !array_key_exists($key, $from_db) ||
                ($from_db[$key]['parent'] != $value['parent']) ||
                ($from_db[$key]['order'] != $value['order'])){
                $to_db[$key] = $value;
            }
        }

        return $to_db;
    }


    /*
     * Build Query to update category order
     */
    private function queryBuilder($toDB){
        $query = "UPDATE Channels";
        $query_parent = " SET parent_id = CASE id";
        $query_order = " display_order = CASE id";
        $query_ids = " WHERE id IN (". implode(", ",array_keys($toDB)) . ")";

        foreach ($toDB as $id => $value){
            $query_parent .= " WHEN " . $id . " THEN ". $value['parent'];
            $query_order .= " WHEN " . $id . " THEN ". $value['order'];
        }
        $query_parent .= " END,";
        $query_order .= " END";

        return $query. $query_parent . $query_order . $query_ids;
    }
}
