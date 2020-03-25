<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function fiscalyears(Request $request){
        return view ('Settings.fiscalyears');
    }

    public function edit(Request $request){
        return view ('Settings.fiscalyearedit');
    }
}
