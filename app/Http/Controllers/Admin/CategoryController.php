<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('pages.backend.admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.admin.category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);
        // get form image
        $featuredImg = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($featuredImg))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$featuredImg->getClientOriginalExtension();
            
            // check category dir is exists
            $path = public_path('assets/uploads/category' );
            if(!File::exists($path)) {
                File::isDirectory($path);
            }

            // resize image for category and upload
            Image::make($featuredImg)->resize(1600,479)->save('assets/uploads/category/' .$featuredImgname, 100);

            // check category slider dir is exists
            $sliderPath = public_path('assets/uploads/category/slider' );
            if (!File::exists($path))
            {
                File::isDirectory($path);
            }

            // resize image for category slider and upload
            Image::make($featuredImg)->resize(465,298)->save('assets/uploads/category/slider/' .$featuredImgname, 100);
        }else {
            $featuredImgname = "default.png";
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->featuredImg = $featuredImgname;
        $category->save();
        Toastr::success('Category Successfully Saved :)' ,'Success');
        return redirect()->route('admin.category.index');

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
        $category = Category::find($id);
        return view('pages.backend.admin.category.edit',compact('category'));
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
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ]);
        // get form image
        $featuredImg = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);

        if (isset($featuredImg))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $featuredImgname = $slug.'-'.$currentDate.'-'.uniqid().'.'.$featuredImg->getClientOriginalExtension();
            
            // check category dir is exists
            $path = public_path('assets/uploads/category' );
            if(!File::exists($path)) {
                File::isDirectory($path);
            }

            //  delete old image
            $oldImagepath = public_path('assets/uploads/category/'.$category->featuredImg);
            if(File::exists($oldImagepath)) {
                File::delete($oldImagepath);
            }

            // resize image for category and upload
            Image::make($featuredImg)->resize(1600,479)->save('assets/uploads/category/' .$featuredImgname, 100);

            // check category slider dir is exists
            $sliderPath = public_path('assets/uploads/category/slider' );
            if (!File::exists($path))
            {
                File::isDirectory($path);
            }

            //  delete old image
            $oldSliderpath = public_path('assets/uploads/category/slider/'.$category->featuredImg);
            if(File::exists($oldSliderpath)) {
                File::delete($oldSliderpath);
            }

            // resize image for category slider and upload
            Image::make($featuredImg)->resize(465,298)->save('assets/uploads/category/slider/' .$featuredImgname, 100);
        }else {
            $featuredImgname = $category->featuredImg;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->featuredImg = $featuredImgname;
        $category->save();
        Toastr::success('Category Successfully Updated :)' ,'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }

        if (Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }
        $category->delete();
        Toastr::success('Category Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
