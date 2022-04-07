<div
class="modal fade text-start"
id="account_varificatoin_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Add Acount </h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body" >
        <h4>Account Holder Name</h4>
        <p>@if(session()->has('model_ac_no')) {{session()->get('model_ac_no')}} @endif</p>
        <div class="row">
          
          <div class="col-md-6">
            <button onclick="add_varifyed_paye(@if(session()->has('lastinser_id')) {{session()->get('lastinser_id')}} @endif)" type="button" class="btn mb-2 btn-block btn-success waves-effect waves-float waves-light">Add</button>
          </div>
          <div class="col-md-6">
            <button onclick="cancel_add_varifyed_paye(@if(session()->has('lastinser_id')) {{session()->get('lastinser_id')}} @endif)" type="button" class="btn mb-2 btn-block btn-success waves-effect waves-float waves-light">Cancel</button>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
@if(Request::url() == url('add_account') || Request::url() == url('find_bankacount_search'))
<div
class="modal fade text-start"
id="add_bankacount_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Add Acount </h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body" >
        <h4>Do you want to verify the above account ?</h4>
        <p class="my-2 text-danger">
          Rs. {{bank_account_addfees()}} will be debuced from helyi pay account.
        </p>
        <div class="row">
          
          <div class="col-md-12">
            @if(bank_account_addfees() > get_wallet_bal_byid(session()->get('userid')))
            <button  type="button" disabled class="btn btn-blockbtn-danger waves-effect waves-float waves-light" data-bs-dismiss="modal">Proceed</button>
            <span class="text-danger">Insufficient balance</span>
            @else
            <button onclick="submit_add_account()" type="button" class="btn mb-2 btn-block btn-success waves-effect waves-float waves-light" data-bs-dismiss="modal">Proceed</button>
            @endif
          </div>
        </div>
      </div>
  </div>
</div>
</div>
@endif
<div
class="modal fade text-start"
id="customdateinfobox"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Select Custom Date</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 mb-2">
            <input type="hidden" id="customdateinfobox_value">
            <input type="hidden" id="customdateinfobox_boxid">
            <input type="hidden" id="filter_uid">
            <label for="">From Date</label>
            <input type="text" name="" id="home_filter_from_date" class="form-control">
          </div>
          <div class="col-md-12 mb-2">
            <label for="">To Date</label>
            <input type="text" name="" id="home_filter_to_date" class="form-control">
          </div>
          <div class="col-md-12 mb-2">
            <button type="button" onclick="home_date_filter()" class="btn btn-block btn-success">Submit</button>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
@if (Request::url() == url('money_transfer_form'))
<div
class="modal fade text-start"
id="send_money_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      {{-- @if (check_is_tpin_genrated(session()->get('userid')) == 1) --}}
      <h4 class="modal-title" id="myModalLabel20">Enter Transaction Pin</h4>
      {{-- @else
      <h4 class="modal-title" id="myModalLabel20">Generate transaction pin</h4>
      @endif --}}
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

      <div @if(check_is_tpin_genrated(session()->get('userid')) != 1) style="display:none;" @endif id="NetworkTransfervarifypin">
    <div class="modal-body" >
        <div class="mb-2"  id="transaction_pin">
            <label for="">Enter your Transaction pin</label>
            <input type="password" name="transactionpin" id="send_transactionpin" class="send_transactionpin_valid form-control">
            <label style="display: none;" for="" id="Transaction_pin_error" class="text-danger">Transaction pin should be 6 digit</label>
            <span class="field-icon" id="tpin_eye"><i data-feather='eye'></i></span>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="" onclick="bank_transfer_tpin_verify()" class="btn btn-success">Submit</button>
        {{-- <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button> --}}
    </div>
  </div>
<div @if(check_is_tpin_genrated(session()->get('userid')) == 1) style="display:none;" @endif class="modal-body" id="NetworkTransfernewpin">
  <form action="" method="post">
    @csrf
    <div class="form-group mb-2">
      <label for="">Transaction Pin</label>
      <input type="number" class="form-control" required name="transactionpin" id="newtransactionpin">
      <label for="" id="NTransaction_pin_error" style="display: none" class="NTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
    <div class="form-group mb-2">
      <label for="">Confirm Transaction Pin</label>
      <input type="number" class="form-control" name="" id="cnewtransactionpin">
      <label for="" id="CNTransaction_pin_error" style="display: none" class="CNTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
    <div class="form-group">
        <button type="button" onclick="model_gen_tpin()" id="submit_btn" class="btn btn-success">Submit</button>
        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
    </div>
