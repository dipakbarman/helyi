@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <h4 class="card-title">
                Select Payment gateway For Generate Payment Link
            </h4>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form action="{{ url('update_payment_link_option') }}" method="post" onsubmit="validbtn()">
                        @csrf
                        <div class="mb-2">
                            <input type="hidden" name="getway_id" value="{{ $getway_id }}">
                            <input type="text" readonly class="form-control" name="getway_name" value="{{ $getway_name }}">
                        </div>
                        <div class="p-1">
                            @foreach ($q as $item)
                            <div class="form-check form-check-success pb-4">
                            <input type="checkbox" class="form-check-input" name="option_select[]" value="{{$item->id}}"  id="optionid{{$item->id}}"
                            @if(check_alredy_option_exist_for_link($getway_id,$item->id) == 1)
                                disabled 
                             @else
                             @if(check_active_getway_option_for_link($getway_id,$item->id) == 1)
                              checked 
                             @endif
                             @endif
                             />
                            <label class="form-check-label" style="padding-left:5px;" for="optionid{{$item->id}}">{{ $item->option_name }}</label>
                            </div>
                            @endforeach
                            <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                            <button type="submit" id="submit_btn" class="btn btn-success">Submit</button> <a class="btn btn-danger" href="{{ url('select_payment_getway') }}">Cencel</a> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection