<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\FiscalYear;

class RecordsController extends Controller
{
    public function show($company_id,$fiscal_year_id)
    {
        $company    = Company::find($company_id);
        $fiscalYear = FiscalYear::find($fiscal_year_id);
        $fiscalYears = FiscalYear::all();
        $current_fiscal_year    = FiscalYear::where('id', $fiscal_year_id)->first();

        return view('records.record',['company' => $company,'fiscalYears'=> $fiscalYears,'current_fiscal_year'=>$current_fiscal_year]);
    }
    public function store(){
        
    }
}
