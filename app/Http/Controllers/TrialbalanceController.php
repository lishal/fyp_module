<?php

namespace App\Http\Controllers;

use App\FiscalYear;

class TrialbalanceController extends Controller
{
    public function index($fiscal_year_id = 0){
       
        $fiscalYears= FiscalYear::all();

        return view ('trialbalance.index',[
            'fiscalYears'=>$fiscalYears
        ]);
    
    }
    public function store(Request $request)
    {
        
    }
}
