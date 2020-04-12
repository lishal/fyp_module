<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\FiscalYear;
use App\YearlyRecord;
use App\Record;

class RecordsController extends Controller
{
    protected $records;
    protected $request;

    public function __construct(Company $records, Request $request)
    {
        $this->middleware('auth');

        $this->records = $records;
        $this->request = $request;
    }

    public function show($company_id,$fiscal_year_id)
    {
        $company    = Company::find($company_id);
        $fiscalYear = FiscalYear::find($fiscal_year_id);
        $fiscalYears = FiscalYear::all();
        $current_fiscal_year    = FiscalYear::where('id', $fiscal_year_id)->first();

        $current_year_records = Record::where('company_id', $company_id)
        ->whereBetween('record_english_date', [$current_fiscal_year->fiscal_year_start_date_ad, $current_fiscal_year->fiscal_year_end_date_ad])->get()->toArray();

        return view('records.record',['company' => $company,'fiscalYears'=> $fiscalYears,'current_fiscal_year'=>$current_fiscal_year, 'records'=>$current_year_records,'company_id'=>$company_id]);
    }
    public function store(Request $request){

        $active_fiscal_year         = FiscalYear::where('current_fiscal_year', '1')->first(); 
        $records = $request->input();
        $record = new Record();
        $record->record_particular  = $records['record_particulars'];
        $record->record_CBF         = $records['record_CBF'];
        $record->record_debit       = $records['record_debit'];
        $record->record_credit      = $records['record_credit'];
        $record->record_status      = '1';
        $record->company_id         = $records['company_id'];
        $record->record_created_date= $records['record_date'];
        $record->record_english_date= $records['record_english_date'];
        $record->fiscal_year_id     = $active_fiscal_year->id;
        $record->save();
        
        return response()->json(array('success' => true), 200);

    }
    public function updateTotal(Request $request)
    {   
        

        $records = $request->input();
        
            $year = date('Y', strtotime($records['record_created_date']));

            $yearly_record = YearlyRecord::where('fiscal_year_id', '=', $records['fiscalyearid'], 'and')->where('company_id', '=', $records['company_id'])->get()->toArray();

            if(count($yearly_record) == 0){
                $yearly_record = new YearlyRecord();
            }else{
                $yearly_record = YearlyRecord::find($yearly_record[0]['yearly_record_id']);
            }
            $yearly_record->fiscal_year_id = $records['fiscalyearid'];
            $yearly_record->yearly_record_balance = $records['total'];
            $yearly_record->company_id = $records['company_id'];
            if($records['total_debit'] >= $records['total_credit']){
                $yearly_record->yearly_record_status = 'dr';
            }else{
                $yearly_record->yearly_record_status = 'cr';
            }
            
            $yearly_record->save();
            
        

    }
    
    
}
