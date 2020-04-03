@extends('layouts.mainlayout')
@section('content-header')
<h2>Add Companies</h2>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default panel-default-equal">
            <div class="panel-heading">
                <h5>Company Detail</h5>
            </div>
            <div class="panel-body">
                @include('validation.messages')
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/companies/save') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Company Name*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{ old('company_name')? old('company_name'): ($company->company_name? $company->company_name: '') }}">

                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label class="col-md-2 control-label">Company VAT number*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Company VAT number" name="company_vat_number" value="{{ old('company_vat_number')? old('company_vat_number'): ($company->company_vat_number? $company->company_vat_number: '') }}">
                        </div>
                    </div> --}}

                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Company Type*</label>

                        <div class="col-md-7">
                            <select class="form-control" name="company_type">
                                <option value="" {{ old('company_type')==""?'selected':''}} >Please select</option>
                                @foreach($types as $type)
                                    @if(old('company_type'))
                                        <option value="{{$type->id}}" {{ old('company_type') == $type->id? 'selected': ''}} >{{$type->name}}</option>
                                    @else
                                        <option value="{{$type->id}}" {{ $company->company_type_id == $type->id? 'selected': ''}} >{{$type->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">User Name*</label>

                        <div class="col-md-7">
                            <select class="form-control" name="company_user_id">
                                <option value="" {{ old('company_user_id')==""?'selected':''}} >Please select</option>
                                @foreach($users as $user)
                                    @if(old('company_user_id'))
                                        <option value="{{$user->id}}" {{ old('company_user_id') == $user->id? 'selected': ''}} >{{$user->email}}</option>
                                    @else
                                        <option value="{{$user->id}}" {{ $company->company_user_id == $user->id? 'selected': ''}} >{{$user->email}}</option>
                                    @endif
                                @endforeach
                            </select>
 
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Address*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address')? old('address'): ($company->company_address? $company->company_address: '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Owner*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Owner Name" name="owner" value="{{ old('owner')? old('owner'): ($company->company_owner? $company->company_owner: '') }}">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Phone Number*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number')? old('phone_number'): ($company->company_phone_number? $company->company_phone_number: '') }}">

                        </div>
                    </div>
                    
                    @if($company->id == 0)
                        <div class="form-group">
                            <label class="col-md-2 control-label">Balance*</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" placeholder="Balance" name="balance" value="{{ old('balance')? old('balance'): ($company->balance? $company->balance: '') }}">

                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-md-2 control-label">Status*</label>

                        <div class="col-md-7">
                            <select class="form-control" name="status">
                                @if(old('status'))
                                    <option value="" {{ old('status')==""?'selected':''}} >Please select</option>
                                    <option value="1" {{ old('status')=="1"?'selected':''}} >Active</option>
                                    <option value="2" {{ old('status')=="2"?'selected':''}} >Inactive</option>
                                @else
                                    <option value="" {{ $company->status == ""?'selected':''}} >Please select</option>
                                    <option value="1" {{ $company->status == "1"?'selected':''}} >Active</option>
                                    <option value="2" {{ $company->status == "2"?'selected':''}} >Inactive</option>
                                @endif
                            </select>
                        </div> 
                    </div>

                    <div class="form-group bi-form-controls">
                        <div class="col-md-9 text-left">
                            <button type="submit" class="btn btn-default pull-right" value="cancel" name="action">CANCEL</button>
                            <button type="submit" class="btn btn-default pull-right" value="save" name="action" style="margin-right:10px">SAVE </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection