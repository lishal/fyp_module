@extends('layouts.mainlayout')
@section('content-header')
<h2>Fiscal Year </h2>
@endsection
@section('content')
<div class="add-button">
    <a href="{{ url('Settings/fiscalyear/edit') }}" class="btn btn-primary">Add Fiscal Year</a>
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
                    @if (count($fiscalYears) > 0)
                    @foreach ($fiscalYears as $year)
                        <tr>
                            <td>{{ $year->fiscal_year_name }}</td>
                            <td>{{ $year->fiscal_year_start_date_ad }}</td>
                            <td>{{ $year->fiscal_year_end_date_ad }}</td>
                            <td>{{ $year->current_fiscal_year == 1? 'Yes': 'No' }}</td>
                            <td>
                                <a href="{{ url('Settings/fiscalyear/edit') }}/{{ $year->id }}" class="ibtn btn-icon"> <i class="fa fa-pencil" rel="tootltip" title="Edit"></i> </a>  
                                {{-- <a href="{{ url('Settings/fiscalyear/delete') }}/{{ $year->id }}" onclick="return confirmDelete()" class="ibtn btn-icon"> <i class="fa fa-remove" rel="tootltip" title="Delete"></i> </a> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="5">No records found</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
