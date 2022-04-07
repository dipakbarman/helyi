@extends('backend.master')
@section('body')
<div class="row match-height">
    <div class="content-body">
        <section class="app-user-list">
            <div class="row match-height">
                <div class="col-md-4">
                    <div class="col-lg-12 col-md-6 col-12">
                      <div class="card earnings-card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6" style="border-right: 1px solid #eee;">
                              <h4 class="card-title mb-1">Sales</h4>
                              <div class="font-small-2">This Month</div>
                              <h5 class="mb-1">0</h5>
                              <p class="card-text text-muted font-small-2">
                                {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                              </p>
                            </div>
                            <div class="col-6">
                              <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                              <div class="font-small-2">Today</div>
                              <h5 class="mb-1">0</h5>
                              <p class="card-text text-muted font-small-2">
                                {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="col-lg-12 col-md-6 col-12">
                      <div class="card earnings-card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6" style="border-right: 1px solid #eee;">
                              <h4 class="card-title mb-1">customers</h4>
                              <div class="font-small-2">This Month</div>
                              <h5 class="mb-1">{{count_total_user_this_month()}}</h5>
                              <p class="card-text text-muted font-small-2">
                                
                              </p>
                            </div>
                            <div class="col-6">
                              <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                              <div class="font-small-2">Today</div>
                              <h5 class="mb-1">{{count_total_user_today()}}</h5>
                              <p class="card-text text-muted font-small-2">
                                
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="col-lg-12 col-md-6 col-12">
                      <div class="card earnings-card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6" style="border-right: 1px solid #eee;">
                              <h4 class="card-title mb-1">Stores</h4>
                              <div class="font-small-2">This Month</div>
                              <h5 class="mb-1">{{count_total_store_this_month()}}</h5>
                              <p class="card-text text-muted font-small-2">
                                
                              </p>
                            </div>
                            <div class="col-6">
                              <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                              <div class="font-small-2">Today</div>
                              <h5 class="mb-1">{{count_total_store_today()}}</h5>
                              <p class="card-text text-muted font-small-2">
                                
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @php
                      $count_total_lein_balance = DB::table('merchant')->where('is_deleted',0)->sum('lein_wallet');
                      $count_total_wallet_balance = DB::table('merchant')->where('is_deleted',0)->sum('wallet');
                      $total_wallet_processing = DB::table('add_money_log')->where('is_added',0)->count();
                      $total_wallet_successful = DB::table('add_money_log')->where('is_added',1)->count();
                      $total_wallet_failed = DB::table('add_money_log')->where('is_added',3)->count();
                      $curent_mindate = date('Ymd'); 
                      $last_seven_date = date('Ymd', strtotime('-7 days'));
                      $first_date = date('Ym01');
                  @endphp
                  {{-- <div class="col-md-12">
                    <div class="card p-2">
                      <form action="{{ url('admin_dashboard_filter') }}" method="get">
                        @csrf
                        <div class="row">
                          <div class="col-md-1">
                            From Date : 
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="from_date" id="home_filter_from_date" class="form-control admin_date_filed" placeholder="dd-mm-yyyy">
                          </div>
                          <div class="col-md-1">
                            To Date: 
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="to_date" id="home_filter_to_date" class="form-control admin_date_filed" placeholder="dd-mm-yyyy" >
                          </div>
                          <div class="col-md-3">
                            <select class="form-select" name="filter_type" onchange="admin_filter_type(this.value)" id="" required>
                              <option value="">Select Type</option>
                              <option value="1">Total</option>
                              <option value="2">Today</option>
                              <option value="3">Last 7 Days</option>
                              <option value="4">This Month</option>            
                              <option value="5">Custom Date</option>            
                            </select>
                          </div>
                          <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-block">Filter</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div> --}}
                  <div class="col-md-3">
                    <div class="card p-1">
                        <div class="card-headers" style="border-bottom: 1px solid #eee;">
                          Total wallet loaded
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                  <span>
                                    <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,1)' id="info_filter1">
                                      <option value="">Select Type</option>
                                      <option value="1">Total</option>
                                      <option value="2">Today</option>
                                      <option value="3">Last 7 days</option>
                                      <option value="4">This Month</option>
                                      <option value="5">Custom Date</option>
                                    </select>
                                  </span>
                                <i class="fas fa-rupee-sign"></i> 
                                <span id="amount1">
                                  @php
                                    $today = DB::table('add_money_log')->where('min_date',date('Ymd'))->where('is_added',1)->sum('total_amount');
                                    echo number_format($today,2);
                                @endphp
                                </span>
                              {{-- @if($filter_type == 1)
                              @php
                                    $today = DB::table('add_money_log')->where('is_added',1)->sum('total_amount');
                                    echo $today;
                                @endphp
                              @endif
                              @if($filter_type == 2)
                                @php
                                    $today = DB::table('add_money_log')->where('min_date',date('Ymd'))->where('is_added',1)->sum('total_amount');
                                    echo number_format($today.2);
                                @endphp
                              @endif
                              @if($filter_type == 3)
                                @php
                                    $today = DB::table('add_money_log')->whereBetween('min_date',[$curent_mindate,$last_seven_date])->where('is_added',1)->sum('total_amount');
                                    echo number_format($today,2);
                                @endphp
                              @endif
                              @if($filter_type == 4)
                                @php
                                    $today = DB::table('add_money_log')->whereBetween('min_date',[$first_date,$curent_mindate])->where('is_added',1)->sum('total_amount');
                                    echo number_format($today,2);
                                @endphp
                              @endif
                              @if($filter_type == 5)
                              @php
                                   $today = DB::table('add_money_log')->whereBetween('min_date',[$from_date,$to_date])->where('is_added',1)->sum('total_amount');
                                    echo number_format($today,2);
                              @endphp
                              @endif --}}
                                </div>

                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="col-lg-12 col-md-6 col-12">
                      <div class="card earnings-card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <h4 class="card-title mb-1">Payouts</h4>
                            </div>
                            <div class="col-md-12">
                              <span>
                                <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,10)' id="info_filter10">
                                  <option value="">Select Type</option>
                                  <option value="1">Total</option>
                                  <option value="2">Today</option>
                                  <option value="3">Last 7 days</option>
                                  <option value="4">This Month</option>
                                  <option value="5">Custom Date</option>
                                </select>
                              </span>
                            </div>
                            <div class="col-6" style="border-right: 1px solid #eee;">
                              
                              <div class="font-small-2">Total No. Payout</div>
                              
                              <h5 class="mb-1">
                                <span id="amount10">
                                  @if($filter_type == 2)
                                @php
                                    $today = DB::table('payout')->where('mindate',date('Ymd'))->count();
                                    echo number_format($today,2);
                                @endphp
                              @endif
                                </span>
                                {{-- @if($filter_type == 1)
                              @php
                                    $today = DB::table('payout')->count();
                                    echo $today;
                                @endphp
                              @endif
                              @if($filter_type == 2)
                                @php
                                    $today = DB::table('payout')->where('mindate',date('Ymd'))->count();
                                    echo $today;
                                @endphp
                              @endif
                              @if($filter_type == 3)
                                @php
                                    $today = DB::table('payout')->whereBetween('mindate',[$curent_mindate,$last_seven_date])->count();
                                    echo $today;
                                @endphp
                              @endif
                              @if($filter_type == 4)
                                @php
                                    $today = DB::table('payout')->whereBetween('mindate',[$first_date,$curent_mindate])->count();
                                    echo $today;
                                @endphp
                              @endif
                              @if($filter_type == 5)
                              @php
                                   $today = DB::table('payout')->whereBetween('mindate',[$from_date,$to_date])->count();
                                    echo $today;
                              @endphp
                              @endif --}}
                              </h5>
                              <p class="card-text text-muted font-small-2">
                              </p>
                            </div>
                            <div class="col-6">
                              
                              <div class="font-small-2">Amount</div>
                              <h5 class="mb-1">
                                <span id="amount11">
                                  @if($filter_type == 2)
                                @php
                                    $today = DB::table('payout')->where('mindate',date('Ymd'))->where('status',1)->sum('amount');
                                      echo number_format($today,2);
                                @endphp
                              @endif
                                </span>
                                {{-- @if($filter_type == 1)
                                @php
                                      $today = DB::table('payout')->where('status',1)->sum('amount');
                                      echo $today;
                                  @endphp
                                @endif
                                @if($filter_type == 2)
                                  @php
                                      $today = DB::table('payout')->where('mindate',date('Ymd'))->where('status',1)->sum('amount');
                                      echo $today;
                                  @endphp
                                @endif
                                @if($filter_type == 3)
                                  @php
                                      $today = DB::table('payout')->whereBetween('mindate',[$curent_mindate,$last_seven_date])->where('status',1)->sum('amount');
                                      echo $today;
                                  @endphp
                                @endif
                                @if($filter_type == 4)
                                  @php
                                      $today = DB::table('payout')->whereBetween('mindate',[$first_date,$curent_mindate])->where('status',1)->sum('amount');
                                      echo $today;
                                  @endphp
                                @endif
                                @if($filter_type == 5)
                                @php
                                     $today = DB::table('payout')->whereBetween('mindate',[$from_date,$to_date])->where('status',1)->sum('amount');
                                      echo $today;
                                @endphp
                                @endif --}}
                              </h5>
                              <p class="card-text text-muted font-small-2">
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card p-1">
                        <div class="card-headers" style="border-bottom: 1px solid #eee;">
                            Total Network Lein Wallet
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                <i class="fas fa-rupee-sign"></i>
                                @php
                                    echo number_format($count_total_lein_balance,2);
                                @endphp
                                </div>
                                
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card p-1">
                        <div class="card-headers" style="border-bottom: 1px solid #eee;">
                            Total Network Main Wallet
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                <i class="fas fa-rupee-sign"></i> 
                                @php
                                    echo number_format($count_total_wallet_balance,2);
                                @endphp
                                </div>
                                
                            </div>
                        </div>
                    </div>
                  </div>  
                </div>
            </div>      
        </section>
    </div>    
<div class="row">
  <div class="col-md-12 mb-2">
      <h3>Payments</h3>
  </div>
    <div class="col-md-12 mb-2">
    <h4>Wallet</h4>
  </div>
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3">
        <div class="card p-1">
          <div class="card-headers" style="border-bottom: 1px solid #eee;">
            Total Number of transactions Pending
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <span>
                      <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,2)' id="info_filter2">
                        <option value="">Select Type</option>
                        <option value="1">Total</option>
                        <option value="2">Today</option>
                        <option value="3">Last 7 days</option>
                        <option value="4">This Month</option>
                        <option value="5">Custom Date</option>
                      </select>
                    </span>
                    <span id="amount2">
                      @if($filter_type == 2)
                      @php
                          $today = DB::table('add_money_log')->where('min_date',$curent_mindate)->where('is_added',0)->count();
                          echo number_format($today,2);
                      @endphp
                    @endif
                    </span>
                    {{-- @if($filter_type == 1)
                      {{$total_wallet_processing}}
                    @endif
                    @if($filter_type == 2)
                      @php
                          $today = DB::table('add_money_log')->where('min_date',$curent_mindate)->where('is_added',0)->count();
                          echo $today;
                      @endphp
                    @endif
                    @if($filter_type == 3)
                      @php
                          $today = DB::table('add_money_log')->whereBetween('min_date',[$curent_mindate,$last_seven_date])->where('is_added',0)->count();
                          echo $today;
                      @endphp
                    @endif
                    @if($filter_type == 4)
                      @php
                          $today = DB::table('add_money_log')->whereBetween('min_date',[$first_date,$curent_mindate])->where('is_added',0)->count();
                          echo $today;
                      @endphp
                    @endif
                    @if($filter_type == 5)
                    @php
                      $today = DB::table('add_money_log')->whereBetween('min_date',[$from_date,$to_date])->where('is_added',0)->count();
                      echo $today;
                    @endphp
                    @endif --}}
                  </div>
              </div>
          </div>
      </div>  
      </div>
      <div class="col-md-3">
        <div class="card p-1">
          <div class="card-headers" style="border-bottom: 1px solid #eee;">
            Total Number of transactions Success
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <span>
                      <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,3)' id="info_filter3">
                        <option value="">Select Type</option>
                        <option value="1">Total</option>
                        <option value="2">Today</option>
                        <option value="3">Last 7 days</option>
                        <option value="4">This Month</option>
                        <option value="5">Custom Date</option>
                      </select>
                    </span>
                    <span id="amount3">
                      @if($filter_type == 2)
                      @php
                          $today = DB::table('add_money_log')->where('min_date',$curent_mindate)->where('is_added',1)->count();
                          echo number_format($today,2);
                      @endphp
                    @endif
                    </span>
                  {{-- @if($filter_type == 1)
                   {{$total_wallet_successful}}
                   @endif
                   @if($filter_type == 2)
                     @php
                         $today = DB::table('add_money_log')->where('min_date',$curent_mindate)->where('is_added',1)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 3)
                     @php
                         $today = DB::table('add_money_log')->whereBetween('min_date',[$curent_mindate,$last_seven_date])->where('is_added',1)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 4)
                     @php
                         $today = DB::table('add_money_log')->whereBetween('min_date',[$first_date,$curent_mindate])->where('is_added',1)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 5)
                    @php
                      $today = DB::table('add_money_log')->whereBetween('min_date',[$from_date,$to_date])->where('is_added',1)->count();
                      echo $today;
                    @endphp
                    @endif --}}
                  </div>
              </div>
          </div>
      </div>  
      </div>
      <div class="col-md-3">
        <div class="card p-1">
          <div class="card-headers" style="border-bottom: 1px solid #eee;">
            Total Number of transactions Failed
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <span>
                      <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,4)' id="info_filter4">
                        <option value="">Select Type</option>
                        <option value="1">Total</option>
                        <option value="2">Today</option>
                        <option value="3">Last 7 days</option>
                        <option value="4">This Month</option>
                        <option value="5">Custom Date</option>
                      </select>
                    </span>
                    <span id="amount4">
                      @if($filter_type == 2)
                      @php
                          $today = DB::table('add_money_log')->where('min_date',$curent_mindate)->where('is_added',3)->count();
                          echo number_format($today,2);
                      @endphp
                    @endif
                    </span>
                    {{-- @if($filter_type == 1)
                   {{$total_wallet_failed}}
                   @endif
                   @if($filter_type == 2)
                     @php
                         $today = DB::table('add_money_log')->where('min_date',$curent_mindate)->where('is_added',3)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 3)
                     @php
                         $today = DB::table('add_money_log')->whereBetween('min_date',[$curent_mindate,$last_seven_date])->where('is_added',3)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 4)
                     @php
                         $today = DB::table('add_money_log')->whereBetween('min_date',[$first_date,$curent_mindate])->where('is_added',3)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 5)
                    @php
                      $today = DB::table('add_money_log')->whereBetween('min_date',[$from_date,$to_date])->where('is_added',3)->count();
                      echo $today;
                    @endphp
                    @endif --}}
                  </div>
              </div>
          </div>
      </div>  
      </div>
    </div>
  </div>
  <div class="col-md-12 mb-2">
    <h4>Payout</h4>
  </div>
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3">
        <div class="card p-1">
          <div class="card-headers" style="border-bottom: 1px solid #eee;">
            Total Number of transactions Pending
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <span>
                      <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,5)' id="info_filter5">
                        <option value="">Select Type</option>
                        <option value="1">Total</option>
                        <option value="2">Today</option>
                        <option value="3">Last 7 days</option>
                        <option value="4">This Month</option>
                        <option value="5">Custom Date</option>
                      </select>
                    </span>
                    <span id="amount5">
                      @if($filter_type == 2)
                      @php
                          $today = DB::table('payout')->where('mindate',$curent_mindate)->where('status',0)->count();
                          echo number_format($today,2);
                      @endphp
                    @endif
                    </span>
                  </div>
              </div>
          </div>
      </div>  
      </div>
      <div class="col-md-3">
        <div class="card p-1">
          <div class="card-headers" style="border-bottom: 1px solid #eee;">
            Total Number of transactions Success
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <span>
                      <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,6)' id="info_filter6">
                        <option value="">Select Type</option>
                        <option value="1">Total</option>
                        <option value="2">Today</option>
                        <option value="3">Last 7 days</option>
                        <option value="4">This Month</option>
                        <option value="5">Custom Date</option>
                      </select>
                    </span>
                    <span id="amount6">
                      @if($filter_type == 2)
                      @php
                          $today = DB::table('payout')->where('mindate',$curent_mindate)->where('status',1)->count();
                          echo number_format($today,2);
                      @endphp
                    @endif
                    </span>
                  </div>
              </div>
          </div>
      </div>  
      </div>
      <div class="col-md-3">
        <div class="card p-1">
          <div class="card-headers" style="border-bottom: 1px solid #eee;">
            Total Number of transactions Failed
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <span>
                    <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,7)' id="info_filter7">
                        <option value="">Select Type</option>
                        <option value="1">Total</option>
                        <option value="2">Today</option>
                        <option value="3">Last 7 days</option>
                        <option value="4">This Month</option>
                        <option value="5">Custom Date</option>
                      </select>
                    </span>
                    <span id="amount7">
                      @if($filter_type == 2)
                      @php
                          $today = DB::table('payout')->where('mindate',$curent_mindate)->where('status',2)->count();
                          echo number_format($today,2);
                      @endphp
                    @endif
                    </span>
                  </div>
              </div>
          </div>
      </div>  
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <h4>Internal transaction</h4>
  </div>
  <div class="col-md-4">
    <div class="card p-1">
      <div class="card-headers" style="border-bottom: 1px solid #eee;">
          Total Internal Transaction
      </div>




      <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <span>
                <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter_admin(this.value,8)' id="info_filter9">
                  <option value="">Select Type</option>
                  <option value="1">Total</option>
                  <option value="2">Today</option>
                  <option value="3">Last 7 days</option>
                  <option value="4">This Month</option>
                  <option value="5">Custom Date</option>
                </select>
              </span>
            </div>
            <div class="col-md-6" style="border-right: 1px solid #eee;">
              <p class=" mb-1">Amount</p>
              <span id="amount8">
                @if($filter_type == 2)
                @php
                    $today = DB::table('funds_transfer_log')->where('mindate',$curent_mindate)->where('type',1)->sum('amount');
                         echo number_format($today,2);
                @endphp
              @endif
              </span>
              {{-- @if($filter_type == 1)
                @php
                    $today = DB::table('funds_transfer_log')->where('type',1)->sum('amount');
                    echo $today;
                @endphp
                   @endif
                   @if($filter_type == 2)
                     @php
                         $today = DB::table('funds_transfer_log')->where('mindate',$curent_mindate)->where('type',1)->sum('amount');
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 3)
                     @php
                         $today = DB::table('funds_transfer_log')->whereBetween('mindate',[$curent_mindate,$last_seven_date])->where('type',1)->sum('amount');
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 4)
                     @php
                         $today = DB::table('funds_transfer_log')->whereBetween('mindate',[$first_date,$curent_mindate])->where('type',1)->sum('amount');
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 5)
                    @php
                      $today = DB::table('funds_transfer_log')->whereBetween('mindate',[$from_date,$to_date])->where('type',1)->sum('amount');
                      echo $today;
                    @endphp
                    @endif --}}
            </div>
              <div class="col-md-6">
                <p class=" mb-1">Total No. of</p>
                <span id="amount9">
                  @if($filter_type == 2)
                  @php
                      $today = DB::table('funds_transfer_log')->where('mindate',$curent_mindate)->where('type',1)->count();
                         echo number_format($today,2);
                  @endphp
                @endif
                </span>
                {{-- @if($filter_type == 1)
                @php
                    $today = DB::table('funds_transfer_log')->where('type',1)->count();
                    echo $today;
                @endphp
                   @endif
                   @if($filter_type == 2)
                     @php
                         $today = DB::table('funds_transfer_log')->where('mindate',$curent_mindate)->where('type',1)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 3)
                     @php
                         $today = DB::table('funds_transfer_log')->whereBetween('mindate',[$curent_mindate,$last_seven_date])->where('type',1)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 4)
                     @php
                         $today = DB::table('funds_transfer_log')->whereBetween('mindate',[$first_date,$curent_mindate])->where('type',1)->count();
                         echo $today;
                     @endphp
                   @endif
                   @if($filter_type == 5)
                    @php
                      $today = DB::table('funds_transfer_log')->whereBetween('mindate',[$from_date,$to_date])->where('type',1)->count();
                      echo $today;
                    @endphp
                    @endif --}}
              </div>
          </div>
      </div>
  </div>
  </div>
