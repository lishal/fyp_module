<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use App\Type;
use App\User;
use App\YearlyRecord;
use App\FiscalYear;
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
        $company = new Company();
        
        $types = Type::all();
        $users = User::all();

        if($companyId > 0) {
            $company = $company->where('id', $companyId)->first();
        }

        return view('companies.add_companies', ['company' => $company, 'types' => $types, 'users' => $users]);
    }

   

    public function save(Request $request)
    {
        switch ($request->input('action')) {
            case 'save':
                $company_id = $this->request->input('company_id');
    
                $rules = [
                    'company_name'      => 'required|min:3|max:255',
                    'company_type'      => 'required|numeric',
                    'address'           => 'required|min:3|max:255',
                    'owner'             => 'required|min:3|max:255',
                
                ];
    
    
    
                $this->validate($request, $rules);
    
                $company_type       = $this->request->input('company_type');
                $company_user_id    = $this->request->input('company_user_id');
                $company_name       = $this->request->input('company_name');
                $company_address    = $this->request->input('address');
                $company_owner      = $this->request->input('owner');
                $company_phone_number    = $this->request->input('phone_number');
                // $company_vat_number      = $this->request->input('company_vat_number');
                $subscription_start_date = $this->request->input('subscription_start_on');
                $subscription_end_date   = $this->request->input('subscription_end_on');
                $balance                 = $this->request->input('balance');
    
    
                $status = $this->request->input('status');
            
    
                $data = [
                        'company_type_id'   => $company_type, 
                        'company_name'      => $company_name,
                        'company_address'   => $company_address,
                        'company_owner'     => $company_owner,
                        'company_phone_number' => $company_phone_number,
                        'company_user_id'      => $company_user_id,
                        // 'company_vat_number'   => $company_vat_number,
                        'subscription_start_date'   => date('Y-m-d', strtotime($subscription_start_date)),
                        'subscription_end_date'     => date('Y-m-d', strtotime($subscription_end_date)),
                        'status'                    => $status,
                        'updated_at'                => date('Y-m-d H:i:s')
                    ];
    
    
    
                if($company_id == 0) {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $company_id = \DB::table('companies')->insertGetId($data);
                    $message = "Record added successfully.";
    
                    $yearly_record = YearlyRecord::where('company_id', '=', $company_id)->get()->toArray();
    
                    if(count($yearly_record) == 0){
                        $active_fiscal_year     = FiscalYear::where('current_fiscal_year', '1')->first();
    
    
    
                        $yearly_record = new YearlyRecord();
                        $yearly_record->fiscal_year_id          = $active_fiscal_year->id;
                        $yearly_record->yearly_record_balance   = $balance;
                        $yearly_record->company_id              = $company_id;
    
                        if($balance >= 0) {
                            $yearly_record->yearly_record_status = 'dr';
                        } else {
                            $yearly_record->yearly_record_status = 'cr';
                        }
                    
                        $yearly_record->save();
    
                        
                        
                    }
                }
                else {
                    \DB::table('companies')
                    ->where('id', $company_id)
                    ->update($data);
                    $message = "Record updated successfully.";
                }
                return redirect('/companies')->with('success','Record Added');
            break;
    
            case 'cancel':
                return redirect('/companies');
            break;
        }

    }
}
