<?php

namespace App\Http\Controllers;

use App\Trialbalance;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\FiscalYear;

class TrialbalanceController extends Controller
{
    public function index($fiscal_year_id = 0){
       
        $fiscalYears= FiscalYear::all();

        $cashinhand = DB::table('settings')
                        ->where('settings_name','cashinhand')
                        ->where('fiscal_year_id',$fiscal_year_id)
                        ->first();

        return view ('trialbalance.index',[
            'fiscalYears'=>$fiscalYears,
            'CashInHand' =>$cashinhand
        ]);
    
    }
    public function store(Request $request)
    {
        $active_fiscal_year     = FiscalYear::where('current_fiscal_year', '1')->first();
        $value=$request->input('cash_in_hand');

        DB::table('settings')->where(['settings_name'=>'Cashinhand','fiscal_year_id'=>$active_fiscal_year->id])->update([

            'settings_description' => $value
         ]);
         //return($value);
        return redirect('admin/trialbalance');
    }
}
