@extends('layouts.mainlayout')
@section('content-header')
<h2>Trial Balance </h2>
@endsection
@section('content')
    <section class="invoice">
        <div class="row">
        
            <div class="filter">
              <label for="fiscal_year">Fiscal Years: </label>
              <select id="fiscal_year" name="fiscal_year">
            
                @foreach($fiscalYears as $year)
                  <option value="{{ $year->id }}">{{ $year->fiscal_year_name }}</option>
                @endforeach 
                </select>
            </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> Trial Balance.
              <small class="pull-right">Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div>
          <!-- /.col -->
        </div>

        <!-- Cash in hand -->
        @if($current_fiscal_year->current_fiscal_year == 1)
        <div class="row invoice-info">
        
          <div class="form-group">
               <form method="post" action="/admin/trialbalance/store">
                {!! csrf_field() !!}
                  <div class="col-md-3">
                      <input type="number" min="0" class = "form-control" step="0.01" placeholder="Cash In Hand" name="cash_in_hand" >
                  </div>
                  <div class="col-md-2">
                      <button type="submit" class="btn btn-default">SAVE</button>
                  </div>
                </form>
            </div>
          </div>
          @endif
          <div class="row">
            <div class="col-xs-6 table-responsive">
              <table class="table table-striped"  id="credit-table">
                <thead>
                  <tr>
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
                  <td>&nbsp;</td>
                  <td><h3>TOTAL</h3></td>
                  <td id="TrialTotalCreditBalance" style="text-align: right;">&nbsp;</td>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="col-xs-6 table-responsive">
              <table class="table table-striped" id="debit-table">
                <thead>
                  
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
                  <?php $sn = 1;?>
                @foreach($SumOfDifferentAccountTypes as $SumOfDifferentAccountType)
                  @if($SumOfDifferentAccountType->account_type == 'Debit')
                    <tr>
                      <td>{{$sn}}</td>
                      <td>{{$SumOfDifferentAccountType->name}}</td>
                      <td id="TrialTotal{{str_replace(' ', '', $SumOfDifferentAccountType->name)}}Balance" style="text-align: right;">{{number_format($SumOfDifferentAccountType->Balance,2, '.', '')}}</td>
                    </tr>
                     <?php $sn++; ?>
                  @endif
                @endforeach

                  @if ( !empty ( $CashInHand ) ) 
                  <tr>
                    <td>#</td>
                    <td>Cash In Hand</td>
                    <td style="text-align: right;">{{number_format($CashInHand->settings_description,2, '.', '')}}</td>
                  </tr>
                  @endif
                  <tr>
                    <td>#</td>
                    <td>Opening Stock</td>
                    <td style="text-align: right;">{{number_format($openingstock->settings_description, 2, '.', '')}}</td>
                  </tr>
               <tr>
                <tr>
                  <td>&nbsp;</td>
                   <td><h3>TOTAL</h3></td>
                   <td id="TrialTotalDebitBalance" style="text-align: right;">&nbsp;</td>
                 </tr>
                  
                </tbody>
              </table>
            </div>
          </div>
    </section>

    <script>
      TrialTotalCreditorsBalance = 0;
        TrialTotalDebitBalance = 0;

        $('#credit-table tr').each(function(index, value) {
          TrialTotalCreditorsBalance =  parseFloat(Number($(this).find('td:eq(2)').text())) + TrialTotalCreditorsBalance ;
        });

        $('#debit-table tr').each(function(index, value) {
          TrialTotalDebitBalance =  parseFloat(Number($(this).find('td:eq(2)').text())) + TrialTotalDebitBalance ;
        });


        $('#TrialTotalCreditBalance').html('<h3>'+TrialTotalCreditorsBalance.toFixed(2)+'</h3>');
        $('#TrialTotalDebitBalance').html('<h3>'+TrialTotalDebitBalance.toFixed(2)+'</h3>');
      </script>

@endsection