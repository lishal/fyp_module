<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trading;
use App\Trialbalance;
use App\Company;
use App\Record;
use App\YearlyRecord;
use App\FiscalYear;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TradingController extends Controller
{
    public function index($fiscal_year_id = 0)
    {
        $active_fiscal_year     = FiscalYear::where('current_fiscal_year', '1')->first();

        if ($fiscal_year_id == 0) {
            $fiscal_year_id = $active_fiscal_year->id;
        }
        $current_fiscal_year    = FiscalYear::where('id', $fiscal_year_id)->first();

        $openingstock = DB::table('settings')
        ->where('settings_name','Openingstock')
        ->where('fiscal_year_id',$fiscal_year_id)
        ->first();
        // $closingstock = DB::table('settings')
        //                 ->where('settings_name','Closingstock')
        //                 ->where('fiscal_year_id',$fiscal_year_id)
        //                 ->first();

        $cashinhand = DB::table('settings')
                ->where('settings_name','cashinhand')
                ->where('fiscal_year_id',$fiscal_year_id)
                ->first();

        $ExpensesAccountTotal = DB::table('yearly_records')
                                ->selectRaw('yearly_record_balance as Balance, companies.company_type_id,companies.company_name')
                                ->join('companies', 'yearly_records.company_id', '=', 'companies.id')
                                ->where('companies.company_type_id',5)
                                ->where('fiscal_year_id',$fiscal_year_id)
                                ->get()->toArray();

        $fiscalYears  = FiscalYear::all();

         $SumOfDifferentAccountTypes  = DB::table('yearly_records')
                                        ->selectRaw('SUM(yearly_record_balance) as Balance, companies.company_type_id, types.account_type, types.name')
                                        ->join('companies', 'yearly_records.company_id', '=', 'companies.id')
                                        ->join('types', 'companies.company_type_id', '=', 'types.id')
                                        ->where('fiscal_year_id',$fiscal_year_id)
                                        ->groupBy('companies.company_type_id')
                                        ->get()->toArray();
        $closingstock = DB::table('settings')
                        ->where('settings_name','Closingstock')
                        ->where('fiscal_year_id',$fiscal_year_id)
                        ->first();


        return view('trading.index',[
            'openingstock'               => $openingstock,
            'ExpensesAccountTotals'      => $ExpensesAccountTotal,
            'CashInHand'                 => $cashinhand,
            'closingstock'               => $closingstock,
            'fiscalYears'                => $fiscalYears,
            'current_fiscal_year'        => $current_fiscal_year, 
            'active_fiscal_year'         => $active_fiscal_year,
            'SumOfDifferentAccountTypes' => $SumOfDifferentAccountTypes,
        ]);
    }

    public function store(Request $request)
    {
        $documents =  DB::table('settings')->where('settings_name','Closingstock')->update([
            'settings_description' => $request->input('closing_stock'),
        ]);
               return redirect('admin/trading');
    }
}
