@extends('auth.auth')
@section('title', 'Login')
@section('body') 
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <form class="auth-login-form mt-2" action="{{url('logincheck')}}" onsubmit="validbtn()" method="POST">
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
              <h2 class="card-title fw-bold mb-1">Welcome to Helyi! 👋</h2>
                <div class="mb-1">
                  <label class="form-label" for="">Mobile Number</label>
                  <input
            type="number"
            class="form-control"
            id="mobile"
            name="mobile"
            required
            value="super"
            aria-describedby="login-email"
            tabindex="1"
            autofocus
          />
          <label class="text-danger" id="phone_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
                </div>
                <div class="mb-1">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="login-password">Password</label><a href="auth-forgot-password-cover.html">
                      {{-- <small>Forgot Password?</small> --}}
                    </a>
                  </div>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input
                      type="password"
                      class="form-control form-control-merge"
                      id="login-password"
                      name="pass"
                      required
                      tabindex="2"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="login-password"
                    />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                  <div class="mt-1" style="float: right;">
                    <p class="">
                      <a href="{{ url('forgotpassword') }}">
                        <span>Forgot Password?</span>
                      </a>
                    </p>
                  </div>
                </div>
                <div class="mb-1">
                  {{-- <div class="form-check">
                    <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3"/>
                    <label class="form-check-label" for="remember-me"> Remember Me</label>
                  </div> --}}
                </div>
                <button type="submit" class="btn btn-success w-100" tabindex="4" id="validbtn">Sign in</button>
              <button type="button" class="btn btn-success w-100" style="display: none;" id="spindbtn" tabindex="4"><i class="fa fa-spinner fa-spin"></i></button>
              
              <p class="text-center mt-2">
                <span>New on our platform?</span>
                <a href="{{ url('registration') }}">
                  <span>Create an account</span>
                </a>
              </p>
          
              <div class="divider my-2">
                <div class="divider-text">or</div>
              </div>
          
              <a href="{{ url('loginwithpin') }}" class="btn btn-success w-100" tabindex="4" id="validbtn">Login with pin</a>
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