</form> 
</div>

  </div>
</div>
</div>
<script>
  document.querySelector("#send_transactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#send_transactionpin").val();
    if(ph.length < 5){
        $("#Transaction_pin_error").show();
    }else{
        $("#Transaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#cnewtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#cnewtransactionpin").val();
    if(ph.length < 5){
        $("#CNTransaction_pin_error").show();
    }else{
        $("#CNTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#newtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#newtransactionpin").val();
    if(ph.length < 5){
        $("#NTransaction_pin_error").show();
    }else{
        $("#NTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  function model_gen_tpin(){
    var tpin = $("#newtransactionpin").val();
    var ctpin = $("#cnewtransactionpin").val();
    if(tpin != "" && ctpin != ""){
      if(tpin.length == 6 && ctpin.length == 6){
        if(tpin != ctpin){
          Swal.fire({
          icon: 'error',
          title: "Transaction pin and confirm pin should be same",
          confirmButtonText: 'Confirm'
          })
          return false;
        }
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('gen_tpin_in_model_form') }}",
                data: ({
                  tpin:tpin,
                }),
                success: function(response){
                  if(response == 1){
                    $("#NetworkTransfervarifypin").show();
                    $("#NetworkTransfernewpin").hide();
                      Swal.fire({
                        icon: 'success',
                        title: "Transaction pin generated successfully",
                        confirmButtonText: 'Confirm'
                      })
                  }
                }
        });
      }else{
        Swal.fire({
        icon: 'error',
        title: "Transaction pin should be 6 digit",
        confirmButtonText: 'Confirm'
        })
      }
    }else{
      Swal.fire({
      icon: 'error',
      title: "All field required",
      confirmButtonText: 'Confirm'
      })
    }
  }
</script>
@endif
@if (Request::url() == url('find_user_data'))
<div
class="modal fade text-start"
id="send_money_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      {{-- @if (check_is_tpin_genrated(session()->get('userid')) == 1) --}}
      <h4 class="modal-title" id="myModalLabel20">Enter Transaction Pin</h4>
      {{-- @else
      <h4 class="modal-title" id="myModalLabel20">Generate transaction pin</h4>
      @endif --}}
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ url('funds_transfer_form') }}" method="post" id="funds_transfer_form" onsubmit="validbtn()">
      @csrf
      <div @if(check_is_tpin_genrated(session()->get('userid')) != 1) style="display:none;" @endif id="NetworkTransfervarifypin">
    <div class="modal-body" >
        <input type="hidden" name="amount" id="m_amount">
        <input type="hidden" name="remark" id="m_remark">
        <input type="hidden" name="phone_number" id="m_phone_number">
        <div class="mb-2"  id="transaction_pin">
            <label for="">Enter your Transaction pin</label>
            <input type="password" name="transactionpin" id="send_transactionpin" class="send_transactionpin_valid form-control">
            <label style="display: none;" for="" id="Transaction_pin_error" class="text-danger">Transaction pin should be 6 digit</label>
            <span class="field-icon" id="tpin_eye"><i data-feather='eye'></i></span>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="pin_check_btn" class="btn btn-success">Submit</button>
        {{-- <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button> --}}
    </div>
  </div>
<div @if(check_is_tpin_genrated(session()->get('userid')) == 1) style="display:none;" @endif class="modal-body" id="NetworkTransfernewpin">
  <form action="" method="post">
    @csrf
    <div class="form-group mb-2">
      <label for="">Generate Transaction Pin</label>
      <input type="number" class="form-control" required name="transactionpin" id="newtransactionpin">
      <label for="" id="NTransaction_pin_error" style="display: none" class="NTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
  </div>
  <div class="form-group mb-2">
    <label for="">Confirm Transaction Pin</label>
    <input type="number" class="form-control" name="" id="cnewtransactionpin">
    <label for="" id="CNTransaction_pin_error" style="display: none" class="CNTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
  </div>
    <div class="form-group">
        <button type="button" onclick="model_gen_tpin()" id="submit_btn" class="btn btn-success">Submit</button>
        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
    </div>
</form> 
</div>

  </form>
  </div>
</div>
</div>
<script>
  document.querySelector("#send_transactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#send_transactionpin").val();
    if(ph.length < 5){
        $("#Transaction_pin_error").show();
    }else{
        $("#Transaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#cnewtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#cnewtransactionpin").val();
    if(ph.length < 5){
        $("#CNTransaction_pin_error").show();
    }else{
        $("#CNTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#newtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#newtransactionpin").val();
    if(ph.length < 5){
        $("#NTransaction_pin_error").show();
    }else{
        $("#NTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  function model_gen_tpin(){
    var tpin = $("#newtransactionpin").val();
    var ctpin = $("#cnewtransactionpin").val();
    if(tpin != "" && ctpin != ""){
      if(tpin.length == 6 && ctpin.length == 6){
        if(tpin != ctpin){
            Swal.fire({
            icon: 'error',
            title: "Transaction pin and confirm pin should be same",
            confirmButtonText: 'Confirm'
            })
            return false;
        }
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('gen_tpin_in_model_form') }}",
                data: ({
                  tpin:tpin,
                }),
                success: function(response){
                  if(response == 1){
                    $("#NetworkTransfervarifypin").show();
                    $("#NetworkTransfernewpin").hide();
                      Swal.fire({
                        icon: 'success',
                        title: "Transaction pin generated successfully",
                        confirmButtonText: 'Confirm'
                      })
                  }
                }
        });
      }else{
        Swal.fire({
        icon: 'error',
        title: "Transaction pin should be 6 digit",
        confirmButtonText: 'Confirm'
        })
      }
    }else{
      Swal.fire({
      icon: 'error',
      title: "All field required",
      confirmButtonText: 'Confirm'
      })
    }
  }
</script>
@endif
@if (Request::url() == url('credittonetwork') || Request::url() == url('my_network') || Request::url() == url('merchant_network_list'))
<div
class="modal fade text-start"
id="distibutor_send_money_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Credit To Network</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ url('distibutor_funds_transfer_form') }}" method="post" id="distibutor_funds_transfer_form" onsubmit="validbtn()">
      @csrf
  <div @if(check_is_tpin_genrated(session()->get('userid')) != 1) style="display:none;" @endif id="NetworkTransfervarifypin">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12" id="user_details">
          <p><span id="d_username"></span> - <span id="d_mobile"></span></p>
          <p>Company Name - <span id="d_companyname"></span></p>
          <p>Current Balance - <span id="d_wallet_bal"></span></p>
          <input type="hidden" name="suid" id="suid">
        </div>
        <div class="col-md-12" id="distibutor_amount">
          <div class="mb-2">
            <label for="">Amount</label>
            <input type="number" name="amount" id="distibutor_m_amount" class="form-control">
            <span class="mb-2 mt-1" id="ammount_in_word" style="text-transform: capitalized;color:hotpink;"></span><span id="nhide" style="color:hotpink;display:none;"> rupees only</span>
          </div>
          <div class="mb-2">
            <label for="">Remark</label>
            <input type="text" name="remark" id="distibutor_m_remark" class="form-control">
          </div>
        </div>
        <div class="col-md-12" id="distibutor_tpin_enter" style="display: none;">
          <div class="mb-1">
            <label for="">Enter your Transaction pin</label>
            <input type="password" name="transactionpin" id="distibutor_send_transactionpin_valid" class="send_transactionpin_valid form-control">
            <label for="" id="distibutor_Transaction_pin_error" class="text-danger">Transaction pin should be 6 digit</label>
            <span class="field-icon" id="distibutor_tpin_eye"><i data-feather='eye'></i></span>

          </div>
        </div>
        <div class="col-md-12">
      
          <button type="button" class="btn btn-success btn-block" id="distibutor_check_mywallet" onclick="check_mywallet()">Add</button>

        </div>
        
      </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="distibutor_pincheck" class="btn btn-success btn-block" style="display: none;">Submit</button>
        {{-- <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button> --}}
    </div>
  </div>
  <div @if(check_is_tpin_genrated(session()->get('userid')) == 1) style="display:none;" @endif class="modal-body" id="NetworkTransfernewpin">
    <form action="" method="post">
      @csrf
      <div class="form-group mb-2">
        <label for="">Generate Transaction Pin</label>
        <input type="number" class="form-control" required name="transactionpin" id="dnewtransactionpin">
        <label for="" id="NTransaction_pin_error" style="display: none" class="NTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
    <div class="form-group mb-2">
      <label for="">Confirm Transaction Pin</label>
      <input type="number" class="form-control" name="" id="cnewtransactionpin">
      <label for="" id="CNTransaction_pin_error" style="display: none" class="CNTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
      <div class="form-group">
          <button type="button" onclick="model_gen_tpin()" id="submit_btn" class="btn btn-success">Submit</button>
          <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
      </div>
  </form> 
  </div>
  </form>
  </div>
