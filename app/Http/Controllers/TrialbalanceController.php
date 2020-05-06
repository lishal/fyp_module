<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrialbalanceController extends Controller
{
    public function index(){
        return view ('trialbalance.index');
    }
}
