@extends('auth.auth')
@section('title', 'Login')
@section('body')
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
          <!-- Brand logo-->
          <a class="brand-logo" href="{{ url('login') }}">
              <img src="{{ asset('logo.png') }}" alt="">
          </a>
          <!-- /Brand logo-->
          <!-- Left Text-->
          <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ asset('loginpages.png') }}" alt="Login V2"/></div>
          </div>
          <!-- /Left Text-->
          <!-- Login-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              <h2 class="card-title fw-bold mb-1">Welcome to Helyi! 👋</h2>
                
              <form class="auth-login-form mt-2" action="{{url('loginwithpincheck')}}" onsubmit="validbtn()" method="POST">
                @csrf
                <div class="mb-1" id="mobile_field">
                  <label for="login-email" class="form-label">Enter Mobile</label>
                  <input type="number" class="form-control" id="mobile" name="mobile" required  aria-describedby="login-email" tabindex="1" autofocus/>  
                  <label class="text-danger" id="phone_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
                </div>
                <div class="resend_sec_clsss">
                <div class="mb-1" id="otp_field" style="display: none;">
                  <label for="login-email" class="form-label">Enter OTP</label>
                  <div class="auth-input-wrapper d-flex align-items-center justify-content-between">
                    <input
                      type="text"
                      class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                      maxlength="1"
                      id="otp1"
                      autofocus=""
                    />
        
                    <input
                      type="text"
                      id="otp2"
                      class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                      maxlength="1"
                    />
        
                    <input
                      type="text"
                      id="otp3"
                      class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                      maxlength="1"
                    />
        
                    <input
                      type="text"
                      id="otp4"
                      class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                      maxlength="1"
                    />
        
                    <input
                      type="text"
                      id="otp5"
                      class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                      maxlength="1"
                    />
        
                    <input
                      type="text"
                      id="otp6"
                      class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                      maxlength="1"
                    />
                  </div>
                  <button style="display: none;" type="button"  class="btn btn-success w-100 mb-1" tabindex="4" ></button>
                </div>
                <div id="recaptcha-container" class="capture_for_mobile"></div>
                </div>
                <div class="mb-1" style="display: none;" id="pin_field">
                  <label for="login-email" class="form-label">Enter your Pin</label>
                  <input
                    type="password"
                    class="form-control"
                    id="pin"
                    name="pin"
                    required
                    value="super"
                    aria-describedby="login-email"
                    tabindex="1"
                    autofocus
                  />
                  <span class="field-icon" id="tpin_eye"><i class="fas fa-eye"></i></span>
                  <label class="text-danger" id="loginpin_error" style="display: none;" for="">Login Pin should be 4 digit</label>
                </div>
                <div class="mb-1"> </div>
                <button type="submit" id="submit_btn" style="display: none;" class="btn btn-success w-100" tabindex="4">Login</button>
                <button type="button" id="send_otp_btn" class="btn btn-success w-100" tabindex="4" onclick="send_otp()">Send OTP</button>
                <div class="resend_sec_clsss">
                  <button type="button" id="resend_otp_btn" style="display: none;" class="btn btn-success mb-1 w-100 mb-2" tabindex="4" onclick="send_otp()">Resend OTP</button>
                </div>
                <button style="display: none;" type="button" id="otp_var_btn" class="btn btn-success w-100" tabindex="4">OTP Verify</button>
                <button type="button" id="wait_btn" style="display: none;" class="btn btn-success w-100" tabindex="4">Please wait</button>
              </form>
              
              <p class="text-center mt-2">
                <span>New on our platform?</span>
                <a href="{{ url('registration') }}">
                  <span>Create an account</span>
                </a>
              </p>

              <div class="divider my-2">
                <div class="divider-text">or</div>
              </div>

              <a href="{{ url('login') }}" class="btn btn-success w-100" tabindex="4" id="validbtn">Login with mobile</a>
            </div>
          </div>
          <!-- /Login-->
        </div>
      </div>
    </div>
  </div>
</div> 
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
@endsection