</div>
<div class="row">
    <div class="content-body">
        <section class="app-user-list">
            <div class="row match-height">
                <div class="col-md-4">
                        <div class="card p-1">
                            <div class="card-headers" style="border-bottom: 1px solid #eee;">
                                <a href="{{ url('recentsettlements') }}">Recent settlements</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px solid #eee;">
                                        <i class="fas fa-rupee-sign"></i> 0.00
                                        <br>
                                        <p>settled on 30 Dec 2021</p> 
                                    </div>
                                    <div class="col-md-6">
                                        <i class="fas fa-rupee-sign"></i> 0.00
                                        <br>
                                        <p>settled on 30 Dec 2021</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>    
                <div class="col-md-3">
                    <div class="card p-1">
                        <div class="card-headers" style="border-bottom: 1px solid #eee;">
                            Oprn disputes
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Disputes amount</span>
                                <i class="fas fa-rupee-sign"></i> 0.00
                                </div>
                                
                            </div>
                        </div>
                    </div>
            </div>    
            <div class="col-md-3">
                <div class="card p-1">
                    <div class="card-headers" style="border-bottom: 1px solid #eee;">
                        Suspicious transaction 0 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" >
                                <span>Suspicious amount</span>
                                <i class="fas fa-rupee-sign"></i> 0.00
                                <br>
                            </div>
                            
                        </div>
                    </div>
                </div>
        </div>    
            </div>      
        </section>
    </div>    
