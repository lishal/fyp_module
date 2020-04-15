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
                                @if($current_fiscal_year->current_fiscal_year == 1)		
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
                                @endif
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
                                    <br>
                                    <div class="dateselection">
                                        <label for ="select_date">Select Date:</label>
                                        <form method="POST" action="" id="dateSelection">
                                            <label>From:</label>
                                            <input type="text" class= "fromDate" name="record_date_from" id="fromDate" required="true">
                                            <input type="text" disabled name="record_english_date_from" id="englishFromDate" hidden>
                                            <label>&emsp;To:</label>
                                            <input type="text" class= "toDate" name="record_date_to" id="toDate" required="true">
                                            <input type="text" disabled name="record_english_date_to" id="englishToDate" hidden>
                                            <input type="button" class="btn btn-primary" style="width:150px;margin-left:20px;" name="Show" id ="Show" value="Show">
                                            <a href="{{ url('/records/'. $company->id.'/'.$current_fiscal_year->id)}}" style="width:150px;" class="btn btn-secondary">Clear</a>
                                        </form>
                                </div>
                                <br>
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
                                    
                                    <tbody  id="testing">
                                        @if(!empty($previous_yearly_record))
                                            <tr>
                                                
                                                    <td class='created_at'></td>
                                                    <td class='particulars'>B/D</td>
                                                    <td class='cbf'></td>
                                                    

                                                    <td class='debit' style="text-align: right;">@if($previous_yearly_record->yearly_record_status == "dr"){{$previous_yearly_record->yearly_record_balance}} @else {{0}}@endif</td>
                                                    <td class='credit' style="text-align: right;">@if($previous_yearly_record->yearly_record_status == "cr"){{abs($previous_yearly_record->yearly_record_balance)}} @else {{0}} @endif</td>
                                                    <td class='balance' style="text-align: right; font-weight: bold; "></td>
                                                
                                                
                                            </tr>
                                            @endif
                                            @for($i=0; $i < sizeof($records); $i++)
                                            <tr>
                                                @php
                                                    $timestamp = strtotime($records[$i]['record_english_date']);
                                                    $created_at = date('Y-m-d ', $timestamp);
                                                @endphp
                                                <td class='created_at'>{{ $created_at }}</td>
                                                <td class='particulars'>{{ $records[$i]['record_particular'] }}</td>
                                                <td class='cbf'>{{ $records[$i]['record_CBF'] }}</td>		 	
                                                <td class='debit'style="text-align: right;">{{ $records[$i]['record_debit'] }}</td>
                                                <td class='credit'style="text-align: right;">{{ $records[$i]['record_credit'] }}</td>
                                                <td class='balance' style="text-align: right; font-weight: bold; "></td>
                                            </tr>
                                            @endfor
                                            <tr>
                                                <td></td>
                                                 <td></td>
                                                 <td></td>		 	
                                                 <td id='total_debit' style="font-weight: bold; font-size: 18px;text-align: right;"></td>
                                                 <td id='total_credit' style="font-weight: bold; font-size: 18px;text-align: right;"></td>
                                                 <td id='total' style="text-align: right; font-weight: bold; font-size: 18px"></td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
            </div>
        </div>
    </div>
<script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        findTotal();

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
    function storeAjaxRecords(func, record_date, record_particulars, record_debit, record_credit, record_CBF,record_english_date){
        $.ajax({
            headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    type: "POST",
            url: '../store',
            data: ({ company_id:<?php echo $company_id ?>, record_date: record_date, record_particulars:record_particulars, record_debit: record_debit, record_credit: record_credit, record_CBF: record_CBF,record_english_date : record_english_date }),
	        success: function(data) {
                $("table tr:last").before(
	            	"<tr><td class='created_at'>" + record_date + 
		    		"</td><td class='particulars'>" + record_particulars + 
		    		"</td><td class='cbf'>" + record_CBF + 
		    		"</td><td id='debit'>" + record_debit + 
		    		"</td><td class='credit'>" +  record_credit + 
		    		"</td><td class='balance' style='text-align:right;font-weight: bold; '>");
	            location.reload();
            }
        });
    }
    function findTotal() {
		total = 0;
		total_credit = 0;
		total_debit = 0;
		
		$("#testing").find("tr").each(function() {
			
			if(($(this).find("td.debit").text())){	
				
				if(($(this).prev().length) == 0){
				    total = parseFloat($(this).find("td.debit").text()) - parseFloat($(this).find("td.credit").text());
				   
				}else{
				    total = parseFloat($(this).find("td.debit").text()) - parseFloat($(this).find("td.credit").text()) + parseFloat($(this).prev().find("td.balance").text());
				}
				$(this).find("td.balance").text(total.toFixed(2));				
			}
		});
        $("#testing").find("tr").each(function(){
			if(($(this).find("td.debit").text())){
				total_debit = total_debit + parseFloat($(this).find("td.debit").text()); 
				total_credit = total_credit + parseFloat($(this).find("td.credit").text()); 	
			}
		});
        $.ajax({
            headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    type: "POST",
            url: '../edittotal',
            data: ({ total: total, total_debit: total_debit, total_credit:total_credit, record_created_date:$("table").last('tr').find('.created_at').text(), company_id:<?php echo $company_id ?>, fiscalyearid:<?php echo $current_fiscal_year->id ?> }),
	        success: function(data) {
                $("#total").text(total.toFixed(2));
				$("#total_credit").text(total_credit.toFixed(2));		        	
				$("#total_debit").text(total_debit.toFixed(2));	
            }
        });
		
    }
    $('#fiscal_year').on('change', function(){    
	
        var company_id = '{{ $company_id }}';
		var fiscal_year_id = $(this).val();
		 window.location = "{{url('records')}}/"+company_id+"/"+fiscal_year_id
		
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
    .toDate, .fromDate{
        width: 150px;
    }
    select{
        width: 150px;
        height: 40px;
    }


</style>
@endsection

