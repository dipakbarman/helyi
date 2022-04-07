@extends('auth.auth')
@section('title', 'Forgot Password')
@section('body') 
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <form class="auth-login-form mt-2" action="{{url('fchangepassword_form')}}" method="POST" id="fchangepassword_form">
      @csrf
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
              <h2 class="card-title fw-bold mb-1">Forgot Password</h2>
              @if (session()->get('otp_varify') == "")
              <div class="mb-1" id="otp_field">
                <label class="form-label" for="">Enter Your OTP</label>
                <input type="number" name="otp" id="otp" class="form-control">
              </div>  
              @endif
                
                <div class="mb-1" id="cpassword_field" @if (session()->get('otp_varify') == "") style="display: none;" @endif>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="">Enter Password</label>
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="" />
                            <span class="field-icon" id="pass_eye"><i data-feather='eye'></i></span>
                          </div>
                          <div class="col-md-12 mb-1">
                            <label class="form-label" for="">Enter confirm Password</label>
                            <input type="password" name="cpass" id="cpass" class="form-control" placeholder="" />
                            <span class="field-icon" id="cpass_eye"><i data-feather='eye'></i></span>
                          </div>
                    </div>
                </div>
                @if (session()->get('otp_varify') == "")
                <button type="button" id="check_verifyotp_btn" onclick="check_verifyotp()" class="btn btn-success w-100" tabindex="4">verify OTP</button>
                @endif
                <button type="button" id="password_checker_btn" onclick="password_checker()" class="btn btn-success w-100" tabindex="4"   @if (session()->get('otp_varify') == "") style="display: none;" @endif>Proceed</button>
              <button type="button" class="btn btn-success w-100" style="display: none;" id="spindbtn" tabindex="4"><i class="fa fa-spinner fa-spin"></i></button>
              
              <div class="div">
                <p class="text-center mt-2">
                  <span>Already have an account?</span>
                  <a href="{{ url('login') }}">
                    <span>Sign in instead</span>
                  </a>
                </p>
              </div>
            </div>
          </div>
          <!-- /Login-->
        </div>
      </div>
    </div>
  </form>
  </div>
</div> 
@endsection
