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
            <h4 class="card-title pdf_btn_al">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif ><i data-feather='arrow-left'></i></a> 
                Add Wallet Transaction History @if(isset($title)) @if($title == 1) (Razorpay) @endif @if($title == 2) (Cashfree) @endif @endif <span>
                    <a href="{{ url('export_wallet_add_transaction') }}" class="btn btn-success">Export to Excel</a>
                    <a target="_blank" href="{{ url('printaddwallettransition') }}" class="btn btn-success">Export to PDF</a>
                </span>
            </h4>
            <form action="{{ url('addwallettransitionfilter') }}" method="post">
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
                        <option value="5">Transaction Id</option>
                        <option value="6">Payment Methods</option>
                    </select>
                </div>
                <div class="col-md-6" id="cpart"></div>
                <div class="col-md-6" id="bpart" style="display: none;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="payment_options" id="payment_options" >
                                <label for="">Payment Options</label>
                                @php
                                    $payment_optionsq = DB::table('payment_options')->get();
                                    $topup_optionsq = DB::table('topup_options')->get();
                                @endphp
                                    <select name="payment_options" class="form-control form-select">
                                    @foreach ($payment_optionsq as $list)
                                        <option value="{{$list->id}}">{{$list->option_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=""  id="toup_options">
                                <label for="">To-up Options</label>
                                <select name="toup_options" class="form-control form-select">
                                    <option value="">Select Option</option>
                                    @foreach ($topup_optionsq as $list)
                                        <option value="{{ $list->type }}">{{ $list->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=""  id="toup_options">
                                <label for="">Status</label>
                                <select name="pay_status" class="form-control form-select">
                                    <option value="">Select Option</option>
                                        <option value="0">Successful</option>
                                        <option value="1">Processing </option>
                                        <option value="2">Failed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="apart" style="display: none;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="date_range" id="from_date" style="display:none;">
                                <label for="">From Date</label>
                                <input type="date"  name="from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="date_range"  id="to_date" style="display:none;">
                                <label for="">To Date</label>
                                <input type="date" name="to_date" class="form-control">
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
                    <a href="{{ url('addwallettransition') }}" type="submit" class="btn btn-success btn-block">Reset</a>
                </div>
            </div>
        </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>SL No</th>
                              <th>Order Id</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Particulars</th>
                              <th>Sender Mobile</th>
                              <th>Transaction No.</th>
                              <th>Payment Methods</th>
                              <th>Payment Options</th>
                              @if(session()->get('type') != 1)
                              <th>Txn. Amount</th>
                              <th>Commission</th>
                              @endif
                              @if(session()->get('type') == 1)
                              <th>Txn. Amount/Commission</th>
                              @endif
                              <th>Processing Fee</th>
                              <th>Balance</th>
                              <th>Action</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                            @foreach ($q as $index => $list)
                            <tr>
                                <td>{{$index + $q->firstItem()}}</td>
                                <td> <a href="{{ url('transition_view/'.$list->id) }}" target="_blank">#{{ $list->id }}</a></td>
                                <td>{{ $list->view_date }}</td>
                                <td>{{ $list->time }}</td>
                               <td>
                                   Add
                               </td>
                                <td id="ji">
                                    {{-- {{ get_user_number($list->userid) }} --}}
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input class="form-control number_copy_field" type="text" readonly value="{{ get_user_number($list->userid) }}" id="number_copy{{$list->id}}">
                                        </div>
                                        <div class="col-md-2">
                                            <span id="jo"><i onclick="numbercopy('{{$list->id}}')" style="cursor: copy;" class="far fa-copy"></i></span>
                                        </div>
                                    </div>
                                </td>
                                <td id="ji">
                                    <input class="form-control pey_id_copy_field" type="text" readonly value="{{ $list->payment_id }}" id="pey_id_copy{{$list->id}}">
                                    <span id="jo"><i onclick="payidcopy('{{$list->id}}')" style="cursor: copy;" class="far fa-copy"></i></span>
                                </td>
                                <td>
                                    {{ get_payment_methods($list->paymentoption) }}
                                </td>
                                <td>
                                    {{ get_payment_options($list->topuptype) }}
                                </td>
                                <td>
                                    {{  number_format($list->total_amount,0) }}
                                </td>
                                @if(session()->get('type') != 1)
                                    <td>
                                        {{  number_format($list->commission,0) }}
                                    </td>
                                    <td>
                                        {{  number_format($list->bankit_fee,0) }}
                                    </td>
                                @endif
                              @if(session()->get('type') == 1)
                              <td>
                                {{  number_format($list->bankit_fee,0) }}
                            </td>
                              @endif
                                <td>
                                    {{  number_format($list->balance,0) }}
                                </td>
                                <td>
                                    Credit
                                </td>
                                <td>
                                    @php
                                        if($list->is_added == 0){
        echo "<span class='badge badge-glow bg-warning'>Processing</span>";
                                        }
                                        if($list->is_added == 1){
                                            echo "<span class='badge badge-glow bg-success'>Successful</span>";                       
                                        }
                                        if($list->is_added == 3){
                                            echo "<span class='badge badge-glow bg-danger'>Failed</span>";                       
                                        }
                                    @endphp
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
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