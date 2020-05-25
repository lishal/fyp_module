<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Settings;
use App\FiscalYear;
class SettingsController extends Controller
{
    protected $request;
    
    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

    public function fiscalyears(Request $request){
        $fiscalYears     = FiscalYear::all();

        return view('Settings.fiscalyears', ['fiscalYears' => $fiscalYears]);
    }

    public function fiscalyearedit($id=0){
        $fiscalYear = new FiscalYear();
        if($id > 0) {
            $fiscalYear = $fiscalYear->where('id', $id)->first();
        }
        return view ('Settings.fiscalyearedit', ['fiscalYear' => $fiscalYear ]);
    }
    
    public function fiscalyearsave(Request $request){
        switch ($request->input('action')) {
            case 'save':
                $id = $this->request->input('id');

                $rules = [
                    'fiscal_year_name' => 'required|min:3|max:100',
                    'fiscal_year_start_date_ad' => 'required|date',
                    'fiscal_year_end_date_ad' => 'required|date',
                    'current_fiscal_year' => 'required|min:1|max:2',
                ];

                $this->validate($request, $rules);

                $fiscal_year_name             = $this->request->input('fiscal_year_name');
                $fiscal_year_start_date_ad    = $this->request->input('fiscal_year_start_date_ad');
                $fiscal_year_end_date_ad      = $this->request->input('fiscal_year_end_date_ad');
                $nepali_year_start_date_bs    = $this->request->input('nepali_year_start_date_bs');
                $nepali_year_end_date_bs      = $this->request->input('nepali_year_end_date_bs');
                $current_fiscal_year          = $this->request->input('current_fiscal_year');

                $data = [
                        'fiscal_year_name'   => $fiscal_year_name, 
                        'fiscal_year_start_date_ad' => date('Y-m-d', strtotime($fiscal_year_start_date_ad)),
                        'fiscal_year_end_date_ad' => date('Y-m-d', strtotime($fiscal_year_end_date_ad)),
                        'nepali_year_start_date_bs' =>  date('Y-m-d', strtotime($nepali_year_start_date_bs)),
                        'nepali_year_end_date_bs' =>  date('Y-m-d', strtotime($nepali_year_end_date_bs)), 
                        'current_fiscal_year' => $current_fiscal_year,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

            

                $active_fiscal_year     = DB::table('fiscal_years')->where('current_fiscal_year', '1')->first(); 


                $cashinhand = DB::table('settings')
                                ->where('settings_name','cashinhand')
                                ->where('fiscal_year_id',$active_fiscal_year->id)
                                ->first();

                //last year's closing stock will new years opening stock               
                $openingstock = DB::table('settings')
                                ->where('settings_name','Closingstock')
                                ->where('fiscal_year_id',$active_fiscal_year->id)
                                ->first();

                $NetProfit = DB::table('settings')
                                ->where('settings_name','NetProfit')
                                ->where('fiscal_year_id',$active_fiscal_year->id)
                                ->first();

                
                $yearly_records = DB::table('companies')
                                    ->selectRaw('*')
                                    ->join('yearly_records','companies.id' , '=', 'yearly_records.company_id')
                                    ->where('yearly_records.fiscal_year_id',$active_fiscal_year->id)
                                    ->get()->toArray();
            

                if($id == 0) {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $id = \DB::table('fiscal_years')->insertGetId($data);

                    $message = "Record added successfully.";

                    $datasettingsCashInHand = [

                        'settings_name'         => 'Cashinhand',
                        'settings_description'  => $cashinhand->settings_description,
                        'fiscal_year_id'        => $id
                    ];

                    $datasettingsOpeningStock = [

                        'settings_name'         => 'Openingstock',
                        'settings_description'  => $openingstock->settings_description,
                        'fiscal_year_id'        => $id
                    ];

                    $datasettingsClosingStock = [

                        'settings_name'         => 'Closingstock',
                        'settings_description'  => 0,
                        'fiscal_year_id'        => $id
                    ];

                    $datasettingsNetProfit = [

                        'settings_name'         => 'NetProfit',
                        'settings_description'  => 0,
                        'fiscal_year_id'        => $id
                    ];

                    \DB::table('settings')->insert($datasettingsCashInHand);
                    \DB::table('settings')->insert($datasettingsOpeningStock);
                    \DB::table('settings')->insert($datasettingsClosingStock);
                    \DB::table('settings')->insert($datasettingsNetProfit);

                    foreach ($yearly_records as $yearly_record) {
                        if($yearly_record->fiscal_year_id == $active_fiscal_year->id) {
                        $dataRecord = [
                            'record_particular'  => 'B/D',
                            'record_CBF'         => 0,
                            'record_debit'       => ($yearly_record->yearly_record_status == 'dr')?abs($yearly_record->yearly_record_balance): 0,
                            'record_credit'      => ($yearly_record->yearly_record_status == 'cr')?abs($yearly_record->yearly_record_balance): 0, 
                            'record_status'      => '1',
                            'company_id'         => $yearly_record->company_id,
                            'record_created_date'=> $nepali_year_start_date_bs,
                            'record_english_date'=> $fiscal_year_start_date_ad,
                            'fiscal_year_id'     => $id
                        
                        ];
                    
                            \DB::table('records')->insert($dataRecord);
                        

                        $dataYearlyRecord = [
                            'company_id'           => $yearly_record->company_id,
                            'yearly_record_status' => $yearly_record->yearly_record_status,
                            'yearly_record_balance'=> $yearly_record->yearly_record_balance,
                            'fiscal_year_id'     => $id
                        
                        ];

                        
                        \DB::table('yearly_records')->insert($dataYearlyRecord);

                    }
                }

                    \DB::table('fiscal_years')
                    ->where('id', $active_fiscal_year->id)
                    ->update(['current_fiscal_year'=>'0']);

                }
                else {
                    \DB::table('fiscal_years')
                    ->where('id', $id)
                    ->update($data);
                    $message = "Record updated successfully.";
        }
        return redirect('Settings/fiscalyears')->with('success',$message);
            break;

        case 'cancel':
            return redirect('Settings/fiscalyears');
        break;
        }
    }
    public function fiscalyeardelete($id)
    {
        $fiscalYear = FiscalYear::find($id);

        if($fiscalYear->delete()){
            return redirect('Settings/fiscalyears')->with('success','Record deleted successfully.');
        }
        else{
            return redirect('Settings/fiscalyears')->with('success','Something went wrong. Please try again.');
        }
    }
    

}
