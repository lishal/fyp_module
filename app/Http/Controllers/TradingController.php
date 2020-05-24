<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradingController extends Controller
{
    public function index(){
        return view('trading.index');
    }

    public function store(Request $request)
    {
         $documents =  DB::table('settings')->where('settings_name','Closingstock')->update([

            'settings_description' => $request->input('closing_stock'),
         ]);
        return redirect('admin/trading');
    }
}
