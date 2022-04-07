@extends('backend.master')
@section('body')
@php
  $t1_per = "";
  $t2_per = "";
  $t1_flat = "";
  $t2_flat = "";
  $pactive = "";
  $factive = "";
  $per_check = DB::table('topupoption')->where('type',1)->first();
  $flat_check = DB::table('topupoption')->where('type',2)->first();
  if(!empty($per_check)){
    $t1_per = $per_check->t1;
    $t2_per = $per_check->t2;
    $pactive = $per_check->active;
  }
  if(!empty($flat_check)){
    $t1_flat = $flat_check->t1;
    $t2_flat = $flat_check->t2;
    $factive = $flat_check->active; 
  }
@endphp

<div class="row">
    <div class="content-body">
        <section class="app-user-list">
            <div class="row">
                <div class="col-md-12">
                    <!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Create plan</h4>
          </div>
          <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="card-body">
                    <form class="form form-vertical" method="post" action="{{ url('topupoption_form') }}" onsubmit="validbtn()">
                      @csrf
                      <div class="row">
                        <div class="col-12 mb-3">
                          <div class="mb-1">
                            <label class="form-label" for="">Select Active Method</label>
                            <select name="commission_type" required id="" class="form-control">
                              <option value="">Select</option>
                              <option @if($pactive == 1) selected @endif value="1">Percentage</option>
                              <option @if($factive == 1) selected @endif value="2">Flat</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-1">
                              <label class="form-label" for="first-name-vertical">T+1 (%)</label>
                              <input type="number" id="first-name-vertical" class="form-control" name="t1_per" value="{{$t1_per}}" required/>
                            </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">T+2 (%)</label>
                            <input type="number" name="t2_per" id="" class="form-control" value="{{$t2_per}}" required/>
                          </div>
                        </div>
                        
                        <div class="col-6">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical"> T+1 (Flat)</label>
                            <input type="number" name="t1_flat" id="" class="form-control" value="{{$t1_flat}}" required/>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">T+2 (Flat)</label>
                            <input type="number" id="first-name-vertical" class="form-control" name="t2_flat" value="{{$t2_flat}}" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="col-12">
                          <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                          <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- Basic Vertical form layout section end -->    
                </div>    
            </div>      
        </section>
    </div>    
</div>  
@endsection