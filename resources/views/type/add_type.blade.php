@extends('layouts.mainlayout')
@section('content-header')
<h2>Add Account Types </h2>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default panel-default-equal">
            <div class="panel-heading">
                <h5>Type Detail</h5>
            </div>
            <div class="panel-body">
                @include('validation.messages')

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/type/save') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_id" id="type_id" value="{{ $type->id or '0' }}">
                    <div class="form-group type_name">
                        <label class="col-md-2 control-label">Type Name*</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Type Name" name="name" value="{{ old('name')? old('name'): ($type->name? $type->name: '') }}">
                        </div>
                    </div>


                     <div class="form-group long_description">
                        <label class="col-md-2 control-label">Description*</label>

                        <div class="col-md-7">
                            <textarea class="form-control" placeholder="Description" id="description" name="description" rows="8">{{ old('description')? old('description'): ($type->description? $type->description: '') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group account_type">
                        <label class="col-md-2 control-label">Account Type*</label>

                        <div class="col-md-7">
                            <select class="form-control" name="account_type">
                                @if(old('account_type'))
                                    <option value="" {{ old('account_type')==""?'selected':''}} >Please select</option>
                                    <option value="Debit" {{ old('account_type')=="1"?'selected':''}} >Debit</option>
                                    <option value="Credit" {{ old('account_type')=="2"?'selected':''}} >Credit</option>
                                @else
                                    <option value="" {{ $type->account_type == ""?'selected':''}} >Please select</option>
                                    <option value="Debit" {{ $type->account_type == "1"?'selected':''}} >Debit</option>
                                    <option value="Credit" {{ $type->account_type == "2"?'selected':''}} >Credit</option>
                                @endif
                            </select>
                        </div> 
                    </div>

                    <div class="form-group bi-form-controls">
                        <div class="col-md-9 text-left">
                            <button type="submit" class="btn btn-default pull-right">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>

@endsection
