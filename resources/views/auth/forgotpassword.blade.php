@extends('auth.auth')
@section('title', 'Forgot Password')
@section('body') 
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <form class="auth-login-form mt-2" action="{{url('forgotpassword_form')}}" onsubmit="validbtn()" method="POST">
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
                <div class="mb-1">
                  <label class="form-label" for="">Select Type</label>
                  <select name="type" onchange="select_forgot_password_type(this.value)" required id="" class="form-select">
                      <option value="">Select Type</option>
                      <option value="1">Email Id</option>
                      {{-- <option value="2">Phone Number</option> --}}
                  </select>
                </div>
                <div class="mb-1" id="email_field" style="display: none;">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="login-password">Email Id</label><a href="auth-forgot-password-cover.html">
                      {{-- <small>Forgot Password?</small> --}}
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
                <div class="mb-1">
                  {{-- <div class="form-check">
                    <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3"/>
                    <label class="form-check-label" for="remember-me"> Remember Me</label>
                  </div> --}}
                </div>
                <button type="submit" class="btn btn-success w-100" tabindex="4" id="validbtn">Send OTP</button>
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
