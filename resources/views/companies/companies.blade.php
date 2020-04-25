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
            <form method="POST" action="" id="FilterPrint">
                {!! csrf_field() !!}
               <select name="company_types" id="" >
                   <option value="0" selected="selected">No option selected</option>
                   @foreach ($types as $type)
                   <?php 
                       if($company_types == $type->id){
                           $option = 'selected';
                       }
                       else{
                           $option = '';
                       }
                   ?>
                       <option value="{{$type->id}}" {{$option}}>{{$type->name}}</option>
                   @endforeach
               </select>
               <input type="button" class="btn btn-primary" name="Filter" id="Filter" value="Filter">
               <a href="/companies" class="btn btn-secondary">Clear</a>
               
           </form>
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

                <!-- Table Body -->
                <tbody>
                    @if (count($companies) > 0)
                        @foreach ($companies as $company)
                            <tr>
                                <td><a href="{{ url('#' ) }}">{{ $company->company_name }}</a></td>
                                <td>{{ $company->company_address }}</td>
                                <td>{{ $company->company_phone_number }}</td>
                                <td><?php echo number_format($company->yearly_record_balance, 2) ?></td>
                                <td><a href="{{ url('/records/'. $company->id.'/'.$current_fiscal_year->id)}}"><i class="fa fa-eye" style="text-align: center;"></i></a></td>
                                <td>
                                    <a href="{{ url('/companies/edit') }}/{{ $company->id }}" class="ibtn btn-icon"> <i class="fa fa-pencil" rel="tootltip" title="Edit"></i> </a>  
                                    <a href="{{ url('/companies/delete') }}/{{ $company->id }}" onclick="return confirmDelete()" class="ibtn btn-icon"> <i class="fa fa-remove" rel="tootltip" title="Delete"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="6">No records found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#Filter").on("click", function(e){
          e.preventDefault();
          $('#FilterPrint').attr('action', "/filtercompanies").submit();
      });
</script>
<style>
    select{
        width: 150px;
        height: 40px;
        margin-bottom:10px;
        margin-right:5px;
    }
</style>
@endsection
