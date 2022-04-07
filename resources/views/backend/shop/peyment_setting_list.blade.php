@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title mb-2">
              <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                Link history
            </h4>
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL.No.</th>
                          <th>Name</th>
                          <th>Date</th>
                          <th>Pay Option</th>      
                          <th>Phone</th>                    
                          <th>Email</th>                    
                          <th>Order Id</th>                                                   
                          <th>Note</th>                                              
                          <th>link</th>                          
                          <th>Amount</th>                          
                                            
                        </tr>
                      </thead>
                      <tbody>                        
                        @foreach ($peyment_request_link as $index => $list)
                        <tr>
                          <td>{{$index + $peyment_request_link->firstItem()}}</td>
                            <td>{{ $list->name }}</td>
                            <td>{{ datedbu($list->datemin) }}</td>
                            <td>{{ payment_link_option_name($list->pey_option) }}</td>
                            <td>{{ $list->phone }}</td>
                            <td>{{ $list->email }}</td>
                            <td>{{ $list->order_id_rand }}</td>
                            <td>{{ $list->note }}</td>                            
                            <td>{{ $list->link }}</td>
                            <td>{{ $list->total }}</td>                                                                                                     
                        </tr>
                        @endforeach                         
                      </tbody>
                    </table>
                    <div class="py-2">
                      {{$peyment_request_link->withQueryString()->links()}}
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection