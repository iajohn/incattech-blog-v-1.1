<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Company;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CompanyDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company   = Company::first()->get();
        return view('pages.backend.admin.company.index', compact('company'));
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
            'name'        =>  'required',
            'number'      =>  'required',
            'email'       =>  'required|email',
            'webmail'     =>  'required|email',
            'country'     =>  'required',
            'city'        =>  'required',
            'street'      =>  'required',
            'opens'       =>  'required',
            'facebook'    =>  'required|url',
            'instagram'   =>  'required|url',
            'twitter'     =>  'required|url',
            'whatsapp'    =>  'required|url',
            'youtube'     =>  'required|url',
        ]);

        $company = Company::first();

        $company->name      = request()->name;
        $company->number    = request()->number;
        $company->email     = request()->email;
        $company->webmail   = request()->webmail;
        $company->country   = request()->country;
        $company->city      = request()->city;
        $company->street    = request()->street;
        $company->open_days = request()->opens;
        $company->facebook  = request()->facebook;
        $company->instagram = request()->instagram;
        $company->whatsapp  = request()->whatsapp;
        $company->twitter   = request()->twitter;
        $company->youtube   = request()->youtube;

        $company->save();

        Toastr::success('Settings has been saved Successfully','Success');
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $company   = Company::first();
        return view('pages.backend.admin.company.about', compact('company'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function about_update(Request $request)
    {
        $this->validate($request,[
            'about'  =>  'required',
        ]);

        $company = Company::first();
        $company->about_body  = request()->about;

        if ($company->save()) {
            Toastr::success('Company About Settings has been saved Successfully','Success');
            return redirect()->route('admin.company-settings');
        }else{
            return redirect()->back();
        };
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function policy()
    {
        $company   = Company::first();
        return view('pages.backend.admin.company.policy', compact('company'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function policy_update(Request $request)
    {
        $this->validate($request,[
            'policy'  =>  'required',
        ]);

        $company = Company::first();
        $company->policy_body  = request()->policy;

        if ($company->save()) {
            Toastr::success('Company Policy Settings has been saved Successfully','Success');
            return redirect()->route('admin.company-settings');
        }else{
            return redirect()->back();
        };
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $company   = Company::first();
        return view('pages.backend.admin.company.terms', compact('company'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function terms_update(Request $request)
    {
        $this->validate($request,[
            'terms'  =>  'required',
        ]);

        $company = Company::first();
        $company->terms_body  = request()->terms;

        if ($company->save()) {
            Toastr::success('Company Terms of Use Settings has been saved Successfully','Success');
            return redirect()->route('admin.company-settings');
        }else{
            return redirect()->back();
        };
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
        //
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
