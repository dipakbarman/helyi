@extends('backend.master')
@section('body')
@php
    $gateway_key_q = DB::table('gateway_key')->get();
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Payment Gateway Key
            </h4>
            <form action="{{ url('payment_gateway_key_form') }}" method="post" onsubmit="validbtn()">
                @csrf
                <div class="row justify-content-center">
                    @if (!empty($gateway_key_q))
                    <div class="col-md-10">
                        @foreach ($gateway_key_q as $list)
                        <input type="hidden" value="{{$list->type}}" name="type[]">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h5>{{get_payment_gateway_name($list->type)}}</h5>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">App Key</label>
                                    <input type="text" class="form-control" name="appkey[]" required value="{{$list->appkey}}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Secret Key</label>
                                    <input type="text" class="form-control" name="secretkey[]" required value="{{$list->secretkey}}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">@if ($list->type == 1) Rezorpay Account Number @else Payout App Key @endif </label>
                                    <input type="text" class="form-control" name="payout_appkey[]" required value="{{$list->payout_appkey}}">
                                </div>
                                @if ($list->type != 1)
                                <div class="col-md-6 mb-2">
                                    <label for="">Payout Secret Key</label>
                                    <input type="text" class="form-control" name="payout_secretkey[]" required value="{{$list->payout_secretkey}}">
                                </div>
                                @endif
                                @if ($list->type == 1)
                                <input type="hidden" class="form-control" name="payout_secretkey[]" value="null">
                                @endif
                            </div>
                        @endforeach
                        <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                    </div> 
                    @else
                    <div class="col-md-10">
                    @foreach ($gateway as $list)
                    <input type="hidden" value="{{$list->id}}" name="type[]">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h5>{{$list->payment_getway_name}}</h5>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">App Key</label>
                                <input type="text" class="form-control" name="appkey[]" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Secret Key</label>
                                <input type="text" class="form-control" name="secretkey[]" required>
                            </div>
                            @if ($list->id != 1)
                            <div class="col-md-6 mb-2">
                                <label for="">Payout App Key</label>
                                <input type="text" class="form-control" name="payout_appkey[]" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Payout Secret Key</label>
                                <input type="text" class="form-control" name="payout_secretkey[]" required>
                            </div>
                            @endif
                            @if ($list->id == 1)
                            <input type="hidden" class="form-control" name="payout_appkey[]" value="null">
                            <input type="hidden" class="form-control" name="payout_secretkey[]" value="null">
                            @endif
                        </div>
                    @endforeach
                    <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                </div>                  
                @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection