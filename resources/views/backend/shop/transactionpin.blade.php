@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
              <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                Transaction Pin
            </h4>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    @if (!empty($userdata->transactionpin))
                      <button class="btn btn-success mb-2 btn-block" type="button" id="change_transactionpin_btn">Change Transaction pin</button>  
                      <div id="change_transactionpin_div" style="display: none;">
                        <div class="row" id="email_opt_section">
                          <div class="col-md-12">
                            <div class="mb-1">
                              <label class="form-label" for="">Select Type</label>
                              <select name="type" onchange="select_forgot_password_type(this.value)" required id="" class="form-select">
                                  <option value="">Select Type</option>
                                  <option value="1">Email Id</option>
                                  {{-- <option value="2">Phone Number</option> --}}
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-1" id="email_field" style="display: none;">
                              <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Email Id</label><a href="auth-forgot-password-cover.html">
                                </a>
                              </div>
                              <div class="input-group input-group-merge form-password-toggle">
                                <input
                                  type="email"
                                  class="form-control"
                                  id="emailid"
                                  placeholder="Enter Email Id"
                                  name="emailid"
                                />
                              </div>
                              <div class="mt-2" id="email_otp_field" style="display: none">
                                <label for="">Enter OTP</label>
                                <input type="number" id="tpinotp" class="form-control">
                              </div>
                              <div class="mt-2">
                                <button id="send_btn" type="button" onclick="tpin_change_sendotp(1)" class="btn btn-success">Send OTP</button>
                                <button style="display: none" id="verify_btn" type="button" onclick="tpin_change_sendotp(2)" class="btn btn-success">Verify OTP</button>
                                <button style="display: none;" id="tpin_wait_btn" type="button" class="btn btn-success">Please Wait</button>
                              </div>
                            </div>
                            <div class="mb-1" id="phone_field" style="display: none;">
                                <div class="d-flex justify-content-between">
                                  <label class="form-label" for="login-password">Mobile Number</label><a href="auth-forgot-password-cover.html">
                                    {{-- <small>Forgot Password?</small> --}}
                                  </a>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                  <input
                                    type="number"
                                    class="form-control"
                                    id="mobile_number"
                                    placeholder="Enter Mobile Number"
                                    name="mobile_number"
                                  />
                                </div>
                              </div>
                          </div>
                        </div>
                        {{-- xxx --}}
                        <div id="tpin_change_form" style="display: none;">
                          <form action="{{url('transactionpin_update')}}" id="transactionpin_update" method="post" onsubmit="validbtn()">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="">New Transaction Pin</label>
                                <input type="password" class="form-control ntransactionpin" required name="transactionpin" id="transactionpin">
                                <span class="field-icon" id="npin_eye"><i data-feather='eye'></i></span>
                                <label for="" style="display: none" class="Transaction_pin_error text-danger">Transaction pin should be 6 digit</label>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="change_tpin_form()" id="submit_btn" class="btn btn-success">Submit</button>
                            </div>
                        </form>      
                        </div>
                      </div>
                    @else
                    <div class="pin_generate_div">
                    <form action="{{url('transactionpin_create')}}" method="post" onsubmit="validbtn()">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Transaction Pin</label>
                            <input type="number" class="form-control" required name="transactionpin" id="newtransactionpin">
                            <label for="" id="Transaction_pin_error" style="display: none" class="Transaction_pin_error text-danger">Transaction pin should be 6 digit</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                            <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </div>
                    </form>
                </div>
                <script>
                  
                    document.querySelector("#newtransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#newtransactionpin").val();
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
                </script>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//   document.querySelector(".oldtransactionpin")
// .addEventListener("keypress", function(e) {
//     e.preventDefault();
// 	console.log(e.key);
//     var ph = $(".oldtransactionpin").val();
//     if(ph.length < 5){
//         $(".oldtransactionpin_pin_error").show();
//     }else{
//         $(".oldtransactionpin_pin_error").hide();
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
@if (!empty($userdata->transactionpin))
  document.querySelector(".ntransactionpin")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $(".ntransactionpin").val();
    if(ph.length < 5){
        $(".Transaction_pin_error").show();
    }else{
        $(".Transaction_pin_error").hide();
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
  @endif
</script>
@endsection