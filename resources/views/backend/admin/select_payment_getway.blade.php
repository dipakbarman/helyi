@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Select Payment Gateway
            </h4>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form action="{{ url('select_payment_getway_form') }}" method="post" onsubmit="validbtn()">
                        @csrf
                        <div class="p-1">
                            <select name="payment_getway" id="" class="form-select form-control mb-2" required>
                                <option value="">Select</option>
                                @foreach ($q as $item)
                                    <option value="{{$item->id}}">{{$item->payment_getway_name}}</option>
                                @endforeach                
                            </select>
                            <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                            <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection