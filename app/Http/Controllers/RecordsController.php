<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class RecordsController extends Controller
{
    public function show($company_id)
    {
        $company    = Company::find($company_id);
        return view('records.record',['company' => $company]);
    }
}
