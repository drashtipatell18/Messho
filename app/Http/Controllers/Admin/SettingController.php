<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function setting(){
        return view('admin_view_setting');
    }
}