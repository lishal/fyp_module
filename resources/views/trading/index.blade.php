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
                           <form method="post" action="#">
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
                    
                </tbody>
               </table>
             </div>
             <!-- /.col -->
           </div>
           <!-- /.row -->
   </div>

  </div>
@endsection