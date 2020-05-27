<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(Request $request)
	{
      
        return view('print.index');
   
	}
}
