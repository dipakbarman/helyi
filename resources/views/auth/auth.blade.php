<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="helyi, Powerful management dashboard">
    <meta name="keywords" content="helyi, Powerful management dashboard">
    <meta name="author" content="PIXINVENT">
    <title> @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css" integrity="sha512-OtwMKauYE8gmoXusoKzA/wzQoh7WThXJcJVkA29fHP58hBF7osfY0WLCIZbwkeL9OgRCxtAfy17Pn3mndQ4PZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
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
    #business_category option{
      text-transform: capitalize;
    }
    .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-box {
    background-color: #82B53F;
}
.bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-label .bs-stepper-title {
    color: #82B53F;
}
      .btn-success {
    background-color: #82B53F !important;
}
    .error_l{
      font-size: 0.857rem;
      color: #ea5455;
    }
    .brand-logo img {
    height: auto;
    width: 135px;
}
.field-icon {
    float: right;
    padding-right: 6px;
    margin-top: -30px;
    position: relative;
    z-index: 2;
    cursor: pointer;
}
.field-icon .feather, [data-feather] {
    height: 23px;
    width: 23px;
    display: inline-block;
}
</style>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
  @yield('body')
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
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script> --}}
    <script src="{{ asset('app-assets/js/scripts/pages/auth-two-steps.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js" integrity="sha512-+ruHlyki4CepPr07VklkX/KM5NXdD16K1xVwSva5VqOVbsotyCQVKEwdQ1tAeo3UkHCXfSMtKU/mZpKjYqkxZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/auth-register.min.js') }}"></script>

    <!-- END: Page JS-->

    <script>
    //     toastr.options = {
    //   "positionClass": "toast-top-center",
    // }
    @if(Session::has('not_active_user_error'))
      Swal.fire({
        imageUrl: "{{ asset('rg.png') }}",
          title: 'Thanks For Registration',
          text: 'Thank You for registering with us.Your request is under verification process. Please stay in touch with us. 8639832611',
          confirmButtonText: 'Confirm'
        })
      @endif
      @if(Session::has('success'))
      Swal.fire({
      icon: 'success',
      title: "{{ session('success') }}",
      confirmButtonText: 'ok'
    })
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
        @if(Session::has('error'))
        Swal.fire({
          icon: 'error',
          title: "{{ session('error') }}",
          confirmButtonText: 'ok'
        })
    @endif
      $(window).on('load',  function(){
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      })
      function select_forgot_password_type(type){
        if(type == 1){
          $("#email_field").show();
          $("#phone_field").hide();
          $("#emailid").attr("required", true);
          $("#mobile_number").removeAttr('required');
        }else if(type == 2){
          $("#email_field").hide();
          $("#phone_field").show();
          $("#emailid").removeAttr("required");
          $("#mobile_number").attr('required',true);
        }else{
          $("#email_field").hide();
          $("#phone_field").hide();
        }
      }
      @if(Request::url() == url('otpverify'))
      function check_verifyotp(){
        var otp = $("#otp").val();
        if(otp == ""){
          Swal.fire({
            icon: 'error',
            title: "Invalid OTP",
            confirmButtonText: 'Confirm'
            })
            return false;
        }else{
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:"{{ url('otpverify_form') }}",
                data: ({otp : otp
                }), 
                success: function(response){
                  if(response == 1){
                      $("#otp_field").hide();
                      $("#check_verifyotp_btn").hide();
                      $("#cpassword_field").show();
                      $("#password_checker_btn").show();
                      Swal.fire({
                      icon: 'success',
                      title: 'OTP verified successfully',
                      confirmButtonText: 'Confirm'
                      })
                  }
                if(response == 0){
                Swal.fire({
                icon: 'error',
                title: 'OTP not match',
                confirmButtonText: 'Confirm'
                })
                    return false;
                }
                }
            });
        }
      }
      $("#pass_eye").click(function(){
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
        $("#cpass_eye").click(function(){
            var x = document.getElementById("cpass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
      function password_checker(){
        var pass = $("#pass").val();
        var cpass = $("#cpass").val();
        if(pass == ""){
          Swal.fire({
          icon: 'error',
          title: 'All fields required',
          confirmButtonText: 'Confirm'
          })
          return false;
        }else{
          let strength = 0;
            if (pass.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                if (pass.match(/([0-9])/)) {
                    strength += 1;
                    if (pass.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                        strength += 1;
                        if (pass.length > 7) {
                            strength += 1;
                            
                        } else {
                            Swal.fire({
                            icon: 'error',
                            title: 'Password must have 8 characters',
                            confirmButtonText: 'Confirm'
                            })
                            return false;            
                        }
                    } else {
                        Swal.fire({
                        icon: 'error',
                        title: 'Password must have special characters',
                        confirmButtonText: 'Confirm'
                        })
                        return false;        
                    }
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Password must have Number',
                    confirmButtonText: 'Confirm'
                    })
                    return false;    
                }
            } else {
                Swal.fire({
                icon: 'error',
                title: 'Password must have lowercase & uppercase characters',
                confirmButtonText: 'Confirm'
                })
                return false;
            }
        }
        if(pass == cpass){
          $("#fchangepassword_form").submit();
        }else{
          Swal.fire({
          icon: 'error',
          title: 'Password and confirm Password should be same',
          confirmButtonText: 'Confirm'
          })
          return false;
        }
      }
      @endif
    </script>
    @include('auth.jsscript')
  </body>
  <!-- END: Body-->

</html>