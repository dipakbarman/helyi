@extends('backend.master')
@section('body')
@php
    $type = "";
    $name = "";
    if(isset($q)){
        $type = $q->type; 
        if($q->type == 1){
            $name = "Razorpay";
        }
        if($q->type == 2){
            $name = "Cashfree";
        }
    }
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Active Payment gateway
            </h4>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="alert alert-warning mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body d-flex align-items-center">
                          <span>Current Active- <span> {{ $name }} </span></span>
                        </div>
                      </div>
                    <form action="{{url('paymentgetwaysettings_form')}}" method="post" onsubmit="validbtn()">
                        @csrf
                        <div class="mb-2">
                            <label for="">Select Active Payment getway</label>
                            <select name="type" id="" class="form-control form-select" required>
                                <option @if ($type == 1) selected @endif value="1">Razorpay</option>
                                <option @if ($type == 2) selected @endif value="2">Cashfree</option>
                            </select>
                        </div>
                        <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                    </form>     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection