<?php

namespace App\Http\Controllers\Author;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use QCod\AppSettings\SavesSettings;

class SettingsController extends Controller
{
    use SavesSettings;

    public function index()
    {
        // $settings => setting()->all()

        return view('pages.backend.author.settings', compact('settings'));
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
