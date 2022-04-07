@extends('backend.master')
@section('body')
<div class="row">
    @include('backend.admin.tpage_menu')
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title pdf_btn_al">
                Add Wallet History
            </h4>
            <form action="{{ url('admin_add_wallet_history_filter') }}" method="get">
                @csrf
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="">Select type</label>
                    <select name="filter_type"  class="form-control">
                        <option value="">Type</option>
                        <option value="1">Today</option>
                        <option value="2">Last 7 days</option>
                        <option value="3">This month</option>
                        <option value="4">Custom Date</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Filter Type</label>
                    <select name="f_type" onchange="set_filter_type(this.value)" id="add_wallet_filter_type" class="form-control">
                        <option value="5">Transaction Id</option>
                        <option value="7">Status</option>
                        <option value="6">Payment Methods</option>
                        <option value="8">Order Amount</option>
                        <option value="11">User Data</option>
                    </select>
                </div>
                <div class="col-md-6" id="epart" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Order Amount Type</label>
                            <select name="order_amount_type" class="form-control" id="">
                                <option value="1">Is less than equal to</option>
                                <option value="3">Is equal to</option>
                                <option value="4">Is greater than equal to</option>
                                <option value="5">Is less than</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Enter Amount</label>
                            <input type="number" name="order_amount" class="form-control" id="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="dpart" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Select Status</label>
                            <select name="status_type" class="form-control" id="">
                                <option value="1">Success</option>
                                <option value="0">Pending</option>
                                <option value="3">Failed</option>
                                <option value="3">Incomplete</option>
                                <option value="3">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="hpart" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">User Name</label>
                            <input type="text" name="username" class="form-control" id="">
                        </div>
                        <div class="col-md-6">
                            <label for="">Phone number</label>
                            <input type="number" name="phone_number" class="form-control" id="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="cpart">
                </div>
                <div class="col-md-6" id="bpart" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                    </div>
                </div>
                <div class="col-md-6" id="apart" style="display: none;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="date_range" style="display:none;">
                                <label for="">From Date</label>
                                <input type="text"  id="home_filter_from_date" name="from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="date_range"  style="display:none;">
                                <label for="">To Date</label>
                                <input type="text" id="home_filter_to_date" name="to_date" class="form-control">
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
                
                <div class="col-md-1" >
                    <label for=""> </label>
                    <button type="submit" class="btn btn-success btn-block"><i data-feather='filter'></i></button>
                </div>
                <div class="col-md-1">
                    <label for=""> </label>
                    <a href="{{ url('admin_add_wallet_history') }}" type="submit" class="btn btn-success btn-block"><i data-feather='log-in'></i></a>
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
                              <th >Date</th>
                              <th>Time</th>
                              <th>Particulars</th>
                              <th>Txn. Amount</th>
                              <th>User Name</th>
                              <th>Sender Mobile</th>
                              <th>Transaction No.</th>
                              <th>Payment Methods</th>
                              <th>Payment Options</th>
                              <th>Helyi processing Fee</th>
                              <th>Balance</th>
                              <th>Action</th>
                              <th>Credit Time</th>
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
                              <td>#{{ $list->id }}</td>
                              <td style="padding: 0px;">{{ $list->view_date }}</td>
                              <td>{{ $list->time }}</td>
                             <td>
                                 Add
                             </td>
                             <td>
                                {{ number_format($list->total_amount,2) }}
                            </td>
                             <td>
                                {{get_user_name($list->userid)}}
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
                                  {{ number_format($list->bankit_fee,0) }}
                              </td>
                              <td>
                                  {{ number_format($list->balance,0) }}
                              </td>
                              <td>
                                  Credit
                              </td>
                              <td>
                                  @if(!empty($list->timestamp))
                                  {{date('d-m-Y h:i:s a',$list->timestamp)}}
                                  @endif
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