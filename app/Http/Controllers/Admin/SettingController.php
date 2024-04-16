<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;

class SettingController extends Controller
{
    public function setting(){
        $settings = Setting::all();
        return view('admin.view_setting',compact('settings'));
    }

    public function settingCreate(){
        return view('admin.create_setting');
    }

    public function settingInsert(Request $request ){
        $request->validate([
            'upiid' => 'required',
            'pixel_code' => 'required',
        ]);
       
        $settings = Setting::create([
            'upiid'      => $request->input('upiid'),
            'pixel_code'     => $request->input('pixel_code'),
        ]);

        session()->flash('success', 'Setting added successfully!');
        return redirect()->route('settings');
    }

    public function settingEdit($id){

        $settings = Setting::find($id);
        return view('admin.create_setting',compact('settings'));
    
    }

    public function settingUpdate(Request $request, $id){
        $request->validate([
            'upiid' => 'required',
            'pixel_code' => 'required',
        ]);
        $settings = Setting::find($id);

        $settings->update([
            'upiid'      => $request->input('upiid'),
            'pixel_code'     => $request->input('pixel_code'),
        ]);

        session()->flash('success', 'Setting Update successfully!');
        return redirect()->route('settings');
    }

    public function settingDestroy($id)
    {
        $settings = Setting::find($id);
        $settings->delete();
        return redirect()->back();
        session()->flash('danger', 'Setting Delete successfully!');
        return redirect()->back();
    }
}