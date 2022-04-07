@extends('backend.master')
@section('body')
<style>
    .c_css_style h5{
        margin-bottom: 12px;
    }
    .c_css_style h5.float-right {
        font-weight: 800;
        font-size: 16px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title"><a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a></h4>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{ url('pay_submit_form') }}" id="pay_submit_form" method="post" onsubmit="validbtn()">
                        @csrf
                    <div class="row c_css_style">
                        <div class="col-md-12">
                            <h2 style="font-weight: 600;" class="text-center text-success text-bold ">Confirmation</h2>
                            <p class="text-center mb-3" >Please ensure all details are correct</p>
                        </div>
                        <input type="hidden" name="sender_name" value="{{$sender_name}}">
                        <input type="hidden" name="amount" value="{{$amount}}">
                        <input type="hidden" name="bankid" value="{{$bankid}}">
                        <input type="hidden" name="acno" value="{{$acno}}">
                        <input type="hidden" name="bank_name" value="{{$bank_name}}">
                        <input type="hidden" name="to" value="{{$to}}">
                        <input type="hidden" name="ifsc" value="{{$ifsc}}">
                        <input type="hidden" name="type" value="{{$type}}">
                        <input type="hidden" name="fee" id="fee" value="{{$fee}}">
                        <input type="hidden" name="remark" value="{{$remark}}">
                        <input type="hidden" name="purpose" value="{{$purpose}}">
                        <input type="hidden" name="gatway_type" value="{{$gatway_type}}">
                        <div class="col-md-6">
                            <h5 class="float-right">Amount</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>Rs : {{ $amount }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Fee</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>Rs : {{ $fee }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">From</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{get_user_name(session()->get('userid'))}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Sender Name</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $sender_name }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">To</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{$to}}</h5> 
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Bank Name</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $bank_name }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Account Number</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{$acno}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">IFSC Code</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{$ifsc}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Transaction type</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ get_pay_type($type) }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Remark</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{$remark}}</h5>
                        </div>
                        <div class="col-md-12">
                            <span style="font-weight: 600;font-size: 15px;" class="text-danger">*Transfer once confirmed, cannot be reversed. Review the details and click Confirm.</span>
                        </div>
                        <div class="col-md-12 mt-3" style="text-align: center">  
                            <button type="button" onclick="confirm_fee_model()" id="submit_btn" class="btn btn-success">Confirm</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </div>
                        <div class="col-md-12" style="padding-bottom: 80px;">

                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection