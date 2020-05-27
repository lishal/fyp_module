<h3 style="text-align: center; margin-top:5%;">{{$company->company_name}} </h3>
<br>
<br>
<center>
    <table class="table table-striped" id="recordsTable" border="1">
		<thead>
			<tr>
				<th>Date</th>
				<th>Particulars</th>
				<th>CBF</th>
				<th style="text-align: right;">Debit</th>
				<th style="text-align: right;">Credit</th>
				<th style="text-align: right;">Balance</th>
						
			</tr>
		</thead>
		@if(count($records) > 0)
			<tbody id="testing">
				@for($i=0; $i < sizeof($records); $i++)
					 <tr>
					 	@php
					 		$timestamp = strtotime($records[$i]['record_created_date']);
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
		@endif					
    </table>
</center>


<script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){
		
	findTotal();

});

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
				$("#total_credit").text(total_credit.toFixed(2));		        	
				$("#total_debit").text(total_debit.toFixed(2));
			}
		});
	

	}


</script>
<style type="text/css">
	label {
	  display: inline-block;
	  width: 80px;
	  text-align: left;
	}​	
	div.double {outline-style: double;}
</style>
