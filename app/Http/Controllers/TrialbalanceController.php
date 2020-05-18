<?php

namespace App\Http\Controllers;

use App\Settings;
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
        $settings= Settings::all();
        
        if($settings->isEmpty()){
            $data = [
                'settings_name' => 'Cashinhand', 
                'settings_description' => $value,
                'fiscal_year_id'=>$active_fiscal_year->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            \DB::table('settings')->insert($data);
        }
        else{
            $cash=DB::table('settings')->where(['settings_name'=>'Cashinhand','fiscal_year_id'=>$active_fiscal_year->id])->get();
             $cashinhand=$cash[0]->settings_description;
             $update_cashinhand=$cashinhand+$value;
            
            DB::table('settings')->where(['settings_name'=>'Cashinhand','fiscal_year_id'=>$active_fiscal_year->id])->update([

                'settings_description' => $update_cashinhand
             ]);
        }
        
         //return($update_cashinhand);
        return redirect('admin/trialbalance');
    }
}
