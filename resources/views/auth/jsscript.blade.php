<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script>
    @if (Request::url() == url('registration') || Request::url() == url('addnewnetwork') || Request::url() == url('admincreateuser')) 
    const firebaseConfig = {
    apiKey: "AIzaSyA5nP9ml5tlsoiogXySGFLZ7e9V0M4GeSw",
    authDomain: "heyli-9e3e9.firebaseapp.com",
    projectId: "heyli-9e3e9",
    storageBucket: "heyli-9e3e9.appspot.com",
    messagingSenderId: "618243614367",
    appId: "1:618243614367:web:2b50c7d0443900c06164aa",
    measurementId: "G-VM15H8CJ2S"
    };
    firebase.initializeApp(firebaseConfig);
    window.onload = function () {
        render();
    };
    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    };
    @if(Session::has('success'))
        toastr.success("{{ session('success') }}");
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
        @if(Session::has('error'))
        toastr.error("{{ session('error') }}");
    @endif
    function send_otp(){
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var mobile = $("#mobile").val();
        var email = $("#email").val();
        var p_address = $("#p_address").val();
        var id_proof_doc = $("#id_proof_doc").val();
        var bank_doc = $("#bank_doc").val();
        var signature_doc = $("#signature_doc").val();
        if(firstname == "" || lastname == "" || dob == "" || gender == "" || mobile == "" || email == "" || p_address == "" || id_proof_doc == "" || bank_doc == "" || signature_doc == ""){
            // toastr.error("All fields required");
            Swal.fire({
            icon: 'error',
            title: "All fields required",
            confirmButtonText: 'Confirm'
            })
            return false;
        }else{
            if(firstname.match(/^[A-Za-z \s]+$/) && lastname.match(/^[A-Za-z \s]+$/)){
                if(check_mobile(mobile) == 1){
                var valid_number = "+91"+mobile;
                firebase.auth().signInWithPhoneNumber(valid_number, window.recaptchaVerifier).then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            // if(coderesult == false){
            //     Swal.fire({
            //     icon: 'error',
            //     title: "Check capture",
            //     confirmButtonText: 'Confirm'
            //     })
            // }
            console.log(coderesult);
            $("#wait_btn").show();
            $("#send_otp_btn").hide();
            $("#resend_otp_btn").hide();
            $("#otp_var_btn").hide();
            // toastr.success("Please check your phone, Otp sent");
            Swal.fire({
            icon: 'success',
            title: "Please check your phone, Otp sent",
            confirmButtonText: 'Confirm'
            })
            setTimeout(function() {
            $(".capture_for_mobile").hide();
            $("#otp_field").show();
            $("#wait_btn").hide();
            $("#otp_var_btn").show();
            }, 2000);
            setTimeout(function() {
            $(".capture_for_mobile").show();
            $("#resend_otp_btn").show();
            }, 30000);
        }).catch(function (error) {
            toastr.error(error.message);
            $("#wait_btn").hide();
            $("#send_otp_btn").show();
        });
            }else{
                // toastr.error("Phone number should be 10 digit");
                Swal.fire({
                icon: 'error',
                title: "Phone number should be 10 digit",
                confirmButtonText: 'Confirm'
                })
                return false;
            }
            }else{
                Swal.fire({
                icon: 'error',
                title: "The name must contain alpha characters only",
                confirmButtonText: 'Confirm'
                })
                return false;
            }
            
        }
    }
    // $("#send_otp_btn").click(function(){
       
    // });
    $("#otp_var_btn").click(function(){
      @if(Request::url() == url('registration'))
      var otp1 = $("#otp1").val();
      var otp2 = $("#otp2").val();
      var otp3 = $("#otp3").val();
      var otp4 = $("#otp4").val();
      var otp5 = $("#otp5").val();
      var otp6 = $("#otp6").val();
      var otp = otp1+otp2+otp3+otp4+otp5+otp6; 
      @else
      var otp = $("#otp").val();
      @endif
      
    if(otp == ""){
            Swal.fire({
                icon: 'error',
                title: "OTP fields required",
                confirmButtonText: 'Confirm'
                })
            return false;
        }else{
            if(otp.length != 6){
                Swal.fire({
                icon: 'error',
                title: "Enter valid OTP",
                confirmButtonText: 'Confirm'
                })
                return false;
            }else{
            $("#otp_var_btn").hide();
            $("#wait_btn").show();
            coderesult.confirm(otp).then(function (result) {
            var user = result.user;
            console.log(user);
            Swal.fire({
                icon: 'success',
                title: "Phone number verified",
                confirmButtonText: 'Confirm'
                })
            setTimeout(function() {
                $(".capture_for_mobile").hide();
                $("#resend_otp_btn").hide();
                $('#mobile').prop('readonly', true);
                $("#wait_btn").hide();
                $("#otp_field").hide();
                $("#is_otp").val(1);
                go_to_next_page();
            }, 2000);
        }).catch(function (error) {
            toastr.error(error.message);
            $("#wait_btn").hide();
            $("#otp_var_btn").show();
        });
            }
        }
    });
    function go_to_next_page(){
      $("#pin_sec_btn").show();
        $("#firstpart").hide();
        $("#sec_part").show();
        $("#first_head").hide();
        $("#sec_head").show();
        $("#sec_step_btn").hide();
        $("#first_s").removeClass("active");
        $("#sec_s").addClass("active");
    }
    $("#pin_sec_btn").click(function(){
    var shop_name = $("#shop_name").val();
    var merchant_type = $("#merchant_type").val();
    var shop_phone = $("#shop_phone").val();
    var business_category = $("#business_category").val();
    var shop_number = $("#shop_number").val();
    var landmark = $("#landmark").val();
    var city = $("#city").val();
    var pincode = $("#pincode").val();
    var state = $("#state").val();
    var geolocation = $("#geolocation").val();
    var city_of_operation = $("#city_of_operation").val();
    var area_of_operation = $("#area_of_operation").val();
    var store_logo = $("#store_logo").val();
    var store_banner_logo = $("#store_banner_logo").val();
    var fssai = $("#fssai").val();
    var pass = $("#pass").val();
    var cpass = $("#cpass").val();
    if(merchant_type == "" ||shop_name == "" || business_category == "" || shop_number == "" || landmark == "" || city == "" || pincode == "" || state == "" || geolocation == "" || city_of_operation == "" || area_of_operation == "" || store_logo == "" || store_banner_logo == "" || fssai == "" || pass == "" || cpass == ""){
        // toastr.error("All fields required");
        Swal.fire({
                icon: 'error',
                title: 'All fields required',
                confirmButtonText: 'Confirm'
                })
        return false;
    }else{
        if(pincode.length != 6){
            // toastr.error("Pincode should be 6 digit");
            Swal.fire({
                icon: 'error',
                title: 'Pincode should be 6 digit',
                confirmButtonText: 'Confirm'
                })
            return false;
        }
        if(fssai.length != 14){
            // toastr.error("Fssai number should be 14 digit");
            Swal.fire({
                icon: 'error',
                title: 'Fssai number should be 14 digit',
                confirmButtonText: 'Confirm'
                })
            return false;
        }
        
        if(check_mobile(shop_phone) == 1){
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
            $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('check_fssai_licence') }}",
	            data: ({fssai:fssai}),
	            success: function(response){
	                if(response == 1){
						Swal.fire({
						icon: 'error',
						title: "Fssai licence already exist",
							allowEscapeKey: false,
						    allowOutsideClick: false,
						confirmButtonText: 'Confirm'
						})
                        return false;
					}else{
					    if(pass == cpass){
                $("#sec_part").hide();
                $("#login_pin_sec").show();
                $("#login_pin_head").show();
                $("#pin_sec_btn").hide();
                $("#login_pin_btn").show();
                $("#sec_head").hide();
                $("#sec_s").removeClass("active");
                $("#pin_s").addClass("active");
            }else{
                // toastr.error("Password and confirm Password should be same");
                Swal.fire({
                icon: 'error',
                title: 'Password and confirm Password should be same',
                confirmButtonText: 'Confirm'
                })
                return false;
            }
					}
	            }
	        });
            
        }else{
            // toastr.error("Phone number should be 10 digit");
            Swal.fire({
                icon: 'error',
                title: 'Phone number should be 10 digit',
                confirmButtonText: 'Confirm'
                })
            return false;
        }
    }
    });
    $("#login_pin_btn").click(function(){
        var loginpin = $("#loginpin").val();
        var confirmpin = $("#confirmpin").val();
        if(loginpin.length != 4 || confirmpin.length != 4){
            // toastr.error("Login pin should be 4 digit");
            Swal.fire({
                icon: 'error',
                title: 'Login pin should be 4 digit',
                confirmButtonText: 'Confirm'
                })
            return false;
        }else{
            if(loginpin == confirmpin){
                $("#wait_btn").show();
                $("#login_pin_btn").hide();
                // $("#submitbtn").click();
                $( "#registrationform" ).submit();
            }else{
                // toastr.error("Login pin and confirm pin should be same");
                Swal.fire({
                icon: 'error',
                title: 'Login pin and confirm pin should be same',
                confirmButtonText: 'Confirm'
                })
                return false;
            }
        }
    });
    function check_mobile(number){
        if(number.length == 10){
            return 1;
        }else{
            return 0;
        }
    }
    function check_number_valid(mobile){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:"{{ url('check_number_valid') }}",
                data: ({phone_number : phone_number
                }), 
                success: function(response){
                    if(response == 0){
                        // toastr.error("Phone number already in use");
                        Swal.fire({
                icon: 'error',
                title: 'Phone number already in use',
                confirmButtonText: 'Confirm'
                })
                        return false;
                    }
                }
            });
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
        $("#dob").flatpickr({
          dateFormat: "d-m-Y",
          maxDate : "{{date('d-m-Y', strtotime('-18 years'))}}",
        });
        $("#mobile").keyup(function(){
            var mobile = $("#mobile").val();
            $("#otp_field").hide();
            $("#otp_var_btn").hide();
            $(".capture_for_mobile").show();
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:"{{ url('check_number_valid') }}",
                data: ({mobile : mobile
                }), 
                success: function(response){
                    if(response == 0){
                        // toastr.error("Phone number already in use");
                        $("#Phone_number_already_use").show();
                        $("#send_otp_btn").hide();
                        return false;
                    }else{
                        $("#Phone_number_already_use").hide();
                        $("#send_otp_btn").show();
                    }
                }
            });
        });

function setInputFilter(textbox, inputFilter){
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}
setInputFilter(document.getElementById("firstname"), function(value) {
  return /^[a-z \s]*$/i.test(value); });
  setInputFilter(document.getElementById("lastname"), function(value) {
  return /^[a-z \s]*$/i.test(value); });
  setInputFilter(document.getElementById("shop_name"), function(value) {
  return /^[a-z \s]*$/i.test(value); });

var maxValue = 9999999999;
var maxpin = 999999;
var maxfssai = 99999999999999;
var maxloginpin = 9999;
var otplenth = 999999;
document.querySelector(".phone_validate")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#mobile").val();
    if(ph.length < 9){
        $("#phone_number_error").show();
    }else{
        $("#phone_number_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > maxValue) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector(".shop_mobile_number_valid")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#shop_phone").val();
    if(ph.length < 9){
        $("#shop_mobile_number_error").show();
    }else{
        $("#shop_mobile_number_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > maxValue) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector(".pincode_valid")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#pincode").val();
    if(ph.length < 5){
        $("#pincode_error").show();
    }else{
        $("#pincode_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > maxpin) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector(".fssai_valid")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#fssai").val();
    if(ph.length < 13){
        $("#fssai_error").show();
    }else{
        $("#fssai_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > maxfssai) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector(".loginpin_valid")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $(".loginpin_valid").val();
    if(ph.length < 3){
        $("#loginpin_error").show();
    }else{
        $("#loginpin_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > maxloginpin) {
        return false;
      }
      input.value = value;
    }
  });
  document.querySelector(".cloginpin_valid")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $(".cloginpin_valid").val();
    if(ph.length < 3){
        $("#cloginpin_error").show();
    }else{
        $("#cloginpin_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > maxloginpin) {
        return false;
      }
      input.value = value;
    }
  });
//   document.querySelector(".otpinput")
//   .addEventListener("keypress", function(e) {
//     e.preventDefault();
// 	console.log(e.key);
    // var ph = $("#otp").val();
    // if(ph.length != 6){
    //     $(".otpinput_error").show();
    // }else{
    //     $(".otpinput_error").hide();
    // }
//     var input = e.target;
//     var value = Number(input.value);
//     var key = Number(e.key);
//     if (Number.isInteger(key)) {
//       value = Number("" + value + key);
//       if (value > otplenth) {
//         return false;
//       }
//       input.value = value;
//     }
//   });

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition,positionError);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function positionError() {    
        console.log('Geolocation is not enabled. Please enable to use this feature')
            
         if(allowGeoRecall && countLocationAttempts < 5) {
             countLocationAttempts += 1;
             getLocation();
         }
     }
function showPosition(position) {
  var lat = position.coords.latitude;
  var long = position.coords.longitude;
  var geo_locaation = "latitude : "+lat+"--longitude : "+long;
  $("#geolocation").val(geo_locaation);
}
getLocation();
@endif
@if (Request::url() == url('login'))
var maxValue = 9999999999;
document.querySelector("#mobile")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
    var ph = $("#mobile").val();
    if(ph.length < 9){
        $("#phone_number_error").show();
    }else{
        $("#phone_number_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > maxValue) {
        
        return false;
      }
      console.log(ph.length);
      input.value = value;
    }
  });
  // function logincheck(mobile){
  //   var phone_number = $("#mobile").val();
  //   var phone_number = $("#mobile").val();
  //       $.ajaxSetup({
  //           headers: {
  //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
  //           }
  //           });
  //           $.ajax({
  //               type:"POST",
  //               url:"{{ url('logincheck') }}",
  //               data: ({phone_number : phone_number
  //               }), 
  //               success: function(response){
  //                   if(response == 0){
  //                       toastr.error("Phone number already in use");
  //                       return false;
  //                   }
  //               }
  //           });
  //       }
@endif
@if (Request::url() == url('loginwithpin'))
const firebaseConfig = {
apiKey: "AIzaSyA5nP9ml5tlsoiogXySGFLZ7e9V0M4GeSw",
authDomain: "heyli-9e3e9.firebaseapp.com",
projectId: "heyli-9e3e9",
storageBucket: "heyli-9e3e9.appspot.com",
messagingSenderId: "618243614367",
appId: "1:618243614367:web:2b50c7d0443900c06164aa",
measurementId: "G-VM15H8CJ2S"
};
firebase.initializeApp(firebaseConfig);
window.onload = function () {
    render();
};
function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
};
  @if(Session::has('success'))
    toastr.success("{{ session('success') }}");
    @endif
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
    @if(Session::has('error'))
    toastr.error("{{ session('error') }}");
@endif
  
  function send_otp(){
    var mobile = $("#mobile").val();
    if(mobile.length == 10){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
        });
        $.ajax({
            type:"POST",
            url:"{{ url('check_number_valid_login') }}",
            data: ({mobile : mobile
            }), 
            success: function(response){
                if(response == 0){
                    toastr.error("It seems like you are not registered with us, please register with us');");
                  // setTimeout(function() {
                  //   window.location.replace("{{ url('login') }}");
                  // }, 2000);
                }else{
                  var valid_number = "+91"+mobile;
            $("#wait_btn").show();
            $("#send_otp_btn").hide();
            $("#resend_otp_btn").hide();
            $("#otp_var_btn").hide();
            firebase.auth().signInWithPhoneNumber(valid_number, window.recaptchaVerifier).then(function (confirmationResult) {
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        console.log(coderesult);
        toastr.success("Please check your phone, Otp sent");
        setTimeout(function() {
        $(".capture_for_mobile").hide();
        $("#otp_field").show();
        $("#wait_btn").hide();
        $("#otp_var_btn").show();
        }, 2000);
        setTimeout(function() {
        $(".capture_for_mobile").show();
        $("#resend_otp_btn").show();
        }, 30000);
    }).catch(function (error) {
        toastr.error(error.message);
        $("#wait_btn").hide();
        $("#send_otp_btn").show();
    });
                }
            }
        });
    }else{
      toastr.error("Phone number should be 10 digit");
        return false;
    }
  }
  // $("#send_otp_btn").click(function(){
    
   
  // });
  $("#otp_var_btn").click(function(){
    var otp1 = $("#otp1").val();
    var otp2 = $("#otp2").val();
    var otp3 = $("#otp3").val();
    var otp4 = $("#otp4").val();
    var otp5 = $("#otp5").val();
    var otp6 = $("#otp6").val();
    var otp = otp1+otp2+otp3+otp4+otp5+otp6; 
    if(otp == "" || otp.length != 6){
        Swal.fire({
          icon: 'error',
          title: "OTP fields required",
          confirmButtonText: 'Confirm'
          })
      return false;
    }else{
      $("#otp_var_btn").hide();
      $("#wait_btn").show();
      coderesult.confirm(otp).then(function (result) {
        var user = result.user;
        console.log(user);
        Swal.fire({
                icon: 'success',
                title: "Phone number verified",
                confirmButtonText: 'Confirm'
                })
        setTimeout(function() {
          $(".resend_sec_clsss").hide();
            $('#mobile').prop('readonly', true);
            $(".capture_for_mobile").hide();
            $("#resend_otp_btn").hide();
            $('#mobile_field').hide();
            $("#wait_btn").hide();
            $("#otp_field").hide();
            $("#pin_field").show();
            $("#validbtn").show();
            $("#submit_btn").show();
        }, 2000);
    }).catch(function (error) {
        toastr.error(error.message);
        $("#wait_btn").hide();
        $("#otp_var_btn").show();
    });
    }
  });
  var maxValue = 9999999999;
document.querySelector("#mobile")
.addEventListener("keypress", function(e) {
e.preventDefault();
console.log(e.key);
var ph = $("#mobile").val();
if(ph.length < 9){
    $("#phone_number_error").show();
}else{
    $("#phone_number_error").hide();
}
var input = e.target;
var value = Number(input.value);
var key = Number(e.key);
if (Number.isInteger(key)) {
  value = Number("" + value + key);
  if (value > maxValue) {
    return false;
  }
  input.value = value;
}
});
document.querySelector("#pin")
.addEventListener("keypress", function(e) {
e.preventDefault();
console.log(e.key);
var ph = $("#pin").val();
if(ph.length < 3){
    $("#loginpin_error").show();
}else{
    $("#loginpin_error").hide();
}
var input = e.target;
var value = Number(input.value);
var key = Number(e.key);
if (Number.isInteger(key)) {
  value = Number("" + value + key);
  if (value > 9999) {
    return false;
  }
  input.value = value;
}
});
@if(Session::has('not_active_user_error'))
  Swal.fire({
    imageUrl: "{{ asset('rg.png') }}",
      title: 'Thanks For Registration',
      text: 'Thank You for registering with us.Your request is under verification process. Please stay in touch with us.8639832611',
      confirmButtonText: 'Confirm'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "{{ url('loginwithpin') }}";
      }
    })
  @endif
  $("#tpin_eye").click(function(){
        var x = document.getElementById("pin");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });
@endif
</script>