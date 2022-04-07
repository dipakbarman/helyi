<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  
<!-- Mirrored from pixinvent.com/demo/vuexy-html-bootstrap-admin-template/html/ltr/vertical-menu-template/auth-register-multisteps.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 09:43:12 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Register</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.html') }}">
    <link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/style.css') }}">
    <!-- END: Custom CSS-->

  </head>
  <style>
    .brand-logo img {
    height: auto;
    width: 135px;
}
</style>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
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
          src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/illustration/create-account.svg"
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
            <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
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
            <div class="step active" data-target="#personal-info" role="tab" id="personal-info-trigger">
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
          </div>
          <div class="bs-stepper-content px-0 mt-4">
            <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
              <div class="content-header mb-2">
                <h2 class="fw-bolder mb-75">Business Information</h2>
                <span></span>
              </div>
              <form>
                <div class="row">
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="username">Shop Name</label>
                    <input type="text" name="username"  class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label">Shop mobile number</label>
                    <input
                      type="text"
                      name="lastname"
                      id="email"
                      class="form-control"
                      placeholder=""
                      aria-label="john.doe"
                    />
                  </div>
                  
                  <div class="col-md-6 mb-1">
                    <label class="form-label">Business category</label>
                    <select class="form-control" name="" id="">
                        <option value="">Select Category</option>
                        <option value="">Category</option>
                        <option value="">Category</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Shop Number</label>
                    <input type="number" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Area / Landmark</label>
                    <input type="text" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">City</label>
                    <input type="text" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Pincode</label>
                    <input type="number" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">State</label>
                    <input type="text" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Geo location</label>
                    <input type="text" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">City of operation</label>
                    <input type="text" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Area of operation</label>
                    <input type="text" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Set Login Pin</label>
                    <input type="number" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Confirm Pin</label>
                    <input type="number" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Store logo</label>
                    <input type="file" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">Store banner image</label>
                    <input type="file" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">GST (optional)</label>
                    <input type="number" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="">FSSAI licence</label>
                    <input type="number" name="username" id="dob" class="form-control" placeholder="" />
                  </div>
                </div>
                {{-- <div class="row">
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge form-password-toggle">
                      <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      />
                      <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="confirm-password">Confirm Password</label>
                    <div class="input-group input-group-merge form-password-toggle">
                      <input
                        type="password"
                        name="confirm-password"
                        id="confirm-password"
                        class="form-control"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      />
                      <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                  </div>

                  <div class="col-12 mb-1">
                    <label class="form-label" for="multiStepsURL">Profile Link</label>
                    <input
                      type="text"
                      name="multiStepsURL"
                      id="multiStepsURL"
                      class="form-control"
                      placeholder="johndoe/profile"
                      aria-label="johndoe"
                    />
                  </div>

                  <div class="col-12 mb-1">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="multiStepsRememberMe" />
                      <label class="form-check-label" for="multiStepsRememberMe">Remember me</label>
                    </div>
                  </div>
                </div> --}}
              </form>

              <div class="d-flex justify-content-between mt-2">
                <a href="{{ url('registration') }}" class="btn btn-primary" disabled>
                  <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </a>
                {{-- btn-next --}}
                <a href="{{ url('home') }}" class="btn btn-primary ">
                  <span class="align-middle d-sm-inline-block d-none">Confirm</span>
                  <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                </a>
              </div>
            </div>
            <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
              <div class="content-header mb-2">
                <h2 class="fw-bolder mb-75">Personal Information</h2>
                <span>Enter your Information</span>
              </div>
              <form>
                <div class="row">
                  <div class="mb-1 col-md-6">
                    <label class="form-label" for="first-name">First Name</label>
                    <input type="text" name="first-name" id="first-name" class="form-control" placeholder="John" />
                  </div>
                  <div class="mb-1 col-md-6">
                    <label class="form-label" for="last-name">Last Name</label>
                    <input type="text" name="last-name" id="last-name" class="form-control" placeholder="Doe" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="mobile-number">Mobile number</label>
                    <input
                      type="text"
                      name="mobile-number"
                      id="mobile-number"
                      class="form-control mobile-number-mask"
                      placeholder="(472) 765-3654"
                    />
                  </div>
                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="pin-code">PIN code</label>
                    <input
                      type="text"
                      name="pin-code"
                      id="pin-code"
                      class="form-control pin-code-mask"
                      placeholder="Code"
                      maxlength="6"
                    />
                  </div>

                  <div class="col-12 mb-1">
                    <label class="form-label" for="home-address">Home Address</label>
                    <input
                      type="text"
                      name="home-address"
                      id="home-address"
                      class="form-control"
                      placeholder="Address"
                    />
                  </div>

                  <div class="col-12 mb-1">
                    <label class="form-label" for="area-address">Area, Street, Sector, Village</label>
                    <input
                      type="text"
                      name="area-address"
                      id="area-address"
                      class="form-control"
                      placeholder="Area, Street, Sector, Village"
                    />
                  </div>

                  <div class="mb-1 col-md-6">
                    <label class="form-label" for="town-city">Town/City</label>
                    <input type="text" name="town-city" id="town-city" class="form-control" placeholder="Town/City" />
                  </div>
                  <div class="mb-1 col-md-6">
                    <label class="form-label" for="country">Country</label>
                    <select class="select2 w-100" name="country" id="country">
                      <option value="" label="blank"></option>
                      <option value="AK">Alaska</option>
                      <option value="HI">Hawaii</option>
                      <option value="CA">California</option>
                      <option value="NV">Nevada</option>
                      <option value="OR">Oregon</option>
                      <option value="WA">Washington</option>
                      <option value="AZ">Arizona</option>
                      <option value="CO">Colorado</option>
                      <option value="ID">Idaho</option>
                      <option value="MT">Montana</option>
                      <option value="NE">Nebraska</option>
                      <option value="NM">New Mexico</option>
                      <option value="ND">North Dakota</option>
                      <option value="UT">Utah</option>
                      <option value="WY">Wyoming</option>
                      <option value="AL">Alabama</option>
                      <option value="AR">Arkansas</option>
                      <option value="IL">Illinois</option>
                      <option value="IA">Iowa</option>
                      <option value="KS">Kansas</option>
                      <option value="KY">Kentucky</option>
                      <option value="LA">Louisiana</option>
                      <option value="MN">Minnesota</option>
                      <option value="MS">Mississippi</option>
                      <option value="MO">Missouri</option>
                      <option value="OK">Oklahoma</option>
                      <option value="SD">South Dakota</option>
                      <option value="TX">Texas</option>
                      <option value="TN">Tennessee</option>
                      <option value="WI">Wisconsin</option>
                      <option value="CT">Connecticut</option>
                      <option value="DE">Delaware</option>
                      <option value="FL">Florida</option>
                      <option value="GA">Georgia</option>
                      <option value="IN">Indiana</option>
                      <option value="ME">Maine</option>
                      <option value="MD">Maryland</option>
                      <option value="MA">Massachusetts</option>
                      <option value="MI">Michigan</option>
                      <option value="NH">New Hampshire</option>
                      <option value="NJ">New Jersey</option>
                      <option value="NY">New York</option>
                      <option value="NC">North Carolina</option>
                      <option value="OH">Ohio</option>
                      <option value="PA">Pennsylvania</option>
                      <option value="RI">Rhode Island</option>
                      <option value="SC">South Carolina</option>
                      <option value="VT">Vermont</option>
                      <option value="VA">Virginia</option>
                      <option value="WV">West Virginia</option>
                    </select>
                  </div>
                </div>
              </form>

              <div class="d-flex justify-content-between mt-2">
                <button class="btn btn-primary btn-prev">
                  <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none">Next</span>
                  <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                </button>
              </div>
            </div>
            <div id="billing" class="content" role="tabpanel" aria-labelledby="billing-trigger">
              <div class="content-header mb-2">
                <h2 class="fw-bolder mb-75">Select Plan</h2>
                <span>Select plan as per your retirement</span>
              </div>

              <form>
                <!-- select plan options -->
                <div class="row custom-options-checkable gx-3 gy-2">
                  <div class="col-md-4">
                    <input class="custom-option-item-check" type="radio" name="plans" id="basicPlan" value="" />
                    <label class="custom-option-item text-center p-1" for="basicPlan">
                      <span class="custom-option-item-title h3 fw-bolder">Basic</span>
                      <span class="d-block m-75">A simple start for everyone</span>
                      <span class="plan-price">
                        <sup class="font-medium-1 fw-bold text-primary">$</sup>
                        <span class="pricing-value fw-bolder text-primary">0</span>
                        <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                      </span>
                    </label>
                  </div>

                  <div class="col-md-4">
                    <input
                      class="custom-option-item-check"
                      type="radio"
                      name="plans"
                      id="standardPlan"
                      value=""
                      checked
                    />
                    <label class="custom-option-item text-center p-1" for="standardPlan">
                      <span class="custom-option-item-title h3 fw-bolder">Standard</span>
                      <span class="d-block m-75">For small to medium businesses</span>
                      <span class="plan-price">
                        <sup class="font-medium-1 fw-bold text-primary">$</sup>
                        <span class="pricing-value fw-bolder text-primary">99</span>
                        <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                      </span>
                    </label>
                  </div>

                  <div class="col-md-4">
                    <input class="custom-option-item-check" type="radio" name="plans" id="enterprisePlan" value="" />
                    <label class="custom-option-item text-center p-1" for="enterprisePlan">
                      <span class="custom-option-item-title h3 fw-bolder">Enterprise</span>
                      <span class="d-block m-75">Solution for big organizations</span>
                      <span class="plan-price">
                        <sup class="font-medium-1 fw-bold text-primary">$</sup>
                        <span class="pricing-value fw-bolder text-primary">499</span>
                        <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                      </span>
                    </label>
                  </div>
                </div>
                <!-- / select plan options -->

                <div class="content-header my-2 py-1">
                  <h2 class="fw-bolder mb-75">Payment Information</h2>
                  <span>Enter your card Information</span>
                </div>

                <div class="row gx-2">
                  <div class="col-12 mb-1">
                    <label class="form-label" for="addCardNumber">Card Number</label>
                    <div class="input-group input-group-merge">
                      <input
                        id="addCardNumber"
                        name="addCard"
                        class="form-control credit-card-mask"
                        type="text"
                        placeholder="1356 3215 6548 7898"
                        aria-describedby="addCard"
                        data-msg="Please enter your credit card number"
                      />
                      <span class="input-group-text cursor-pointer p-25" id="addCard">
                        <span class="card-type"></span>
                      </span>
                    </div>
                  </div>

                  <div class="col-md-6 mb-1">
                    <label class="form-label" for="addCardName">Name On Card</label>
                    <input type="text" id="addCardName" class="form-control" placeholder="John Doe" />
                  </div>

                  <div class="col-6 col-md-3 mb-1">
                    <label class="form-label" for="addCardExpiryDate">Exp. Date</label>
                    <input
                      type="text"
                      id="addCardExpiryDate"
                      class="form-control expiry-date-mask"
                      placeholder="MM/YY"
                    />
                  </div>

                  <div class="col-6 col-md-3 mb-1">
                    <label class="form-label" for="addCardCvv">CVV</label>
                    <input
                      type="text"
                      id="addCardCvv"
                      class="form-control cvv-code-mask"
                      maxlength="3"
                      placeholder="654"
                    />
                  </div>
                </div>
              </form>

              <div class="d-flex justify-content-between mt-1">
                <button class="btn btn-primary btn-prev">
                  <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-success btn-submit">
                  <i data-feather="check" class="align-middle me-sm-25 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Submit</span>
                </button>
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
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/auth-register.min.js') }}"></script>
    <!-- END: Page JS-->

    <script>
      $(window).on('load',  function(){
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      })
    </script>
  </body>
  <!-- END: Body-->

<!-- Mirrored from pixinvent.com/demo/vuexy-html-bootstrap-admin-template/html/ltr/vertical-menu-template/auth-register-multisteps.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 09:43:12 GMT -->
</html>