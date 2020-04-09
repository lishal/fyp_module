@extends('layouts.mainlayout')
@section('content-header')
<h2>Records </h2>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default panel-default-equal">
                <div class="panel-heading">
                    <h5>Ledger</h5>
                </div>
                <div class="panel-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="container responsive">
                        <div class="row">
                            <div class="col-sm-3">	
                                <div class="row">
                                    <h3 style="text-align:center">Records Transaction</h3>
                                </div>		
                                <label>Nepali Date</label>
                                <input type="text" class= "nepali-calendar" name="record_date" id="nepaliDate" required="true">
                                <label>English Date</label>
                                <input type="text" disabled name="record_english_date" id="englishDate">
                                <label>Particulars</label>
                                <input type="text" name="record_particulars" id="record_particulars" required="true"><br>
                                <label>CBF</label>
                                <input type="text" name="record_CBF" id="record_CBF"><br>
                                <label>Credit</label>
                                <input type="number" name="record_credit" id="record_credit" value="" ><br>
                                <label>Debit</label>
                                <input type="number" name="record_debit" id="record_debit" value=""><br>			
                                
                                <button id="add_li" style="margin-top:10px; height:30px;">Add Record</button>
                            </div>
                            <div class="col-sm-9">			
                                <div class="row">
                                    <h3 style="text-align: center">{{$company->company_name}} </h3>
                                    <div class="filter">
                                        <label for="fiscal_year">Fiscal Years: </label>
                                        <select id="fiscal_year" name="fiscal_year">
                                            @foreach($fiscalYears as $year)
                                                <option value="{{ $year->id }}"@if($year->id == $current_fiscal_year->id) {{'selected'}} @endif>{{ $year->fiscal_year_name }}</option>
                                            @endforeach	
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-striped" id="recordsTable">
                                    <thead>
                                        <tr>
                                            <th>Record Date</th>
                                            <th>Record Particulars</th>
                                            <th>CBF</th>
                                            <th style="text-align: right;">Debit</th>
                                            <th style="text-align: right;">Credit</th>
                                            <th style="text-align: right;">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <th colspan="6">No Record Found</th>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#add_li").click(function (){
            var record_date, record_particulars, record_debit, record_credit;
	    	record_date 		= $('#nepaliDate').val();
	    	record_english_date = $('#englishDate').val();
	    	record_particulars  = $('#record_particulars').val();
	    	record_CBF			= $('#record_CBF').val();
	    	record_credit 		= ($('#record_credit').val() == '') ? 0 : $('#record_credit').val();
	    	record_debit 		= ($('#record_debit').val() == '') ? 0 : $('#record_debit').val();
		    if(record_credit >= 0 && record_debit >= 0 && record_particulars != '' && record_date != ''){
			    storeAjaxRecords(this, record_date, record_particulars, record_debit, record_credit, record_CBF,record_english_date);
		    } else {
		    	alert('Enter all the data');
		    }	    		
        });
    });
    
</script>
<style type="text/css">
	label {
	  display: inline-block;
	  width: 100px;
	  text-align: left;
      font-size: 18px;
	}​	
	div.double {outline-style: double;}
    input{
        width: 250px;
        height: 40px;
    }

</style>
