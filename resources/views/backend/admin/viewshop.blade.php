@extends('backend.master')
@section('body')
@php
    $shopid = "";
    $id = "";
    $firstname = "";
    $lastname = "";
    $dob = "";
    $pass = "";
    $gender = "";
    $mobile = "";
    $email = "";
    $p_address = "";
    $referral = "";
    $is_otp = "";
    $shop_name = "";
    $shop_phone = "";
    $business_category = "";
    $shop_number = "";
    $landmark = "";
    $city = "";
    $pincode = "";
    $state = "";
    $geolocation = "";
    $city_of_operation = "";
    $area_of_operation = "";
    $gst = "";
    $fssai = "";
    $recharge_services = "";
    $money_services = "";
    $aeps_services = "";
    $epos_services = "";
    $pancard_services = "";
    $debit = "";
    $netbanking = "";
    $upi = "";
    $credit = "";
    $amex = "";
    $diners = "";
    $wallet_option = "";
    $corporate = "";
    $prepaid = "";
    $credit_card1 = "";
    $user_type = "";
    if(isset($q)){
        $user_type =  $q->type;
        $shop_id = $q->shop_id;
        $id = $q->id;
        $firstname = $q->firstname;
        $lastname = $q->lastname;
        $dob = $q->dob;
        $gender = $q->gender;
        $mobile = $q->mobile;
        $email = $q->email;
        $p_address = $q->p_address;
        $referral = $q->referral;
        $is_otp = $q->is_otp;
        $shop_name = $q->shop_name;
        $shop_phone = $q->shop_phone;
        $business_category = $q->business_category;
        $shop_number = $q->shop_number;
        $landmark = $q->landmark;
        $city = $q->city;
        $pincode = $q->pincode;
        $state = $q->state;
        $geolocation = $q->geolocation;
        $city_of_operation = $q->city_of_operation;
        $area_of_operation = $q->area_of_operation;
        $gst = $q->gst;
        $fssai = $q->fssai;
        $recharge_services = $q->recharge_services;
        $money_services = $q->money_services;
        $aeps_services = $q->aeps_services;
        $epos_services = $q->epos_services;
        $pancard_services = $q->pancard_services;
        $debit = $q->debit;
        $netbanking = $q->netbanking;
        $upi = $q->upi;
        $credit = $q->credit;
        $amex = $q->amex;
        $diners = $q->diners;
        $wallet_option = $q->wallet_option;
        $corporate = $q->corporate;
        $prepaid = $q->prepaid;
        $credit_card1 = $q->prepaid;
    }
    $reffer_user_id = "";
    $reffer_user_name = "";
    $reffer_user_type = "";
    $reffer_user_phone  = "";
    if(!empty(session()->get('find_q'))){
        $find_q = DB::table('merchant')->where('id',session()->get('find_q'))->first();
        $reffer_user_id = $find_q->id;
        $reffer_user_name = $find_q->name;
        $reffer_user_type = get_user_type($find_q->type);
        $reffer_user_phone = $find_q->mobile;
        session()->forget('find_q');
    }
@endphp
<style>
    .card.earnings-card {
    background: #f7f7f7;
}
</style>

<div class="row">
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills nav-fill">
                                  @if ($user_type != 4)
                                    <li class="nav-item">
                                      <a class="nav-link" id="mapping-tab-fill" data-bs-toggle="pill" href="#mapping-fill" aria-expanded="true"
                                        >Mapping</a
                                      >
                                    </li>
                                    @endif
                                    <li class="nav-item">
                                      <a class="nav-link" id="catalogue-tab-fill" data-bs-toggle="pill" href="#catalogue-fill" aria-expanded="false"
                                        >Catalogue</a
                                      >
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="storysummary-tab-fill" data-bs-toggle="pill" href="#storysummary-fill" aria-expanded="false"
                                          >Story Summary</a
                                        >
                                      </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="stores-tab-fill" data-bs-toggle="pill" href="#stores-fill" aria-expanded="false"
                                        >Stores</a
                                      >
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="stores-tab-fill" data-bs-toggle="pill" href="#services" aria-expanded="false"
                                        >Services</a
                                      >
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="stores-tab-fill" data-bs-toggle="pill" href="#paymentoptions" aria-expanded="false"
                                        >Payment Options</a
                                      >
                                    </li>
                                  </ul>
                            </div>
                        </div>
                     <div class="row">
                         <div class="col-12">
                             <p> <a href="{{ url('storelist') }}"><i data-feather='arrow-left'></i></a>  Stores</p>
                         </div>
                         <div class="col-md-12">
                            <div class="tab-content">
                              @if ($user_type != 4)
                              <div
                              role="tabpanel"
                              class="tab-pane"
                              id="mapping-fill"
                              aria-labelledby="mapping-tab-fill"
                              aria-expanded="true"
                            >
                              <div class="row">
                                <div class="col-md-4" style="padding: 24px 54px;">
                                    <form action="{{ url('find_mapping_data_form') }}" method="get" onsubmit="validbtn()">
                                        @csrf
                                        <input type="hidden" name="main_user_id" value="{{$id}}">
                                        <p style="font-size: 15px;font-weight: 700;margin-bottom: 15px;">
                                        @if(!empty($reffer_user_id))
                                        Name : {{$reffer_user_name}} <br>
                                        Phone number : {{$reffer_user_phone}} <br>
                                        Type : {{$reffer_user_type}} <br>
                                        </p>
                                        <input type="hidden" name="reffer_user_id" value="{{$reffer_user_id}}">
                                        @else
                                        <div class="form-group mb-2">
                                          <label for="">Select User Type</label>
                                          <select name="reffer_user_type" id="" class="form-control" required>
                                            @if ($user_type == 1)
                                            <option value="3">Distibutor</option>
                                            @endif
                                            <option value="4">Master Distibutor</option>
                                          </select>
                                        </div>
                                        <div class="form-group mb-2">
                                          <label for="">Enter Phone Number</label>
                                          <input type="number" required name="phone_number" class="form-control">
                                        </div>
                                        @endif
                                        @if(!empty($reffer_user_id))
                                        <a href="{{ url('viewshop/'.$shop_id) }}" class="btn btn-danger">Cancel</a>
                                        @endif
                                        <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                                        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                                    </form>
                                </div>
                              </div>
                            </div>  
                              @endif
                              <div
                                  role="tabpanel"
                                  class="tab-pane active"
                                  id="storysummary-fill"
                                  aria-labelledby="storysummary-tab-fill"
                                  aria-expanded="true"
                                >
                                <div class="row match-height">
                                    <div class="col-md-4">
                                        <div class="col-lg-12 col-md-6 col-12">
                                          <div class="card earnings-card">
                                            <div class="card-body">
                                              <div class="row">
                                                <div class="col-6" style="border-right: 1px solid #eee;">
                                                  <h4 class="card-title mb-1">Sales</h4>
                                                  <div class="font-small-2">This Month</div>
                                                  <h5 class="mb-1">$4055.56</h5>
                                                  <p class="card-text text-muted font-small-2">
                                                    <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
                                                  </p>
                                                </div>
                                                <div class="col-6">
                                                  <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                                                  <div class="font-small-2">This Month</div>
                                                  <h5 class="mb-1">$4055.56</h5>
                                                  <p class="card-text text-muted font-small-2">
                                                    <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
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
                                                  <h5 class="mb-1">$4055.56</h5>
                                                  <p class="card-text text-muted font-small-2">
                                                    <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
                                                  </p>
                                                </div>
                                                <div class="col-6">
                                                  <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                                                  <div class="font-small-2">This Month</div>
                                                  <h5 class="mb-1">$4055.56</h5>
                                                  <p class="card-text text-muted font-small-2">
                                                    <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
                                                  </p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-12">
                                        <div class="card earnings-card">
                                          <div class="card-body pb-50">
                                            <h6>Total Wallet</h6>
                                            <span>
                                              <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{ $id }},1)' id="info_filter1">
                                                <option value="">Select Type</option>
                                                <option value="1">Total</option>
                                                <option value="2">Today</option>
                                                <option value="3">Last 7 days</option>
                                                <option value="4">This Month</option>
                                                <option value="5">Custom Date</option>
                                              </select>
                                            </span>
                                            <div class="row">
                                              {{-- @if(isset($cfilter)) style="display: none;" @endif --}}
                                              <div class="col-md-12 total"  >
                                                <p>@if(isset($filtertype_name)) {{$filtertype_name}} @endif</p>
                                                <h2 class="fw-bolder mb-1"> <a href="{{ url('alltransaction') }}"> <span id="amount1"> {{number_format(total_addmoney_filter($id,$filtertype),0)}} </span></a></h2>
                                              </div>
                                            </div>
                                            <div id="line-area-chart-5"></div>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="row">
                                 
                                  <div class="col-lg-4 col-12">
                                    <div class="card earnings-card">
                                      <div class="card-body pb-50">
                                        <h6>Payouts</h6>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <span>
                                              <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{$id}},2)' id="info_filter2">
                                                <option value="">Select Type</option>
                                                <option value="1">Total</option>
                                                <option value="2">Today</option>
                                                <option value="3">Last 7 days</option>
                                                <option value="4">This Month</option>
                                                <option value="5">Custom Date</option>
                                              </select>
                                            </span>
                                          </div>
                                          <div class="col-md-6">
                                            <p>Amount Transfer</p>
                                            <h2 class="fw-bolder mb-1">
                                              <span id="amount2"> {{number_format(count_payout_amount_transfer_today($id),0)}} </span></h2>
                                          </div>
                                          <div class="col-md-6">
                                            <p>Total Payouts</p>
                                            <h2 class="fw-bolder mb-1">
                                              <span id="amount22"> {{number_format(count_no_of_payout_today($id),0)}} </span>
                                            </h2>
                                          </div>
                                        </div>
                                        <div id="line-area-chart-3"></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-6">
                                    <div class="card earnings-card card-tiny-line-stats">
                                      <div class="card-body pb-50">
                                        <h6>Total Account Added</h6>
                                        <span>
                                          <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{$id}},3)' id="info_filter3">
                                            <option value="">Select Type</option>
                                            <option value="1">Total</option>
                                            <option value="2">Today</option>
                                            <option value="3">Last 7 days</option>
                                            <option value="4">This Month</option>
                                            <option value="5">Custom Date</option>
                                          </select>
                                        </span>
                                        <div class="row">
                                          <div class="col-md-12 total" @if(isset($cfilter)) style="display: none;" @endif>
                                            <p>@if(isset($filtertype_name)) {{$filtertype_name}} @endif</p>
                                            <h2 class="fw-bolder mb-1"> <span id="amount3">{{number_format(count_total_bank_added_filter(session()->get('userid'),$filtertype),0)}}</span> </h2>
                                          </div>
                                        </div>
                                        
                                        <div id="statistics-line-chart"></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-6">
                                    <div class="card earnings-card card-tiny-line-stats">
                                      <div class="card-body pb-50">
                                        <h6>Total Internal Transfer</h6>
                                        <span>
                                          <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{$id}},4)' id="info_filter4">
                                            <option value="">Select Type</option>
                                            <option value="1">Total</option>
                                            <option value="2">Today</option>
                                            <option value="3">Last 7 days</option>
                                            <option value="4">This Month</option>
                                            <option value="5">Custom Date</option>
                                          </select>
                                        </span>
                                        
                                        <div class="row">
                                          <div class="col-md-12 total" @if(isset($cfilter)) style="display: none;" @endif>
                                            <p>@if(isset($filtertype_name)) {{$filtertype_name}} @endif</p>
                                      
                                            <h2 class="fw-bolder mb-1"> <span id="amount4">{{number_format(total_transfer_funds_filter(session()->get('userid'),$filtertype),0)}}</span></h2>
                                          </div>
                                        
                                        </div>
                                        <div id="line-area-chart-6"></div>
                                      </div>
                                    </div>
                                  </div>
                                  @if ($q->type == 4)
    <div class="col-lg-4 col-6">
      <div class="card earnings-card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Distibutor Network</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{$id}},5)' id="info_filter5">
              <option value="">Select Type</option>
              <option value="1">Total</option>
              <option value="2">Today</option>
              <option value="3">Last 7 days</option>
              <option value="4">This Month</option>
              <option value="5">Custom Date</option>
            </select>
          </span>
          <div class="row">
            <div class="col-md-12 total" @if(isset($cfilter)) style="display: none;" @endif>
              <p>@if(isset($filtertype_name)) {{$filtertype_name}} @endif</p>
              <h2 class="fw-bolder mb-1"> <span id="amount5">{{number_format(count_my_distibutor_network_filter(session()->get('userid'),$filtertype),0)}}</span> </h2>
            </div>
          </div>
          <div id="line-area-chart-4"></div>
        </div>
      </div>
    </div>
    @endif
    @if ($q->type == 3 || $q->type == 4)
    <div class="col-lg-4 col-6">
      <div class="card earnings-card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Mearchant Network</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{$id}},6)' id="info_filter6">
              <option value="">Select Type</option>
              <option value="1">Total</option>
              <option value="2">Today</option>
              <option value="3">Last 7 days</option>
              <option value="4">This Month</option>
              <option value="5">Custom Date</option>
            </select>
          </span>
          <div class="row">
            <div class="col-md-12 total" @if(isset($cfilter)) style="display: none;" @endif>
              <p>@if(isset($filtertype_name))  {{$filtertype_name}} @endif</p>
              <h2 class="fw-bolder mb-1"> <span id="amount6">{{number_format(count_my_merchant_network_filter(session()->get('userid'),$filtertype),0)}}</span> </h2>
            </div>
          </div>
          <div id="line-area-chart-2"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-6">
      <div class="card earnings-card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Network Transfer</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{$id}},7)' id="info_filter7">
              <option value="">Select Type</option>
              <option value="1">Total</option>
              <option value="2">Today</option>
              <option value="3">Last 7 days</option>
              <option value="4">This Month</option>
              <option value="5">Custom Date</option>
            </select>
          </span>
          <div class="row">
            <div class="col-md-12 total" @if(isset($cfilter)) style="display: none;" @endif>
              <p>@if(isset($filtertype_name)) {{$filtertype_name}} @endif</p>
             
              <h2 class="fw-bolder mb-1"> <span id="amount7">{{number_format(count_total_network_transfer_filter(session()->get('userid'),$filtertype),0)}}</span> </h2>
            </div>
           
          </div>
          <div id="line-area-chart-1"></div>
        </div>
      </div>
    </div>
    @endif
                                </div>
                                </div>
                                <div
                                  role="tabpanel"
                                  class="tab-pane"
                                  id="paymentoptions"
                                  aria-labelledby="storysummary-tab-fill"
                                  aria-expanded="true"
                                >
                                <form action="{{ url('store_paymentoptions_form') }}"  method="post" enctype="multipart/form-data" onsubmit="validbtn()">
                                  @csrf
                                <div class="row">
                                  <input type="hidden" name="userid" value="{{ $id }}">
                                  <div class="col-md-4 mb-2">
                                    <label>Debit</label>                               
                                    <select name="debit" id="" class="form-select form-control" required>
                                      <option @if($debit == 1) selected @endif value="1">Active</option>
                                      <option @if($debit == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>Netbanking</label>                                 
                                    <select name="netbanking" id="" class="form-select form-control" required>
                                      <option @if($netbanking == 1) selected @endif value="1">Active</option>
                                      <option @if($netbanking == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>UPI</label>                               
                                    <select name="upi" id="" class="form-select form-control" required>
                                      <option @if($upi == 1) selected @endif value="1">Active</option>
                                      <option @if($upi == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>Credit</label>                               
                                    <select name="credit" id="" class="form-select form-control" required>
                                      <option @if($credit == 1) selected @endif value="1">Active</option>
                                      <option @if($credit == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>AMEX</label>                                
                                    <select name="amex" id="" class="form-select form-control" required>
                                      <option @if($amex == 1) selected @endif value="1">Active</option>
                                      <option @if($amex == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>Diners</label>                           
                                    <select name="diners" id="" class="form-select form-control" required>
                                      <option @if($diners == 1) selected @endif value="1">Active</option>
                                      <option @if($diners == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>Wallet</label>                           
                                    <select name="wallet_option" id="" class="form-select form-control" required>
                                      <option @if($wallet_option == 1) selected @endif value="1">Active</option>
                                      <option @if($wallet_option == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>Corporate</label>                        
                                    <select name="corporate" id="" class="form-select form-control" required>
                                      <option @if($corporate == 1) selected @endif value="1">Active</option>
                                      <option @if($corporate == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>Prepaid</label>                      
                                    <select name="prepaid" id="" class="form-select form-control" required>
                                      <option @if($prepaid == 1) selected @endif value="1">Active</option>
                                      <option @if($prepaid == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label>Credit Card 1</label>                      
                                    <select name="credit_card1" id="" class="form-select form-control" required>
                                      <option @if($credit_card1 == 1) selected @endif value="1">Active</option>
                                      <option @if($credit_card1 == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-12">
                                    <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                                  </div>
                                </div>
                                </form>
                                </div>
                                <div
                                  role="tabpanel"
                                  class="tab-pane"
                                  id="services"
                                  aria-labelledby="storysummary-tab-fill"
                                  aria-expanded="true"
                                >
                                <form action="{{ url('shop_service_form') }}"  method="post" enctype="multipart/form-data" onsubmit="validbtn()">
                                  @csrf
                                <div class="row">
                                  <input type="hidden" name="userid" value="{{ $id }}">
                                  <div class="col-md-4 mb-2">
                                    <label for="">Recharge services</label>                                    
                                    <select name="recharge_services" id="" class="form-select form-control" required>
                                      <option @if($recharge_services == 1) selected @endif value="1">Active</option>
                                      <option @if($recharge_services == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label for="">Money services</label>                                    
                                    <select name="money_services" id="" class="form-select form-control" required>
                                      <option @if($money_services == 1) selected @endif value="1">Active</option>
                                      <option @if($money_services == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label for="">Aeps services</label>                                    
                                    <select name="aeps_services" id="" class="form-select form-control" required>
                                      <option @if($aeps_services == 1) selected @endif value="1">Active</option>
                                      <option @if($aeps_services == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label for="">Epos services</label>                                    
                                    <select name="epos_services" id="" class="form-select form-control" required>
                                      <option @if($epos_services == 1) selected @endif value="1">Active</option>
                                      <option @if($epos_services == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-2">
                                    <label for="">Pancard services</label>                                    
                                    <select name="pancard_services" id="" class="form-select form-control" required>
                                      <option @if($pancard_services == 1) selected @endif value="1">Active</option>
                                      <option @if($pancard_services == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>
                                  <div class="col-md-12">
                                    <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                                  </div>
                                  {{-- <div class="col-md-4">
                                    <label for="">Recharge services</label>                                    
                                    <select name="recharge_services" id="" class="form-select form-control" required>
                                      <option @if($recharge_services == 1) selected @endif value="1">Active</option>
                                      <option @if($recharge_services == 0) selected @endif value="0">Deactive</option>
                                    </select>
                                  </div>     --}}
                                </div>
                                </form>
                                </div>
                                <div
                                  class="tab-pane"
                                  id="stores-fill"
                                  role="tabpanel"
                                  aria-labelledby="stores-tab-fill"
                                  aria-expanded="false"
                                >
                                  <div class="row">
                                      <div class="col-md-12">
                                        <form class="form">
                                            <div class="row">
                                                <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="username">Shop Id</label>
                                                    <input type="text" readonly name="shop_id" id="shop_id" value="{{$shop_id}}"  class="form-control" placeholder="" />
                                                  </div>
                                                <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="username">First Name</label>
                                                    <input type="text" name="firstname" id="firstname" value="{{$firstname}}"  class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label">Last Name</label>
                                                    <input
                                                      type="text"
                                                      name="lastname"
                                                      id="lastname" value="{{$lastname}}"
                                                      class="form-control"
                                                      placeholder=""
                                                      aria-label="john.doe"
                                                    />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">DOB</label>
                                                    <input type="date" name="dob" id="dob" value="{{$dob}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label">Gender</label>
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value="">Select Gender</option>
                                                        <option @if($gender == "Male") selected @endif  value="Male">Male</option>
                                                        <option @if($gender == "Female") selected @endif value="Female">Female</option>
                                                    </select>
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Mobile Number</label>
                                                    <input type="number" name="mobile" id="mobile" value="{{$mobile}}" class="form-control" placeholder="" />
                                                  </div>
                                                  
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Email Id</label>
                                                    <input type="email" name="email" id="email" value="{{$email}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Permanent address</label>
                                                    <input type="email" name="p_address" id="p_address" value="{{$p_address}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Upload id proof</label>
                                                    <input type="file" name="id_proof" id="id_proof_doc" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Upload bank details</label>
                                                    <input type="file" name="bank_doc" id="bank_doc" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Upload your signature</label>
                                                    <input type="file" name="signature_doc" id="signature_doc" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Referral code(optional)</label>
                                                    <input type="number" name="referral" id="referral" value="{{$referral}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="username">Shop Name</label>
                                                    <input type="text" name="shop_name" id="shop_name" value="{{$shop_name}}"  class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label">Shop mobile number</label>
                                                    <input
                                                      type="number"
                                                      name="shop_phone"
                                                      id="shop_phone" value="{{$shop_phone}}"
                                                      class="form-control"
                                                      placeholder=""
                                                      aria-label="john.doe"
                                                    />
                                                  </div>
                                                  
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label">Business category</label>
                                                    <select class="form-control" name="business_category" id="business_category">
                                                        <option value="">Select Category</option>
                                                        <option value="1">Category</option>
                                                        <option value="2">Category</option>
                                                    </select>
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Shop Number</label>
                                                    <input type="text" name="shop_number" id="shop_number" value="{{$shop_number}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Area / Landmark</label>
                                                    <input type="text" name="landmark" id="landmark" value="{{$landmark}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">City</label>
                                                    <input type="text" name="city" id="city" value="{{$city}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Pincode</label>
                                                    <input type="number" name="pincode" id="pincode" value="{{$pincode}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">State</label>
                                                    <input type="text" name="state" id="state" value="{{$state}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Geo location</label>
                                                    <input type="text" name="geolocation" id="geolocation" value="{{$geolocation}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">City of operation</label>
                                                    <input type="text" name="city_of_operation" id="city_of_operation" value="{{$city_of_operation}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Area of operation</label>
                                                    <input type="text" name="area_of_operation" id="area_of_operation" value="{{$area_of_operation}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Store logo</label>
                                                    <input type="file" name="store_logo" id="store_logo"  class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">Store banner image</label>
                                                    <input type="file" name="store_banner_logo" id="store_banner_logo"  class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">GST (optional)</label>
                                                    <input type="number" name="gst" id="gst" value="{{$gst}}" class="form-control" placeholder="" />
                                                  </div>
                                                  <div class="col-md-3 mb-1">
                                                    <label class="form-label" for="">FSSAI licence</label>
                                                    <input type="number" name="fssai" id="fssai" value="{{$fssai}}" class="form-control" placeholder="" />
                                                  </div>
                                            </div>
                                          </form>
                                      </div>
                                  </div>
                                </div>
                                <div
                                  class="tab-pane"
                                  id="about-fill"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-fill"
                                  aria-expanded="false"
                                >
                                  <p>
                                    Carrot cake dragée chocolate. Lemon drops ice cream wafer gummies dragée. Chocolate bar liquorice
                                    cheesecake cookie chupa chups marshmallow oat cake biscuit. Dessert toffee fruitcake ice cream powder
                                    tootsie roll cake.Chocolate bonbon chocolate chocolate cake halvah tootsie roll marshmallow. Brownie
                                    chocolate toffee toffee jelly beans bonbon sesame snaps sugar plum candy canes.
                                  </p>
                                </div>
                              </div>
                         </div>
                     </div>
                      
                    </div>
                  </div>
            </div>
        </div>
    </div>    
</div>  
<div class="row">
  <div class="col-md-12">
    <div class="card p-2">
      <h4 class="card-title">
        All Transactions
      </h4>  
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Sl. No.</th> 
                <th>Date/Time</th>
                <th>Amount</th>
                <th>Action</th>
                <th>Balance</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($all_tranaction as $index => $list)
              <tr>
                <td>{{$index + $all_tranaction->firstItem()}}</td>
                  <td>{{ $list->time }}-{{ $list->date }}</td>
                  @if(!empty($list->atype))
                  @if ($list->atype == 2)
                  <td><div class="fw-bolder text-danger"> - {{ number_format($list->amt,2)}}</div></td>
                  @endif
                  @if ($list->atype == 1)
                  <td> <div class="fw-bolder text-success">+ {{ number_format($list->amt,2)}}</div></td>
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
                  <td><div class="fw-bolder"> <span class="text-success">{{ number_format($list->bal,2)}}</span>  </div> </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="py-2">
            {{$all_tranaction->withQueryString()->links()}}
          </div>
        </div>
      </div>
    </div>   
  </div>
</div>
@endsection