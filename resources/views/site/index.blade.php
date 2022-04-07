@include('site/header')
<style>
/*.testim {*/
/*		width: 100%;*/
/*		position: absolute;*/
/*		top: 50%;*/
/*		-webkit-transform: translatey(-50%);*/
/*		-moz-transform: translatey(-50%);*/
/*		-ms-transform: translatey(-50%);*/
/*		-o-transform: translatey(-50%);*/
/*		transform: translatey(-50%);*/
/*}*/

.testim .wrap {
    position: relative;
    width: 100%;
    max-width: 1020px;
    padding: 40px 20px;
    margin: auto;
}

.testim .arrow {
    display: block;
    position: absolute;
    color: #333;
    cursor: pointer;
    font-size: 2em;
    top: 50%;
    -webkit-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		-moz-transform: translateY(-50%);
		-o-transform: translateY(-50%);
		transform: translateY(-50%);
    -webkit-transition: all .3s ease-in-out;    
    -ms-transition: all .3s ease-in-out;    
    -moz-transition: all .3s ease-in-out;    
    -o-transition: all .3s ease-in-out;    
    transition: all .3s ease-in-out;
    padding: 5px;
    z-index: 99;
}

.testim .arrow:before {
		cursor: pointer;
}

.testim .arrow:hover {
    color: green;
}
    

.testim .arrow.left {
    left: 70px;
}

.testim .arrow.right {
    right: 70px;
}

.testim .dots {
    text-align: center;
    position: absolute;
    width: 100%;
    bottom: 60px;
    left: 0;
    display: block;
    z-index: 3333;
		height: 12px;
}

.testim .dots .dot {
    list-style-type: none;
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 1px solid green;
    margin: 0 10px;
    cursor: pointer;
    -webkit-transition: all .5s ease-in-out;    
    -ms-transition: all .5s ease-in-out;    
    -moz-transition: all .5s ease-in-out;    
    -o-transition: all .5s ease-in-out;    
    transition: all .5s ease-in-out;
		position: relative;
}

.testim .dots .dot.active,
.testim .dots .dot:hover {
    background: green;
    border-color: green;
}

.testim .dots .dot.active {
    -webkit-animation: testim-scale .5s ease-in-out forwards;   
    -moz-animation: testim-scale .5s ease-in-out forwards;   
    -ms-animation: testim-scale .5s ease-in-out forwards;   
    -o-animation: testim-scale .5s ease-in-out forwards;   
    animation: testim-scale .5s ease-in-out forwards;   
}
    
.testim .cont {
    position: relative;
		overflow: hidden;
}

.testim .cont > div {
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
    padding: 0 0 70px 0;
    opacity: 0;
}

.testim .cont > div.inactive {
    opacity: 1;
}
    

.testim .cont > div.active {
    position: relative;
    opacity: 1;
}
    

.testim .cont div .img img {
    display: block;
    width: 100px;
    height: 100px;
    margin: auto;
    border-radius: 50%;
}

.testim .cont div h2 {
    color: green;
    font-size: 1em;
    margin: 15px 0;
}

.testim .cont div p {
    font-size: 1.15em;
    color: #333;
    width: 70%;
    margin: auto;
}

.testim .cont div.active .img img {
    -webkit-animation: testim-show .5s ease-in-out forwards;            
    -moz-animation: testim-show .5s ease-in-out forwards;            
    -ms-animation: testim-show .5s ease-in-out forwards;            
    -o-animation: testim-show .5s ease-in-out forwards;            
    animation: testim-show .5s ease-in-out forwards;            
}

.testim .cont div.active h2 {
    -webkit-animation: testim-content-in .4s ease-in-out forwards;    
    -moz-animation: testim-content-in .4s ease-in-out forwards;    
    -ms-animation: testim-content-in .4s ease-in-out forwards;    
    -o-animation: testim-content-in .4s ease-in-out forwards;    
    animation: testim-content-in .4s ease-in-out forwards;    
}

.testim .cont div.active p {
    -webkit-animation: testim-content-in .5s ease-in-out forwards;    
    -moz-animation: testim-content-in .5s ease-in-out forwards;    
    -ms-animation: testim-content-in .5s ease-in-out forwards;    
    -o-animation: testim-content-in .5s ease-in-out forwards;    
    animation: testim-content-in .5s ease-in-out forwards;    
}

.testim .cont div.inactive .img img {
    -webkit-animation: testim-hide .5s ease-in-out forwards;            
    -moz-animation: testim-hide .5s ease-in-out forwards;            
    -ms-animation: testim-hide .5s ease-in-out forwards;            
    -o-animation: testim-hide .5s ease-in-out forwards;            
    animation: testim-hide .5s ease-in-out forwards;            
}

.testim .cont div.inactive h2 {
    -webkit-animation: testim-content-out .4s ease-in-out forwards;        
    -moz-animation: testim-content-out .4s ease-in-out forwards;        
    -ms-animation: testim-content-out .4s ease-in-out forwards;        
    -o-animation: testim-content-out .4s ease-in-out forwards;        
    animation: testim-content-out .4s ease-in-out forwards;        
}

.testim .cont div.inactive p {
    -webkit-animation: testim-content-out .5s ease-in-out forwards;    
    -moz-animation: testim-content-out .5s ease-in-out forwards;    
    -ms-animation: testim-content-out .5s ease-in-out forwards;    
    -o-animation: testim-content-out .5s ease-in-out forwards;    
    animation: testim-content-out .5s ease-in-out forwards;    
}

@-webkit-keyframes testim-scale {
    0% {
        -webkit-box-shadow: 0px 0px 0px 0px #eee;
        box-shadow: 0px 0px 0px 0px #eee;
    }

    35% {
        -webkit-box-shadow: 0px 0px 10px 5px #eee;        
        box-shadow: 0px 0px 10px 5px #eee;        
    }

    70% {
        -webkit-box-shadow: 0px 0px 10px 5px #ea830e;        
        box-shadow: 0px 0px 10px 5px #ea830e;        
    }

    100% {
        -webkit-box-shadow: 0px 0px 0px 0px #ea830e;        
        box-shadow: 0px 0px 0px 0px #ea830e;        
    }
}

@-moz-keyframes testim-scale {
    0% {
        -moz-box-shadow: 0px 0px 0px 0px #eee;
        box-shadow: 0px 0px 0px 0px #eee;
    }

    35% {
        -moz-box-shadow: 0px 0px 10px 5px #eee;        
        box-shadow: 0px 0px 10px 5px #eee;        
    }

    70% {
        -moz-box-shadow: 0px 0px 10px 5px #ea830e;        
        box-shadow: 0px 0px 10px 5px #ea830e;        
    }

    100% {
        -moz-box-shadow: 0px 0px 0px 0px #ea830e;        
        box-shadow: 0px 0px 0px 0px #ea830e;        
    }
}

@-ms-keyframes testim-scale {
    0% {
        -ms-box-shadow: 0px 0px 0px 0px #eee;
        box-shadow: 0px 0px 0px 0px #eee;
    }

    35% {
        -ms-box-shadow: 0px 0px 10px 5px #eee;        
        box-shadow: 0px 0px 10px 5px #eee;        
    }

    70% {
        -ms-box-shadow: 0px 0px 10px 5px #ea830e;        
        box-shadow: 0px 0px 10px 5px #ea830e;        
    }

    100% {
        -ms-box-shadow: 0px 0px 0px 0px #ea830e;        
        box-shadow: 0px 0px 0px 0px #ea830e;        
    }
}

@-o-keyframes testim-scale {
    0% {
        -o-box-shadow: 0px 0px 0px 0px #eee;
        box-shadow: 0px 0px 0px 0px #eee;
    }

    35% {
        -o-box-shadow: 0px 0px 10px 5px #eee;        
        box-shadow: 0px 0px 10px 5px #eee;        
    }

    70% {
        -o-box-shadow: 0px 0px 10px 5px #ea830e;        
        box-shadow: 0px 0px 10px 5px #ea830e;        
    }

    100% {
        -o-box-shadow: 0px 0px 0px 0px #ea830e;        
        box-shadow: 0px 0px 0px 0px #ea830e;        
    }
}

@keyframes testim-scale {
    0% {
        box-shadow: 0px 0px 0px 0px #eee;
    }

    35% {
        box-shadow: 0px 0px 10px 5px #eee;        
    }

    70% {
        box-shadow: 0px 0px 10px 5px #ea830e;        
    }

    100% {
        box-shadow: 0px 0px 0px 0px #ea830e;        
    }
}

@-webkit-keyframes testim-content-in {
    from {
        opacity: 0;
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
    }
    
    to {
        opacity: 1;
        -webkit-transform: translateY(0);        
        transform: translateY(0);        
    }
}

