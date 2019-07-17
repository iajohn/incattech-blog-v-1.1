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
// use QCod\AppSettings\SavesSettings;

class SettingsController extends Controller
{
    // use SavesSettings;

    public function index()
    {
        $company   = Company::first();
        return view('pages.backend.admin.settings.settings', compact('company'));
    }

    public function store(Request $request)
    {
        $rules = Setting::getValidationRules();
        $data = $this->validate($request, $rules);

        $validSettings = array_keys($rules);

        foreach ($data as $key => $val) {
            if (in_array($key, $validSettings)) {
                Setting::add($key, $val, Setting::getDataType($key));
            }
        }

        Toastr::success('Settings has been saved Successfully','Success');
        return redirect()->back();
        // ->with('status', 'Settings has been saved.');
    }

}
