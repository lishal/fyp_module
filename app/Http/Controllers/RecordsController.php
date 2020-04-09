<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\FiscalYear;
use App\Record;

class RecordsController extends Controller
{
    protected $records;
    protected $request;

    public function __construct(Company $records, Request $request)
    {
        $this->middleware('auth');

        $this->records = $records;
        $this->request = $request;
    }

    public function show($company_id,$fiscal_year_id)
    {
        $company    = Company::find($company_id);
        $fiscalYear = FiscalYear::find($fiscal_year_id);
        $fiscalYears = FiscalYear::all();
        $current_fiscal_year    = FiscalYear::where('id', $fiscal_year_id)->first();

        $current_year_records = Record::where('company_id', $company_id)
        ->whereBetween('record_english_date', [$current_fiscal_year->fiscal_year_start_date_ad, $current_fiscal_year->fiscal_year_end_date_ad])->get()->toArray();

        return view('records.record',['company' => $company,'fiscalYears'=> $fiscalYears,'current_fiscal_year'=>$current_fiscal_year, 'records'=>$current_year_records]);
    }
    public function store(){

       

    }
}
