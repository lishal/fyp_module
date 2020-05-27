<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\FiscalYear;

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
}
