@extends('backend.master')
@section('body')


<div class="row">
    <div class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card py-2 px-2">
                    <div class="row match-height">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light">Wallet</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light">Add Money</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light">Send Money</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>  
<div class="row">
    <div class="content-body"><!-- users list start -->
        
        <!-- Row grouping -->
        <section id="multilingual-datatable">
          <div class="row">
            <div class="col-8">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">Latest Transaction</h4>
                </div>
                <div class="">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>01</td>
                        <td>255</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>58</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>489</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        
                      </tr>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="info_tabs">
                            <span style="color: green;">To Collect</span>
                            <span style="float: right;"> <i class="fas fa-rupee-sign"></i> 10</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info_tabs">
                            <span style="color: red;">To Pay</span>
                            <span style="float: right;"> <i class="fas fa-rupee-sign"></i> 10</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info_tabs">
                            <span>Cash + Bank</span>
                            <span style="float: right;"> <i class="fas fa-rupee-sign"></i> 10</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info_tabs">
                            <span>Stock Value</span>
                            <span style="float: right;"> <i class="fas fa-rupee-sign"></i> 10</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info_tabs">
                            <span>Low Stock</span>
                            <span style="float: right;"> 10 items</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </section>
        
                </div>    
</div>

@endsection