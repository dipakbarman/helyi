@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title mb-2 pdf_btn_al">              
                All Transaction 
            </h4>
            <div class="row">
                <div class="py-2">
                    <form action="{{ url('admin_all_transaction') }}" method="get">
                      @csrf
                      <div class="row">
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="user_name" placeholder="User name">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="user_phone_number" placeholder="Phone number">
                        </div>
                        <div class="col-md-2">
                            <input type="text"  id="home_filter_from_date" name="from_date" class="form-control" placeholder="From date">
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="home_filter_to_date" name="to_date" class="form-control" placeholder="To date">
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-success btn-block">Search</button>
                        </div>
                        <div class="col-md-2">
                          <a href="{{ url('admin_all_transaction') }}"  class="btn btn-success btn-block">Reset</a>
                        </div>
                      </div>
                    </form>
                  </div>
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Sl. No.</th> 
                          <th>Date/Time</th>
                          <th>Name</th>
                          <th>Phone No</th>
                          <th>Amount</th>
                          <th>Action</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($q as $index => $list)
                        <tr>  
                          <td>{{$index + $q->firstItem()}}</td>
                            <td>{{ $list->time }}-{{ $list->viewdate }}</td>
                            <td>{{ get_user_firstname($list->uid) }}</td>
                            <td>{{ $list->mobile }}</td>
                            @if(!empty($list->atype))
                            @if ($list->atype == 2)
                            <td><div class="fw-bolder text-danger"> - {{number_format($list->amt,0)}}</div></td>
                            @endif
                            @if ($list->atype == 1)
                            <td> <div class="fw-bolder text-success">+ {{ number_format($list->amt,0)}}</div></td>
                            @endif
                            @else
                            <td>-</td>
                            @endif
                            <td>
                                {{ $list->r }}
                            </td>
                            @php
                            $link = "";
                            if ($list->r == "Payout bank transfer") {
                              $link = "payouttransaction";
                            }else if($list->r == "Internal Transfer"){
                              $link = "internaltransition";
                            }else if($list->r == "Epos Amount Added To Main Wallet" || $list->r == "Processing Fee" || $list->r == "Add Wallet" || $list->r == ("EPOS Add Wallet")){
                              $link = "addwallettransition";
                            }else if($list->r == "Epos lein to main wallet" || $list->r == "EPOS Added Wallet" || $list->r == "Epos lein to main wallet"){
                              $link = "transaction_history";
                            }else if($list->r == "Commission Earned"){
                              $link = "comissionhistory";
                            }
                            @endphp
                            <td><div class="fw-bolder"> <span class="text-success">{{ number_format($list->bal,0)}}</span> @if(!empty($link)) <span></span> @endif </div> </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="py-2">
                      {{$q->withQueryString()->links()}}
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection