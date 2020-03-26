@extends('layouts.mainlayout')
@section('content-header')
<h2>Fiscal Year </h2>
@endsection
@section('content')
<div class="add-button">
    <a href="{{ url('/settings/fiscalyear/edit') }}" class="btn btn-primary">Add Fiscal Year</a>
</div>
        
<div class="panel-body">
    <div class="panel-top mb-5">
        @include('validation.messages')
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Fiscal Year
        </div>
    </div>
</div>

@endsection