</div>
</div>
<script>
//   document.querySelector("#distibutor_send_transactionpin_valid")
// .addEventListener("keypress", function(e) {
//     e.preventDefault();
// 	console.log(e.key);
//     var ph = $("#distibutor_send_transactionpin_valid").val();
//     if(ph.length < 5){
//         $("#distibutor_Transaction_pin_error").show();
//     }else{
//         $("#distibutor_Transaction_pin_error").hide();
// 		// $('#pin_check_btn').attr("disabled", true);
//     }
//     var input = e.target;
//     var value = Number(input.value);
//     var key = Number(e.key);
//     if (Number.isInteger(key)) {
//       value = Number("" + value + key);
//       if (value > 999999) {
//         return false;
//       }
//       input.value = value;
//     }
//   });
document.querySelector("#cnewtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#cnewtransactionpin").val();
    if(ph.length < 5){
        $("#CNTransaction_pin_error").show();
    }else{
        $("#CNTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  }); 
  document.querySelector("#dnewtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#dnewtransactionpin").val();
    if(ph.length < 5){
        $("#NTransaction_pin_error").show();
    }else{
        $("#NTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  
  function model_gen_tpin(){
    var tpin = $("#dnewtransactionpin").val();
    var ctpin = $("#cnewtransactionpin").val();
    if(tpin != "" && ctpin != ""){
      if(tpin.length == 6 && ctpin.length == 6){
        if(tpin != ctpin){
            Swal.fire({
            icon: 'error',
            title: "Transaction pin and confirm pin should be same",
            confirmButtonText: 'Confirm'
            })
            return false;
        }
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('gen_tpin_in_model_form') }}",
                data: ({
                  tpin:tpin,
                }),
                success: function(response){
                  if(response == 1){
                    $("#NetworkTransfervarifypin").show();
                    $("#NetworkTransfernewpin").hide();
                      Swal.fire({
                        icon: 'success',
                        title: "Transaction pin generated successfully",
                        confirmButtonText: 'Confirm'
                      })
                  }
                }
        });
      }else{
        Swal.fire({
        icon: 'error',
        title: "Transaction pin should be 6 digit",
        confirmButtonText: 'Confirm'
        })
      }
    }else{
      Swal.fire({
      icon: 'error',
      title: "All field required",
      confirmButtonText: 'Confirm'
      })
    }
  }
</script>
@endif
@php
    $planq = DB::table('plans')->where('is_deleted',0)->get();
    $payment_getway = DB::table('active_payment_getway')->first();
@endphp
@foreach ($planq as $list)
<div class="modal fade" id="pricingModal{{$list->id}}" tabindex="-1" aria-labelledby="pricingModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-sm-5 mx-50 pb-5">
        <div id="pricing-plan">
          <!-- title text and switch button -->
          <div class="text-center">
            <h1 id="pricingModalTitle">Subscription Plan</h1>
            <p class="mb-3">
              All plans include 40+ advanced tools and features to boost your store. Choose the best plan to fit your needs.
            </p>
          </div>
          <!--/ title text and switch button -->

          <!-- pricing plan cards -->
          <div class="row pricing-card">
            <div class="col-md-12">
              <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                  <img src="{{ url('storage/app/'.$list->planlogo) }}" class="mb-1" alt="">
                  <h3>{{$list->package_name}}</h3>
                  <div class="annual-plan">
              
                    <input type="hidden" name="plan_price" id="plan_price{{ $list->id }}" value="{{ $list->price }}">
                    <input type="hidden" name="plan_id" id="plan_id{{ $list->id }}" value="{{ $list->id }}">
                    
                    <div class="plan-price mt-2">
                      <sup class="font-medium-1 fw-bold text-primary"><i class="fas fa-rupee-sign"></i></sup>
                      <span class="pricing-standard-value fw-bolder text-primary">{{ $list->price }}</span>
                      <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                    </div>
                    <small class="annual-pricing d-none text-muted"></small>
                  </div>
                </div>
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
              <div class="row mt-3 justify-content-center">
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Debit Card</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->debit_card_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->debit_card_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->debit_card_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->debit_card_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Netbanking</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->netbanking_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->netbanking_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->netbanking_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->netbanking_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>UPI</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->upi_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->upi_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->upi_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->upi_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Credit Card</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->credit_card_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->credit_card_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->credit_card_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->credit_card_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>AMEX  Card</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->amex_card_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->amex_card_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->amex_card_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->amex_card_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Diners  Card</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->diners_card_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->diners_card_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->diners_card_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->diners_card_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Wallet</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->wallet_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->wallet_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->wallet_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->wallet_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Corporate Card</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->corporate_card_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->corporate_card_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->corporate_card_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->corporate_card_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Prepaid card</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Instant <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->prepaid_card_instant }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T0 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->prepaid_card_t0 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T+1 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->prepaid_card_t1 }} @if(!empty($per_s)) % @endif</span></span></li>
                      <li class="list-group-item ">T-2 <span  class=""><span style="float: right">@if(!empty($rup_s)) <i class="fas fa-rupee-sign"></i> @endif {{ $list->prepaid_card_t2 }} @if(!empty($per_s)) % @endif</span></span></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="pln_model_css mb-2 ">
                    <h4>Transaction Limit</h4>
                    <ul class="list-group list-group-circle text-start">
                      <li class="list-group-item ">Monthly limit <span  class="">{{ $list->monthly_limit }}</span></li>
                      <li class="list-group-item ">Limit Per Day <span  class="">{{ $list->limit_per_day }}</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ pricing plan cards -->

          <!-- pricing free trial -->
          <!--/ pricing free trial -->
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@foreach ($planq as $list)
<div
class="modal fade text-start"
id="planpurchesModal{{$list->id}}"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<form @if ($payment_getway->type == 2) action="{{  url('cashfree_plan_purchase') }}" @endif method="post" id="cashfee_getway{{$list->id}}">
  @csrf
<div class="modal-dialog modal-dialog-centered modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Upgrade Plan</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 py-2">
          <h4 style="text-align: center;font-weight:600">Your wallet Balance - {{get_wallet_bal_byid(session()->get('userid'))}}</h4>        
        </div>
        {{-- <div class="col-md-12" id="plan_purches_tpin_field" style="display: none;">
          <div class="mb-1">
            <label for="">Enter your Transaction pin</label>
            <input type="password" name="transactionpin" id="plan_purches_tpin_field" class="send_transactionpin_valid form-control">
            <label for="" id="distibutor_Transaction_pin_error" class="text-danger">Transaction pin should be 6 digit</label>
            <span class="field-icon" id="distibutor_tpin_eye"><i data-feather='eye'></i></span>
          </div>
        </div> --}}
        <div class="col-md-6">
          <input type="hidden" name="plan_price" id="plan_price{{ $list->id }}" value="{{ $list->price }}">
              <input type="hidden" name="plan_id" id="plan_id{{ $list->id }}" value="{{ $list->id }}">
          <input type="hidden" id="upgrad_plan_id" >
          {{-- rez --}}
          @if ($payment_getway->type == 1)
            {{-- rezorpay --}}
            <button type="button" onclick="upgrade_plan({{$list->id}})" class="btn w-100 btn-success mt-2">Online Pay</button>
            @endif
            @if ($payment_getway->type == 2)
            {{-- cash free --}}
            <button type="submit" class="btn w-100 btn-success mt-2">Online Pay</button>
            @endif 
        </div>
        <div class="col-md-6">
          @if($list->price > get_wallet_bal_byid(session()->get('userid')))
            <button disabled type="button" class="btn w-100 btn-success mt-2">From Wallet</button>
            <span class="text-danger" style="font-size: 10px;">You have not sufficient balance</span>
          @else
          <button type="button" onclick="upgrade_plan_from_wallet({{$list->id}})" class="btn w-100 btn-success mt-2">From Wallet</button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</form>
</div>
@endforeach
@php
    $popupchecklink = "";
    $popupcheckimage = "";
    $popupcheck = DB::table('offer_popup')->first();
    if(!empty($popupcheck)){
        $popupchecklink = $popupcheck->link;
        $popupcheckimage = $popupcheck->image;
    }
