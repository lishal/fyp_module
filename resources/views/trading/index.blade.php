@extends('layouts.mainlayout')
@section('content-header')
<h2>Balances </h2>
@endsection
@section('content')
<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#trading" aria-controls="trading" role="tab" data-toggle="tab">Trading</a></li>
      <li role="presentation"><a href="#profitloss" aria-controls="profitloss" role="tab" data-toggle="tab">Profit Loss</a></li>
      <li role="presentation"><a href="#balancesheet" aria-controls="blancesheet" role="tab" data-toggle="tab">Balance Sheet</a></li>
     
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="trading">
        <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <i class="fa fa-globe"></i> Trading Account
                    <small class="pull-right">Date: <?php echo date('Y-m-d'); ?></small>
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                
                  <div class="form-group">
                       <form method="post" action="/admin/trading/store">
                        {!! csrf_field() !!}
                          <div class="col-md-3">
                              <input type="text" min="0" class="form-control" placeholder="Closing Stock" name="closing_stock" value="">
                          </div>
                          <div class="col-md-2">
                              <button type="submit" class="btn btn-default">SAVE</button>
                          </div>
                         </form>
                    </div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-xs-6 table-responsive">
                  <table class="table table-striped"  id="trading-debit-table">
                    <thead>
                      <tr>
                      <th></th>
                      <th><h3>DEBIT</h3></th>
                      <th></th>
                      
                    </tr>
                    <tr>
                      <th>S.N</th>
                      <th>Particulars</th>
                      <th style="text-align: right;">Amount</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td>1</th>
                        <td>Opening Stock</td>
                        <td style="text-align: right;" >{{number_format($openingstock->settings_description,2, '.', '')}}</td>
                       </tr>
                       <?php $sn = 2;?>
                       @foreach($SumOfDifferentAccountTypes as $SumOfDifferentAccountType)
                          @if($SumOfDifferentAccountType->account_type == 'Debit' )
                            <tr>
                              <td>{{$sn}}</td>
                              <td>{{$SumOfDifferentAccountType->name}}</td>
                              <td id="TrialTotal{{str_replace(' ', '', $SumOfDifferentAccountType->name)}}Balance" style="text-align: right;">{{number_format(abs($SumOfDifferentAccountType->Balance),2, '.', '')}}</td>
                            </tr>
                             <?php $sn++; ?>
                          @endif
                        @endforeach
                         <tr>
                              <td></td>
                              <td><b>Gross Profit</b></td>
                              <td class="grossprofit" style="text-align: right;" ></td>
                          </tr>
                         <tr>
                              <td></td>
                              <td><h3>TOTAL</h3></td>
                              <td id="TradingTotalDebitBalance" style="text-align: right;"></td>
                          </tr>
                    </tbody>
                  </table>
                </div>

                <div class="col-xs-6 table-responsive">
                  <table class="table table-striped" id="trading-credit-table">
                    <thead>
                      
                      <th></th>
                      <th><h3>CREDIT</h3></th>
                      <th></th>
                    </tr>
                    <tr>
                     
                      <th>S.N</th>
                      <th>Particulars</th>
                      <th style="text-align: right;">Amount</th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php $sn = 1;?>
                       @foreach($SumOfDifferentAccountTypes as $SumOfDifferentAccountType)
                          @if($SumOfDifferentAccountType->account_type == 'Credit')
                            <tr>
                              <td>{{$sn}}</td>
                              <td>{{$SumOfDifferentAccountType->name}}</td>
                              <td id="TrialTotal{{str_replace(' ', '', $SumOfDifferentAccountType->name)}}Balance" style="text-align: right;">{{number_format(abs($SumOfDifferentAccountType->Balance),2, '.', '')}}</td>
                            </tr>
                             <?php $sn++; ?>
                          @endif
                         
                        @endforeach
                        <tr>

                        <td>2</td>
                        <td>Closing Stock</td>
                        <td style="text-align: right;">{{number_format($closingstock->settings_description,2, '.', '')}}</td>
                       </tr>
                       <tr>
                              <td></td>
                              <td><h3>TOTAL</h3></td>
                              <td id="TradingTotalCreditBalance" style="text-align: right;"></td>
                          </tr>
                    
                        
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
    </div>
        <div role="tabpanel" class="tab-pane" id="profitloss">
            <!-- title row -->
               <div class="row">
                 <div class="col-xs-12">
                   <h2 class="page-header">
                     <i class="fa fa-globe"></i> Profit & Loss Account
                     <small class="pull-right">Date: <?php echo date('Y-m-d'); ?></small>
                   </h2>
                 </div>
                 <!-- /.col -->
               </div>


               <!-- Table row -->
               <div class="row">
                 <div class="col-xs-6 table-responsive">
                   <table class="table table-striped"  id="profit-table">
                     <thead>
                       <tr>
                       <th></th>
                       <th><h3>Profit</h3></th>
                       <th></th>
                       
                     </tr>
                     <tr>
                       <th>S.N</th>
                       <th>Particulars</th>
                       <th>Amount</th>
                     
                     </tr>
                     </thead>
                     <tbody>
                     @php ($sn = 1) 
                        @foreach($ExpensesAccountTotals as $ExpensesAccountTotal)
                        <tr>
                           
                               <td>{{$sn}}</td>
                               <td>{{$ExpensesAccountTotal->company_name}}</td>
                               <td style="text-align: right;">{{number_format($ExpensesAccountTotal->Balance,2,'.','')}}</td>
                             

                        </tr>
                        @php ($sn++ )
                        @endforeach
                         <tr>
                           <td>#</td>
                           <td><b>Net Profit</b></td>
                           <td class="NetProfit" id="NetProfit" style="text-align: right;"></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td><h3>TOTAL</h3></td>
                           <td id="TotalProfitTableBalance" style="text-align: right;"></td>
                        </tr>
                       
                          
                     </tbody>
                   </table>
                 </div>

                 <div class="col-xs-6 table-responsive">
                   <table class="table table-striped" id="loss-table">
                     <thead>
                       
                       <th></th>
                       <th><h3>Loss</h3></th>
                       <th></th>
                     </tr>
                       <tr>
                         <th>S.N</th>
                         <th>Particulars</th>
                         <th style="text-align: right;">Amount</th>
                       </tr>
                       
                     </thead>
                     <tbody>
                       <tr>
                           <td></td>
                           <td><b>Gross Profit</b></td>
                           <td class="grossprofit" style="text-align: right;"></td>
                       </tr>
                        <tr>
                           <td></td>
                           <td><h3>TOTAL</h3></td>
                           <td id="TotalLossTableBalance" style="text-align: right;"></td>
                         </tr>
                     </tbody>
                   </table>
                 </div>
                 <!-- /.col -->
               </div>
               <!-- /.row -->
       </div>
       <div role="tabpanel" class="tab-pane" id="balancesheet">
        <!-- title row -->
           <div class="row">
             <div class="col-xs-12">
               <h2 class="page-header">
                 <i class="fa fa-globe"></i> Balance Sheet
                 <small class="pull-right">Date: <?php echo date('Y-m-d'); ?></small>
               </h2>
             </div>
             <!-- /.col -->
           </div>


           <!-- Table row -->
           <div class="row">
             <div class="col-xs-6 table-responsive">
               <table class="table table-striped"  id="liabilties-table">
                 <thead>
                   <tr>
                   <th></th>
                   <th><h3>Liabilties</h3></th>
                   <th></th>
                   
                 </tr>
                 <tr>
                   <th>S.N</th>
                   <th>Particulars</th>
                   <th style="text-align: right;">Amount</th>
                 
                 </tr>
                 </thead>
                 <tbody>
                 <?php $sn = 1;?>
                 @foreach($SumOfDifferentAccountTypes as $SumOfDifferentAccountType)
                   @if($SumOfDifferentAccountType->account_type == 'Credit' && ($SumOfDifferentAccountType->company_type_id != 9)) 
                     <tr>
                       <td>{{$sn}}</td>
                       <td>{{$SumOfDifferentAccountType->name}}</td>
                       <td id="TrialTotal{{str_replace(' ', '', $SumOfDifferentAccountType->name)}}Balance" style="text-align: right;">{{number_format(abs($SumOfDifferentAccountType->Balance),2, '.', '')}}</td>
                     </tr>
                      <?php $sn++; ?>
                   @endif
                  
                 @endforeach
                 <tr>
                       <td>#</td>
                       <td><b>Net Profit</b></td>
                       <td class="NetProfit" style="text-align: right;"></td>
                 </tr>
           
           <tr>
             <td>&nbsp;</td>
             <td><h3>TOTAL</h3></td>
             <td id="TotalLiabiltiesBalance" style="text-align: right;">&nbsp;</td>
             
           </tr>
     </tbody>
               </table>
             </div>

             <div class="col-xs-6 table-responsive">
               <table class="table table-striped" id="assets-table">
                 <thead>
                   
                   <th></th>
                   <th><h3>Assests</h3></th>
                   <th></th>
                 </tr>
                   <tr>
                     <th>S.N</th>
                     <th>Particulars</th>
                     <th style="text-align: right;">Amount</th>
                   </tr>
                   
                 </thead>
                <tbody>
    
           <?php $sn = 1;?>
         @foreach($SumOfDifferentAccountTypes as $SumOfDifferentAccountType)
           @if($SumOfDifferentAccountType->account_type == 'Debit' && ($SumOfDifferentAccountType->company_type_id != 5 && $SumOfDifferentAccountType->company_type_id != 6 && $SumOfDifferentAccountType->company_type_id != 7 && $SumOfDifferentAccountType->company_type_id != 8) )
             <tr>
               <td>{{$sn}}</td>
               <td>{{$SumOfDifferentAccountType->name}}</td>
               <td id="TrialTotal{{str_replace(' ', '', $SumOfDifferentAccountType->name)}}Balance" style="text-align: right;">{{number_format($SumOfDifferentAccountType->Balance,2, '.', '')}}</td>
             </tr>
              <?php $sn++; ?>
           @endif
           @endforeach
           <tr>
                 <td>#</td>
                 <td>Cash In Hand</td>
                 <td style="text-align: right;">{{number_format($CashInHand->settings_description,2, '.', '')}}</td>
             </tr>
             <tr>

               <td>#</td>
               <td>Closing Stock</td>
               <td style="text-align: right;">{{number_format($closingstock->settings_description,2, '.', '')}}</td>
              </tr>
              <tr>
           
          <tr>
            <td>&nbsp;</td>
             <td><h3>TOTAL</h3></td>
             <td id="TotalAssetsBalance" style="text-align: right;">&nbsp;</td>
           </tr>
     </tbody>
               </table>
             </div>
             <!-- /.col -->
           </div>
           <!-- /.row -->
   </div>

  </div>

  <script>

