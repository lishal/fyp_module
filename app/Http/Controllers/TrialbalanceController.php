<?php

namespace App\Http\Controllers;



class TrialbalanceController extends Controller
{
    public function index($fiscal_year_id = 0){
       
       

        return view ('trialbalance.index');
    
    }
    public function store(Request $request)
    {
        
    }
}
