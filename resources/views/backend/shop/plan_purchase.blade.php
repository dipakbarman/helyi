@extends('backend.master')
@section('body')
<style>
  span.pricing-standard-value.fw-bolder {
    font-size: 27px;
}
</style>
<div class="row">
  <div class="col-md-12">
    <div class="text-center">
      <h1 class="mt-5">Pricing Plans</h1>
      <p class="mb-2 pb-75">
        All plans include 40+ advanced tools and features to boost your store. Choose the best plan to fit your needs.
      </p>
      
    </div>
  </div>
</div>
<div class="row justify-content-center">
        <!-- standard plan -->
    @if (!empty($q))
    @php
        $i = 1;
    @endphp
    @foreach ($q as $list)
    <div class="col-12 col-md-4">
      <form @if ($payment_getway->type == 2) action="{{  url('cashfree_plan_purchase') }}" @endif method="post" id="cashfee_getway{{$list->id}}">
        <div class="card standard-pricing popular text-center">
          <div class="card-body">
            @if($i == 2)
            <div class="pricing-badge text-end">
              <span class="badge rounded-pill badge-light-primary">Popular</span>
            </div>
            @else
            <div class="pricing-badge text-end" style="visibility: hidden">
              <span class="badge py-2"></span>
              1
            </div>
            @endif
            <img src="{{ url('storage/app/'.$list->planlogo) }}" height="100px" class="mb-1" alt="svg img" />
            <h3>{{ $list->package_name }}</h3>
            {{-- <p class="card-text">For small to medium businesses</p> --}}
            <div class="annual-plan">
              
              <input type="hidden" name="plan_price" id="plan_price{{ $list->id }}" value="{{ $list->price }}">
              <input type="hidden" name="plan_id" id="plan_id{{ $list->id }}" value="{{ $list->id }}">
              
              <div class="plan-price mt-2">
                <sup class="font-medium-1 fw-bold text-success"><i class="fas fa-rupee-sign"></i></sup>
                <span class="pricing-standard-value fw-bolder text-success">{{ $list->price }}</span>
                <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
              </div>
              <small class="annual-pricing d-none text-muted"></small>
            </div>
            @php
                $rup_s = "";
                $per_s = "";
                if($list->plan_type == 1){
                  $per_s = 1;
                }
                if($list->plan_type == 2){
                  $rup_s = 1;
                }
            @endphp
            <ul class="list-group list-group-circle text-start">
              <li class="list-group-item ">Debit Card <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->debit_card_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">Netbanking <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->netbanking_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">UPI <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->upi_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">Credit Card <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->credit_card_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">AMEX Card <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->amex_card_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">Diners Card <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->diners_card_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">Wallet <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->wallet_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">Corporate Card <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->corporate_card_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">Prepaid card <span > <span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->prepaid_card_instant }} @if(!empty($per_s)) % @endif</span> </span></li>
              <li class="list-group-item ">Monthly limit <span > <span style="float: right"><i class="fas fa-rupee-sign"></i> {{ $list->monthly_limit }}</span> </span></li>
              <li class="list-group-item ">Limit per day <span > <span style="float: right"> <i class="fas fa-rupee-sign"></i>{{ $list->limit_per_day }}</span> </span></li>
            </ul>
            <button type="button" data-bs-toggle="modal" data-bs-target="#pricingModal{{$list->id}}" class="btn w-100 btn-success mt-2">View More</button>
            @php
                $user_curent_plan_id = get_user_curent_planid(session()->get('userid'));
                $user_curent_plan_price = get_plan_price($user_curent_plan_id); 
            @endphp
            @if($list->price > $user_curent_plan_price)
            <button type="button" data-bs-toggle="modal" data-bs-target="#planpurchesModal{{$list->id}}" class="btn w-100 btn-success mt-2">Upgrade</button>
            @else
            <button type="button" disabled class="btn w-100 btn-success mt-2"> @if(get_user_curent_planid(session()->get('userid')) == $list->id) Your Current Plan @else Upgrade @endif </button>
            @endif   
          </div>
        </div>
      </form>
      </div>
      @php
          $i++;
      @endphp
      @endforeach
       @endif
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card p-2">
      <div class="pricing-free-trial">
        <div class="row">
          <div class="col-12 col-lg-10 col-lg-offset-3 mx-auto">
            <div class="pricing-trial-content d-flex justify-content-between">
              <div class="text-center text-md-start mt-3">
                <h3 class="text-primary">Still not convinced? Start with a 30-day FREE trial!</h3>
                <h5>You will get full access to with all the features for 30 days.</h5>
                <button class="btn btn-success mt-2 mt-lg-3">Start 30-day FREE trial</button>
              </div>
    
              <!-- image -->
              <img
                src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/illustration/pricing-Illustration.svg"
                class="pricing-trial-img img-fluid"
                alt="svg img"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  function upgrade_plan_from_wallet(id){
    $("#plan_id_pin_check").val(id);
    $("#plan_purches_tpin_verify_model").modal('show');
  }
  function upgrade_plan_from_wallet_pin_check(){
    var planid = $("#plan_id_pin_check").val();
    var tpin = $("#send_transactionpin").val();
    if(tpin == "" || tpin.length != 6){
      Swal.fire({
      icon: 'error',
      title: "Invalid transaction pin",
      confirmButtonText: 'Confirm'
      })
      return false;
    }
    $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:"{{ url('upgrade_plan_from_wallet') }}",
                data: ({planid:planid,tpin:tpin}),
                success: function(response){
                  if(response == 0){
                    Swal.fire({
                    icon: 'error',
                    title: "Invalid Transaction pin",
                    confirmButtonText: 'Confirm'
                    })
                    return false;
                  }
                  if(response == 1){
                      Swal.fire({
                        icon: 'success',
                        title: 'Plan purchase successful',
                        confirmButtonText: 'Confirm',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "{{ url('utilitiesandpayments') }}";
                        }
                      })
                  }  
                }
            });
  }
  function upgrade_plan(id){
    var amount = $("#plan_price"+id).val();
    var planid = $("#plan_id"+id).val();
    var keyy_id  = $("#rezkeyy_id").val();
    var s_name = $("#rez_name").val();
    var s_email = $("#rez_email").val();
    var s_phone = $("#rez_phone").val();
    var options = {
        "key": keyy_id,
        "amount": amount*100,
        "currency": "INR",
        "name": "heyli",
        "description": "Live transaction",
        "image": "https://essaneinfotech.com/heyli/public/logo.png",
        "prefill": {
          "name": s_name,
          "email": s_email,
          "contact": s_phone
        },
        "handler": function (response){
          $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:"{{ url('rez_plan_purchase') }}",
                data: "payment_id="+response.razorpay_payment_id+"&amt="+amount+"&planid="+planid,
                success: function(response){
                  if(response == 1){
                      Swal.fire({
                        icon: 'success',
                        title: 'Plan purchase successful',
                        confirmButtonText: 'Confirm'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "{{ url('utilitiesandpayments') }}";
                        }
                      })
                  }  
                }
            });
        }
    };

    
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
        Swal.fire({
        icon: 'error',
        title: 'Please try again',
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "{{ url('addmoney') }}";
        }
      })
});
      rzp1.open();
  }
</script>
@endsection