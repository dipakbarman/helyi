
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Helyi</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo/favicon.png') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/709a39a23a.js" crossorigin="anonymous"></script>
    
</head>


<body>

    <header>
        <div class="topSection">
            <div class="container">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" />
                    </a>
                </div>

                <a href="javascript:void(0)" class="menuIcon"></a>
                <nav id="nav">
                    <a href="javascript:void(0)" class="icon-remove closeBtn"></a>
                    <ul>
                        <!--<li><a href="index.php">Home</a></li>-->
                        
                        <li><a href="{{ url('bill_payment') }}"> Bill payments </a></li>
                        <li><a href="{{ url('business') }}"> Business </a></li>
                        <!--<li><a href="partner.php">Channel Partner</a></li>-->
                        <li class="about-li">
                            <a href="javascript:void(0)">Channel Partner&nbsp;&nbsp; <i class="fas fa-caret-down"></i></a> <i class="icon-angle-down"></i>
                            <div class="menu-box-customer">
                                <div class="layout-wrap-about">
                                    <div class="trangle"></div>
                                    <ul class="menu-ul-about">
                                        <li><a href="{{ url('retailer') }}">Retailer</a></li>
                                        <li><a href="{{ url('distributor') }}">Distributor</a></li>
                                        <li><a href="{{ url('masterdistributor') }}">Master Distributor</a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!--<li><a href="About.php"> About us </a></li>-->
                        <li><a href="{{ url('contact') }}">Contact Us</a></li>
                        <!-- <li>
                            <a href="javascript:void(0)">
                                <img src="assets/images/phoneIcon.svg" class="phoneIcon" /> +91 91 88 54 54 54
                            </a>
                        </li> -->
                        <li class="sign-btn"><span><a href="#" data-toggle="modal" data-target="#loginmodal"> Log in/Register </a> </span></li>
                        <li class="register-btn text-white" style="background:#F38844;"><a href="#" style="background:#F38844;"  data-toggle="modal"  data-target="#signUp"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Get the app</a></li>
                        
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    

