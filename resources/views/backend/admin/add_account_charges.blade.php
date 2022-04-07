@extends('backend.master')
@section('body')
@php
  $amount = "";
      $check = DB::table('add_account_charges')->count(); 
      if ($check > 0) {
          $text_data = DB::table('add_account_charges')->first(); 
          $amount = $text_data->amount;
      }
  @endphp
<div class="row">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <h4 class="card-title">
                            Add account charges
                        </h4>
                        <form action="{{url('add_account_charges_form')}}" method="post" onsubmit="validbtn()">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="mb-1" for="">Amount</label>
                                <input type="number" class="form-control" placeholder="Enter amount" name="amount" value="{{$amount}}">
                            </div>
                            <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection