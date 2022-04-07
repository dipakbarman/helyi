@extends('auth.auth')
@section('title', 'Login')
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body"><div class="auth-wrapper auth-basic px-2">
<div class="auth-inner my-2">
<!-- Login basic -->
<div class="card mb-0">
  <div class="card-body">
    <a href="#" class="brand-logo">
        <img src="{{ asset('logo.png') }}" alt="">
    </a>

    <h4 class="card-title mb-1">Welcome to Helyi! 👋</h4>

    <form class="auth-login-form mt-2" action="{{url('adminlogincheck')}}" onsubmit="validbtn()" method="POST">
      @csrf
        <div class="mb-1">
        <label for="login-email" class="form-label">Email</label>
        <input
          type="text"
          class="form-control"
          id="login-email"
          name="email"
          required
          value=""
          placeholder="john@example.com"
          aria-describedby="login-email"
          tabindex="1"
          autofocus
        />
      </div>

      <div class="mb-1">
        <div class="d-flex justify-content-between">
          <label class="form-label" for="login-password">Password</label>
        </div>
        <div class="input-group input-group-merge form-password-toggle">
          <input
            type="password"
            class="form-control form-control-merge"
            id="login-password"
            name="pass"
            value=""
            tabindex="2"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            aria-describedby="login-password"
          />
          <span id="ad_e" class="input-group-text cursor-pointer"><i class="fas fa-eye"></i></span>
          
        </div>
      </div>
      <div class="mb-1">
        {{-- <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3" />
          <label class="form-check-label" for="remember-me"> Remember Me </label>
        </div> --}}
      </div>
      <button type="submit" class="btn btn-primary w-100" tabindex="4" id="validbtn">Sign in</button>
      <button type="button" class="btn btn-primary w-100" style="display: none;" id="spindbtn" tabindex="4"><i class="fa fa-spinner fa-spin"></i></button>
    </form>

  </div>
</div>
<!-- /Login basic -->
</div>
</div>

    </div>
  </div>
</div>
@section('body')