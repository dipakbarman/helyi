@extends('backend.master')
@section('body')
@php
    $allplanq = DB::table('plans')->where('is_deleted',0)->get();
@endphp

<div class="row">
    <div class="content-body"><!-- users list start -->
        <section class="app-user-list">
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <h4 class="col-md-12 card-title text-center">
                      Users
                    </h4>
                    <div class="col-6 br-1 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75">{{count_total_user()}}</h3>
                        <span>Total</span>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75">{{count_total_pending_user()}}</h3>
                        <span>Pending</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <h4 class="col-md-12 card-title text-center">
                      Shops
                    </h4>
                    <div class="col-6 br-1 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75"> <a href="{{ url('storelist') }}">{{count_total_shop()}}</a></h3>
                        <span>Total</span>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75"> <a href="{{ url('storependinglist') }}">{{count_total_pending_shop()}}</a> </h3>
                        <span>Pending</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <h4 class="col-md-12 card-title text-center">
                      Distributors
                    </h4>
                    <div class="col-6 br-1 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75"> <a href="{{ url('distributorlist') }}"> {{count_total_distributor()}} </a></h3>
                        <span>Total</span>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75"><a href="{{ url('distributorpendinglist') }}">{{count_total_pending_distributor()}}</a></h3>
                        <span>Pending</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <h4 class="col-md-12 card-title text-center">
                      Master Distributors
                    </h4>
                    <div class="col-6 br-1 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75"> <a href="{{ url('masterdistributorlist') }}"> {{count_total_masterdistri()}} </a></h3>
                        <span>Total</span>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <div>
                        <h3 class="fw-bolder mb-75"><a href="{{ url('masterdistributorpendinglist') }}">{{count_total_pending_masterdistri()}}</a></h3>
                        <span>Pending</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Row grouping -->
        <section id="">
          <div class="row">
            <div class="col-12">
              <div class="card p-2">
                <div class="row">
                  <div class="col-md-4">
                    <form action="{{ url($searchlink) }}" method="get">
                      @csrf
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i data-feather='search'></i></span>
                      <input
                        type="number"
                        id="fname-icon"
                        class="form-control"
                        name="number"
                        placeholder="Search records by phone number"
                      />
                    </div>
                  </form>
                  </div>
                  <div class="col-md-3">
                    <button type="button" id="Add_money_to_wallet" class="btn font-13 btn-block btn-success waves-effect waves-float waves-light">Add money to wallet</button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" id="deduct_money_to_wallet" class="btn font-13 btn-block btn-success waves-effect waves-float waves-light">Deduct money from wallet</button>
                  </div>
                  <div class="col-md-1 text-center">
                    <button class="btn btn-block btn-success" type="button"> <i data-feather='refresh-ccw'></i></button>
                  </div>
                  <div class="col-md-1 text-center">
                    
                    <button class="btn btn-block btn-success" type="button"> <i data-feather='log-in'></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">@if(isset($pgtitle)) {{$pgtitle}} @endif</h4>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="addmoney_cls" style="display: none;">Add Money</th>
                        <th class="deductmoney_cls" style="display: none;">Deduct Money</th>
                        <th>Store Id</th>
                        <th>Store Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Wallet</th>
                        <th>Lein Wallet</th>
                        <th>Distibutor</th>
                        <th>Master Distibutor</th>
                        <th>Current plan</th>
                        @if(isset($qist_type))
                        @if($qist_type == 3 || $qist_type == 4)
                        <th>Total Merchant</th>
                        @endif
                        @if($qist_type == 4)
                        <th>Total Distibutor</th>
                        @endif
                        @if($qist_type == 3 || $qist_type == 4)
                        <th>Total Network Balance</th>
                        @endif
                        @endif
                        <th>Change Type</th>
                        <th style="padding-left:80px;padding-right:80px;">Plan</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Instant</th>
                        <th>Send Money</th>
                        <th>KYC Verification</th>
                        <th>City</th>
                        {{-- @if ($qist_type != 1)
                            <th>Type</th>
                        @endif --}}
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($qlist as $list)
                      <tr>
                        <td class="addmoney_cls" style="display: none;">
                          <button class="btn"  onclick="send_to_wallet({{$list->id}})"><i class="far fa-square"></i></button>
                        </td>
                        <td class="deductmoney_cls" style="display: none;">
                          <button class="btn"  onclick="deduct_to_wallet({{$list->id}})"><i class="far fa-square"></i></button>
                        </td>
                        <td>
                          <a class="shop_id_css" href="{{ url('viewshop') }}/{{$list->shop_id}}">{{$list->shop_id}}</a>
                        </td>
                        <td>{{ $list->shop_name }}</td>
                        <td>{{ $list->p_address }}</td>
                        <td>{{ $list->mobile }}</td>
                        <td>{{ $list->view_password }}</td>
                        <td>{{ $list->email }}</td>
                        <td>{{ number_format($list->wallet,0) }}</td>
                        <td>{{ number_format($list->lein_wallet,0) }}</td>
                        <td>
                            @if ($list->type == 1)
                            @if(!empty($list->refer_uid))
                            @php
                                $refer_uid_type = DB::table('merchant')->where('id',$list->refer_uid)->first();
                            @endphp
                              {{ get_user_name($list->refer_uid) }}
                            @endif
                            @endif
                        </td>
                        <td>
                          @if ($list->type == 3)
                          @if(!empty($list->refer_uid))
                            @php
                                $refer_uid_type = DB::table('merchant')->where('id',$list->refer_uid)->first();
                            @endphp
                              {{ get_user_name($list->refer_uid) }}
                            @endif
                          @endif
                          @if ($list->type == 1)
                              @if (!empty($refer_uid_type))
                              @if (!empty($refer_uid_type->refer_uid))
                                {{ get_user_name($refer_uid_type->refer_uid) }}
                              @endif
                              @endif
                          @endif
                        </td>
                        <td>{{ get_plan_name($list->plan_id) }}</td>
                        @if(isset($qist_type))
                        @if($qist_type == 3 || $qist_type == 4)
                        <td> <a href="{{ url('networkstorelist/'.$list->id) }}"> {{count_my_merchant_network($list->id)}} </a></td>
                        @endif
                        @if($qist_type == 4)
                        <td> <a href="{{ url('networkdistributorlist/'.$list->id) }}">{{count_my_distibutor_network($list->id)}}</a></td>
                        @endif
                        @if($qist_type == 3 || $qist_type == 4)
                        <td>
                          @php
                          $bal = DB::table('merchant')->where('refer_uid',$list->id)->sum('wallet');
                          echo number_format($bal,2); 
                          @endphp
                        </td>
                        @endif
                        @endif
                        <td>---</td>
                        <td>
                          @if ($list->is_kyc == 1)
                          <select name="admin_change_plan" id="admin_change_plan{{$list->id}}" onchange="admin_change_plan({{$list->id}})" class="form-select form-control">
                              <option value="">Select Plan</option>
                              
                              @foreach ($allplanq as $planlist)
                              <option @if($list->plan_id == $planlist->id) disabled @endif value='{{ $planlist->id }}'>{{ $planlist->package_name }}@if($list->plan_id == $planlist->id) (User Current Plan) @endif</option>
                              @endforeach
                          </select>
                          @else
                              KYC Pending 
                          @endif
                        </td>
                        <td>--</td>
                        <td>
                          <div class="form-check form-switch form-check-success">
                            <input onclick="change_shop_stats({{$list->id}})" @if($list->is_active == 1) checked @endif type="checkbox" class="form-check-input" id="customSwitch{{$list->id}}" />
                            <label class="form-check-label" for="customSwitch{{$list->id}}">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="form-check form-switch form-check-success">
                            <input onclick="change_instant_stats({{$list->id}})" @if($list->is_instant == 1) checked @endif type="checkbox" class="form-check-input" id="instantcustomSwitch{{$list->id}}"/>
                            <label class="form-check-label" for="instantcustomSwitch{{$list->id}}">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="form-check form-switch form-check-success">
                            <input onclick="change_send_money_stats({{$list->id}})" @if($list->is_send_money == 1) checked @endif type="checkbox" class="form-check-input" id="is_send_moneySwitch{{$list->id}}"/>
                            <label class="form-check-label" for="is_send_moneySwitch{{$list->id}}">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="form-check form-switch form-check-success">
                            <input onclick="change_kyc_stats({{$list->id}})" @if($list->is_kyc == 1) checked @endif type="checkbox" class="form-check-input" id="kyc_swech{{$list->id}}" />
                            <label class="form-check-label" for="kyc_swech{{$list->id}}">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                          </div>
                        </td>
                        <td>{{$list->city}}</td>
                        {{-- @if ($qist_type != 1)
                        <td>
                          <select name="" class="form-control" id="type_change">
                            <option @if($list->type == 4) selected @endif value="4">Master Distributors</option>
                            <option @if($list->type == 3) selected @endif value="3">Distributors</option>
                          </select>
                        </td>
                        @endif --}}
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="alert-octagon" class="me-50"></i>
                                <span>Block</span>
                              </a>
                              <a class="dropdown-item" href="{{ url('viewshop/'.$list->shop_id) }}">
                                <i data-feather="eye" class="me-50"></i>
                                <span>View</span>
                              </a>
                              {{-- <a class="dropdown-item" href="#">
                                <i data-feather="check" class="me-50"></i>
                                <span>Verify</span>
                              </a> --}}
                              <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{ url('deleteshop/'.$list->id) }}">
                                <i data-feather="trash-2" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather='copy'></i>
                                <span>Duplicate</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="message-square" class="me-50"></i>
                                <span>Chat</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="arrow-down-circle" class="me-50"></i>
                                <span>Download info</span>
                              </a>
                              <a target="_blank" class="dropdown-item" href="{{ url('view_kyc_document/'.$list->id) }}">
                                <i data-feather="file" class="me-50"></i>
                                <span>View Document</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  {{ $qlist->withQueryString()->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>
<!--/ Row grouping -->
        
                </div>    
</div>
<script>
var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
    $("#nhide").show();
    return str;
}
function get_calculate_val(){
  $('input[name="topupmen"]:checked').prop('checked', false);
    $("#fee_view_sec").hide();
    var add_amount_filed = $('#add_amount_field').val();
    $('#ammount_in_word_admin').html(inWords(add_amount_filed));
}
function get_deduct_calculate_val(){
  $('input[name="topupmen"]:checked').prop('checked', false);
    $("#fee_view_sec").hide();
    var add_amount_filed = $('#deduct_amount_field').val();
    $('#deduct_amount_field_inword').html(inWords(add_amount_filed));
}
</script>
@endsection