@endphp
@if (!empty($popupcheck))
<div
class="modal fade text-start"
id="popup_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body" >
        <a href="{{ $popupchecklink }}">
          <div>
            <img src="{{ url('storage/app/'.$popupcheckimage) }}" height="100%" width="100%" alt="">
          </div>
        </a>
      </div>
  </div>
</div>
</div>
@endif
@if (Request::url() == url('plan_purchase'))
<div
class="modal fade text-start"
id="plan_purches_tpin_verify_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Enter Transaction Pin</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

      <div @if(check_is_tpin_genrated(session()->get('userid')) != 1) style="display:none;" @endif id="NetworkTransfervarifypin">
    <div class="modal-body" >
        <div class="mb-2"  id="transaction_pin">
            <label for="">Enter your Transaction pin</label>
            <input type="password" name="transactionpin" id="send_transactionpin" class="send_transactionpin_valid form-control">
            <label style="display: none;" for="" id="Transaction_pin_error" class="text-danger">Transaction pin should be 6 digit</label>
            <span class="field-icon" id="tpin_eye"><i data-feather='eye'></i></span>
        </div>
    </div>
    <input type="hidden" id="plan_id_pin_check" value="">
    <div class="modal-footer">
        <button type="button" onclick="upgrade_plan_from_wallet_pin_check()" class="btn btn-success">Submit</button>
        {{-- <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button> --}}
    </div>
  </div>
<div @if(check_is_tpin_genrated(session()->get('userid')) == 1) style="display:none;" @endif class="modal-body" id="NetworkTransfernewpin">
  <form action="" method="post">
    @csrf
    <div class="form-group mb-2">
      <label for="">Transaction Pin</label>
      <input type="number" class="form-control" required name="transactionpin" id="newtransactionpin">
      <label for="" id="NTransaction_pin_error" style="display: none" class="NTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
    <div class="form-group mb-2">
      <label for="">Confirm Transaction Pin</label>
      <input type="number" class="form-control" name="" id="cnewtransactionpin">
      <label for="" id="CNTransaction_pin_error" style="display: none" class="CNTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
    <div class="form-group">
        <button type="button" onclick="model_gen_tpin()" id="submit_btn" class="btn btn-success">Submit</button>
        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
    </div>
</form> 
</div>

  </div>
</div>
</div>
<script>
  document.querySelector("#send_transactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#send_transactionpin").val();
    if(ph.length < 5){
        $("#Transaction_pin_error").show();
    }else{
        $("#Transaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#cnewtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#cnewtransactionpin").val();
    if(ph.length < 5){
        $("#CNTransaction_pin_error").show();
    }else{
        $("#CNTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#newtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#newtransactionpin").val();
    if(ph.length < 5){
        $("#NTransaction_pin_error").show();
    }else{
        $("#NTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  function model_gen_tpin(){
    var tpin = $("#newtransactionpin").val();
    var ctpin = $("#cnewtransactionpin").val();
    if(tpin != "" && ctpin != ""){
      if(tpin.length == 6 && ctpin.length == 6){
        if(tpin != ctpin){
          Swal.fire({
          icon: 'error',
          title: "Transaction pin and confirm pin should be same",
          confirmButtonText: 'Confirm'
          })
          return false;
        }
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('gen_tpin_in_model_form') }}",
                data: ({
                  tpin:tpin,
                }),
                success: function(response){
                  if(response == 1){
                    $("#NetworkTransfervarifypin").show();
                    $("#NetworkTransfernewpin").hide();
                      Swal.fire({
                        icon: 'success',
                        title: "Transaction pin generated successfully",
                        confirmButtonText: 'Confirm'
                      })
                  }
                }
        });
      }else{
        Swal.fire({
        icon: 'error',
        title: "Transaction pin should be 6 digit",
        confirmButtonText: 'Confirm'
        })
      }
    }else{
      Swal.fire({
      icon: 'error',
      title: "All field required",
      confirmButtonText: 'Confirm'
      })
    }
  }