@-moz-keyframes testim-content-in {
    from {
        opacity: 0;
        -moz-transform: translateY(100%);
        transform: translateY(100%);
    }
    
    to {
        opacity: 1;
        -moz-transform: translateY(0);        
        transform: translateY(0);        
    }
}

@-ms-keyframes testim-content-in {
    from {
        opacity: 0;
        -ms-transform: translateY(100%);
        transform: translateY(100%);
    }
    
    to {
        opacity: 1;
        -ms-transform: translateY(0);        
        transform: translateY(0);        
    }
}

@-o-keyframes testim-content-in {
    from {
        opacity: 0;
        -o-transform: translateY(100%);
        transform: translateY(100%);
    }
    
    to {
        opacity: 1;
        -o-transform: translateY(0);        
        transform: translateY(0);        
    }
}

@keyframes testim-content-in {
    from {
        opacity: 0;
        transform: translateY(100%);
    }
    
    to {
        opacity: 1;
        transform: translateY(0);        
    }
}

@-webkit-keyframes testim-content-out {
    from {
        opacity: 1;
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }
    
    to {
        opacity: 0;
        -webkit-transform: translateY(-100%);        
        transform: translateY(-100%);        
    }
}

@-moz-keyframes testim-content-out {
    from {
        opacity: 1;
        -moz-transform: translateY(0);
        transform: translateY(0);
    }
    
    to {
        opacity: 0;
        -moz-transform: translateY(-100%);        
        transform: translateY(-100%);        
    }
}

@-ms-keyframes testim-content-out {
    from {
        opacity: 1;
        -ms-transform: translateY(0);
        transform: translateY(0);
    }
    
    to {
        opacity: 0;
        -ms-transform: translateY(-100%);        
        transform: translateY(-100%);        
    }
}

@-o-keyframes testim-content-out {
    from {
        opacity: 1;
        -o-transform: translateY(0);
        transform: translateY(0);
    }
    
    to {
        opacity: 0;
        transform: translateY(-100%);        
        transform: translateY(-100%);        
    }
}

@keyframes testim-content-out {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    
    to {
        opacity: 0;
        transform: translateY(-100%);        
    }
}

