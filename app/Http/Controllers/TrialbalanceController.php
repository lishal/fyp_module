<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\FiscalYear;


class TrialbalanceController extends Controller
{
    public function index($fiscal_year_id = 0){
        $active_fiscal_year     = FiscalYear::where('current_fiscal_year', '1')->first();
        if ($fiscal_year_id == 0) {
            $fiscal_year_id = $active_fiscal_year->id;
        }
        $fiscalYears= FiscalYear::all();

        $current_fiscal_year    = FiscalYear::where('id', $fiscal_year_id)->first();

        $cashinhand = DB::table('settings')
                        ->where('settings_name','cashinhand')
                        ->where('fiscal_year_id',$fiscal_year_id)
                        ->first();
        $openingstock = DB::table('settings')
                        ->where('settings_name','Openingstock')
                        ->where('fiscal_year_id',$fiscal_year_id)
                        ->first();
        $SumOfDifferentAccountTypes = DB::table('yearly_records')
                        ->selectRaw('SUM(yearly_record_balance) as Balance, companies.company_type_id, types.account_type, types.name')
                        ->join('companies', 'yearly_records.company_id', '=', 'companies.id')
                        ->join('types', 'companies.company_type_id', '=', 'types.id')
                        ->where('fiscal_year_id',$fiscal_year_id)
                        ->groupBy('companies.company_type_id')
                        ->get()->toArray();

        return view ('trialbalance.index',[
            'fiscalYears'=>$fiscalYears,
            'CashInHand' =>$cashinhand,
            'current_fiscal_year'=> $current_fiscal_year,
            'openingstock'=> $openingstock,
            'SumOfDifferentAccountTypes' => $SumOfDifferentAccountTypes,
            'active_fiscal_year'=> $active_fiscal_year
        ]);
    
    }
    public function store(Request $request)
    {
    //     $active_fiscal_year     = FiscalYear::where('current_fiscal_year', '1')->first();
        $value=$request->input('cash_in_hand');
    //    // $settings= Settings::all();
    //     $settings_check     = Settings::where('settings_name','Cashinhand')->first(); 

        
    //     if($settings_check ==""){
    //         $data = [
    //             'settings_name' => 'Cashinhand', 
    //             'settings_description' => $value,
    //             'fiscal_year_id'=>$active_fiscal_year->id,
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ];
    //         \DB::table('settings')->insert($data);
    //     }
        
    //     else{
    //         $cash=DB::table('settings')->where(['settings_name'=>'Cashinhand','fiscal_year_id'=>$active_fiscal_year->id])->get();
    //          $cashinhand=$cash[0]->settings_description;
    //          $update_cashinhand=$cashinhand+$value;
            
    //         DB::table('settings')->where(['settings_name'=>'Cashinhand','fiscal_year_id'=>$active_fiscal_year->id])->update([

    //             'settings_description' => $update_cashinhand
    //          ]);
    //     }
        
         //return($update_cashinhand);
         $active_fiscal_year     = FiscalYear::where('current_fiscal_year', '1')->first();
        $cash=DB::table('settings')->where(['settings_name'=>'Cashinhand','fiscal_year_id'=>$active_fiscal_year->id])->get();
             $cashinhand=$cash[0]->settings_description;
             $update_cashinhand=$cashinhand+$value;
            
            DB::table('settings')->where(['settings_name'=>'Cashinhand','fiscal_year_id'=>$active_fiscal_year->id])->update([

                'settings_description' => $update_cashinhand
             ]);
        return redirect('admin/trialbalance');
    }
}