</script>
@endif
@if (Request::url() == url('my_network') || Request::url() == url('merchant_network_list'))
<div
class="modal fade text-start"
id="plan_purches_tpin_verify_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Enter Transaction Pin</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

      <div @if(check_is_tpin_genrated(session()->get('userid')) != 1) style="display:none;" @endif id="NNetworkTransfervarifypin">
    <div class="modal-body" >
        <div class="mb-2"  id="transaction_pin">
            <label for="">Enter your Transaction pin</label>
            <input type="password" name="transactionpin" id="send_transactionpin" class="send_transactionpin_valid form-control">
            <label style="display: none;" for="" id="Transaction_pin_error" class="text-danger">Transaction pin should be 6 digit</label>
            <span class="field-icon" id="tpin_eye"><i data-feather='eye'></i></span>
        </div>
    </div>
    <input type="hidden" id="change_network_plan_id" value="">
    <input type="hidden" id="change_network_plan_uid" value="">
    <div class="modal-footer">
        <button type="button" onclick="network_upgrade_plan_from_wallet_pin_check()" class="btn btn-success">Submit</button>
        {{-- <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button> --}}
    </div>
  </div>
<div @if(check_is_tpin_genrated(session()->get('userid')) == 1) style="display:none;" @endif class="modal-body" id="NNetworkTransfernewpin">
  <form action="" method="post">
    @csrf
    <div class="form-group mb-2">
      <label for="">Transaction Pin</label>
      <input type="number" class="form-control" required name="transactionpin" id="nnewtransactionpin">
      <label for="" id="NNTransaction_pin_error" style="display: none" class="NNTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
    <div class="form-group mb-2">
      <label for="">Confirm Transaction Pin</label>
      <input type="number" class="form-control" name="" id="ccnewtransactionpin">
      <label for="" id="CCNTransaction_pin_error" style="display: none" class="CCNTransaction_pin_error text-danger">Transaction pin should be 6 digit</label>
    </div>
    <div class="form-group">
        <button type="button" onclick="model_gen_tpin()" id="submit_btn" class="btn btn-success">Submit</button>
        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
    </div>
</form> 
</div>

  </div>
</div>
</div>
<script>
  document.querySelector("#send_transactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#send_transactionpin").val();
    if(ph.length < 5){
        $("#Transaction_pin_error").show();
    }else{
        $("#Transaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#ccnewtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#ccnewtransactionpin").val();
    if(ph.length < 5){
        $("#CCNTransaction_pin_error").show();
    }else{
        $("#CCNTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector("#nnewtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#nnewtransactionpin").val();
    if(ph.length < 5){
        $("#NNTransaction_pin_error").show();
    }else{
        $("#NNTransaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  function model_gen_tpin(){
    var tpin = $("#nnewtransactionpin").val();
    var ctpin = $("#ccnewtransactionpin").val();
    if(tpin != "" && ctpin != ""){
      if(tpin.length == 6 && ctpin.length == 6){
        if(tpin != ctpin){
          Swal.fire({
          icon: 'error',
          title: "Transaction pin and confirm pin should be same",
          confirmButtonText: 'Confirm'
          })
          return false;
        }
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('gen_tpin_in_model_form') }}",
                data: ({
                  tpin:tpin,
                }),
                success: function(response){
                  if(response == 1){
                    $("#NNetworkTransfervarifypin").show();
                    $("#NNetworkTransfernewpin").hide();
                      Swal.fire({
                        icon: 'success',
                        title: "Transaction pin generated successfully",
                        confirmButtonText: 'Confirm'
                      })
                  }
                }
        });
      }else{
        Swal.fire({
        icon: 'error',
        title: "Transaction pin should be 6 digit",
        confirmButtonText: 'Confirm'
        })
      }
    }else{
      Swal.fire({
      icon: 'error',
      title: "All field required",
      confirmButtonText: 'Confirm'
      })
    }
  }
</script>
@endif
<div
class="modal fade text-start"
id="confirm_fee_model"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Information</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body" >
        <p class="my-2 text-danger">
          A Charge of Rs <span id="fee_amount"></span> plus taxes will apply
        </p>
        <div class="row">
          <div class="col-md-12">
            <button  type="button" id="confirm_fee_btn" class="btn btn-block btn-success waves-effect waves-float waves-light" onclick="continue_payout_form()">Continue</button>
            <button class="btn btn-success btn-block" id="confirm_fee_wait_btn" style="display: none;">Please Wait</button>
          </div>
        </div>
      </div>
  </div>
</div>
</div>  