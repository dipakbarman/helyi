@extends('backend.master')
@section('body')
@php
  $master_distributor_per = "";
  $distributor_per = "";
  $master_distributor_flat = "";
  $distributor_flat = "";
  $pactive = "";
  $factive = "";
  $adminc = "";
  $masterc = "";
  $distibutorc = "";
  $commission_distributeq = DB::table('commission_distribute')->first();
  if(!empty($commission_distributeq)){
    $adminc = $commission_distributeq->admin;
    $masterc = $commission_distributeq->master_distributor;
    $distibutorc = $commission_distributeq->distributor;
  }
  $per_check = DB::table('commission')->where('type',1)->first();
  $flat_check = DB::table('commission')->where('type',2)->first();
  if(!empty($per_check)){
    $master_distributor_per = $per_check->master_distributor;
    $distributor_per = $per_check->distributor;
    $pactive = $per_check->active;
  }
  if(!empty($flat_check)){
    $master_distributor_flat = $flat_check->master_distributor;
    $distributor_flat = $flat_check->distributor;
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
            <h4 class="card-title">Commission</h4>
          </div>
          <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="card-body">
                  <form class="form form-vertical" method="post" action="{{ url('commission_settings_form') }}" onsubmit="validbtn()">
                    @csrf
                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="">Admin</label>
                        <input type="number" name="admin" value="{{$adminc}}" required class="form-control">
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="">Master distributor</label>
                        <input type="number" name="master_distributor" value="{{$masterc}}" required class="form-control">
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="">Distributor</label>
                        <input type="number" name="distributor" value="{{$distibutorc}}" required class="form-control">
                      </div>
                      <div class="col-md-4">
                        <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                      </div>
                    </div>
                  </form>
                    {{-- <form class="form form-vertical" method="post" action="{{ url('commission_form') }}" onsubmit="validbtn()">
                      @csrf
                      <div class="row">
                        <div class="col-12 mb-3">
                          <div class="mb-1">
                            <label class="form-label" for="">Select commission Active Method</label>
                            <select name="commission_type" required id="" class="form-control">
                              <option value="">Select</option>
                              <option @if($pactive == 1) selected @endif value="1">Percentage</option>
                              <option @if($factive == 1) selected @endif value="2">Flat</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Master Distributor (%)</label>
                            <input type="number" name="master_distributor_per" id="" class="form-control" value="{{$master_distributor_per}}" required/>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Distributor (%)</label>
                            <input type="number" id="first-name-vertical" class="form-control" name="distributor_per" value="{{$distributor_per}}" required/>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Master distributor (Flat)</label>
                            <input type="number" name="master_distributor_flat" id="" class="form-control" value="{{$master_distributor_flat}}" required/>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Distributor (Flat)</label>
                            <input type="number" id="first-name-vertical" class="form-control" name="distributor_flat" value="{{$distributor_flat}}" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="col-12">
                          <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                          <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </div>
                      </div>
                    </form> --}}
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