@extends('backend.master')
@section('body')
@php
  $text_line = "";
      $check = DB::table('mtext')->count(); 
      if ($check > 0) {
          $text_data = DB::table('mtext')->get(); 
          $text_line = $text_data[0]->text;
      }
  @endphp
<div class="row">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <h4 class="card-title">
                            Marquee text
                        </h4>
                        <form action="{{url('marquetext_form')}}" method="post" onsubmit="validbtn()">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="mb-1" for="">Text</label>
                                <input type="text" class="form-control" placeholder="Enter Text" name="text" value="{{$text_line}}">
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