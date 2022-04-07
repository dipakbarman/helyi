@extends('backend.master')
@section('body')
<div class="row mb-2">
    <div class="col-md-12">
        @include('backend.shop.tpage_menu')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title mb-2 pdf_btn_al">
              <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
              Payout Transaction 
                <a target="_blank" href="{{ url('printpayouttransaction') }}" class="btn btn-success">Export to PDF</a>
                <a href="{{ url('export_payouttransaction') }}" class="btn btn-success ml-2">Export to Excel</a>
            </h4>
            <form action="{{ url('payoutfilter') }}" method="get">
                @csrf
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="">Filter Type</label>
                    <select name="filter_type" onchange="set_filter_type(this.value)" id="add_wallet_filter_type" class="form-control" required>
                        <option value="">Type</option>
                        <option value="1">Today</option>
                        <option value="2">Last 7 days</option>
                        <option value="3">This month</option>
                        <option value="4">Custom Date</option>
                        <option value="6">Status</option>
                    </select>
                </div>
                <div class="col-md-6" id="cpart"></div>
                <div class="col-md-6" id="bpart" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="payment_options" id="payment_options" >
                                <label for="">Payment Status</label>
                                    <select name="payment_status" class="form-control form-select">
                                        <option value="1">Successful</option>
                                        <option value="0">Processing</option>
                                        <option value="2">Failed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="apart" style="display: none;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="date_range"  style="display:none;">
                                <label for="">From Date</label>
                                <input type="text" id="from_date" name="from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="date_range"   style="display:none;">
                                <label for="">To Date</label>
                                <input type="text" id="to_date" name="to_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="oder_id_fild" id="order_id" style="display:none;">
                                <label for="">Transaction Id</label>
                                <input type="text" name="order_id_f" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-2" >
                    <label for=""> </label>
                    <button type="submit" class="btn btn-success btn-block">Filter</button>
                </div>
                <div class="col-md-2">
                    <label for=""> </label>
                    <a href="{{ url('payouttransaction') }}" type="submit" class="btn btn-success btn-block">Reset</a>
                </div>
            </div>
        </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th>Sl. No.</th> 
                                  <th>Date</th>
                                  <th>Amount</th>
                                  <th>Tax</th>
                                  <th>Transaction Id</th>
                                  <th>Reference Id</th>
                                  <th>UTI</th>
                                  <th>User Name</th>
                                  <th>Account Number</th>
                                  <th>IFSC</th>
                                  <th>Status</th>
                                  <th>Print</th>
                                </tr>
                              </thead>
                                <tbody>
                                    @foreach ($q as $index => $list)
                                    <tr>
                                    <td>{{$index + $q->firstItem()}}</td>
                                    <td>{{ $list->date }}</td>
                                    <td>{{ number_format($list->amount,0) }}</td>
                                    <td>{{ number_format($list->tax,0) }}</td>
                                    <td>{{ $list->transferid }}</td>
                                    <td>{{ $list->referenceId }}</td>
                                    <td>{{ $list->uti }}</td>
                                    <td>
                                        @php
                                            $find_uname_q = DB::table('merchant_bank_accounts')->where('id',$list->bankid);
                                            $count = $find_uname_q->count();
                                            if($count > 0){
                                                $find_uname_val = $find_uname_q->first();
                                                if(!empty($find_uname_val->varify_user_name)){
                                                    echo $find_uname_val->varify_user_name;
                                                }else{
                                                    echo $find_uname_val->name;
                                                }
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $list->account_no }}</td>
                                    <td>{{ $list->ifsc }}</td>
                                    <td>
                                        @if($list->status == 1)
                                        <span class='badge badge-glow bg-success'>{{ $list->status_text }}</span>
                                        @endif
                                        @if($list->status == 2)
                                            <span class='badge badge-glow bg-danger'>{{$list->status_text}}</span>
                                            @endif
                                        @if($list->status == 0)
                                        <span class='badge badge-glow bg-warning'>
                                            @if ($list->status_text == "SUCCESS")
                                            PENDING
                                            @else
                                                {{$list->status_text}}
                                            @endif
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ url('print_payout_response/'.$list->id) }}" class="btn btn-sm btn-success mx-1">Print</a>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                    <div class="py-2">
                        {{$q->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection