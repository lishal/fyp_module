<?php

namespace App\Http\Controllers;
use App\Company;
use App\Type;
use App\YearlyRecord;
use App\FiscalYear;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfitlossController extends Controller
{
    public function index()
    {
        $company   = new Company();
        $companies = $company->where('company_type_id', 5)->get();


        $ExpensesAccountTotal = DB::table('yearly_records')
                                        ->selectRaw('yearly_record_balance as Balance, companies.company_type_id,companies.company_name')
                                        ->join('companies', 'yearly_records.company_id', '=', 'companies.id')
                                        ->where('companies.company_type_id',5)
                                        ->get()->toArray();
        return view('admin.profitloss.index',['ExpensesAccountTotals'=>$ExpensesAccountTotal]);
            
    }
}
