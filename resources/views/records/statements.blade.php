@extends('layouts.mainlayout')
@section('content-header')
<h2>Statements </h2>
@endsection
@section('content')
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            Statements
        </div>

        <div class="panel-body">
            <table class="table table-striped deals-table">
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
                    @if (count($records) > 0)
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
                    @else
                    <tr><td colspan="9">No records found</td></tr>
                    @endif
                </body>
            </table>
            <div class="col-md-9 text-left">
                <a href="{{ url()->previous() }}"  class="btn btn-default pull-right" style="width:150px;margin-right:-35%;">Back</a>
            </div>
            
        </div>
    </div>
</div>
<script>
     $(document).ready(function(){

        findTotal();
     });
    function findTotal(){
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
    }
</script>
@endsection