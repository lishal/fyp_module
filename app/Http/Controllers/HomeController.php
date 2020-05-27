<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;
use App\Type;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $company= Company::count(); 
        $type= Type::count(); 
        // return($company);
        return view('home',['company'=>$company,'type'=>$type]);
    }
}
