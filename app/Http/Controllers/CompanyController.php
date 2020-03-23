<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use App\Type;

class CompanyController extends Controller
{
    protected $company;
    protected $request;

    public function __construct(company $company, Request $request)
    {
        $this->middleware('auth');

        $this->company = $company;
        $this->request = $request;
    }
    //
    // public function index(){
    //     return view('companies.companies');
    // }

    public function index(Request $request)
	{


    // $current_fiscal_year    = FiscalYear::where('current_fiscal_year', '1')->first();


    if($this->request->input('company_types')){

            

            $companies = DB::table('companies')
                            ->selectRaw('*')
                            ->rightJoin('yearly_records','companies.id' , '=', 'yearly_records.company_id')
                            ->where('companies.company_type_id', (int)$this->request->input('company_types'))
                            ->where('yearly_records.fiscal_year_id',$current_fiscal_year->id)
                            ->get()->toArray();
                                        


        }else {
	  	    $companies = $this->company->getAll();


        }
         
        $types     = Type::all();

	    return view('companies.companies', ['companies' => $companies,'types'=>$types]);
    }
    public function edit($companyId=0)
    {
        

        return view('companies.add_companies');
    }
}
