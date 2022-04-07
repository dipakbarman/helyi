@extends('backend.master')
@section('body')
@php
    $link = "";
    $image = "";
    $check = DB::table('offer_popup')->first();
    if(!empty($check)){
        $link = $check->link;
        $image = $check->image;
    }
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Offer Popup
            </h4>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{url('offerpopup_form')}}" method="post" enctype="multipart/form-data" onsubmit="validbtn()">
                        @csrf
                        <div class="form-group">
                            <label for="">Enter Link</label>
                            <input type="text" name="link" class="form-control" id="" value="{{$link}}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <br>
                            @if (!empty($image))
                                <div class="p-2">
                                <img src="{{ url('storage/app/'.$image) }}" height="auto" width="300px" alt="">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control" id="" @if(empty($image)) required @endif>
                        </div>
                        <div class="mt-2">
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