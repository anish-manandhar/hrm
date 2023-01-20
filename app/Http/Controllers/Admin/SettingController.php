<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function store(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            if (is_array($value))
                Setting::where('key', $key)->update(['value' => json_encode($value)]);
            else
                Setting::where('key', $key)->update(['value' => $value]);
        }
        return back();
    }
}
