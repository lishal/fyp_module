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
                </tbody>
              </table>
            </div>
          </div>
    </section>

@endsection