@-webkit-keyframes testim-show {
    from {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    
    to {
        opacity: 1;
        -webkit-transform: scale(1);       
        transform: scale(1);       
    }
}

@-moz-keyframes testim-show {
    from {
        opacity: 0;
        -moz-transform: scale(0);
        transform: scale(0);
    }
    
    to {
        opacity: 1;
        -moz-transform: scale(1);       
        transform: scale(1);       
    }
}

@-ms-keyframes testim-show {
    from {
        opacity: 0;
        -ms-transform: scale(0);
        transform: scale(0);
    }
    
    to {
        opacity: 1;
        -ms-transform: scale(1);       
        transform: scale(1);       
    }
}

@-o-keyframes testim-show {
    from {
        opacity: 0;
        -o-transform: scale(0);
        transform: scale(0);
    }
    
    to {
        opacity: 1;
        -o-transform: scale(1);       
        transform: scale(1);       
    }
}

@keyframes testim-show {
    from {
        opacity: 0;
        transform: scale(0);
    }
    
    to {
        opacity: 1;
        transform: scale(1);       
    }
}

@-webkit-keyframes testim-hide {
    from {
        opacity: 1;
        -webkit-transform: scale(1);       
        transform: scale(1);       
    }
    
    to {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
}

@-moz-keyframes testim-hide {
    from {
        opacity: 1;
        -moz-transform: scale(1);       
        transform: scale(1);       
    }
    
    to {
        opacity: 0;
        -moz-transform: scale(0);
        transform: scale(0);
    }
}

@-ms-keyframes testim-hide {
    from {
        opacity: 1;
        -ms-transform: scale(1);       
        transform: scale(1);       
    }
    
    to {
        opacity: 0;
        -ms-transform: scale(0);
        transform: scale(0);
    }
}

@-o-keyframes testim-hide {
    from {
        opacity: 1;
        -o-transform: scale(1);       
        transform: scale(1);       
    }
    
    to {
        opacity: 0;
        -o-transform: scale(0);
        transform: scale(0);
    }
}

@keyframes testim-hide {
    from {
        opacity: 1;
        transform: scale(1);       
    }
    
    to {
        opacity: 0;
        transform: scale(0);
    }
}

@media all and (max-width: 300px) {
	body {
		font-size: 14px;
	}
}

@media all and (max-width: 500px) {
	.testim .arrow {
		font-size: 1.5em;
	}
	
	.testim .cont div p {
		line-height: 25px;
	}

}
</style>
<section>
    <div class="homeBanner">
        <div class="container">
            <div class="homeBanLeft">
                <h2 style="font-size:40px;">
                    <div class="FL">Pay&nbsp;</div>
                    <div id="content-1">Business Services </div>
                    <div id="content-2">Contractors </div>
                    <div id="content-3">Employees </div>
                    <div id="content-4">Freelancers </div>
                    <div id="content-1">Home Supplies</div>
                    <div id="content-2">Legal Services</div>
                    <div id="content-3">Office Supplies</div>
                    <div id="content-4">Rent Lease</div>
                    <div id="content-1">Taxes</div>
                    <div id="content-2">Tution Fees</div>
                </h2><br>
                <p>Join the Fastest growing community of <span style="color:#82b53f;">Helyi</span> users</p>
                <p>Be Part of HELYI Users and Pay your Rental, Bill Payments and to your suppliers with your Credit Card at very nominal Fee and earn cash backs and rewards on your payments.</p>
                <button type="button" class="btn btnGet" data-v-115eca61="" style="position: static; background:#F38844">Get Started</button>
            </div>
            <div class="homeBanRight" style="margin-top:18%;">
                <img src="{{ url('assets/rana/1.png') }}" id="img_service" width="440px">
            </div>
            
            <div class="clear"></div>
        </div>
    </div>
</section>


<section class="threeSteps">
    <div class="container">
       <h2 style="font-size:40px;">
            3 simple steps<br>
            to pay your Rental & Bill Payments with Helyi
        </h2>
        <ul class="row box3Steps">
            <li class="col-lg-4 col-md-6 col-sm-12">
                <div class="box3StepsInn">
                    <div class="steps3Box"> <img src="{{ asset('assets/rana/h1.jpg') }}" /> </div>
                    <h5 style="color:#83b641;">Sign up</h5>
                    <p>Create a Helyi account</p>
                </div>
            </li>
            <li class="col-lg-4 col-md-6 col-sm-12">
                <div class="box3StepsInn">
                    <div class="steps3Box"> <img src="{{ asset('assets/rana/h3.jpg') }}" /> </div>
                    <h5 style="color:#83b641;">Add Biller / Payee</h5>
                    <p>Add your biller (or) Land Lord Bank account details</p>
                </div>
            </li>
            <li class="col-lg-4 col-md-6 col-sm-12">
                <div class="box3StepsInn">
                    <div class="steps3Box"> <img src="{{ asset('assets/rana/h2.jpg') }}" /> </div>
                    <h5 style="color:#83b641;">Pay & Amount Credited</h5>
                    <p>Pay your expenses with card and your beneficiary gets money instantly</p>
                </div>
            </li>
            <li class="col-lg-12 text-center">
                <button type="button" class="btn btnGet" data-v-115eca61="" style="position: static; background:#f38844;">Get Started</button>
            </li>
        </ul>
    </div>
</section>

<section class="homeBanNext2 whtBg">
    <div class="container">
        <h2 class="text-center" style="font-size:40px;">Why Heyli</h2>
        <ul class="row boxes2Main">
            <li class="col-lg-4 col-md-4 col-sm-12">
                <a href="/Home/Rental_payments" class="boxes2">
                    <h3>
                        <p style="font-size:30px;color:#82b53f;" class="mb-2"><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<span>10M</span><span style="color:#f38844">+</span></p>
                        <p style="font-size:14px;">Processed Transactions</p>
                    </h3>
                    <!--<div class="boxes2Img"> <img src="assets/images/1-pay-rental-payments.png" /> </div>-->
                </a>
            </li>
            <li class="col-lg-4 col-md-4 col-sm-12">
                <a href="/Home/Bill_payments" class="boxes2">
                    <h3>
                        <p style="font-size:30px;color:#82b53f;" class="mb-2"><span>8</span><span style="color:#f38844">+</span></p>
                        <p style="font-size:14px;">Years of Experience</p>
                    </h3>
                    <!--<div class="boxes2Img"> <img src="assets/images/2-pay-bill-payments.png" /> </div>-->
                </a>
            </li>
            
            <li class="col-lg-4 col-md-4 col-sm-12">
                <a href="/Home/Business" class="boxes2">
                    <h3>
                        <p style="font-size:30px;color:#82b53f;" class="mb-2"><span>10K</span><span style="color:#f38844">+</span></p>
                        <p style="font-size:14px;">Family of Helyi Users</p>
                    </h3>
                    <!--<div class="boxes2Img"> <img src="assets/images/4-pay-business-payments.png" /> </div>-->
                </a>
            </li>
        </ul>
    </div>
</section>


<section id="testim" class="testim">
        <h2 class="text-center" style="font-size:40px;">What Our Client Say ?</h2>
         <div class="testim-cover">
            <div class="wrap">
                @php
                $review_q = DB::table('review')->get();
                @endphp
                <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                <ul id="testim-dots" class="dots">
                @foreach ($review_q as $list)
                <li class="dot @if($list->id == 1) active @endif">
                @endforeach
                </ul>
                <div id="testim-content" class="cont">
            
                    @foreach ($review_q as $list)
                    <div class="@if($list->id == 1) active @endif">
                        <div class="img"><img src="{{ url('storage/app/'.$list->pic) }}" alt=""></div>
                        <h2>{{$list->name}}</h2>
                        <p>{{$list->dsc}}</p>                    
                    </div>
                    @endforeach
                </div>

            </div>
         </div>
    </section>

<section class="homeBanNext">
    <div class="container">
        <p class="max600"><strong>We accept all major credit and debit cards</strong></p>
        <div class="clientLogos">
            <div class="gradBox gradLeft"></div>
            <div class="gradBox gradRight"></div>
            <div class="clientLogosBox">
                <div class=""><img class="news-item" src="{{ asset('assets/images/weblogo1.png') }}" /> </div>
            </div>
        </div>
    </div>
</section>
<!--<script src="https://use.fontawesome.com/1744f3f671.js"></script>-->
@include('site/footer')
<script>
    // vars
'use strict'
var	testim = document.getElementById("testim"),
		testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
    testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
    testimLeftArrow = document.getElementById("left-arrow"),
    testimRightArrow = document.getElementById("right-arrow"),
    testimSpeed = 4500,
    currentSlide = 0,
    currentActive = 0,
    testimTimer,
		touchStartPos,
		touchEndPos,
		touchPosDiff,
		ignoreTouch = 30;
;

window.onload = function() {

    // Testim Script
    function playSlide(slide) {
        for (var k = 0; k < testimDots.length; k++) {
            testimContent[k].classList.remove("active");
            testimContent[k].classList.remove("inactive");
            testimDots[k].classList.remove("active");
        }

        if (slide < 0) {
            slide = currentSlide = testimContent.length-1;
        }

        if (slide > testimContent.length - 1) {
            slide = currentSlide = 0;
        }

        if (currentActive != currentSlide) {
            testimContent[currentActive].classList.add("inactive");            
        }
        testimContent[slide].classList.add("active");
        testimDots[slide].classList.add("active");

        currentActive = currentSlide;
    
        clearTimeout(testimTimer);
        testimTimer = setTimeout(function() {
            playSlide(currentSlide += 1);
        }, testimSpeed)
    }

    testimLeftArrow.addEventListener("click", function() {
        playSlide(currentSlide -= 1);
    })

    testimRightArrow.addEventListener("click", function() {
        playSlide(currentSlide += 1);
    })    

    for (var l = 0; l < testimDots.length; l++) {
        testimDots[l].addEventListener("click", function() {
            playSlide(currentSlide = testimDots.indexOf(this));
        })
    }

    playSlide(currentSlide);

    // keyboard shortcuts
    document.addEventListener("keyup", function(e) {
        switch (e.keyCode) {
            case 37:
                testimLeftArrow.click();
                break;
                
            case 39:
                testimRightArrow.click();
                break;

            case 39:
                testimRightArrow.click();
                break;

            default:
                break;
        }
    })
		
		testim.addEventListener("touchstart", function(e) {
				touchStartPos = e.changedTouches[0].clientX;
		})
	
		testim.addEventListener("touchend", function(e) {
				touchEndPos = e.changedTouches[0].clientX;
			
				touchPosDiff = touchStartPos - touchEndPos;
			
				console.log(touchPosDiff);
				console.log(touchStartPos);	
				console.log(touchEndPos);	

			
				if (touchPosDiff > 0 + ignoreTouch) {
						testimLeftArrow.click();
				} else if (touchPosDiff < 0 - ignoreTouch) {
						testimRightArrow.click();
				} else {
					return;
				}
			
		})
}
</script>