</div>  
<div class="row">
  <div class="content-body">
    <div class="row match-height">
      <div class="col-md-6">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column"
          >
            <div class="header-left">
              <h4 class="card-title">Total transaction</h4>
            </div>
            <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
              <i data-feather="calendar"></i>
              <input
                type="text"
                class="form-control flat-picker border-0 shadow-none bg-transparent pe-0"
                placeholder="YYYY-MM-DD"
              />
            </div>
          </div>
          <div class="card-body">
            <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column"
          >
            <div class="header-left">
              <h4 class="card-title">Total refunds</h4>
            </div>
            <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
              <i data-feather="calendar"></i>
              <input
                type="text"
                class="form-control flat-picker border-0 shadow-none bg-transparent pe-0"
                placeholder="YYYY-MM-DD"
              />
            </div>
          </div>
          <div class="card-body">
            <canvas class="horizontal-bar-chart-ex chartjs" data-height="400"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">Average translational value
        <div class="card">
          <div class="card-header">
            <div>
              <h4 class="card-title">Average translational value</h4>
              
            </div>
          </div>
          <div class="card-body">
            <canvas class="line-chart-ex chartjs" data-height="450"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-baseline flex-sm-row flex-column">
            <h4 class="card-title">Preferred payment methods</h4>
            <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
              <i data-feather="calendar"></i>
              <input
                type="text"
                class="form-control flat-picker border-0 shadow-none bg-transparent pe-0"
                placeholder="YYYY-MM-DD"
              />
            </div>
          </div>
          <div class="card-body">
            <canvas class="line-area-chart-ex chartjs" data-height="450"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection