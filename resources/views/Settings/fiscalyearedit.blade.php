@extends('layouts.mainlayout')
@section('content-header')
<h2>Add Fiscal Year</h2>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default panel-default-equal">
            <div class="panel-heading">
                <h5>Fiscal Year Detail</h5>
            </div>
            <div class="panel-body">
                @include('validation.messages')
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/Settings/fiscalyear/save') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $fiscalYear->id or '0' }}">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Name*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Fiscal Year Name" name="fiscal_year_name" value="{{ old('fiscal_year_name')? old('fiscal_year_name'): ($fiscalYear->fiscal_year_name? $fiscalYear->fiscal_year_name: '') }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Start Date (in BS)*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Fiscal Year Start Date (in BS)" id="nepali_year_start_date_bs" name="nepali_year_start_date_bs" value="{{ old('nepali_year_start_date_bs')? old('nepali_year_start_date_bs'): ($fiscalYear->nepali_year_start_date_bs? $fiscalYear->nepali_year_start_date_bs: '') }}"readonly >

                    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Start Date (in AD)*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Fiscal Year Start Date (in AD)" id="englishDateStart" name="fiscal_year_start_date_ad" value="{{ old('fiscal_year_start_date_ad')? old('fiscal_year_start_date_ad'): ($fiscalYear->fiscal_year_start_date_ad? $fiscalYear->fiscal_year_start_date_ad: '') }}" readonly >

                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">End Date (in BS)*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Fiscal Year End Date (in BS)" id="nepali_year_end_date_bs" name="nepali_year_end_date_bs" value="{{ old('nepali_year_end_date_bs')? old('nepali_year_end_date_bs'): ($fiscalYear->nepali_year_end_date_bs? $fiscalYear->nepali_year_end_date_bs: '') }}"  readonly >

                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">End Date (in AD)*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Fiscal Year End Date (in AD)" id="englishDateEnd" name="fiscal_year_end_date_ad"value="{{ old('fiscal_year_end_date_ad')? old('fiscal_year_end_date_ad'): ($fiscalYear->fiscal_year_end_date_ad? $fiscalYear->fiscal_year_end_date_ad: '') }}"  readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Is Current Fiscal Year?*</label>

                        <div class="col-md-7">
                            <input type="radio" name="current_fiscal_year" value="1"  {{ old("current_fiscal_year") == "1"? "checked": ($fiscalYear->current_fiscal_year == "1"? "checked": "") }}> Yes
                            <input type="radio" name="current_fiscal_year" value="0"  {{ old("current_fiscal_year") === "0"? "checked": ($fiscalYear->current_fiscal_year == 0? "checked": "") }}> No

                        </div>
                    </div>
  
                    <div class="form-group bi-form-controls">
                        <div class="col-md-9 text-left">
                            <button type="submit" class="btn btn-default pull-right" value="cancel" name="action">CANCEL</button>
                            <button type="submit" class="btn btn-default pull-right" value="save" name="action" style="margin-right:10px">SAVE </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
