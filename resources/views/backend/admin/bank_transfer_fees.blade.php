@extends('backend.master')
@section('body')
@php
    $active_type = "";
    $active_payout = DB::table('active_payout_type')->first();
    if(!empty($active_payout)){
        $active_type = $active_payout->type;
    }
@endphp
<form action="{{ url('bank_transfer_fees_form') }}" method="post" onsubmit="validbtn()">
    @csrf
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Bank Transfer Fee
            </h4>
            <div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
            @if ($count < 1)
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="">Active Payout</label>
                            <select name="active_payout" id="" class="form-select" required>
                                <option value="">Select gateway</option>
                                <option @if($active_type == 1) selected @endif value="1">Rezorpay</option>
                                <option @if($active_type == 2) selected @endif value="2">Cashfree</option>
                            </select>
                        </div>
                    </div>
                </div>
                @for ($i = 0; $i < 3; $i++)
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">From Price</label>
                                <input type="number" name="fromprice[]" value="" class="form-control" required>                            
                            </div>
                            <div class="col-md-4">
                                <label for="">To Price</label>
                                <input type="number" name="toprice[]" required value="" class="form-control" >                            
                            </div>
                            <div class="col-md-4">
                                <label for="">Tax</label>
                                <input type="number" name="tax[]" value="" required class="form-control" >                            
                            </div>
                        </div>
                    </div>
                    @endfor     
            </div>
            @else
            @php
                $q = DB::table('bankaccount_fees')->get();
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="">Active Payout</label>
                            <select name="active_payout" id="" class="form-select" required>
                                <option value="">Select gateway</option>
                                <option @if($active_type == 1) selected @endif value="1">Rezorpay</option>
                                <option @if($active_type == 2) selected @endif value="2">Cashfree</option>
                            </select>
                        </div>
                    </div>
                </div>
                @foreach ($q as $list)
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">From Price</label>
                                <input type="number" name="fromprice[]" value="{{$list->from_price}}" class="form-control" required>                            
                            </div>
                            <div class="col-md-4">
                                <label for="">To Price</label>
                                <input type="number" name="toprice[]" required value="{{$list->to_price}}" class="form-control" >                            
                            </div>
                            <div class="col-md-4">
                                <label for="">Tax</label>
                                <input type="number" name="tax[]" value="{{$list->tax}}" required class="form-control" >                            
                            </div>
                        </div>
                    </div>
                    @endforeach     
            </div>   
            @endif
</div>
</div>
            <div class="row">
                <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection