@extends('backend.master')
@section('body')
<style>
  button.btn.btn-success.waves-effect.waves-float.waves-light {
    padding: 13px 22px 10px 7px;
}
</style>
<div class="row match-height">
    <!-- Greetings Card starts -->
    <style>
      div#mtext {
    padding: 0px 0px 23px;
}
    </style>
    <div class="col-xl-12 col-md-12 col-12" id="mtext">
      <marquee>{{ get_marque_text() }}</marquee>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card card-congratulations">
        <div class="card-body text-center">
          <img
            src="{{ asset('app-assets/images/elements/decore-left.png') }}"
            class="congratulations-img-left"
            alt="card-img-left"
          />
          <img
            src="{{ asset('app-assets/images/elements/decore-right.png') }}"
            class="congratulations-img-right"
            alt="card-img-right"
          />
          <div class="avatar avatar-xl bg-primary shadow">
            <div class="avatar-content">
              <i data-feather="award" class="font-large-1"></i>
            </div>
          </div>
          <div class="text-center">
            <h1 class="mb-1 text-white">Congratulations <span style="text-transform: capitalize;"> {{username()}}</span>,</h1>
            <p class="card-text m-auto w-75">
              You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.
            </p>
          </div>
        </div>
      </div>
    </div>
        <!-- Subscribers Chart Card starts -->
    <div class="col-md-6">
      <div class="row match-height">
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-body pb-50">
              <h6>Total Wallet</h6>
              <span>
                <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{session()->get("userid")}},1)' id="info_filter1">
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
                <div class="col-md-12 total" >
                  <p>@if(isset($filtertype_name)) {{$filtertype_name}} @endif</p>
                  <h2 class="fw-bolder mb-1"> <a href="{{ url('alltransaction') }}"> <span id="amount1"> {{number_format(total_addmoney_filter(session()->get('userid'),$filtertype),0)}} </span></a></h2>
                </div>
              </div>
              <div id="line-area-chart-5"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-body pb-50">
              <h6>Payouts</h6>
              <div class="row">
                <div class="col-md-12">
                  <span>
                    <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{session()->get("userid")}},2)' id="info_filter2">
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
                    <span id="amount2"> {{number_format(count_payout_amount_transfer_today(session()->get('userid')),0)}} </span></h2>
                </div>
                <div class="col-md-6">
                  <p>Total Payouts</p>
                  <h2 class="fw-bolder mb-1">
                    <span id="amount22"> {{number_format(count_no_of_payout_today(session()->get('userid')),0)}} </span>
                  </h2>
                </div>
              </div>
              <div id="line-area-chart-3"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Subscribers Chart Card ends -->
    <!-- Subscribers Chart Card starts -->
</div>
    <div class="row match-height">
    <div class="col-lg-3 col-6">
      <div class="card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Account Added</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{session()->get("userid")}},3)' id="info_filter3">
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
    
    <div class="col-lg-3 col-6">
      <div class="card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Internal Transfer</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{session()->get("userid")}},4)' id="info_filter4">
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
    @if (session()->get('type') == 4)
    <div class="col-lg-3 col-6">
      <div class="card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Distibutor Network</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{session()->get("userid")}},5)' id="info_filter5">
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
    @if (session()->get('type') == 3 || session()->get('type') == 4)
    <div class="col-lg-3 col-6">
      <div class="card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Mearchant Network</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{session()->get("userid")}},6)' id="info_filter6">
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
    <div class="col-lg-3 col-6">
      <div class="card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Total Network Transfer</h6>
          <span>
            <select name="ftype" class="form-control form-select mb-2" onchange='ajax_info_filter(this.value,{{session()->get("userid")}},7)' id="info_filter7">
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

    <!-- Subscribers Chart Card ends -->
    <!-- Greetings Card ends -->

  </div>

  <div class="row">
    <div class="content-body"><!-- users list start -->
        
        <!-- Row grouping -->
        <section id="multilingual-datatable">
          <div class="row">
            <div class="col-12">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">Transaction</h4>
                </div>
                <div class="card-datatable">
                  {{-- id="check_d" --}}
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Date/Time</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($q as $list)
                        <tr>
                            <td>{{ $list->time }}-{{ $list->date }}</td>
                            <td>{{ number_format($list->amt,0) }}</td>
                            <td>
                                {{ $list->r }}
                            </td>
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
        </section>
        
                </div>    
</div>

@endsection