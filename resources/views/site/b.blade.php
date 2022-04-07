@include('site/header')
<!--<div class="container mb-5">-->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--            <div class="card" style="margin-top:15%;">-->
<!--                <div class="card-body">-->
<!--                    <h2 class="text-dark text-center">Services We Provide</h2>-->
<!--                    <p class="text-center">Provides Recharge Portal & White Lable, Master Distributor, Distributor, Retailer, Api User.</p>-->
<!--                </div>-->
               
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<section class="homeBanNext2 whtBg" style="margin-top:7%;">
    <div class="container">
        <h2 class="text-center mb-2">Services We Provide</h2>
         <p class="text-center" style="font-size:12px;">Provides Recharge Portal & White Lable, Master Distributor, Distributor, Retailer, Api User.</p>
        <ul class="row boxes2Main">
            <li class="col-lg-4 col-md-4 col-sm-6">
                <a href="/Home/Rental_payments" class="boxes2">
                    <h3>
                        <p>Aadhar Pay</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/aadharpay.svg') }}"/> </div>
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-6">
                <a href="/Home/Bill_payments" class="boxes2">
                    <h3>
                        <p>AEPS</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/aeps.svg') }}" /> </div>
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-6">
                <a href="/Home/Utility_bill_payments" class="boxes2">
                    <h3>
                        <p>Money Transfer</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/money transfer.svg') }}" /> </div>
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p>CMS</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/cms.svg') }}" /> </div>
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p>Bank</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/bank.svg') }}" /> </div>
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p>Broadband</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/Boardband.svg') }}" /> </div>
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p>Data Card Prepaid</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/Data_card_prepaid.svg') }}" /> </div>
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p>Data Card Postpaid</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/Data_card_postpaid.svg') }}" /> </div>
                </a>
            </li>
             <li class="col-lg-4 col-md-4 col-sm-">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p>Recharge</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/recharge.svg') }}" /> </div>
                </a>
            </li>
             <li class="col-lg-4 col-md-4 col-sm-">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p>Pan Card</p>
                    </h3>
                    <div class="boxes2Img"> <img src="{{ asset('assets/icons assets/pancard.svg') }}" /> </div>
                </a>
            </li>
            
        </ul>
    </div>
</section>
@include('site/footer')