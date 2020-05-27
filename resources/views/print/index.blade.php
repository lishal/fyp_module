@extends('layouts.mainlayout')
@section('content-header')
<h2>Print </h2>
@endsection
@section('content')
<div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('#') }}" enctype="multipart/form-data" target ="_blank">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">Year</label>

            <div class="col-md-7">
                <select class="form-control" name="fiscalyear">
                     @foreach ($fiscalYears as $fiscalyear)
                        <option value="{{$fiscalyear->id}}">{{$fiscalyear->fiscal_year_name}}</option>
                     @endforeach
                </select>
                @if ($errors->has('status'))
                    <span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>
                @endif
            </div> 
        </div>
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">Account</label>

            <div class="col-md-7">
                <select class="form-control" name="companies">
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                    @endforeach
                    
                </select>
                @if ($errors->has('status'))
                    <span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>
                @endif
            </div> 
        </div>

        <div class="form-group bi-form-controls">
            <div class="col-md-9 text-left">
                <button type="submit" class="btn btn-default pull-right">Generate Pdf</button>
            </div>
        </div>
    </form>
</div>
@endsection