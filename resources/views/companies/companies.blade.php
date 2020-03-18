@extends('layouts.mainlayout')
@section('content-header')
<h2>Account Types </h2>
@endsection
@section('content')
<div class="add-button">
    <a href="{{ url('/companies/edit') }}" class="btn btn-primary">Add Account</a>
</div>
        
<div class="panel-body">
    <div class="panel-top mb-5">
        @include('validation.messages')
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Accounts
        </div>

        <div class="panel-body">
            <table id="company_records" class="table table-striped deals-table">

                <!-- Table Headings -->
                <thead>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Balance</th>
                    <th>Records</th>
                    <th>Action</th>
                </thead>

                
            </table>
        </div>
    </div>
</div>
@endsection
<script>
    function confirmDelete() {
        if(confirm('Are you sure to delete this item?') == true) {
            return true;
        }
        else {
            return false;
        }
    }
</script>