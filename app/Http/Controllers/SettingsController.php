<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

                 if($active_fiscal_year!=""){
                 
            
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

                }
           
                if ($id == 0) {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $id=\DB::table('fiscal_years')->insert($data);
                    $settings_check     = DB::table('Settings')->where('settings_name','' )->first(); 

        
                    if($settings_check ==""){
                        $data = [
                            'settings_name' => 'Cashinhand', 
                            'settings_description' => 0,
                            'fiscal_year_id'=>1,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        \DB::table('settings')->insert($data);
                        $data2 = [
                            'settings_name' => 'Openingstock', 
                            'settings_description' => 0,
                            'fiscal_year_id'=>1,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        \DB::table('settings')->insert($data2);
                        $data3 = [
                            'settings_name' => 'Closingstock', 
                            'settings_description' => 0,
                            'fiscal_year_id'=>1,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        \DB::table('settings')->insert($data3);
                        $data4 = [
                            'settings_name' => 'NetProfit', 
                            'settings_description' => 0,
                            'fiscal_year_id'=>1,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        \DB::table('settings')->insert($data4);
                    }
                    else{
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

                   
                }

                    if($active_fiscal_year){
                        \DB::table('fiscal_years')
                        ->where('id', $active_fiscal_year->id)
                        ->update(['current_fiscal_year'=>'0']);
                    }
                    $message = "Record added successfully.";

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
