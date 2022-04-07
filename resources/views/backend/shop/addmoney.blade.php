@extends('backend.master')
@section('body')
@php
    $paymnt_getway_type = "";
    if(isset($q)){
        $paymnt_getway_type = $q->type; 
    }
@endphp
<style>
  .info_tabs {
    font-size: 18px;
}
.form-check-inline {
    margin-right: -1rem;
}
</style>
<div class="row match-height">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card p-1">
                    <div class="card-body">
                      <h4 class="card-title">
                        <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @else href="{{ url('addmoney') }}" @endif><i data-feather='arrow-left'></i></a> 
                        Add money to wallet
                      </h4>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                {{-- <div class="info_tabs">
                                    <span>Your balance</span>
                                    <span style="float: right;color: #28c76f;"> <i class="fas fa-rupee-sign"></i> {{get_wallet_bal()}}</span>
                                </div> --}}
                                <form action="{{ url('addmoney_cashfree') }}" method="post">
                                    <div class="row">
                                      <div class="col-md-12 mb-2">
                                        <label class="mb-1" for="">Top-Up Your Account</label>
                                    <div class="input-group input-group-merge mv-1">
                                        <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                                        <input
                                          type="text"
                                          required
                                          id="money_value"
                                          class="form-control"
                                          name="money"
                                          value=""
                                          placeholder=""
                                        />
                                      </div>
                                      <span class="mb-2 mt-1" id="ammount_in_word" style="text-transform: capitalized;color:hotpink;"></span><span id="nhide" style="color:hotpink;display:none;"> rupees only</span>
                                      </div>
                                    </div>
                            </div>
                            <div class="col-md-12"></div>
                            
                            <div class="col-md-10">
                              <div class="row justify-content-center">
                                <div class="col-md-12 mb-2">
                                  <p class="available_payment_title mb-1" >available payment methods</p>
                                </div>
                                @php
                                    $payment_options = DB::table('payment_options')->get();
                                    $j = 1;
                                @endphp
                                @foreach ($payment_options as $item)
                                @if(check_is_enabe_pm($item->id,session()->get('userid')) == 1)
                                <div class="col-md-3 mb-2">
                                  <div class="form-check form-check-inline apm">
                                      <input
                                      class="form-check-input form-check-css paymentoption"
                                      type="radio"
                                      name="paymentoption"
                                      id="option_select{{$item->id}}"
                                      value="{{$item->id}}"
                                    />
                                    <label class="form-check-label" style="font-size:12px;" for="option_select{{$item->id}}"> <img src="{{ asset($item->icon) }}" class="p_methods_image" alt=""> {{ $item->option_name }}</label>
                                    
                                  </div>
                                </div>
                                @endif
                                @endforeach
                                <div class="col-md-12 mb-2">
                                  <p class="available_payment_title">Top-Up Option</p>
                              </div>
                              @if ($userdata->is_instant == 1)
                              <div class="col-md-2 mb-2">
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label" for="i1"> Instant</label>
                                    <input
                                    required
                                      class="form-check-input form-check-css topupoption_selecteor"
                                      type="radio"
                                      name="topupmen"
                                      id="i1"
                                      value="0"
                                    />
                                  </div>
                              </div>
                              @endif
                              <div class="col-md-2 mb-2">
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label" for="i2">T0</label>
                                    <input
                                    required
                                      class="form-check-input form-check-css topupoption_selecteor"
                                      type="radio"
                                      name="topupmen"
                                      id="i2"
                                      value="3"
                                    />
                                    
                                  </div>
                              </div>
                              
                              <div class="col-md-2 mb-2">
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label" for="i4">T+1</label>
                                    <input
                                    required
                                      class="form-check-input form-check-css topupoption_selecteor"
                                      type="radio"
                                      name="topupmen"
                                      id="i4"
                                      value="1"
                                    />
                                    
                                  </div>
                              </div>
                              <div class="col-md-2 mb-2">
                                <div class="form-check form-check-inline">
                                  <label class="form-check-label" for="i3"> T+2</label>  
                                  <input
                                  required
                                      class="form-check-input form-check-css topupoption_selecteor"
                                      type="radio"
                                      name="topupmen"
                                      id="i3"
                                      value="2"
                                    />
                                  </div>
                              </div>
                              <div class="col-md-12">
                                <div class="row justify-content-center">
                                <div class="col-md-6">
                                  <div id="fee_view_sec" style="display: none;">
                                  <p> <span>Total balance to be credited</span> <span class="text-success" style="float: right"><i class="fas fa-rupee-sign"></i>  <span id="total_top_up_balence"></span> </span> </p>
                                  <p><span>Processing fee ( <span id="rup_s" style="display: none;"><i class="fas fa-rupee-sign"></i></span><span id="how_percentahe"></span><span id="per_s" style="display: none;">%</span> )</span> <span class="text-danger" style="float: right"> <i class="fas fa-rupee-sign"></i> <span  id="conversion_fees" ></span></span> </p>
                                  <div class="form_download">
                                    <p class="text-danger">*Card Holder Consent Form <span> <a href="{{ asset('ConsentForm.pdf') }}" download><i class="fa fa-download" aria-hidden="true"></i></a></span> </p>
                                  </div>
                                  <div class="form-group form-check mb-2">
                                    <input type="checkbox" class="form-check-input" required name="is_partial_payment" id="tt">
                                    <label class="form-label" for="tt">i as helyi user, confirm that i have downloaded and filled the form on bhalf of the customer. At any point of time 
                                      when i am asked to provide details regarding this transaction, i will provide</label>
                                </div>
                                  <br>
                                </div>
                                </div>  
                                </div>
                              </div>
                              <div class="col-md-12 mb-2 text-center">
                                
                                @if($userdata->is_kyc == 1)
                                <input type="hidden" id="payment_gateway_type" name="payment_gateway_type">
                                <button onclick="add_money()" id="rezpay_js_btn" style="display: none" class="btn btn-success" type="button">Check Out Amount <span class="btn_pe_ammount"></span></button>
                                <button type="submit" id="cashfree_sub_btn" style="display: none"  class="btn btn-success">Check Out Amount <span class="btn_pe_ammount"></span></button>
                                @else
                                <a class="btn btn-success" href="{{url('submit_your_kyc')}}">Check Out Amount</a>
                                @endif
                              </div>
                              </div>
                            </form>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 pt-2">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>S.No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Mobile No.</th>
                                    <th>Txn Id</th>
                                    <th>Request Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($transactionq as $index => $list)
                                  <tr>
                                    <td>{{$index + $transactionq->firstItem()}}</td>
                                    <td>{{ $list->date }} {{   $list->time }}</td>
                                    <td>{{number_format($list->total_amount,0)}}</td>
                                    <td>{{get_user_number($list->userid)}}</td>
                                    <td>{{ $list->payment_id }}</td>
                                    <td>
                                      @php
                                          if($list->is_added == 0){
              echo "<span class='badge badge-glow bg-warning'>Processing</span>";
                                          }
                                          if($list->is_added == 1){
                                            if($list->method_type == 1){
                                              if($list->is_capture == 1){
                                                echo "<span class='badge badge-glow bg-success'>Successful</span>";                       
                                              }
                                              if($list->is_capture == 0){
                                                echo "<span class='badge badge-glow bg-danger'>Pending</span>";                       
                                              }
                                            }
                                            if($list->method_type == 2 || $list->method_type == 3){
                                              echo "<span class='badge badge-glow bg-success'>Successful</span>";                       
                                            }
                                          }
                                          if($list->is_added == 3){
                                              echo "<span class='badge badge-glow bg-danger'>Failed</span>";                       
                                          }
                                      @endphp
                                  </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              <div class="py-2">
                                {{$transactionq->withQueryString()->links()}}
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function add_money() {
  var netbanking = false;
        var card = false;
        var upi = false;
        var wallet = false;
  var tt = $("input[type='checkbox'][name='is_partial_payment']:checked").val();
  if(tt == undefined){
    Swal.fire({
      icon: 'error',
      title: "Please accept terms and conditions",
      confirmButtonText: 'Confirm'
    })
    return false;
  }
			var amount = Number($("#money_value").val());
      var topup_type = $("input[type='radio'][name='topupmen']:checked").val();
      var payment_option = $('input[name="paymentoption"]:checked').val();
      if(payment_option == 7){
        wallet = true;
      }
      if(payment_option == 3){
        upi = true;
      }
      if(payment_option == 2){
        netbanking = true;
      }
      if(payment_option == 1 || payment_option == 4 || payment_option == 5 || payment_option == 6 || payment_option == 8 || payment_option == 9 || payment_option == 10){
        card = true;
      }
      if(topup_type == undefined){
        // toastr.error('Select topup option');
        Swal.fire({
      icon: 'error',
      title: "Select topup option",
      confirmButtonText: 'Confirm'
    })
        return false;
      }
      if(amount < 1){
        // toastr.error('Enter valid amount !');
        Swal.fire({
      icon: 'error',
      title: "Enter valid amount !",
      confirmButtonText: 'Confirm'
    })
        return false;
      }
        var day_limit = Number({{get_plan_day_limit(session()->get('userid'))}});
        var total_addmoney_today = Number({{get_total_today_amount(session()->get('userid'))}});
        var total_money_today = total_addmoney_today+amount;
        var monthy_limit = Number({{get_plan_monthy_limit(session()->get('userid'))}});
        var total_addmoney_monthy = Number({{get_total_monthly_amount(session()->get('userid'))}});
        var total_money_monthy = total_addmoney_monthy+amount;
        var s_name = $("#rez_name").val();
        var s_email = $("#rez_email").val();
        var s_phone = $("#rez_phone").val();
        if(monthy_limit < total_money_monthy){
          Swal.fire({
            icon: 'error',
            title: "Your monthy limit is "+monthy_limit,
            confirmButtonText: 'Confirm'
          })
          return false;
        }
        if(day_limit < total_money_today){
          Swal.fire({
            icon: 'error',
            title: "Your daily limit is "+day_limit,
            confirmButtonText: 'Confirm'
          })
          return false;
        }
        var keyy_id = $("#rezkeyy_id").val();
        var options = {
        "key": keyy_id,
        "amount": amount*100,
        "currency": "INR",
        "name": "heyli",
        "description": "Live transaction",
        "image": "https://essaneinfotech.com/heyli/public/logo.png",
        "method":{
        "netbanking":netbanking,
        "card":card,        
        "upi":upi,
        "wallet":wallet     
        },
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
                url:"{{ url('addmoney_rezorpay') }}",
                data: "payment_id="+response.razorpay_payment_id+"&amt="+amount+"&topup_type="+topup_type+"&payment_option="+payment_option,
                success: function(response){
                  var total = response;
                      Swal.fire({
                      icon: 'success',
                      title: total+' Added to current wallet',
                      confirmButtonText: 'Confirm',
                      allowEscapeKey: false,
                      allowOutsideClick: false,
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = "{{ url('addmoney') }}";
                      }
                    })
                     
                }
            });
        }
    };

    
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
        $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:"{{ url('addmoney_rezorpay_fail') }}",
                data: "payment_id="+response.error.metadata.payment_id+"&amt="+amount+"&topup_type="+topup_type+"&payment_option="+payment_option,
                success: function(response){
                    Swal.fire({
                    icon: 'error',
                    title: total+' Please try again',
                    confirmButtonText: 'Confirm',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    }).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = "{{ url('addmoney') }}";
                    }
                    });
                }
            });
});
      rzp1.open();
    }
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

document.getElementById('money_value').onkeyup = function () {
    $('input[name="topupmen"]:checked').prop('checked', false);
    $('input[name="paymentoption"]:checked').prop('checked', false);
    $("#fee_view_sec").hide();
    document.getElementById('ammount_in_word').innerHTML = inWords(document.getElementById('money_value').value);
};
</script>
@endsection