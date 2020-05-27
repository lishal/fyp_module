<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\FiscalYear;
use App\Record;

class PdfController extends Controller
{
    protected $company;
    protected $request;

    public function __construct(Company $company, Request $request)
    {
        $this->middleware('auth');
        $this->company = $company;
        $this->request = $request;
    }

    public function index(Request $request)
	{
        $fiscalYears            = FiscalYear::all();
        $companies              = Company::orderBy("company_name")->get();
        return view('print.index',['companies' => $companies, 'fiscalYears'=> $fiscalYears]);
   
    }
    
    public function generatePDF(Request $request)
    {

       $fiscal_year_id = $this->request->input('fiscalyear');
       $company_id        = $this->request->input('companies');

        $current_fiscal_year    = FiscalYear::where('current_fiscal_year', '1')->first();
        $company    = Company::find($company_id);
         $fiscalYear = FiscalYear::where('id', $fiscal_year_id)->first();
         $startDate  = date($fiscalYear->fiscal_year_start_date_ad);
         $endDate    = date($fiscalYear->fiscal_year_end_date_ad);

        $records = Record::where('company_id', $company_id)
                   ->whereBetween('record_english_date', [$startDate, $endDate])
                   ->get()
                   ->toArray();

        
        $data = ['company'  => $company,'records' => $records,'fiscalYear'=>$fiscalYear];

        return view('print.myPDF',$data);
    }
}