TrialTotalCreditorsBalance = 0;
	TrialTotalDebitBalance = 0;

	TradingTotalCreditBalance = 0;
	TradingTotalDebitBalance = 0;
	
	assetsTableTotal = 0;
	liablitiesTableTotal = 0;


	LossSideTableTotal 		= 0; 
	ProfitSideTableTotal 	= 0
	ProfitSideExpenseTableTotal = 0;

	$('#credit-table tr').each(function(index, value) {
    	TrialTotalCreditorsBalance =  parseFloat(Number($(this).find('td:eq(2)').text())) + TrialTotalCreditorsBalance ;
	});

	$('#debit-table tr').each(function(index, value) {
    	TrialTotalDebitBalance =  parseFloat(Number($(this).find('td:eq(2)').text())) + TrialTotalDebitBalance ;
	});


	$('#trading-credit-table tr').each(function(index, value) {
    	TradingTotalCreditBalance =  parseFloat(Number($(this).find('td:eq(2)').text())) + TradingTotalCreditBalance ;
	});

	$('#trading-debit-table tr').each(function(index, value) {
		TradingTotalDebitBalance =  parseFloat(Number($(this).find('td:eq(2)').text())) + TradingTotalDebitBalance ;
	});

	

	Grossprofit = TradingTotalCreditBalance - TradingTotalDebitBalance;
	TradingTotalDebitBalance = Grossprofit + TradingTotalDebitBalance;
	$('.grossprofit').html(Grossprofit.toFixed(2));


	$('#loss-table tr').each(function(index, value) {
		LossSideTableTotal =  parseFloat(Number($(this).find('td:eq(2)').text())) + LossSideTableTotal ;
	});



	$('#profit-table tr').each(function(index, value) {

		ProfitSideExpenseTableTotal =  parseFloat(Number($(this).find('td:eq(2)').text())) + ProfitSideExpenseTableTotal ;
	});

	NetProfit = Grossprofit - ProfitSideExpenseTableTotal;
	ProfitSideTableTotal = NetProfit + ProfitSideExpenseTableTotal;
	$('.NetProfit').html('<b>'+NetProfit.toFixed(2)+'</b>');

	$('#liabilties-table tr').each(function(index, value) {
		liablitiesTableTotal =  parseFloat(Number($(this).find('td:eq(2)').text())) + liablitiesTableTotal ;
	});
	$('#assets-table tr').each(function(index, value) {
		assetsTableTotal =  parseFloat(Number($(this).find('td:eq(2)').text())) + assetsTableTotal ;
	});

	$('#TrialTotalCreditBalance').html('<h3>'+TrialTotalCreditorsBalance.toFixed(2)+'</h3>');
	$('#TrialTotalDebitBalance').html('<h3>'+TrialTotalDebitBalance.toFixed(2)+'</h3>');

	$('#TradingTotalCreditBalance').html('<h3>'+TradingTotalCreditBalance.toFixed(2)+'</h3>');
	$('#TradingTotalDebitBalance').html('<h3>'+TradingTotalDebitBalance.toFixed(2)+'</h3>');

	$('#TotalLossTableBalance').html('<h3>'+LossSideTableTotal.toFixed(2)+'</h3>');
  $('#TotalProfitTableBalance').html('<h3>'+ProfitSideTableTotal.toFixed(2)+'</h3>');
  $('#TotalLiabiltiesBalance').html('<h3>'+liablitiesTableTotal.toFixed(2)+'</h3>');
	$('#TotalAssetsBalance').html('<h3>'+assetsTableTotal.toFixed(2)+'</h3>');


    </script>
@endsection