@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Base Price
            </h4>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form action="{{ url('set_plan_base_price_form') }}" method="post" onsubmit="validbtn()">
                            @csrf
                            @php
                                $chek_is_null = DB::table('commition_base_price')->count();
                            @endphp
                            @if ($chek_is_null > 0)
                            <div class="form-group">
                                @foreach ($base_table as $list)
                                <input type="hidden" name="option_id[]" value="{{$list->option_id}}">
                                <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="">{{ get_payment_methods($list->option_id) }} percentage (%)</label>
                                    <input type="text" value="{{$list->percentage}}" name="percentage[]" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">{{ get_payment_methods($list->option_id) }} flat (Rs.)</label>
                                    <input type="text" value="{{$list->base_price}}" name="base_price[]" required class="form-control">
                                </div>
                                </div>
                                @endforeach
                                <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                                <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                            </div>
                            @else
                            <div class="form-group">
                                @foreach ($payment_options as $list)
                                @if($list->id != 10)
                                <input type="hidden" name="option_id[]" value="{{$list->id}}">
                                <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="">{{ $list->option_name }} percentage (%)</label>
                                    <input type="text" name="percentage[]" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">{{ $list->option_name }} flat (Rs.)</label>
                                    <input type="text" name="base_price[]" required class="form-control">
                                </div>
                                </div>
                                @endif
                                @endforeach
                                <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                                <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection