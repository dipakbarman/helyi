<!DOCTYPE html>
{{-- Development By Essane infotech --}}
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="helyi, Powerful management dashboard">
    <meta name="keywords" content="helyi, Powerful management dashboard">
    <meta name="author" content="">
    <title> Helyi @if(session()->get('type') == 0) Admin  @endif @if(session()->get('type') == 1) Merchant   @endif  Dashboard</title>
    <link rel="apple-touch-icon" href="{{ asset('fav.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('fav.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Vendor CSS-->
    
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css" integrity="sha512-OtwMKauYE8gmoXusoKzA/wzQoh7WThXJcJVkA29fHP58hBF7osfY0WLCIZbwkeL9OgRCxtAfy17Pn3mndQ4PZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    @include('backend.css')
    @include('backend.responsive')
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    @if(session()->get('type') != 0)
    <input type="hidden" id="rez_name" value="{{ get_user_name(session()->get('userid'))}}">
    <input type="hidden" id="rez_email" value="{{ get_user_emailid(session()->get('userid'))}}">
    <input type="hidden" id="rez_phone" value="{{ get_user_number(session()->get('userid'))}}">
    @endif
    <input type="hidden" name="" id="rezkeyy_id" value="{{ get_rez_key() }}">
    
    @if(session()->get('type') == 0)
    @include('backend.admin.headermenu')
    @endif
    @if(session()->get('type') == 1)
    @include('backend.shop.headermenu')
    @endif
    @if(session()->get('type') == 3)
    @include('backend.shop.headermenu')
    @endif
    @if(session()->get('type') == 4)
    @include('backend.shop.headermenu')
    @endif
    <ul class="main-search-list-defaultlist d-none">
      <li class="d-flex align-items-center"><a href="#">
          <h6 class="section-label mt-75 mb-0">Files</h6></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
          <div class="d-flex">
            <div class="me-75"><img src="{{ asset('app-assets/images/icons/xls.png') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
            </div>
          </div><small class="search-data-size me-50 text-muted">&apos;17kb</small></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
          <div class="d-flex">
            <div class="me-75"><img src="{{ asset('app-assets/images/icons/jpg.png') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
            </div>
          </div><small class="search-data-size me-50 text-muted">&apos;11kb</small></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
          <div class="d-flex">
            <div class="me-75"><img src="{{ asset('app-assets/images/icons/pdf.png') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
            </div>
          </div><small class="search-data-size me-50 text-muted">&apos;150kb</small></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
          <div class="d-flex">
            <div class="me-75"><img src="{{ asset('app-assets/images/icons/doc.png') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
            </div>
          </div><small class="search-data-size me-50 text-muted">&apos;256kb</small></a></li>
      <li class="d-flex align-items-center"><a href="#">
          <h6 class="section-label mt-75 mb-0">Members</h6></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
          <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-8.jpg') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
            </div>
          </div></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
          <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
            </div>
          </div></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
          <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-14.jpg') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
            </div>
          </div></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
          <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-6.jpg') }}" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
            </div>
          </div></a></li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
      <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
          <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div></a></li>
    </ul>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item me-auto">
            <a class="navbar-brand" @if(session()->get('type') == 0) href="{{ url('dashboard') }}" @else href="{{ url('utilitiesandpayments') }}" @endif >
              <img src="{{ asset('logo.png') }}" alt="">
            </a>
          </li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          @if(session()->get('type') == 0)
          @include('backend.admin.menu')
          @endif
          @if(session()->get('type') == 1)
          @include('backend.shop.menu')
          @endif
          @if(session()->get('type') == 3)
          @include('backend.shop.menu')
          @endif
          @if(session()->get('type') == 4)
          @include('backend.shop.menu')
          @endif
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"> </div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
  @yield('body')
  @if (session()->get('type') == 0)
    @include('backend.admin.models')
    @endif
    @if (session()->get('type') == 1)
    @include('backend.shop.models')
    @endif
    @if (session()->get('type') == 3)
    @include('backend.shop.models')
    @endif
    @if (session()->get('type') == 4)
    @include('backend.shop.models')
    @endif
</section>
<!-- Dashboard Ecommerce ends -->

        </div>
      </div>
    </div>
    <!-- END: Content-->
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
      <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT  &copy; 2021<a class="ms-25" href="#" target="_blank">Helyi</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Helyi & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/chart-chartjs.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/cards/card-statistics.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js" integrity="sha512-+ruHlyki4CepPr07VklkX/KM5NXdD16K1xVwSva5VqOVbsotyCQVKEwdQ1tAeo3UkHCXfSMtKU/mZpKjYqkxZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/tables/table-datatables-basic.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}"></script>
    <!-- END: Page JS-->

    <script>
      $(window).on('load',  function(){
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      })
      toastr.options = {
      "positionClass": "toast-bottom-left",
    }

    @if(Session::has('sw_success'))
    Swal.fire({
      icon: 'success',
      title: 'Transaction successful',
      confirmButtonText: 'Confirm'
    })
    @endif
    @if(!empty(session()->get('model_ac_no')))
    // $('#account_varificatoin_model').modal('show');			
    var idis = "{{session()->get('lastinser_id')}}";
    Swal.fire({
      title: 'Account Holder Name \n {{session::get('model_ac_no')}}',
      showDenyButton: true,
      showCancelButton: false,
      allowOutsideClick: false,
      confirmButtonText: 'Add',
      denyButtonText: `Cancel`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        add_varifyed_paye(idis);
      } else if (result.isDenied) {
        cancel_add_varifyed_paye(idis);
      }
    })
    @endif
    @if(Session::has('success'))
    Swal.fire({
      icon: 'success',
      title: "{{ session('success') }}",
      confirmButtonText: 'ok'
    })
    // toastr.success("{{ session('success') }}");
    @endif
    @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
    @endif
    @if(Session::has('error'))
    // toastr.error("{{ session('error') }}");
    Swal.fire({
      icon: 'error',
      title: "{{ session('error') }}",
      confirmButtonText: 'ok'
    })
    @endif
    @if(Session::has('payment_failed_error'))
        Swal.fire({
          icon: 'error',
          title: 'Payment failed',
          confirmButtonText: 'Try Again'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "{{ url('addmoney') }}";
          }
        })
      @endif
      @if(Session::has('payment_success_msg'))
      var total = {{ session('payment_success_msg') }};
        Swal.fire({
          icon: 'success',
          title: total+' Added to current wallet',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "{{ url('addmoney') }}";
          }
        })
      @endif
            // $('.datepicker').datepicker({
            //      format: 'dd-mm-yyyy',
            // });
            @if(Session::has('not_active_user_error'))
        Swal.fire({
          imageUrl: "{{ asset('rg.png') }}",
            title: 'Thanks For Registration',
            text: 'Thank You for registering with us.Your request is under verification process. Please stay in touch with us. 8639832611',
            confirmButtonText: 'Confirm',
          })
        @endif
        </script>
        @if (Request::url() == url('addnewnetwork') || Request::url() == url('admincreateuser'))
        @include('auth.jsscript')
        @endif
        @include('backend.sweetmsg')
        @include('backend.script')
        @if (session()->get('type') == 0)
        @include('backend.scriptadmin')
        @endif
        @if (session()->get('type') != 0)
        @include('backend.addmoneyscript')
        @endif
        <script>
            @if(isset($success_msg))
function msg(){

Swal.fire({
    icon: 'success',
    title: "link generated successfully",
    confirmButtonText: 'Confirm'
    })
}
msg();
@endif
</script>
  </body>
  <!-- END: Body-->

  {{-- Development By Essane infotech --}}
</html>