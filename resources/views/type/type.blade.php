@extends('layouts.mainlayout')
@section('content-header')
<h2>Account Types </h2>
@endsection
@section('content')
<div class="add-button">
    <a href="{{ url('/type/edit') }}" class="btn btn-primary">Add Type</a>
</div>
        
<div class="panel-body">
    <div class="panel-top mb-5">
        @include('validation.messages')
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Types
        </div>

        <div class="panel-body">
            <table class="table table-striped deals-table">

                <!-- Table Headings -->
                <thead>
                    <th>Name</th>
                    <th>Account Type(Dr/Cr)</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @if (count($types) > 0)
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->account_type }}</td>
                                <td>{{ $type->created_at }}</td>
                                <td>{{ $type->updated_at }}</td>
                                <td>
                                    <a href="{{ url('type/edit') }}/{{ $type->id }}" class="ibtn btn-icon"> <i class="fa fa-pencil" rel="tootltip" title="Edit"></i> </a>  
                                    <a href="{{ url('type/delete') }}/{{ $type->id }}" onclick="return confirmDelete()" class="ibtn btn-icon"> <i class="fa fa-remove" rel="tootltip" title="Delete"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
