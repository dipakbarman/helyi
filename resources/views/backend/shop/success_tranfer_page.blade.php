@extends('backend.master')
@section('body')
@php
    $amount = "";
    $date = "";
    $time_is = "";
    $transferid = "";
    $uti = "";
    $referenceId = "";
    $from = "";
    $to_name = "";
    $to_account = "";
    $ifsc = "";
    $type = "";
    $remark = "";
    $id = "";
    $sender_name = "";
    $bank_name = "";
    $mobile_number = "";
    $status_text = "";
    $name = "";
    if(isset($q)){
    if($q->gatway_type == 1){
    $all_tranaction_data = rezorpay_paye_details($q->transferid);
        if(empty($all_tranaction_data['error']['description'])){
                $data  = array();
                if(!empty($all_tranaction_data['reference_id'])){
                    $data['referenceId'] = $all_tranaction_data['reference_id'];
                }
                if(!empty($all_tranaction_data['utr'])){
                    $data['uti'] = $all_tranaction_data['utr'];
                }
                if(!empty($all_tranaction_data['status'])){
                    if($all_tranaction_data['status'] == "processed"){
                        $data['status'] = 1;
                        $data['status_text'] = "Success";
                        $data['payee_action_proced'] = 1;
                    }
                    else{
                        $data['status'] = 0;
                        $data['payee_action_proced'] = 0;
                        $data['status_text'] = $all_tranaction_data['status'];
                    }
                }
                DB::table('payout')->where('id',$q->id)->update($data);
            }
        $q = DB::table('payout')->where('uid',session()->get('userid'))->where('id',$q->id)->first();
        }
        $bankq = DB::table('merchant_bank_accounts')->where('id',$q->bankid)->first();
        $amount = number_format($q->amount,0);
        $mobile_number = $bankq->mobile_number;
        if(!empty($bankq->varify_user_name)){
            $name = $bankq->varify_user_name;
        }else{
            $name = $bankq->name;
         }
        $from = get_user_name($q->uid);
        $to_name = $bankq->name;
        $to_account = $q->account_no;
        $ifsc = $q->ifsc;
        $type = get_pay_type($q->type);
        $remark = $q->remark;
        $id = $q->id;
        $sender_name = $q->sender_name;
        $bank_name = $q->bank_name;
        $date = $q->date;
        $transferid = $q->transferid;
        $referenceId = $q->referenceId;
        $uti = $q->uti;
        $time_is = $q->time_is;
        $status_text = $q->status_text;
    }
@endphp
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
            <h4 class="card-title">
                
            </h4>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row c_css_style">
                        <div class="col-md-12">
                            <h2 style="font-weight: 600;" class="text-center text-success text-bold ">Success!</h2>
                            <p class="text-center mb-3" >Your transfer has been processed.</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Sender Name</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $sender_name }}</h5> 
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Recipient Name</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $name }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Sender Mobile Number</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ get_user_number(session()->get('userid')) }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Bank Name</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{$bank_name}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Account No</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{$to_account}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Txn. Amount</h5>
                        </div>
                        <div class="col-md-6">
                            <h5> {{$amount}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Transaction Date</h5>
                        </div>
                        <div class="col-md-6">
                            <h5> {{$date}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Transaction Time</h5>
                        </div>
                        <div class="col-md-6">
                            <h5> {{$time_is}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Service Delivery Id</h5>
                        </div>
                        <div class="col-md-6">
                            <h5> {{$uti}}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="float-right">Status</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>{{$status_text}}</h5>
                        </div>
                        
                        <input type="hidden" id="tid" value="{{$id}}">
                        <div class="col-md-12" style="padding-bottom: 40px;">

                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2" style="text-align: center">
                    <a href="{{ url('utilitiesandpayments') }}" class="btn btn-success mx-1">Home</a>
                    <a href="{{ url('add_account') }}" class="btn btn-success mx-1">Continue</a>
                    <button type="button" onclick="copy_shear_text()" class="btn btn-success mx-1"> <span id="copy_btn">Share</span></button>
                    <button onclick="add_to_favorites_thistory()" id="favbtn" class="btn btn-success mx-1">Add to favorites</button>
                    <a target="_blank" href="{{ url('print_payout_response/'.$id) }}" class="btn btn-success mx-1">Print</a>
                    {{-- <a target="_blank" href="{{ url('print_pdf_payout_response/'.$id) }}" class="btn btn-success mx-1">Download PDF</a> --}}
                </div>
                <div class="col-md-12">
                    <textarea style="visibility:hidden" name="" id="shear_text" cols="60" rows="2">Sender Name : {{$sender_name}} &#13;&#10;Recipient Name : {{$name}} &#13;&#10;Sender Mobile Number : {{ get_user_number(session()->get('userid')) }} &#13;&#10;Bank Name : {{$bank_name}} &#13;&#10;Account No : {{$to_account}} &#13;&#10;Txn. Amount : {{$amount}} &#13;&#10;Transaction Date : {{$date}} &#13;&#10;Transaction Time : {{$time_is}} &#13;&#10;Service Delivery Id : {{$uti}} &#13;&#10;Status : {{$status_text}} &#13;&#10;</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function copy_shear_text(){
        /* Get the text field */
  var copyText = document.getElementById("shear_text");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    $("#copy_btn").html("Copied");
    alert("Copied the text: " + copyText.value);
    }
</script>
@endsection