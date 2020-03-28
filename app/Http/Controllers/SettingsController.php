<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\FiscalYear;
class SettingsController extends Controller
{
    protected $request;
    
    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

    public function fiscalyears(Request $request){
        $fiscalYears     = FiscalYear::all();

        return view ('Settings.fiscalyears', ['fiscalYears' => $fiscalYears]);
    }

    public function edit($id=0){
        $fiscalYear = new FiscalYear();
        if($id > 0) {
            $fiscalYear = $fiscalYear->where('id', $id)->first();
        }
        return view ('Settings.fiscalyearedit', ['fiscalYear' => $fiscalYear]);
    }
    
    public function fiscalyearsave(Request $request){

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

        if($id == 0) {
            $data['created_at'] = date('Y-m-d H:i:s');
                $id = \DB::table('fiscal_years')->insert($data);
            return redirect('Settings/fiscalyears')->with('success','Fiscal Year  successfully added.');
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
