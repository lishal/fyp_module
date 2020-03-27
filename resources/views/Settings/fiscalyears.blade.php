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
        <div class="panel-body">
            <table id="years" class="table table-striped deals-table">
    
                <!-- Table Headings -->
                <thead>
                    <th>Name</th>
                    <th>Start Date in AD</th>
                    <th>End Date in AD</th>
                    <th>Is Current Year</th>
                    <th>Action</th>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <tr><td colspan="5">No records found</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
