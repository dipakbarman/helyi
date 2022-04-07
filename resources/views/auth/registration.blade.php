@extends('auth.auth')
@section('title', 'Registration')
@section('body')

<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body"><div class="auth-wrapper auth-cover">
<div class="auth-inner row m-0">
<!-- Brand logo-->
<a class="brand-logo" href="#">
    <img src="{{ asset('logo.png') }}" alt="">
</a>
<!-- /Brand logo-->

<!-- Left Text-->
<div class="col-lg-3 d-none d-lg-flex align-items-center p-0">
  <div class="w-100 d-lg-flex align-items-center justify-content-center">
    <img
      class="img-fluid w-100"
      src="{{ asset('reg.png') }}"
      alt="multi-steps"
    />
  </div>
</div>
<!-- /Left Text-->

<!-- Register-->
<div class="col-lg-9 d-flex align-items-center auth-bg px-2 px-sm-3 px-lg-5 pt-3">
  <div class="width-700 mx-auto">
    <div class="bs-stepper register-multi-steps-wizard shadow-none">
      <div class="bs-stepper-header px-0" role="tablist">
        <div class="step active" id="first_s">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">
              <i data-feather="home" class="font-medium-3"></i>
            </span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Signup Process</span>
              <span class="bs-stepper-subtitle">Personal details</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" id="sec_s">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">
              <i data-feather="user" class="font-medium-3"></i>
            </span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Signup Process</span>
              <span class="bs-stepper-subtitle">Business details</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i data-feather="chevron-right" class="font-medium-2"></i>
        </div>
        <div class="step" id="pin_s">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">
              <i data-feather="key" class="font-medium-3"></i>
            </span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Signup Process</span>
              <span class="bs-stepper-subtitle">Login Pin details</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content px-0 mt-4">
        <div id="">
          <div class="content-header mb-2" id="first_head">
            <h2 class="fw-bolder mb-75">Account Information</h2>
            <span>Enter your account details</span>
          </div>
          <div class="content-header mb-2" id="sec_head" style="display: none;">
            <h2 class="fw-bolder mb-75">Business details</h2>
            <span>Enter your business details</span>
          </div>
          <div class="content-header mb-2" id="login_pin_head" style="display: none;">
            <h2 class="fw-bolder mb-75">Set Login Pin</h2>
            <span>Enter login pin details</span>
          </div>
          <form action="{{ url('registration_form') }}" method="post" enctype="multipart/form-data" id="registrationform">
            @csrf
            <div class="row" id="firstpart">
              <div class="col-md-6 mb-1">
                <label class="form-label" for="username">First Name</label>
                <input type="text" name="firstname" id="firstname"  class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label">Last Name</label>
                <input
                  type="text"
                  name="lastname"
                  id="lastname"
                  class="form-control"
                  placeholder=""
                  aria-label="john.doe"
                />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">DOB</label>
                <input type="text" name="dob" id="dob" class="form-control flatpickr-basic" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label">Gender</label>
                <select class="form-control form-select" name="gender" id="gender">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Mobile Number</label>
                <input type="number" name="mobile" id="mobile" class="form-control phone_validate" placeholder="" />
                <label class="text-danger error_l" id="phone_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
                <label class="text-danger error_l" id="Phone_number_already_use" style="display: none;" for="">Phone number already in use</label>
              </div>
              
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Email Id</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Permanent address</label>
                <input type="text" name="p_address" id="p_address" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Upload id proof</label>
                <input type="file" name="id_proof" id="id_proof_doc" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Upload bank details</label>
                <input type="file" name="bank_doc" id="bank_doc" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Upload your signature</label>
                <input type="file" name="signature_doc" id="signature_doc" class="form-control" placeholder="" />
              </div>
              <div class="col-md-12 mb-1">
                <label class="form-label" for="">Referral code(optional)</label>
                <input type="number" name="referral" id="referral" class="form-control" placeholder="" />
              </div>
              <div id="recaptcha-container" class="capture_for_mobile"></div>
              <div class="col-md-4">

              </div>
              <div class="col-md-4 mb-1" style="display: none;" id="otp_field">
                <label class="form-label" for="">Enter OTP</label>
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
                <label class="text-primary mt-1" id="resend_otp_btn" style="display: none;"><a onclick="send_otp()">Resend OTP</a></label>
              </div>
              <input type="hidden" name="is_otp" id="is_otp" value="">
            </div>
            {{-- style="display: none;" --}}
            <div class="row" id="sec_part" style="display: none;">
              <div class="col-md-6 mb-1">
                <label class="form-label" for="username">Shop Name</label>
                <input type="text" name="shop_name" id="shop_name"  class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label">Shop mobile number</label>
                <input
                  type="number"
                  name="shop_phone"
                  id="shop_phone"
                  class="form-control shop_mobile_number_valid"
                  placeholder=""
                  aria-label="john.doe"
                />
                <label class="text-danger error_l" id="shop_mobile_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
              </div>
              
              <div class="col-md-6 mb-1">
                <label class="form-label">Business category</label>
                <select class="form-control form-select" name="business_category" id="business_category">
                    <option value="">Select Category</option>
                    <option value="1">grocery </option>
                    <option value="2">food & restaurants </option>
                    <option value="3">fruits & vegetables</option>
                    <option value="4">meat & fish </option>
                    <option value="5">pet supolies</option>
                    <option value="6">paan shop</option>
                    <option value="7">gifts & lifestyle</option>
                    <option value="8">pick & drop</option>
                    <option value="9">flowers </option>
                    <option value="10">dairy products </option>
                    <option value="11">stationary </option>
                    <option value="12">water can supply</option>
                    <option value="13">pickup</option>
                    <option value="14">pharmacy</option>
                    <option value="15">mobile & accessories </option>
                    <option value="16">car services </option>
                    <option value="17">sports & fitness </option>
                    <option value="18">home services </option>
                    <option value="19">clothing </option>
                    <option value="20">Laundry </option>
                    <option value="21">Car & bike services </option>
                    <option value="22">beauty & grooming</option>
                    <option value="23">online classes</option>
                    <option value="24">mother & child </option>
                    <option value="25">other store</option>
                    <option value="26">custom delivery</option>
                </select>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Shop Number</label>
                <input type="number" name="shop_number" id="shop_number" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Area / Landmark</label>
                <input type="text" name="landmark" id="landmark" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">City</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Pincode</label>
                <input type="number" name="pincode" id="pincode" class="form-control pincode_valid" placeholder="" />
                <label class="text-danger error_l" id="pincode_error" style="display: none;" for="">Pincode should be 6 digit</label>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">State</label>
                <select name="state" id="state" class="form-control form-select">
                  <option value="">Select State</option>
                  @foreach ($stateq as $list)
                  <option value="{{$list->name}}">{{$list->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label">Select Your Type</label>
                <select class="form-control form-select"  name="merchant_type" id="merchant_type">
                    <option value="">Select type</option>
                    <option value="1">Merchant</option>
                    <option value="3">Distributor</option>
                    <option value="4">Master distributor</option>
                </select>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Geo location</label>
                <input type="text" name="geolocation" id="geolocation" readonly class="form-control" placeholder=""/>
                <span onclick="getLocation()" class="field-icon" id="cpass_eye"><i data-feather='map-pin'></i></span>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">City of operation</label>
                <input type="text" name="city_of_operation" id="city_of_operation" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Area of operation</label>
                <input type="text" name="area_of_operation" id="area_of_operation" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Store logo</label>
                <input type="file" name="store_logo" id="store_logo" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Store banner image</label>
                <input type="file" name="store_banner_logo" id="store_banner_logo" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">GST (optional)</label>
                <input type="text" name="gst" id="gst" class="form-control" placeholder="" />
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">FSSAI licence</label>
                <input type="number" name="fssai" id="fssai" class="form-control fssai_valid" placeholder="" />
                <label class="text-danger error_l" id="fssai_error" style="display: none;" for="">FSSAI licence should be 14 digit</label>
                {{-- <label class="text-danger error_l" id="fssai_exist_error" style="display: none;" for="">FSSAI licence already exist</label> --}}
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Enter Password</label>
                <input type="password" name="pass" id="pass" class="form-control" placeholder="" />
                <span class="field-icon" id="pass_eye"><i data-feather='eye'></i></span>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Enter confirm Password</label>
                <input type="password" name="cpass" id="cpass" class="form-control" placeholder="" />
                <span class="field-icon" id="cpass_eye"><i data-feather='eye'></i></span>
              </div>

            </div>
            <div id="login_pin_sec" style="display: none;">
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Set Login Pin</label>
                <input type="number" name="loginpin" id="loginpin" class="form-control loginpin_valid" placeholder="" />
                <label class="text-danger error_l" id="loginpin_error" style="display: none;" for="">Login Pin should be 4 digit</label>
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label" for="">Confirm Pin</label>
                <input type="password" name="confirmpin" id="confirmpin" class="form-control cloginpin_valid" placeholder="" />
                <label class="text-danger error_l" id="cloginpin_error" style="display: none;" for="">Login Pin should be 4 digit</label>
              </div>
            </div>
            
          </form>

          <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-outline-secondary btn-prev" disabled style="visibility: hidden">
              <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            {{-- btn-next --}}
            <button type="button" class="btn btn-success " onclick="send_otp()" id="send_otp_btn">
              <span class="align-middle d-sm-inline-block d-none">Send OTP</span>
              <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
            <button type="button" class="btn btn-success " style="display: none;" id="otp_var_btn">
              <span class="align-middle d-sm-inline-block d-none">Verify OTP</span>
              <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
            <button type="button" class="btn btn-success " style="display: none;" id="wait_btn">
              <span class="align-middle d-sm-inline-block d-none">Please wait...</span>
              <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
            <button type="button" class="btn btn-success " style="display: none;" id="pin_sec_btn">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
            <button type="button" class="btn btn-success " style="display: none;" id="login_pin_btn">
              <span class="align-middle d-sm-inline-block d-none">Register</span>
              <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
            <button type="button" class="btn btn-success " style="display: none;" id="sec_step_btn">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
            
          </div>
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
    </div>
  </div>
</div>
</div>
</div>

    </div>
  </div>
</div>
@endsection